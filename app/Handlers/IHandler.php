<?php 

namespace App\Handlers;


interface IHandler {
    public function setNext(IHandler $handler): IHandler;

    public function handle(object $request): object;
}