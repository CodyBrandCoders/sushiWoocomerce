<?php
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

if(isset($_GET["email"])) :

  $data = [
      'email'     => $_GET["email"],
      'status'    => 'subscribed',
  ];

  function syncMailchimp($data) {
      $apiKey = '{INSERT_API_KEY}'; // (string) - Can be found in your Mailchimp Backend
      $listId = '{INSERT_LIST_ID}'; // (string) - Can be found in your Mailchimp Backend

      $memberId = md5(strtolower($data['email']));
      $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
      $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

      $json = json_encode([
          'email_address' => $data['email'],
          'status'        => $data['status'],
      ]);

      $ch = curl_init($url);

      curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
      curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 10);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

      $result = curl_exec($ch);
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
      return $httpCode;
  }

  echo syncMailchimp($data);
endif;
