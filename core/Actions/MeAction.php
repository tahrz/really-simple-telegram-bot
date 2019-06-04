<?php

namespace Core\Actions;

use Core\Repository\FileStorageRepository;
use SimpleTelegramBot\Helpers\MessageHelper;

/**
 * Class MeAction
 *
 * @package Core\Actions
 */
class MeAction
{
    /**
     * @param object $update
     */
    public function __invoke(object $update): void
    {
        $repo = new FileStorageRepository();

        if ($repo->checkOnExistUserData($update)) {
            $user = $repo->getDataByUserId($update->message->chat->username);
            MessageHelper::sendWithoutAnswer($update->message->chat->id, 'You are: ' . $user->firstName . ' ' . $user->lastName);
        } else {
            MessageHelper::sendWithoutAnswer($update->message->chat->id, 'I can`t remember you');
        }
    }
}