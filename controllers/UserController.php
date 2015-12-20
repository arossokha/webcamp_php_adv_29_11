<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\UploadedFile;

class UserController extends \yii\web\Controller
{
    public function actionProfile()
    {
        $model = Yii::$app->user->getIdentity();
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                /**
                 * @todo: move to before save
                 */
                $webFilePath = '/uploads/' . md5('userphoto_'.$model->getId()) . '.' . $model->file->extension;

                $model->file->saveAs(Yii::getAlias('@webroot').$webFilePath);
                $model->image = $webFilePath;


                $model->save(false);
            }
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all User models with ListView Widget
     * @return mixed
     */
    public function actionList()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPdf($id) {
        $user = $this->findModel($id);
        return $this->renderPartial('view',[
                'model' => $user
            ]);
    }

     /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

     /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
