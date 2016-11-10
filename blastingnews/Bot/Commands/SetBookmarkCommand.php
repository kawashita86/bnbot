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

class SetBookmarkCommand extends Command
{
  /**
   * @var string Command Name
   */
  protected $name = "setbookmark";

  /**
   * @var string Command Description
   */
  protected $description = "Add a bookmark to the cache";

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
    $this->replyWithMessage(['text' => 'Adding your bookmark']);

    $this->replyWithChatAction(['action' => Actions::TYPING]);
    $args  = $this->getArguments();
    $author_id = 1;
    if($this->addBookmark($author_id, array('title' => $args[0], 'options' => $args[1], 'author_id' => 1)))
      $this->replyWithMessage(['text' => 'Bookmark added correctly']);
    else
      $this->replyWithMessage(['text' => 'Error while adding bookmark']);
  }

  protected function addBookmark($author_id, $bookmark){
    $bookmark = array(
      'title' => $bookmark['title'],
      'options' => $bookmark['options'],
      'author_id' => $author_id,
    );

    return $this->redis->set('c1:poll', json_encode($bookmark));
  }
}