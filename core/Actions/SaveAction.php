<?php declare(strict_types=1);

namespace Core\Actions;

use SimpleTelegramBot\Chat\MessageHelper;
use Core\Repository\FileStorageRepository;
use SimpleTelegramBot\Connection\ConnectionService;

/**
 * Class SaveAction
 *
 * @package Core\Actions
 */
class SaveAction
{
    /**
     * @param object $update
     * @param ConnectionService $connectionService
     */
    public function __invoke(object $update, ConnectionService $connectionService): void
    {
        $repo = new FileStorageRepository();
        $messageHelper = new MessageHelper($connectionService);

        if (!$repo->checkOnExistUserData($update)) {
            $messageHelper->sendWithoutResponse($update->message->chat->id, 'Done.');
            $repo->saveDate($update);
        } else {
            $messageHelper->sendWithoutResponse($update->message->chat->id, 'Already saved.');
        }
    }
}