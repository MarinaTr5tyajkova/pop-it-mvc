<?php
namespace Controller;
use Src\View;
class Site {
    public function index(): string {
        return new View('site.hello', ['message' => 'Index работает!']);
    }

    public function hello(): string {
        return new View('site.hello', ['message' => 'Hello работает!']);
    }
}