<?php declare(strict_types=1);

namespace Core\Actions;

use SimpleTelegramBot\Chat\MessageHelper;
use Core\Repository\FileStorageRepository;
use SimpleTelegramBot\Connection\ConnectionService;

/**
 * Class MeAction
 *
 * @package Core\Actions
 */
class MeAction
{
    /**
     * @param object $update
     * @param ConnectionService $connectionService
     */
    public function __invoke(object $update, ConnectionService $connectionService): void
    {
        $repo = new FileStorageRepository();
        $messageHelper = new MessageHelper($connectionService);

        if ($repo->checkOnExistUserData($update)) {
            $user = $repo->getDataByUserName($update->message->chat->username);
            $messageHelper->sendWithoutResponse($update->message->chat->id, 'You are: ' . $user->firstName . ' ' . $user->lastName);
        } else {
            $messageHelper->sendWithoutResponse($update->message->chat->id, 'I can`t remember you');
        }
    }
}