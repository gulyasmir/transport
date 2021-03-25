<?php

namespace backend\controllers;

use Yii;
use common\models\EntityAddress;
use backend\models\EntityAddressSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * EntityAddressController implements the CRUD actions for EntityAddress model.
 */
class EntityAddressController extends Controller
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
     * Lists all EntityAddress models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntityAddressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EntityAddress model.
     * @param integer $entity_address_id
     * @param integer $address_id
     * @param integer $legal_form_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($entity_address_id, $address_id, $legal_form_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($entity_address_id, $address_id, $legal_form_id),
        ]);
    }

    /**
     * Creates a new EntityAddress model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EntityAddress();

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
                
                $success = 'Юридическое лицо сохранено.';
                \Yii::$app->session->setFlash('success', $success);
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EntityAddress model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $entity_address_id
     * @param integer $address_id
     * @param integer $legal_form_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($entity_address_id, $address_id, $legal_form_id)
    {
        $model = $this->findModel($entity_address_id, $address_id, $legal_form_id);
        
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
                
                $success = 'Юридическое лицо сохранено.';
                \Yii::$app->session->setFlash('success', $success);
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EntityAddress model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $entity_address_id
     * @param integer $address_id
     * @param integer $legal_form_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($entity_address_id, $address_id, $legal_form_id)
    {
        $this->findModel($entity_address_id, $address_id, $legal_form_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EntityAddress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $entity_address_id
     * @param integer $address_id
     * @param integer $legal_form_id
     * @return EntityAddress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($entity_address_id, $address_id, $legal_form_id)
    {
        if (($model = EntityAddress::findOne(['entity_address_id' => $entity_address_id, 'address_id' => $address_id, 'legal_form_id' => $legal_form_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
