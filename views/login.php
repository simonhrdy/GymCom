<?php

use app\core\form\Form;
?>
<div class="section">
    <?php $form = Form::begin('', 'post', ['class' => 'form-group']) ?>
    <?php echo $form->field($model, 'email', 'input') ?>
    <?php echo $form->field($model, 'password', 'input') ?>
    <div class="form-group">
        <button type="submit"> Přihlásit se</button>
    </div>
    <?php echo app\core\form\Form::end() ?>
</div>