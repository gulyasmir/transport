<?php

namespace backend\controllers;

use Yii;
use common\models\DedicatedTransportTruck;
use backend\models\DedicatedTransportTruckSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * DedicatedTruckController implements the CRUD actions for DedicatedTransportTruck model.
 */
class DedicatedTruckController extends Controller
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


    public function actionClickmenu(){

      if(\Yii::$app->request->isAjax){
        $model = DedicatedTransportTruck::find()->all();
        $start_count = count($model);
        $session = Yii::$app->session;
          if ($session->isActive){
            $session->set('start_count_dedicated_truck', $start_count);
          }
        return $start_count;
        }
      return true;
    }

    public function actionCounter(){

    if(\Yii::$app->request->isAjax){
      $session = Yii::$app->session;
      if ($session->isActive){
        $start_count = $session->get('start_count_dedicated_truck');
      } else {
        $start_count = 0;
      }
        $model = DedicatedTransportTruck::find()->all();
        $new_count=count($model);

       $count_new_records = $new_count - $start_count;

       return $count_new_records;
      }
    return true;
    }


    /**
     * Lists all DedicatedTransportTruck models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DedicatedTransportTruckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DedicatedTransportTruck model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($dt_truck_id, $order_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($dt_truck_id, $order_id),
        ]);
    }

    /**
     * Creates a new DedicatedTransportTruck model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DedicatedTransportTruck();

        if ($model->load(Yii::$app->requesr->post())) {

            $post = \Yii::$app->request->post('DedicatedTransportTruck');

            $order = new Order();

            // НАЧАЛО ТРАНЗАКЦИИ
            $transaction = \Yii::$app->db->beginTransaction();

            $order->from = $model->from;
            $order->to = $model->to;
              $model->order->real_price = $model->real_price;
            // ####
            $order->save();print_r($order->getErrors());die();

            if (!$order->save()) {

                // #### СОХРАНЕНИЕ ЗАКАЗА С АДРЕСАМИ НЕ СДЕЛАНО

                $transaction->rollback();
                return false;
            }

            $model->order_id = $order->order_id;
            $model->pick_up_date = \Yii::$app->formatter->asTimestamp($model->pick_up_date);
            $model->loading_operations = isset($post['loading_operations']) ? 1 : 0;
            $model->territory_entry = isset($post['territory_entry']) ? 1 : 0;
            $model->city_pick_up = isset($post['city_pick_up']) ? 1 : 0;
            $model->city_delivery = isset($post['city_delivery']) ? 1 : 0;
            $model->filling = isset($post['filling']) ? 1 : 0;
            $model->hard_package = isset($post['hard_package']) ? 1 : 0;
            $model->pallet_transparent = isset($post['pallet_transparent']) ? 1 : 0;
            $model->pallet_black = isset($post['pallet_black']) ? 1 : 0;
            $model->tent_remove_to = isset($post['tent_remove_to']) ? 1 : 0;
            $model->tent_remove_from = isset($post['tent_remove_from']) ? 1 : 0;
            $model->pallet_board_pack = isset($post['pallet_board_pack']) ? 1 : 0;

            if ($model->semi_trailer_type == 1) {
                $model->tent_hard_board = isset($post['tent_hard_board']) ? 1 : 0;
                $model->tent_removable_top_beam = isset($post['tent_removable_top_beam']) ? 1 : 0;
                $model->tent_removable_side_beam = isset($post['tent_removable_side_beam']) ? 1 : 0;
            } else {
                $model->tent_hard_board = 0;
                $model->tent_removable_top_beam = 0;
                $model->tent_removable_side_beam = 0;
            }

            $model->is_draft = 0;

            if (!$model->save()) {
                $transaction->rollback();

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

                // КОНЕЦ ТРАНЗАКЦИИ
                $transaction->commit();

                $success = 'Заказ сохранен.';
                \Yii::$app->session->setFlash('success', $success);
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DedicatedTransportTruck model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($dt_truck_id, $order_id)
    {
        $model = $this->findModel($dt_truck_id, $order_id);

        $model->invoice = $model->order->invoice;
        $model->number_of_departure = $model->order->number_of_departure;
        $model->from = $model->order->from;
        $model->to = $model->order->to;
        $model->status = $model->order->status;

  $model->real_price = $model->order->real_price;

        if ($model->load(Yii::$app->request->post())) {

            $post = \Yii::$app->request->post('DedicatedTransportTruck');

            // НАЧАЛО ТРАНЗАКЦИИ
            $transaction = \Yii::$app->db->beginTransaction();

            $model->order->invoice = $model->invoice;
            $model->order->number_of_departure = $model->number_of_departure;
            $model->order->from = $model->from;
            $model->order->to = $model->to;
            $model->order->status = $model->status;

              $model->order->real_price = $model->real_price;

            if (!$model->order->save()) {
                $transaction->rollback();
                return false;
            }

            $model->pick_up_date = \Yii::$app->formatter->asTimestamp($model->pick_up_date);
            $model->loading_operations = isset($post['loading_operations']) ? 1 : 0;
            $model->territory_entry = isset($post['territory_entry']) ? 1 : 0;
            $model->city_pick_up = isset($post['city_pick_up']) ? 1 : 0;
            $model->city_delivery = isset($post['city_delivery']) ? 1 : 0;
            $model->filling = isset($post['filling']) ? 1 : 0;
            $model->hard_package = isset($post['hard_package']) ? 1 : 0;
            $model->pallet_transparent = isset($post['pallet_transparent']) ? 1 : 0;
            $model->pallet_black = isset($post['pallet_black']) ? 1 : 0;
            $model->tent_remove_to = isset($post['tent_remove_to']) ? 1 : 0;
            $model->tent_remove_from = isset($post['tent_remove_from']) ? 1 : 0;
            $model->pallet_board_pack = isset($post['pallet_board_pack']) ? 1 : 0;

            if ($model->semi_trailer_type == 1) {
                $model->tent_hard_board = isset($post['tent_hard_board']) ? 1 : 0;
                $model->tent_removable_top_beam = isset($post['tent_removable_top_beam']) ? 1 : 0;
                $model->tent_removable_side_beam = isset($post['tent_removable_side_beam']) ? 1 : 0;
            } else {
                $model->tent_hard_board = 0;
                $model->tent_removable_top_beam = 0;
                $model->tent_removable_side_beam = 0;
            }

            $model->is_draft = 0;

            if (!$model->save()) {
                $transaction->rollback();

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

                // КОНЕЦ ТРАНЗАКЦИИ
                $transaction->commit();

                $success = 'Заказ сохранен.';
                \Yii::$app->session->setFlash('success', $success);
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DedicatedTransportTruck model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($dt_truck_id, $order_id)
    {
        $this->findModel($dt_truck_id, $order_id)->delete();

        $success = 'Заказ удален.';
        \Yii::$app->session->setFlash('success', $success);
        return $this->redirect(['index']);
    }

    /**
     * Finds the DedicatedTransportTruck model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DedicatedTransportTruck the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($dt_truck_id, $order_id)
    {
        if (($model = DedicatedTransportTruck::findOne(['dt_truck_id' => $dt_truck_id, 'order_id' => $order_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
