<?php
/* @var $this yii\web\View */

use \Yii;
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;

$this->title = 'Update user';
$this->params['breadcrumbs'][] = ['label' => 'User list', 'url'=>['user/index']];
$this->params['breadcrumbs'][] = ['label' => $this->title];


?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h4>Update user</h4>
                
                <?php $form = ActiveForm::begin([
                    'id' => 'update-form',
                    'method' => 'post',
                    'action' => ['user/update', '_id' => trim($userform->_id) ],
                ]); ?>

                    <?= $form->field($userform, 'username')->textInput() ?>

                    <?= $form->field($userform, 'password')->textInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-sm', 'name' => 'create-button']) ?>
                        <?= Html::resetButton('Reset', ['class' => 'btn btn-danger btn-sm', 'name' => 'reset-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
                

            </div>
        </div>

    </div>
</div>
