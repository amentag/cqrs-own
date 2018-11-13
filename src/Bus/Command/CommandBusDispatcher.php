<?php

namespace App\Bus\Command;

use App\Common\Command;
use App\Common\CommandHandler;
use App\Common\Infrastructure\CommandBusMiddleware;

class CommandBusDispatcher implements CommandBusMiddleware
{
    /**
     * @var CommandHandler[]
     */
    private $handlers;

    /**
     * CommandBusDispatcher constructor.
     *
     * @param CommandHandler[] $handlers
     */
    public function __construct(iterable $handlers)
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    public function dispatch(Command $command)
    {
        $commandClass = get_class($command);
        $handler = $this->handlers[$commandClass];


        $handler->handle($command);
    }
}