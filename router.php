  <?php

  $routes = [
    
    '/asdasd' => 'index.php',
    '/' => 'controllers/index.php',
    '/login' => 'controllers/login.php',
    '/registration' => 'controllers/registration.php',
    '/logout' => 'controllers/logout.php',
    '/stalls' => 'controllers/restaurants.php',
    '/your_orders' => 'controllers/your_orders.php',
  ];

  $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

  function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
      require $routes[$uri];
    } else {
      abort();
    }
  }

  function abort($code = 404) {
    http_response_code($code);
    require "views/$code.php";
    die();
  }

  routeToController($uri, $routes);