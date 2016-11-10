<?php


$app->get('/', function ($request, $response, $args) {
    // Sample log message
  $this->logger->info("Called index route");

    $this->telegram->addCommand(new BlastingNews\Bot\Commands\StartCommand());
    $result = $this->telegram->setWebhook(['url' => 'https://rocky-bastion-1679.herokuapp.com/44605275:AAG_nevQUgen0EiE2KQhiBfRBIxLGVPSebE/webhook']);
    $this->logger->info(print_r($result, 1));

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


$app->get('/webhook', function($request, $response, $args){

  $this->logger->info("Called index route");
// webhook.php
  $update = $this->telegram->commandsHandler(true);
  print_r($update);
  return;
});
