<?php

namespace Core\Repository;

/**
 * Class FileStorageRepository
 *
 * @package Core\Repository
 */
class FileStorageRepository implements RepositoryInterface
{
    /**
     * @param object $update
     * @return bool
     */
    public function saveDate(object $update): bool
    {
        $oldData = json_decode(file_get_contents(DATA_FILE), true);

        $newData[$update->message->chat->username] = [
            'firstName' => $update->message->chat->first_name,
            'lastName' => $update->message->chat->last_name,
        ];

        $data = fopen(DATA_FILE, 'w');
        fwrite($data, json_encode(array_merge($oldData ?? [], $newData)));

        return fclose($data);
    }

    /**
     * @param object $update
     * @return bool
     */
    public function checkOnExistUserData(object $update): bool
    {
        $data = json_decode(file_get_contents(DATA_FILE));
        $userName = $update->message->chat->username;

        return array_key_exists($userName, (array)$data);
    }

    /**
     * @param string $username
     * @return object
     */
    public function getDataByUserId(string $username): object
    {
        $data = json_decode(file_get_contents(DATA_FILE));

        return $data->$username;
    }
}