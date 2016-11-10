<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 10/11/16
 * Time: 15.51
 */

namespace BlastingNews\Bot\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class HelpCommand extends Command
{
  /**
   * @var string Command Name
   */
  protected $name = "help";

  /**
   * @var string Command Description
   */
  protected $description = "A list of action you can ask the bot";

  /**
   * @inheritdoc
   */
  public function handle($arguments)
  {
    $this->replyWithMessage(['text' => 'Hello! Welcome to our bot, Here are our available commands:']);

    // This will update the chat status to typing...
    $this->replyWithChatAction(['action' => Actions::TYPING]);

    // This will prepare a list of available commands and send the user.
    // First, Get an array of all registered commands
    // They'll be in 'command-name' => 'Command Handler Class' format.
    $commands = $this->getTelegram()->getCommands();

    // Build the list
    $response = '';
    foreach ($commands as $name => $command) {
      $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
    }

    // Reply with the commands list
    $this->replyWithMessage(['text' => $response]);
  }

}