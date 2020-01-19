<?php

require_once 'class_logger.php';

class IEO_CRM_Helper {

    public static $updateRealCrm = true;
    public static $allowedFormIds = ['4feb9e1', '348b45b'];
    public static $crmHookUrl = 'https://gobemark.info/rest/483/ya23gupm0zmpwajn';
    public static $tableLogName = 'ieo_crm_user_create_log';

    public static function updateCrmAfterSubmitOfRegisterForm(&$ajax_handler)
    {

        Logger::logDataToFile('postReceived', print_r($_POST, 1));

        //Here we need to check if exact register form has been submitted.
        if(!in_array($_POST['form_id'], self::$allowedFormIds))
            return;

        $email = $_POST['form_fields']['email'];
        $fullName = $_POST['form_fields']['field_1'];
        $phone = $_POST['form_fields']['field_2'];

        //Here maybe validation of fields

        $crmHookUrl = self::$crmHookUrl;
        $crmMethod = 'crm.lead.add';
        $crmRequestFormat = 'json';
        $nowWeSendRequestTo = $crmHookUrl . '/' . $crmMethod . '.' . $crmRequestFormat;

        $queryData = array(
            'fields' => array(
                "TITLE" => $fullName,
                "STATUS_ID" => "NEW",
                "OPENED" => "Y",
                "PHONE" => array(array("VALUE" => $phone, "VALUE_TYPE" => "WORK" )),
                "EMAIL" => array(array("VALUE" => $email, "VALUE_TYPE" => "WORK" )),
            ),
            'params' => array("REGISTER_SONET_EVENT" => "N")
        );
        Logger::logDataToFile('queryDataToCRM', print_r($queryData, 1));

        if(self::$updateRealCrm){

            $queryData = http_build_query($queryData);

            $result = wp_remote_post( $nowWeSendRequestTo, [
                'body' => $queryData,
            ]);

            Logger::logDataToFile('crmRequestResult', print_r($result, 1));
            $updateResultArray = json_decode($result['body'], 1);
            $updateResultLeadId = $updateResultArray['result'];

            if(empty($updateResultLeadId))
                $updateResultLeadId = 0;
            //If created lead id returned
            if($updateResultLeadId){

                Logger::logDataToFile('leadWasCreated', $email . ' : ' . $updateResultLeadId);
                $ajax_handler->data['output'] = 'TNX lead was created!';

            } else {

                Logger::logDataToFile('leadWasNotCreated', $email);
                $ajax_handler->data['output'] = 'Sorry, lead was not created!';

            }

            $dbLogInsertData = [];
            $dbLogInsertData['email'] = $email;
            $dbLogInsertData['fullName'] = $fullName;
            $dbLogInsertData['phone'] = $phone;
            $dbLogInsertData['leadId'] = $updateResultLeadId;
            $dbLogInsertData['encodedPostData'] = json_encode($_POST);

            self::storeCRMUpdateRequestToDbLog($dbLogInsertData);

        }


    }

    public static function storeCRMUpdateRequestToDbLog($insertData)
    {

        global $wpdb;

        $email = $insertData['email'];
        $fullName = $insertData['fullName'];
        $phone = $insertData['phone'];
        $leadId = $insertData['leadId'];
        $encodedPostData = $insertData['encodedPostData'];

        $wpdb->insert(
            self::$tableLogName,
            array(
                'email' => $email,
                'full_name' => $fullName,
                'phone' => $phone,
                'lead_id' => $leadId,
                'encoded_post_data' => $encodedPostData,
            ),
            array(
                '%s',
                '%s',
                '%s',
                '%d',
                '%s',
            )
        );

        if($wpdb->last_error !== ''){
            Logger::logDataToFile('lastDbPaymentLogError', $email . ":\n" . print_r($wpdb->last_error, 1));
        }

        $insertId = $wpdb->insert_id;
        Logger::logDataToFile('wpdbInsertIdPaymentLog', $insertId);

        if(empty($insertId)){
            //throw new \Exception('Empty insert ID into payment log for email: ' . $email);
            Logger::logDataToFile('wpdbInsertIdIsEmpty', $encodedPostData);
        }


    }


}