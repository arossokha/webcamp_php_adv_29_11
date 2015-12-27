<?php

namespace app\controllers;

use Yii;
use app\models\Country;
use app\models\CountrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionActiveRecord() {

        $countryExists = Country::find()->where(['code' => 'PR'])->exists();
        if(!$countryExists) {
            $model = new Country();
            $model->name = 'Pery';
            $model->code = 'PR';
            if(!$model->save()) {
                var_dump($model->getErrors());
                return "Model not saved";
            }
        }

        $country = Country::findOne('UA');

        $countries = Country::findAll(['UA','GB']);

        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex()
    {
        // throw new \Exception("Error Processing Request", 1);

        Yii::trace('Load country index');
        $searchModel = new CountrySearch();
        Yii::trace(VarDumper::dumpAsString($searchModel));

        /**
         * replace theme on live site
         */
        $view = Yii::$app->get('view');
        $view->theme->pathMap['@app/views'] = '@app/themes/shadow';
        $view->theme->pathMap['@app/views'] = '@app/views';


        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $db = Yii::$app->get('db');
        $countryNames = $db->createCommand('SELECT name FROM country')
            ->queryColumn();
        Yii::trace("Country names:\n".VarDumper::dumpAsString($countryNames));


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'countryNames' => $countryNames,
            'message' => Yii::$app->session->getFlash('countryDeleted')
        ]);
    }

    /**
     * Displays a single Country model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Country model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Country();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Country model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Country model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('countryDeleted', Yii::t('app','You deleted country successfully.'));

        return $this->redirect(['index']);
    }

    /**
     * Finds the Country model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Country the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Country::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
