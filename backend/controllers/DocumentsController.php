<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use common\models\Documents;
use common\models\Order;
use backend\models\DocumentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * DocumentsController implements the CRUD actions for Documents model.
 */
class DocumentsController extends Controller
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
                $model = Documents::find()->all();
                $start_count = count($model);
                $session = Yii::$app->session;
                  if ($session->isActive){
                    $session->set('start_count_documents', $start_count);
                  }
                return $start_count;
                }
              return true;
            }

            public function actionCounter(){

            if(\Yii::$app->request->isAjax){
              $session = Yii::$app->session;
              if ($session->isActive){
                $start_count = $session->get('start_count_documents');
              } else {
                $start_count = 0;
              }
                $model = Documents::find()->all();
                $new_count=count($model);

               $count_new_records = $new_count - $start_count;

               return $count_new_records;
              }
            return true;
            }


    /**
     * Lists all Documents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documents model.
     * @param integer $document_id
     * @param integer $user_id
     * @param integer $order_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($document_id, $user_id, $order_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($document_id, $user_id, $order_id),
        ]);
    }

    /**
     * Creates a new Documents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($order_id)
    {
        $model = new Documents();

        if ($model->load(\Yii::$app->request->post())) {

            // НАЧАЛО ТРАНЗАКЦИИ
            $transaction = \Yii::$app->db->beginTransaction();

            $order = Order::find()->where(['order_id' => $order_id])->one();

            $model->order_id = $order->order_id;
            $model->user_id = $order->user->id;
            $model->create_date = time();
            $model->uploader = 2;
            $model->name = 'tmp_name';

            if ($model->save()) {

                // Загрузка файла
                $file_name = $order->order_id.'_'.time();
                $model->file = UploadedFile::getInstance($model, 'name');
                if (!empty($model->name)) {
                    $model->file->saveAs(\Yii::$app->params['documents_full_path'].'/'.$file_name.'.'.$model->file->extension);
                    $model->name = $file_name.'.'.$model->file->extension;
                    $model->save();

                    // КОНЕЦ ТРАНЗАКЦИИ
                    $transaction->commit();

                } else {
                    $transaction->rollback();
                    return false;
                }

                // Сборный груз одно место
                if (mb_stripos($order->order_number, 'СО-') !== false) {

                    if (isset($order->generalCargoOnePlace['order_id'])) {
                        $order_data = $order->generalCargoOnePlace;
                        $get_param = 'GeneralCargoOnePlace[gc_one_place_id]='.$order->generalCargoOnePlace->gc_one_place_id;
                        $view = 'general-one-place';
                    }

                // Сборный груз несколько мест
                } elseif (mb_stripos($order->order_number, 'СМ-') !== false) {

                    if (isset($order->generalCargoManyPlace['order_id'])) {
                        $order_data = $order->generalCargoManyPlace;
                        $get_param = 'GeneralCargoManyPlace[gc_many_places_id]='.$order->generalCargoManyPlace->gc_many_places_id;
                        $view = 'general-many-places';
                    }

                // Сборный груз письмо
                } elseif (mb_stripos($order->order_number, 'СП-') !== false) {

                    if (isset($order->generalCargoLetter['order_id'])) {
                        $order_data = $order->generalCargoLetter;
                        $get_param = 'GeneralCargoLetter[gc_letter_id]='.$order->generalCargoLetter->gc_letter_id;
                        $view = 'general-letter';
                    }

                // Выделенный транспорт фура
                } elseif (mb_stripos($order->order_number, 'ВФ-') !== false) {

                    if (isset($order->dedicatedTransportTruck['order_id'])) {
                        $order_data = $order->dedicatedTransportTruck;
                        $get_param = 'DedicatedTransportTruck[dt_truck_id]='.$order->dedicatedTransportTruck->dt_truck_id;
                        $view = 'dedicated-truck';
                    }

                // Выделенный транспорт машина
                } elseif (mb_stripos($order->order_number, 'ВМ-') !== false) {

                    if (isset($order->dedicatedTransportCar['order_id'])) {
                        $order_data = $order->dedicatedTransportCar;
                        $get_param = 'DedicatedTransportCar[dt_car_id]='.$order->dedicatedTransportCar->dt_car_id;
                        $view = 'dedicated-car';
                    }
                }

                $success = 'Документ загружен успешно.';
                \Yii::$app->session->setFlash('success', $success);
                return $this->redirect(Url::base()."/{$view}/index?{$get_param}");
            } else {
                $transaction->rollback();
                return false;
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Documents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $document_id
     * @param integer $user_id
     * @param integer $order_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($document_id, $user_id, $order_id)
    {
        $model = $this->findModel($document_id, $user_id, $order_id);

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //    return $this->redirect(['view', 'document_id' => $model->document_id, 'user_id' => $model->user_id, 'order_id' => $model->order_id]);
        //}

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Documents model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $document_id
     * @param integer $user_id
     * @param integer $order_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($document_id, $user_id, $order_id)
    {
        $model = $this->findModel($document_id, $user_id, $order_id);

        // Удаление документа
        if ($model->name) {
            @unlink(\Yii::$app->params['documents_full_path'].'/'.$model->name);
        }
        $model->delete();

        $success = 'Документ удален.';
        \Yii::$app->session->setFlash('success', $success);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Documents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $document_id
     * @param integer $user_id
     * @param integer $order_id
     * @return Documents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($document_id, $user_id, $order_id)
    {
        if (($model = Documents::findOne(['document_id' => $document_id, 'user_id' => $user_id, 'order_id' => $order_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
