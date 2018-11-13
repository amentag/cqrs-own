<?php

namespace App\Common;

interface CommandHandler
{
    public function handle(Command $command): void;

    public function listenTo(): string;
}