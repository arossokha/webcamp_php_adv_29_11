<?php

namespace app\controllers;

use Yii;
use app\models\User;
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

}
