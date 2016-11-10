<?php


$app->get('/', function ($request, $response, $args) {
    // Sample log message
  $this->logger->info("Called index route");

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


$app->post('/webhook', function($request, $response, $args){

  $this->logger->info("Called webhook route");
// webhook.php
  $this->telegram->addCommand(new BlastingNews\Bot\Commands\StartCommand());
  $this->telegram->addCommand(new BlastingNews\Bot\Commands\HelpCommand());
  $this->telegram->addCommand(new BlastingNews\Bot\Commands\SetBookmarkCommand($this->redis));
  $update = $this->telegram->commandsHandler(true);
  $this->logger->info("Data ". print_r($update,1));
  return;
});
