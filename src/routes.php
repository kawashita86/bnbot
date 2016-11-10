<?php


$app->get('/', function ($request, $response, $args) {
    // Sample log message
  $this->logger->info("Called index route");

    $this->telegram->addCommand(new BlastingNews\Bot\Commands\StartCommand());
    $result = $this->telegram->getUpdates();
    $this->logger->info(print_r($result, 1));
    print_r($result);

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
