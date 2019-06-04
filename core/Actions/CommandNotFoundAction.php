<?php

namespace Core\Actions;

use SimpleTelegramBot\Helpers\MessageHelper;

/**
 * Class CommandNotFoundAction
 *
 * @package Core\Actions
 */
class CommandNotFoundAction
{
    /**
     * @param object $update
     */
    public function __invoke(object $update): void
    {
        (new MessageHelper($update->message->chat->id, 'unsupported command!'))->sendWithArrayResponse();
    }
}