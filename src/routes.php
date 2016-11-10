<?php


$app->get('/', function ($request, $response, $args) {
    // Sample log message
  $this->logger->info("Called index route");

    $this->telegram->addCommand(new BlastingNews\Bot\Commands\StartCommand());
    $result = $this->telegram->getMe();
    $this->logger->info(print_r($result, 1));
    print_r($result);

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/sethook', function($request, $response, $args){
  $this->logger->info("Called sethook route");
  $response = $this->telegram->setWebhook(['url' => 'https://rocky-bastion-1679.herokuapp.com/webhook']);
  print_r($response);
  return;
});


$app->get('/webhook', function($request, $response, $args){

  $this->logger->info("Called webhook route");
// webhook.php
 // $update = $this->telegram->commandsHandler(true);

  $updates = $this->telegram->getWebhookUpdates();
  print_r($updates);
  return;
});
