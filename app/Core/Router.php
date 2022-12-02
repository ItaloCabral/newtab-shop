<?php

namespace App\Core;

use App\Core\Classes\Request;
use CallbackFilterIterator;

class Router {
  protected $routes = [
      'GET' => [],
      'POST' => []
  ];
  public Request $request;

  public function __construct(Request $request) {
    $this->request = $request;
  }

  public function get($path, $callback) {
      $this->routes['GET'][$path] = $callback;
  }

  public function post($uri, $controller) {
      $this->routes['POST'][$uri] = $controller;
  }

  public function resolve() {
      $path = $this->request->getPath();
      $method = $this->request->getMethod();
      $callback = $this->routes[$method][$path] ?? false;

      if(!$callback) {
          echo "Not found";
          exit;
      }

      echo call_user_func($callback);
  }

  public function direct($uri, $requestType) {
      if (array_key_exists($uri, $this->routes[$requestType])) {
          return $this->routes[$requestType][$uri];
      }

      throw new \Exception('No route defined for this URI.');
  }
}
