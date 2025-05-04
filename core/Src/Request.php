<?php

namespace Src;

use Error;


class Request
{
    protected array $body;
    public string $method;
    public array $headers;

    public function __construct()
    {
        $this->body = $_REQUEST;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->headers = getallheaders() ?? [];
    }

    public function all(): array
    {
        return $this->body + $this->files();
    }

    public function set(string $field, $value): void
    {
        $this->body[$field] = $value;
    }

    public function get(string $field, $default = null)
    {
        return $this->body[$field] ?? $default;
    }

    public function files(): array
    {
        return $_FILES;
    }

    public function __get(string $key)
    {
        return $this->get($key);
    }
}