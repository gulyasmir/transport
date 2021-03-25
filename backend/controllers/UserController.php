<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */

     public function actionClickmenu(){

       if(\Yii::$app->request->isAjax){
         $model = User::find()->all();
         $start_count = count($model);
         $session = Yii::$app->session;
           if ($session->isActive){
             $session->set('start_count_user', $start_count);
           }
         return $start_count;
         }
       return true;
     }

     public function actionCounter(){

     if(\Yii::$app->request->isAjax){
       $session = Yii::$app->session;
       if ($session->isActive){
         $start_count = $session->get('start_count_user');
       } else {
         $start_count = 0;
       }
         $model = User::find()->all();
         $new_count=count($model);

        $count_new_records = $new_count - $start_count;

        return $count_new_records;
       }
     return true;
     }

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
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->password_hash) {
                $model->setPassword($model->password_hash);
            } else {
                $model->password_hash = $model->hidden_password;
            }
            $model->generateAuthKey();

            $model->created_at = time();
            $model->updated_at = $model->created_at;

            if (!$model->save()) {
                $err = [];
                if (count($model->getErrors())) {
                    foreach($model->getErrors() as $attr) {
                        if (is_string($attr)) {
                            $err[] = $attr;
                        } elseif (count($attr)) {
                            foreach($attr as $error) {
                                $err[] = $error;
                            }
                        }
                    }
                }
                $errors = join('<br>', $err);
                \Yii::$app->session->setFlash('error', $errors);
            } else {

                $success = 'Пользователь сохранен.';
                \Yii::$app->session->setFlash('success', $success);
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if ($model->password_hash) {
                $model->setPassword($model->password_hash);
            } else {
                $model->password_hash = $model->hidden_password;
            }

            $model->updated_at = time();

            if (!$model->save()) {
                $err = [];
                if (count($model->getErrors())) {
                    foreach($model->getErrors() as $attr) {
                        if (is_string($attr)) {
                            $err[] = $attr;
                        } elseif (count($attr)) {
                            foreach($attr as $error) {
                                $err[] = $error;
                            }
                        }
                    }
                }
                $errors = join('<br>', $err);
                \Yii::$app->session->setFlash('error', $errors);
            } else {

                $success = 'Пользователь сохранен.';
                \Yii::$app->session->setFlash('success', $success);
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $success = 'Пользователь удален.';
        \Yii::$app->session->setFlash('success', $success);
        return $this->redirect(['index']);
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
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
