<?php

namespace Core\Actions;

use Core\Repository\FileStorageRepository;
use SimpleTelegramBot\Helpers\MessageHelper;

/**
 * Class SaveAction
 * @package Core\Actions
 */
class SaveAction
{
    /**
     * @param object $update
     */
    public function __invoke(object $update): void
    {
        $repo = new FileStorageRepository();

        if (!$repo->checkOnExistUserData($update)) {
            MessageHelper::sendWithoutAnswer($update->message->chat->id, 'Done.');
            $repo->saveDate($update);
        } else {
            MessageHelper::sendWithoutAnswer($update->message->chat->id, 'Already saved.');
        }
    }
}