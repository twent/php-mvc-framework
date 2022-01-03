<?php

namespace app\controllers;

use app\core\{App, Controller, Request, Response};
use app\models\{User, LoginForm};
use app\core\middlewares\AuthMiddleware;

class AuthController extends Controller
{
    public function __construct() 
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {   
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->data());
            if ($loginForm->validate() && $loginForm->login()) {
                App::$app->session->setFlash('success', App::$app->user->fullName(). ' Вы успешно авторизовались!');
                App::$app->response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $user = new User();

        if ($request->isPost()) {
            $user->loadData($request->data());
            if ($user->validate() && $user->save()) {
                App::$app->session->setFlash('success', 'Спасибо! Вы успешно зарегестрировались. На Ваш Email-адрес пришло письмо с ссылкой дял подтверждения аккаунта.');
                App::$app->response->redirect('/');
                exit;
            }

            return $this->render('register', [
                'model' => $user
            ]);
        }

        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function profile()
    {
        //App::$app->view->setTitle();
        return $this->render('profile');
    }

    public function logout(Request $request, Response $response)
    {
        App::$app->logout();
        $response->redirect('/');
    }


}