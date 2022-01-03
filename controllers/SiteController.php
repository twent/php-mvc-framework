<?php

namespace app\controllers;
use twent\mvccore\{App,Controller,Request,Response};
use app\models\ContactForm;

class SiteController extends Controller
{
    public function index()
    {
        $params = [
            'title' => 'Главная',
            'user_name' => 'Ярослав'
        ];
        return $this->render('index', $params);
    }

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->data());
            if ($contact->validate() && $contact->send()) {
                App::$app->session->setFlash('success', 'Вы успешно отправили сообщение. Постараемся рассмотреть его в ближайшее время');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }

}
