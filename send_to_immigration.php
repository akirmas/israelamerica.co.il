<?php



error_reporting(E_ALL);
ini_set('display_errors', 1);

const WEBHOOK_URL = 'https://usainvestmentspro.bitrix24.com/rest/22/omtj0zq688j93aa8/';

function requestToLog($data=null){
    $f = fopen('/var/www/usainvestmentspro.com/logs/send_to_immigration.txt', 'a+');
    fwrite($f, print_r(($data===null?$_REQUEST:$data), true));
    fclose($f);
}

function sendRequest($data, $url){
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_POSTFIELDS => $data,
    ));

    $result = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($result, 1);
    return $result;
}


function addLead($fields){
    $queryUrl = WEBHOOK_URL.'crm.lead.add.json';
    $queryData = http_build_query($fields);

    $result = sendRequest($queryData, $queryUrl);
    return $result['result'];
}

function getLeadDataFromRequestData($rawData){

    $result = array();

    if (isset($rawData['fields'])){
        $fields = $rawData['fields'];

//        $name_parts = explode(' ', preg_replace("/\s{2,}/", " ", preg_replace("/(\s+$|^\s+)/", "", $fields['name']['value'])));
        $first_name = $fields['first_name']['value'];
        $last_name = $fields['last_name']['value'];

        $result['TITLE'] = $first_name." ".$last_name;
        $result['NAME'] = $first_name?:"";
        $result['LAST_NAME'] = $last_name?:"";
        $result['EMAIL'] = array(array('VALUE' => $fields['email']['value'], 'VALUE_TYPE' => 'WORK'));
        $result['PHONE'] = array(array('VALUE' => $fields['phone']['value'], 'VALUE_TYPE' => 'WORK'));
        $result['SOURCE_ID'] = "WEB";
        //birth
        $result['UF_CRM_1544448526'] = $fields['birth_country']['value'];
        //residence
        $result['ADDRESS_COUNTRY'] = $fields['residence_country']['value'];
        $result['ASSIGNED_BY_ID'] = 12;


        return $result;
    }

    return false;
}

if ($lead_data = getLeadDataFromRequestData($_REQUEST)){

    addLead(array('fields' => $lead_data));

}