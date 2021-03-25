<?php

namespace backend\controllers;

use Yii;
use common\models\DocumentRequest;
use common\models\Order;
use backend\models\DocumentRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * DocumentRequestController implements the CRUD actions for DocumentRequest model.
 */
class DocumentRequestController extends Controller
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


        public function actionClickmenu(){

          if(\Yii::$app->request->isAjax){
            $model = DocumentRequest::find()->all();
            $start_count = count($model);
            $session = Yii::$app->session;
              if ($session->isActive){
                $session->set('start_count_document_request', $start_count);
              }
            return $start_count;
            }
          return true;
        }

        public function actionCounter(){

        if(\Yii::$app->request->isAjax){
          $session = Yii::$app->session;
          if ($session->isActive){
            $start_count = $session->get('start_count_document_request');
          } else {
            $start_count = 0;
          }
            $model = DocumentRequest::find()->all();
            $new_count=count($model);

           $count_new_records = $new_count - $start_count;

           return $count_new_records;
          }
        return true;
        }


    /**
     * Lists all DocumentRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DocumentRequest model.
     * @param integer $feedback_request_id
     * @param integer $user_id
     * @param integer $order_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($document_request_id, $user_id, $order_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($document_request_id, $user_id, $order_id),
        ]);
    }

    /**
     * Creates a new DocumentRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DocumentRequest();

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //    return $this->redirect(['view', 'document_request_id' => $model->document_request_id, 'user_id' => $model->user_id, 'order_id' => $model->order_id]);
        //}

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DocumentRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $feedback_request_id
     * @param integer $user_id
     * @param integer $order_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($document_request_id, $user_id, $order_id)
    {
        $model = $this->findModel($document_request_id, $user_id, $order_id);

        $model->date_from = date('d.m.Y', $model->date_from);
        $model->date_to = date('d.m.Y', $model->date_to);

        if ($model->load(Yii::$app->request->post())) {

            $order = Order::find()->where(['order_id' => $order_id])->one();

            $email = $model->email ? $model->email : $model->user->email;

            $err = [];
            if (!$model->response) {
                $err[] = 'Заполните текст ответа на заявку.';
            }

            if (count($err)) {
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

                // Отсылаем email
                $model->send_email_response($email, $order);

                $model->status = 2;
                $model->save();

                $success = 'Заявка выполнена.';
                \Yii::$app->session->setFlash('success', $success);
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DocumentRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $feedback_request_id
     * @param integer $user_id
     * @param integer $order_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($document_request_id, $user_id, $order_id)
    {
        $this->findModel($document_request_id, $user_id, $order_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DocumentRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $feedback_request_id
     * @param integer $user_id
     * @param integer $order_id
     * @return DocumentRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($document_request_id, $user_id, $order_id)
    {
        if (($model = DocumentRequest::findOne(['document_request_id' => $document_request_id, 'user_id' => $user_id, 'order_id' => $order_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
