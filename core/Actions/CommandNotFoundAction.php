<?php declare(strict_types=1);

namespace Core\Actions;

use SimpleTelegramBot\Chat\MessageHelper;
use SimpleTelegramBot\Connection\ConnectionService;

/**
 * Class CommandNotFoundAction
 *
 * @package Core\Actions
 */
class CommandNotFoundAction
{
    /**
     * @param object $update
     * @param ConnectionService $connectionService
     */
    public function __invoke(object $update, ConnectionService $connectionService): void
    {
        $messageHelper = new MessageHelper($connectionService);
        $messageHelper->sendWithoutResponse($update->message->chat->id, 'unsupported command!');
    }
}