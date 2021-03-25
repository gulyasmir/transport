<?php

namespace backend\controllers;

use Yii;
use common\models\GeneralCargoLetter;
use common\models\Order;
use backend\models\GeneralCargoLetterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * GeneralLetterController implements the CRUD actions for GeneralCargoLetter model.
 */
class GeneralLetterController extends Controller
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
        $model = GeneralCargoLetter::find()->all();
        $start_count = count($model);
        $session = Yii::$app->session;
          if ($session->isActive){
            $session->set('start_count_general_cargo_letter', $start_count);
          }
        return $start_count;
        }
      return true;
    }

    public function actionCounter(){

    if(\Yii::$app->request->isAjax){
      $session = Yii::$app->session;
      if ($session->isActive){
        $start_count = $session->get('start_count_general_cargo_letter');
      } else {
        $start_count = 0;
      }
        $model = GeneralCargoLetter::find()->all();
        $new_count=count($model);

       $count_new_records = $new_count - $start_count;

       return $count_new_records;
      }
    return true;
    }

    /**
     * Lists all GeneralCargoLetter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GeneralCargoLetterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeneralCargoLetter model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($gc_letter_id, $order_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($gc_letter_id, $order_id),
        ]);
    }

    /**
     * Creates a new GeneralCargoLetter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GeneralCargoLetter();

        if ($model->load(Yii::$app->request->post())) {

            $post = \Yii::$app->request->post('GeneralCargoLetter');

            $order = new Order();

            // НАЧАЛО ТРАНЗАКЦИИ
            $transaction = \Yii::$app->db->beginTransaction();

            $order->from = $model->from;
            $order->to = $model->to;

            // ####
            $order->save();print_r($order->getErrors());die();

            if (!$order->save()) {

                // #### СОХРАНЕНИЕ ЗАКАЗА С АДРЕСАМИ НЕ СДЕЛАНО

                $transaction->rollback();
                return false;
            }

            $model->order_id = $order->order_id;
            $model->pick_up_date = \Yii::$app->formatter->asTimestamp($model->pick_up_date);
            $model->territory_entry = isset($post['territory_entry']) ? 1 : 0;
            $model->city_pick_up = isset($post['city_pick_up']) ? 1 : 0;
            $model->city_delivery = isset($post['city_delivery']) ? 1 : 0;
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
     * Updates an existing GeneralCargoLetter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($gc_letter_id, $order_id)
    {
        $model = $this->findModel($gc_letter_id, $order_id);

        $model->invoice = $model->order->invoice;
        $model->number_of_departure = $model->order->number_of_departure;
        $model->from = $model->order->from;
        $model->to = $model->order->to;
        $model->status = $model->order->status;

  $model->real_price = $model->order->real_price;

        if ($model->load(Yii::$app->request->post())) {

            $post = \Yii::$app->request->post('GeneralCargoLetter');

            // НАЧАЛО ТРАНЗАКЦИИ
            $transaction = \Yii::$app->db->beginTransaction();

            $model->order->invoice = $model->invoice;
            $model->order->number_of_departure = $model->number_of_departure;
            $model->order->from = $model->from;
            $model->order->to = $model->to;

            $model->order->real_price = $model->real_price;

            $model->order->status = $model->status;
            if (!$model->order->save()) {
                $transaction->rollback();
                return false;
            }

            $model->pick_up_date = \Yii::$app->formatter->asTimestamp($model->pick_up_date);
            $model->territory_entry = isset($post['territory_entry']) ? 1 : 0;
            $model->city_pick_up = isset($post['city_pick_up']) ? 1 : 0;
            $model->city_delivery = isset($post['city_delivery']) ? 1 : 0;
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
     * Deletes an existing GeneralCargoLetter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($gc_letter_id, $order_id)
    {
        $this->findModel($gc_letter_id, $order_id)->delete();

        $success = 'Заказ удален.';
        \Yii::$app->session->setFlash('success', $success);
        return $this->redirect(['index']);
    }

    /**
     * Finds the GeneralCargoLetter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GeneralCargoLetter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($gc_letter_id, $order_id)
    {
        if (($model = GeneralCargoLetter::findOne(['gc_letter_id' => $gc_letter_id, 'order_id' => $order_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
