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
		$allUsers = Yii::$app->db->createCommand('SELECT cu.id, cu.lastname, cu.firstname, cu.login, cr.title role, cu.user_card FROM crm_users cu
		LEFT JOIN crm_roles cr ON cu.role = cr.id		
		ORDER BY cu.id DESC limit 10
		')
            ->queryAll();
		$count = Yii::$app->db->createCommand('SELECT count(id) amount FROM crm_users')->queryAll();
		
		//var_dump($allUsers); exit;
		return $this->renderPartial('get_users',[
			'users' => $allUsers,
			'amount' => $count['0']['amount']
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
	public function actionGet_user_card(){
		$post = $_POST;
		if($post['id']){
			$id = $post['id'];
			$user_id = $post['user_id'];
			$query = Yii::$app->db->createCommand("
			SELECT * FROM crm_user_card WHERE id = $id
			")->queryAll();
			$user_info = Yii::$app->db->createCommand("
			SELECT lastname, firstname, role FROM crm_users WHERE id = $user_id
			")->queryAll();
			return $this->renderPartial('get_user_card',[
				'user_card' => $query['0'],
				'user_info' => $user_info['0']
			]);
		}else{
			return $this->renderPartial('add_user_card');
		}
	}
}
