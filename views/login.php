<?php

/** @var $this \twent\mvccore\View */
$this->title = 'Вход';

/** @var @model \app\models\User */
use twent\mvccore\form\Form;

echo '<h1>Вход</h1>';
$form = Form::begin('', 'post');
echo $form->field($model, 'email')->emailField();
echo $form->field($model, 'password')->passwordField();
echo '<div class="mb-3 form-check">
        <input name="privacy" type="checkbox" class="form-check-input" required>
        <label class="form-check-label">С условиями использования сайта согласен</label>
        <div class="invalid-feedback">
          Please enter a message in the textarea.
        </div>
      </div>';
echo '<button type="submit" class="btn btn-primary">Войти</button>';
Form::end();
