<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['telegram'] = function($c) {
    $settings = $c->get('settings')['telegram'];
    $api_token = getenv('TELEGRAM_API_KEY');
    if($api_token == false || empty($api_token))
      throw \Exception('Invalid api token');
    $telegram = new Telegram\Bot\Api($api_token);
    return $telegram;
};

$container['redis'] = function($c) {
  return new Predis\Client(getenv('REDIS_URL'));
};
