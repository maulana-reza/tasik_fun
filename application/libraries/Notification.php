<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notification {

    public static $API_ACCESS_KEY = "AAAAsvBbgiE:APA91bGSyOKlxdbJqaMNbXK1pdCMfDtAlu5LxwjzYjKGqWBJjbmYVTuPG8UMbhzPv_yd08OlbKuhMluhXTI1Y-7EulylcUt7fhlD-bt4LM1VuSHc1B4BIW2_wWAOD_V_0a9_Q-gaIGKx";
    /**
     * Push notifikasi using firabase
     * 
     * @param array device_token
     * @param string title
     * @param string message
     * @param string url
     * @param string type
     * @return mmixed
     * 
     */

    static function pushNotification($deviceToken, $title, $message, $url = null, $type = 0) {
        $host = "https://fcm.googleapis.com/fcm/send";
        $msg = array
        (
            'body'   => $message,
            'title'     => $title,
            'tag'       => $url,
        );
        $headers = [
            'Authorization: key='.self::$API_ACCESS_KEY,
            'Content-Type: application/json' 
        ];
    
        $ch = curl_init();            
        
        curl_setopt($ch, CURLOPT_URL, $host);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'registration_ids' => $deviceToken,
            'notification' => $msg
        ]));
        $result = curl_exec($ch);
        if ($result === false) {
            return false;
        }
        curl_close($ch);
        return $result;
    }
}