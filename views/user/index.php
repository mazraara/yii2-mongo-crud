<?php
/* @var $this yii\web\View */
use \Yii;
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use \yii\helpers\Url;

$this->title = 'User list';
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h4><a href="<?= Url::toRoute(['user/create'])?>">Add user</a></h4>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-lg-12">
                <p>Retrieve user</p>
                
                <?php $form = ActiveForm::begin([
                    'id' => 'create-form',
                    'method' => 'get',
                    'action' => ['user/index'],
                    'fieldConfig' => [ 
                        //'template' => "{input}",
                    ],
                ]); ?>

                    <?= $form->field($userform, 'username')->textInput() ?>

                    <?= $form->field($userform, 'password')->textInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-sm', 'name' => 'create-button']) ?>
                        <?= Html::resetButton('Empty', ['class' => 'btn btn-danger btn-sm', 'name' => 'reset-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
                
            </div>
        </div>
        
        
        
        <div class="row">
            <div class="col-lg-12">
                <h4>User list</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-condensed">
                        <tr>
                            <th class="center">ID</th>
                            <th class="center">username</th>
                            <th class="center">password</th>
                            <th class="center">created at</th>
                            <th class="center">updated at</th>
                            <th class="center">actions</th>
                        </tr>
                        <?= $listview = \yii\widgets\ListView::widget([
                                'dataProvider' => $dataProvider,
                                'viewParams'=>[],
                                //'itemOptions' => ['class' => 'items', 'tag' => false,],
                                'itemView' => '_view',
                                #Set the table content, pagination, summary location
                                'layout' => "{items} </table> \n{summary}\n {pager}",
                                #Set the display format of the summary
                                'summary' => '<div class="summary">{begin} - {end} / {totalCount}</div>',
                                #Custom paging component
                                'pager' => ['class'=>'app\components\widgets\LinkPager'],
                            ]); ?>

                    </table>
                </div>
                
            </div>
        </div>

    </div>
</div>
