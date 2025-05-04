<?php
namespace Src;

use Error;

class Route {
    private static array $routes = [];
    private static string $prefix = '';

    public static function setPrefix($value): void {
        self::$prefix = $value;
    }

    public static function add(string $route, array $action): void {
        if (!array_key_exists($route, self::$routes)) {
            self::$routes[$route] = $action;
        }
    }

    public function start(): void {
        $path = explode('?', $_SERVER['REQUEST_URI'])[0]; // Убираем GET-параметры

        // Обрезаем префикс
        if (self::$prefix) {
            $path = substr($path, strlen(self::$prefix));
        }

        // Удаляем начальный и конечный слэши
        $path = trim($path, '/');

        // УБИРАЕМ ОТЛАДОЧНУЮ ИНФОРМАЦИЮ
        // echo "Requested path: '$path'\n"; // Выводим путь для отладки
        // echo "Available routes: " . print_r(array_keys(self::$routes), true) . "\n"; // Все доступные маршруты

        // Проверяем, существует ли маршрут
        if (!array_key_exists($path, self::$routes)) {
            http_response_code(404);
            echo "Page not found";
            return;
        }

        $class = self::$routes[$path][0];
        $action = self::$routes[$path][1];

        if (!class_exists($class)) {
            throw new Error('This class does not exist');
        }

        if (!method_exists($class, $action)) {
            throw new Error('This method does not exist');
        }

        call_user_func([new $class, $action], new Request());
    }
}