<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\UserForm;
use app\models\UserModel;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            //  Rule-based access control
            'access' => [
                // yii\filters\AccessControl
                'class' => AccessControl::className(),

                // yii\filters\AccessRule
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'ips' => ['192.168.0.80'],
                    ],
                    // everything else is denied
                ],

            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // Index, delete operation only accepts POST requests
                    'index' => ['get'],
                    'delete' => ['get'],
                    // Create, update accepts get, post request
                    'create' => ['get', 'post'],
                    'update' => ['get', 'post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        try {
            $userform = new UserForm();
            $userform->scenario = 'search';

            $dataProvider = $userform->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'userform' => $userform,
            ]);
        } catch (Exception $e) {

            print_r($e);
        }
    }

    public function actionCreate()
    {
        try {

            $userform = new UserForm();
            $userform->scenario = 'create';

            if (Yii::$app->request->isPost) {
                if ($userform->load(Yii::$app->request->post()) && $userform->validate()) {

                    //$collection = Yii::$app->mongodb->getCollection('user');
                    //$collection->insert([
                    //    'username' => $userform->username,
                    //    'password' => $userform->password,
                    //]);

                    $model = new UserModel();
                    $model->username = $userform->username;
                    $model->password = $userform->password;
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Added successfully！');
                    }
                }
            }

            return $this->render('create', ['userform' => $userform]);
        } catch (Exception $e) {

        }
    }

    public function actionUpdate($_id = null)
    {
        try {
            $userModel = $this->loadUser($_id);

            $userform = new UserForm();
            $userform->scenario = 'update';
            $userform->attributes = $userModel->attributes;

            if (Yii::$app->request->isPost && $userform->load(Yii::$app->request->post())) {

                $userModel->username = $userform->username;
                $userModel->password = $userform->password;

                if ($userModel->save()) {
                    Yii::$app->session->setFlash('success', 'Updated successfully！');
                }
            }

            return $this->render('update', ['userform' => $userform]);
        } catch (Exception $e) {

        }
    }

    public function actionDelete($_id = null)
    {
        try {

            $model = $this->loadUser($_id);

            if (Yii::$app->request->isGet) {

                //$_id = Yii::$app->request->get('_id');
                //$collection = Yii::$app->mongodb->getCollection('user');
                //$collection->remove(['_id' => $_id]);

                if ($model->delete()) {
                    Yii::$app->session->setFlash('success', "Successfully deleted！");
                }
            }

            return $this->redirect(['index']);
        } catch (Exception $e) {

        }
    }

    private function loadUser($_id)
    {

        //$query = new \yii\mongodb\Query();
        //$model = $query->from('user')->where(['_id' => $_id])->one();

        $model = UserModel::findOne(['_id' => $_id]);
        if (is_null($model)) {
            throw new \yii\web\NotFoundHttpException('Data does not exist！');
        }

        return $model;
    }
}
