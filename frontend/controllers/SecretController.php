<?php

namespace frontend\controllers;

use frontend\models\Secret;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SecretController implements the CRUD actions for Secret model.
 */
class SecretController extends Controller
{
    public $defaultAction = 'view';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Displays a single Secret model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $message = '';

        if (Yii::$app->request->isPost) {

            $password = Yii::$app->request->post('password');

            // Проверить пароль.
            if (Secret::verifyPassword($password, $model->password)) {
                // Расшифровать данные.
                $model->decrypt($password);

                return $this->render('view', [
                    'model' => $model,
                ]);
            } else {
                $message = 'Incorrect password';
            }
        }

        // Запросить пароль доступа.
        return $this->render('access', [
            'model' => $model, 'message' => $message
        ]);
    }

    /**
     * Creates a new Secret model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Secret();

        if ($model->load(Yii::$app->request->post())) {

            $password = $model->password;
            $content = $model->content;

            // Сгенерировать уникальный псевдоним.
            $model->generateNewAlias();

            // Зашифровать данные пользователя.
            $model->hashPassword();
            $model->encrypt($password);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->alias]);
            }
            else {
                $model->password = '';
                $model->content = $content;
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

     /**
     * Deletes an existing Secret model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/']);
    }

    /**
     * Finds the Secret model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Secret the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Secret::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
