<?php

class Logger {

    public static $logDir = CURRENT_WEBSITE_DIR . '/wp-content/plugins/ieo_crm_sync/logs';

    public static function logDataToFile($logName, $dataToLog, $isQATest = false)
    {

        $additionalPath = '';
        $logName = self::addDateToNameIfNeeded($logName);

        $logPath = self::$logDir;
        if(!empty($additionalPath)){
            $logPath =  $logPath . $additionalPath;
            if(!is_dir($logPath)){
                mkdir($logPath);
            }
        }
        $filePath = $logPath . '/' . $logName;

        $date = new DateTime();
        $date = $date->format("y.m.d / h:i:s");
        file_put_contents($filePath,  "[$date]" . ' : ' . $dataToLog . "\n", FILE_APPEND);

    }

    public static function addDateToNameIfNeeded($logName)
    {

        $date = new DateTime();
        $date = $date->format('y_m_d');

        if($logName === 'raw_response.txt')
            $logName = 'raw_response_' . $date . '.txt';

        return $logName;

    }

}