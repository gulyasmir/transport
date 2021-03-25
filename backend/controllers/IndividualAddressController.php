<?php

namespace backend\controllers;

use Yii;
use common\models\IndividualAddress;
use backend\models\IndividualAddressSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * IndividualAddressController implements the CRUD actions for IndividualAddress model.
 */
class IndividualAddressController extends Controller
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
     * Lists all IndividualAddress models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IndividualAddressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IndividualAddress model.
     * @param integer $individual_address_id
     * @param integer $address_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($individual_address_id, $address_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($individual_address_id, $address_id),
        ]);
    }

    /**
     * Creates a new IndividualAddress model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IndividualAddress();

        if ($model->load(Yii::$app->request->post())) {
            
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
                
                $success = 'Физическое лицо сохранено.';
                \Yii::$app->session->setFlash('success', $success);
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing IndividualAddress model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $individual_address_id
     * @param integer $address_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($individual_address_id, $address_id)
    {
        $model = $this->findModel($individual_address_id, $address_id);

        $model->contact_person = $model->address->contact_person;
        $model->phone = $model->address->phone;
        $model->aaddress = $model->address->address;
        
        if ($model->load(Yii::$app->request->post())) {
            
            // НАЧАЛО ТРАНЗАКЦИИ
            $transaction = \Yii::$app->db->beginTransaction();
            
            $model->address->contact_person = $model->contact_person;
            $model->address->phone = $model->phone;
            $model->address->address = $model->aaddress;
            if (!$model->address->save()) {
                
                $transaction->rollback();
                return false;
            }
            
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
                
                $success = 'Физическое лицо сохранено.';
                \Yii::$app->session->setFlash('success', $success);
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing IndividualAddress model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $individual_address_id
     * @param integer $address_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($individual_address_id, $address_id)
    {
        $this->findModel($individual_address_id, $address_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the IndividualAddress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $individual_address_id
     * @param integer $address_id
     * @return IndividualAddress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($individual_address_id, $address_id)
    {
        if (($model = IndividualAddress::findOne(['individual_address_id' => $individual_address_id, 'address_id' => $address_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
