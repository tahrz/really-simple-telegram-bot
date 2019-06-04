<?php

namespace Core\Base;

use ReflectionClass;
use ReflectionException;
use Core\Actions\CommandNotFoundAction;

/**
 * Class Commander
 *
 * @package Core\Base
 */
class Commander
{
    /**
     * @var object
     */
    private $update;

    /**
     * @var array
     */
    private $commands = [];

    /**
     * Commander constructor.
     *
     * @param object $update
     */
    public function __construct(object $update)
    {
        $this->update = $update;
    }

    /**
     * @param string $command
     * @param string $action
     */
    public function command(string $command, string $action): void
    {
        $this->commands[$command] = $action;
    }

    /**
     * @return object
     * @throws ReflectionException
     */
    public function run(): object
    {
        if (isset($this->commands[$this->update->message->text])) {
            return (new ReflectionClass($this->commands[$this->update->message->text]))->newInstance()($this->update);
        }

        return (new CommandNotFoundAction())($this->update);
    }
}