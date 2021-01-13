<?php
class Route
{
    private $routes;

    public function __construct()
    {
        $route = [

            'edit' => 'task/edit',
            'edit/(.+)' => 'task/edit/$1',
            'add' => 'task/index/$1',
            'auth' => 'auth/index',
            'logout' => 'main/logout',
            '(.+)' => 'main/index/$1',
            '' => 'main/index',

        ];

        $this->routes = $route;

    }


    public function run()
    {

        $url = trim($_SERVER['REQUEST_URI'], '/');

        foreach ($this->routes as $urlPattern => $path) {

            if (preg_match("~$urlPattern~", $url)) {

                $internalRoute = preg_replace("~$urlPattern~", $path, $url);

                $param = explode('/', $internalRoute);

                $controllerName = array_shift($param) . 'Controller';

                $controllerName = ucfirst($controllerName);

                $actionName = 'Action' . ucfirst(array_shift($param));

                $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {

                    include_once($controllerFile);

                }

                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $param);

                if ($result != null) {
                    break;
                }

            }
        }
    }
}