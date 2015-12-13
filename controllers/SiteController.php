<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\Inflector;

use app\models\EntryForm;
use app\models\Country;
use app\models\RegistrationForm;
use yii\data\Pagination;
use yii\db\Expression;
use yii\db\Query;

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

    public function actionSql ()
    {
        $db = Yii::$app->getDb();
        $db = Yii::$app->db;
        $db = Yii::$app->get('db');
/**
 * query all
 */
        // $data = $db->createCommand('SELECT * FROM country')
        //     ->queryAll();

        // return '<pre>'.var_export($data,true);
/**
 * query one
 */
        // $data = $db->createCommand('SELECT * FROM country LIMIT 1')
        //     ->queryOne();

        // return '<pre>'.var_export($data,true);
        
/**
 * query scalar
 */
        // $data = $db->createCommand('SELECT COUNT(*) as `count` FROM country')->queryScalar();
        // $data = $db->createCommand('SELECT code FROM country LIMIT 1')->queryScalar();
        // $data = $db->createCommand('SELECT SUM(population) as `count` FROM country')->queryScalar();

        // return '<pre>'.var_export($data,true);
        

/**
 * bind params
 */
        // $populationLimit = 100000000;
        // $data = $db->createCommand('SELECT * FROM country WHERE population < :p ')->bindParam(':p',$populationLimit)
        //     ->queryAll();

        // return '<pre>'.var_export($data,true);
/**
 * execute sql
 */
   //  $executeResult = $db->createCommand('UPDATE country SET population=population + 1000')
   // ->execute();

   //      $data = $db->createCommand('SELECT * FROM country ')->queryAll();

   //      return '<pre>'.$executeResult.var_export($data,true);
/**
 * insert data and update with query builder
 */
        // $db->createCommand()->insert('country', [
        //     'name' => 'Ukraine',
        //     'code' => 'UA',
        //     'population' => 43000000,
        // ])->execute();
        
        //  $executeResult = $db->createCommand()->update('country',['population' => 1000])
        // ->execute();

        // $executeResult = $db->createCommand()->update('country',['population' => new Expression('population+10000')])
        // ->execute();

        // $data = $db->createCommand('SELECT * FROM country ')->queryAll();

        // return '<pre>'.var_export($data,true);
/**
 * query builder
 */
        $query = new Query();
        // $data = $query->select('name,code')
        // $data = $query->select(['code','name'])
        // $data = $query->select(['rename column' => 'code','name'])

        // ->from('country')
        // ->where(['name' => 'Canada','code' => 'AU'])
        // ->all();

        $data = $query->select(['code','name'])
        ->from('country')
        ->where(['like','name','Ca'])
        ->where(['like','name','C%',false])
        ->where(['like','name','C%',false])
        // ->where('name = :n',[':n' => 'Canada'])
        ->where(['or',['name' => 'Canada'],['name' => 'China']])
        ->where(['or',['or',['name' => 'Canada'],['name' => 'Ukraine']],['name' => 'China']])
        ->where(['in','code',['UA','GB']])
        ->andWhere(['>','population',10000])
        ->orWhere(['code'=>'CN'])
        ->all();

        /**
         * filters
         */
        $name = 'China';
        $code = null;
        $population = 1000;
        $data = $query->select(['code','name'])
        ->from('country')
        // ->filterWhere([
        //     'name' => $name,
        //     'code' => $code
        // ])
        ->filterWhere(['>','population',$population])
        // ->orderBy('code DESC')
        ->orderBy(['name' => SORT_DESC,'code' => SORT_ASC])
        ->limit(5)
        ->offset(1)
        ->all();

        return $this->render('sql',[
            'data' => $data
        ]);
    }

    public function actionIndex()
    {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy(['code' => SORT_DESC])
            -> where('population > 100')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }

    public function actionRegister()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegistrationForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
             return $this->render('reg-success', [
                'model' => $model,
            ]);;
        }
        return $this->render('register', [
            'model' => $model,
        ]);
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

    public function actionHello($message = "Hello world") {
        return $this->render('hello',[
                'message' => $message
            ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTestModel()
    {
        $model = new EntryForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->render('entry-confirm', [
                'model' => $model]
            );
        } else {
            return $this->render('entry', [
                'entry' => $model
            ]);
        }
    }
}
