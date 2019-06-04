<?php

namespace Core\Repository;

/**
 * Interface RepositoryInterface
 */
interface RepositoryInterface
{
    /**
     * @param object $update
     * @return bool
     */
    public function saveDate(object $update): bool;

    /**
     * @param object $update
     * @return bool
     */
    public function checkOnExistUserData(object $update): bool;

    /**
     * @param string $username
     * @return object
     */
    public function getDataByUserId(string $username): object;
}