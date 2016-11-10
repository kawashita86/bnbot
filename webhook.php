<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 09/11/16
 * Time: 18.34
 */

include('vendor/autoload.php');

use Telegram\Bot\Api;
$hook_url = 'https://yourdomain/44605275:AAG_nevQUgen0EiE2KQhiBfRBIxLGVPSebE/webhook.php';
$telegram = new Api('44605275:AAG_nevQUgen0EiE2KQhiBfRBIxLGVPSebE');


// webhook.php
$update = $telegram->commandsHandler(true);