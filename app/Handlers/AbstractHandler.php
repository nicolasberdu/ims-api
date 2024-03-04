<?php
namespace App\Handlers;

abstract class AbstractHandler implements IHandler
{
    /**
     * @var IHandler
     */
    private $nextHandler;

    public function setNext(IHandler $handler): IHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(object $request): object {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($request);
        }

        return null;
    }
}