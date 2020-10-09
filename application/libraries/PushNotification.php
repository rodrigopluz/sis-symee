<?php

if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

/**
 * PushNotification Library
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class PushNotification
 */
class PushNotification
{
    // Android - API access key from Google API's Console.
    private static $API_ACCESS_KEY = 'AAAAC2L3dx4:APA91bGQTmTbX-DDvOkVowEkEWAH2bRY8h8-ymBJzQD4P5FNjTlbUg5rXwfGru8LRvRLZQK2HvMl9lnhjFvbkIpQ44f4y9D0mXR96JEKSrP9YwpznahG3JVjGh4F4hz08IzFhxjzv47C';

    // iOS - private key's passphrase.
    private static $passphrase = '';

    // change the above three vriables as per your app.
    public function __construct()
    {
    }

    // sends push notification for Android users
    public function android($not, $data, $reg_id)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $end_date = null;

        switch($not) {
            /** notificacao-vinculo */
            case 'NV':
                $notification = [
                    'title' => 'Novo Contrato de Trabalho',
                    'body' => 'Você aceita a solicitação ?',
                    'sound' => 'default',
                    'click_action' => 'FCM_PLUGIN_ACTIVITY',
                    'icon' => 'fcm_push_icon'
                ];
                break;
            /** notificacao-cancelamento */
            case 'NC':
                $notification = [
                    'title' => 'Cancelamento do Contrato de Trabalho',
                    'body' => 'Informação de Cancelamento',
                    'sound' => 'default',
                    'click_action' => 'FCM_PLUGIN_ACTIVITY',
                    'icon' => 'fcm_push_icon'
                ];

                $end_date = $data['data_end'];
                break;
            /** notificacao-refresh */
            case 'NR':
                $notification = [
                    'title' => 'Reenvio de Contrato de Trabalho',
                    'body' => 'Você aceita a solicitação ?',
                    'sound' => 'default',
                    'click_action' => 'FCM_PLUGIN_ACTIVITY',
                    'icon' => 'fcm_push_icon'
                ];
        }
        
        $message = [
            'employe' => $data['person_name'],
            'function' => $data['function_name'],
            'start_date' => $data['data_start'],
            'end_date' => $end_date,
            'id_contract' => $data['id_contract'],
            'id_notification' => $data['id_notification'],
        ];

        $headers = [
            'Authorization: key=' .self::$API_ACCESS_KEY,
            'Content-Type: application/json'
        ];

        $fields = [
            'notification' => $notification,
            'data' => $message,
            'to' => $reg_id,
            'priority' => 'high',
            'restricted_package_name' => ''
        ];

        return self::useCurl($url, $headers, json_encode($fields));
    }

    // sends push notification for iOS users
    public function iOS($data, $devicetoken)
    {
        $deviceToken = $devicetoken;
        $ctx = stream_context_create();

        // ck.pem is your certificate file
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', self::$passphrase);

        // open a connection to the APNS server
		$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        
        if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);
        
        // create the payload body
		$body['aps'] = [
			'alert' => [
			    'title' => $data['mtitle'],
                'body' => $data['mdesc'],
            ],
			'sound' => 'default'
        ];
        
        // encode the payload as JSON
		$payload = json_encode($body);
        
        // build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        
        // send it to the server
		$result = fwrite($fp, $msg, strlen($msg));
		
		// close the connection to the server
		fclose($fp);
        
        if (!$result)
			return 'Message not delivered' . PHP_EOL;
		else
			return 'Message successfully delivered' . PHP_EOL;
    }

    // curl 
    private function useCurl($url, $headers, $fields = null)
    {
        // open connection
        $ch = curl_init();
        if ($url) {
            // set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     
            // disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            if ($fields) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            }
     
            // execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
     
            // close connection
            curl_close($ch);

            return $result;
        }
    }
}