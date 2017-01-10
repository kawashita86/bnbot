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

class SemaphoreCommand extends Command
{
  /**
   * @var string Command Name
   */
  protected $name = "semaphore";

  protected $operations = array('set', 'remove');

  protected $semaphore = false;

  protected $chat_id = false;

  /**
   * @var string Command Description
   */
  protected $description = "Manage semaphore for bn deploy";

  protected $redis;

  public function __construct($redis = null)
  {
    $this->redis = $redis;
  }

  /**
   * @inheritdoc
   */
  public function handle($arguments)
  {
    $this->replyWithMessage(['text' => 'Trying to set semaphore']);

    $this->replyWithChatAction(['action' => Actions::TYPING]);
    $args  = $this->getArguments();
    if(empty($operation = $args[0]) && !in_array($args[0], $this->operations))
      $this->replyWithMessage(['text' => 'Invalid operation type']);
    else {
      if (!$this->setSemaphore($operation))
        $this->replyWithMessage(['text' => 'Bookmark added correctly']);
      else
        $this->replyWithMessage(['text' => 'Error setting  adding bookmark already set '.$operation]);
    }
  }

  protected function setSemaphore($operation){
    $this->chat_id = $this->getUpdate()->getMessage()->getChat()->getId();
    $username = $this->getUpdate()->getMessage()->getChat()->getUsername();

    $semaphore_info = array(
      'operation' => $operation,
      'chat_id' => $this->chat_id,
      'username' => $username
    );
    $this->semaphore = $this->getSemaphore();
    if($this->semaphore === false) {
      $this->semaphore = $semaphore_info;
      return $this->redis->set('c1:semaphore', json_encode($semaphore_info));
    }
    if($this->semaphore['chat_id'] != $this->chat_id)
      return false;

    if($this->semaphore['operation'] == $operation)
      return false;

    $this->semaphore = $semaphore_info;
    if($operation == 'remove')
      return $this->redis->delete('c1:semaphore', json_encode($semaphore_info));
    return $this->redis->set('c1:semaphore', json_encode($semaphore_info));
  }

  public function getSemaphore(){
    return $this->redis->get('c1:semaphore');
  }
}