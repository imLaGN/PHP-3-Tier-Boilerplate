<?php

namespace App;

class Router
{
    // Array of routes
    private array $routes = [];

    // Array of forbidden items
    private static array $forbidden = ['.htaccess', 'config.xml', 'autoload.php'];
    
    /**
     * Adds a new route to local $routes array
     * @param \App\HttpMethod $method
     * @param string $path
     * @param callable|array $callback
     * @return void
     */
    public function addRoute(HttpMethod $method, string $path, callable|array $callback): void
    {
        // Convert route parameters to regex pattern
        $pattern = preg_replace('/\{([a-zA-Z]+)\}/', '(?P<$1>[^/]+)', $path);
        $pattern = "#^$pattern$#";

        var_dump($method);
        $this->routes[$method->value][$pattern] = $callback;
    }
    
    /**
     * Resolves current server request
     * @return mixed
     */
    public function resolve(): mixed
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $path = explode('?', $path)[0];

        // Block access to hidden/system files
        $temp_path = parse_url($path, PHP_URL_PATH); //Clean path - removes URI's queries
        $filename = basename($temp_path);   //Gets the path filename
        if (in_array($filename, $this::$forbidden)) {
            http_response_code(404);
            return "404 Not Found";
        }
        
        // Filters through routes
        foreach ($this->routes[$method] ?? [] as $pattern => $callback) {
            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter(
                    $matches, 
                    fn($key) => !is_numeric($key), 
                    ARRAY_FILTER_USE_KEY
                );
                
                if (is_array($callback)) {
                    [$class, $method] = $callback;
                    $controller = new $class();
                    return $controller->$method($params);
                }
                
                return $callback($params);
            }
        }
        
        // Failed to match to a route
        http_response_code(404);
        return "404 Not Found";
    }
}


// Support objects
enum HttpMethod: string {
    case Get = 'GET';
    case Post = 'POST';
    case Put = 'PUT';
    case Delete = 'DELETE';
}