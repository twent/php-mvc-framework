<?php
/** @var $this \twent\mvccore\View */
/** @var $model \app\models\ContactForm */

use twent\mvccore\form\{Form,TextareaField};

$this->title = 'Обратная связь';

echo "<h1>$this->title</h1>";
$form = Form::begin('', 'post');
echo $form->field($model, 'subject');
echo $form->field($model, 'email')->emailField();
echo new TextareaField($model, 'text');
echo '<button type="submit" class="btn btn-primary">Отправить</button>';
Form::end();
