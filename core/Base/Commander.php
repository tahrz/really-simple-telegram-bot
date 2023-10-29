<?php declare(strict_types=1);

namespace Core\Base;

use ReflectionClass;
use ReflectionException;
use Core\Actions\CommandNotFoundAction;
use SimpleTelegramBot\Connection\ConnectionService;

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
     * @var ConnectionService 
     */
    private $connectionService;

    /**
     * @var array
     */
    private $commands = [];

    /**
     * Commander constructor.
     *
     * @param object $update
     * @param ConnectionService $connectionService
     */
    public function __construct(object $update, ConnectionService $connectionService)
    {
        $this->update = $update;
        $this->connectionService = $connectionService;
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
    public function run(): void
    {
        if (isset($this->commands[$this->update->message->text])) {
            (new $this->commands[$this->update->message->text])(
                $this->update,
                $this->connectionService
            );
        }

        (new CommandNotFoundAction())($this->update, $this->connectionService);
    }
}