<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 09/11/16
 * Time: 18.20
 */

include('vendor/autoload.php');

use Telegram\Bot\Api;
$hook_url = 'https://yourdomain/path/to/hook.php';
$is_hook = false;

$telegram = new Api('44605275:AAG_nevQUgen0EiE2KQhiBfRBIxLGVPSebE');
$telegram->addCommand(new BlastingNews\Bot\Commands\StartCommand());
//https://api.telegram.org/bot44605275:AAG_nevQUgen0EiE2KQhiBfRBIxLGVPSebE/getMe');
if($is_hook){
  $result = $telegram->setWebhook(['url' => $hook_url]);
  if($result->getBody()){

  }
} else {
  $response = $telegram->getUpdates();

}

