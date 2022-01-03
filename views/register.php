<?php

use twent\mvccore\form\Form;

/** @var $this \twent\mvccore\View */
$this->title = 'Регистрация';

echo "<h1>$this->title</h1>";
$form = Form::begin('', 'post');
echo $form->field($model, 'name');
echo $form->field($model, 'lastname');
echo $form->field($model, 'email')->emailField();
echo $form->field($model, 'password')->passwordField();
echo $form->field($model, 'password_repeat')->passwordField();
echo '<div class="mb-3 form-check">
        <input name="privacy" type="checkbox" class="form-check-input" required>
        <label class="form-check-label">С условиями использования сайта согласен</label>
        <div class="invalid-feedback">
            Please enter a message in the textarea.
        </div>
      </div>';
echo '<button type="submit" class="btn btn-primary">Отправить</button>';
Form::end();
