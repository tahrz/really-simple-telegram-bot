<?php declare(strict_types=1);

namespace Core\Actions;

use SimpleTelegramBot\Helpers\MessageHelper;

/**
 * Class StartAction
 *
 * @package Core\Actions
 */
class StartAction
{
    /**
     * @param object $update
     */
    public function __invoke(object $update): void
    {
        MessageHelper::sendWithoutAnswer($update->message->chat->id, 'Hi! For saving use /save, for getting data about you, use /me');
    }
}