<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionAbout()
    {
        return $this->render('about');
    }
	public function actionAdd_user_form(){		
		return $this->renderPartial('add_user_form');
	}
	public function actionGet_users(){			
		$allUsers = Yii::$app->db->createCommand('SELECT cu.lastname, cu.firstname, cu.login, cr.title role FROM crm_users cu
		LEFT JOIN crm_roles cr ON cu.role = cr.id
		')
            ->queryAll();	
			
		return $this->renderPartial('get_users',[
			'users' => $allUsers
		]);
	}
	public function actionAdd_users(){
		$post = $_POST;
		$data = [];
		foreach($post['arrayOfData'] as $val){
			$data[$val['0']] = $val['1'];
		}
		
		$query = Yii::$app->db->createCommand()->insert('crm_users',[
			'lastname' => $data['lastname'],
			'firstname' => $data['firstname'],
			'login' => $data['login'],
			'password' => $data['password'],
			'role' => $data['role']
		])->execute();
	}
}
