<?php

namespace app\core;
use app\core\db\Database;
use app\Models\{User};

class App
{
    const EVENT_BEFORE_REQUEST = 'beforeRequest';
    const EVENT_AFTER_REQUEST = 'afterRequest';

    public static App $app;
    public static string $ROOT_DIR;
    public string $userClass;
    public Router $router;
    public ?Controller $controller = null;
    public Request $request;
    public Response $response;
    public Database $db;
    public Session $session;
    public ?UserModel $user;
    public string $layout = 'index';
    public View $view;

    public function __construct($rootPath, array $config)
    {
        $this->user = null;
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $this->db = new Database($config['db']);
        $this->session = new Session();

        $userId = App::$app->session->get('user');
        if ($userId) {
            $key = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$key => $userId]);
        }
    }

    public function run()
    {
        $this->triggerEvent(self::EVENT_BEFORE_REQUEST);
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e,
            ]);
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $value = $user->{$primaryKey};
        App::$app->session->set('user', $value);

        return true;
    }

    public function logout()
    {
        $this->user = null;
        self::$app->session->remove('user');
    }

    public function triggerEvent($eventName)
    {
        $callbacks = $this->eventListeners[$eventName] ?? [];
        foreach ($callbacks as $callback) {
            call_user_func($callback);
        }
    }

    public function on($eventName, $callback)
    {
        $this->eventListeners[$eventName][] = $callback;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController(Controller $controller)
    {
        return $this->controller = $controller;
    }

}
