<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use common\models\User;
use common\models\Order;
use common\models\Address;
use common\models\EntityAddress;
use common\models\IndividualAddress;
use common\models\DocumentRequest;
use common\models\FeedbackRequest;
use common\models\Documents;
use frontend\models\AddressSearch;
use frontend\models\OrderSearch;
use frontend\models\OrderEditPickUpForm;
use frontend\models\OrderEditCityDeliveryForm;
use frontend\models\OrderEditContactsForm;
use frontend\models\OrderEditAddressForm;
use yii\web\UploadedFile;

use common\models\LkPage;
use common\models\LkChange;

/**
 * Client controller
 */
class ClientController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'profile', 'addresses', 'orders', 'order', 'upload-document', 'documents-request', 'feedback-request', 'order-edit-address', 'order-edit-contacts', 'order-edit-pick-up', 'order-edit-city-delivery'],
                'rules' => [
                    [
                        'actions' => ['index', 'profile', 'addresses', 'orders', 'order', 'upload-document', 'documents-request', 'feedback-request', 'order-edit-address', 'order-edit-contacts', 'order-edit-pick-up', 'order-edit-city-delivery'],
                        'allow' => true,
                        'roles' => ['customer', 'admin'],
                    ],
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

    public function actionIndex()
    {

        $text_lk_page = LkPage::find()->one();

        $this->view->params['breadcrumbs'] = [
            ['label' => '???????????? ??????????????'],
        ];

        return $this->render('index', [
          'text_lk_page' => $text_lk_page
        ]);
    }

    public function actionProfile()
    {
        $this->view->params['breadcrumbs'] = [
            ['label' => '???????????? ??????????????', 'url' => '/client'],
            ['label' => '?????? ??????????????'],
        ];

        $customer = User::findOne([
            'id' => \Yii::$app->user->identity->id,
        ]);

        return $this->render('profile', ['customer' => $customer]);
    }

    public function actionAddresses()
    {
        $this->view->params['breadcrumbs'] = [
            ['label' => '???????????? ??????????????', 'url' => '/client'],
            ['label' => '???????????????? ??????????'],
        ];

        $searchModel = new AddressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('addresses', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionOrders()
    {
        $this->view->params['breadcrumbs'] = [
            ['label' => '???????????? ??????????????', 'url' => '/client'],
            ['label' => '?????? ????????????'],
        ];

        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('orders', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionOrder($order_id)
    {
        $order = Order::find()->where(['order_id' => (int)$order_id])->one();

      //  if (isset($order->order_id) && $order->order_id && $order->status > 0) {
      
        	  if (isset($order->order_id) && $order->order_id ) {

            if ($order->user_id == \Yii::$app->user->identity->id) {

                $this->view->params['breadcrumbs'] = [
                    ['label' => '???????????? ??????????????', 'url' => '/client'],
                    ['label' => '?????? ????????????', 'url' => '/client/orders'],
                    ['label' => "?????????? {$order->order_number}"],
                ];

                return $this->render('order', ['order' => $order]);
            } else {
                echo '?????? ?????????? ?????????????? ????????????????????????.';
            }
        } else {
            echo '???????????? ???????????? ???? ????????????????????.';
        }
    }

    public function actionUploadDocument($order_id)
    {
        // Ajax ??????????????????
        if (\Yii::$app->request->isAjax) {
            $document = new Documents();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($document->load(\Yii::$app->request->post())) {
                return ActiveForm::validate($document);
            }
        }

        $order = Order::find()->where(['order_id' => (int)$order_id])->one();

        if (isset($order->order_id) && $order->order_id) {

            if ($order->user_id == \Yii::$app->user->identity->id) {

                $document = new Documents();

                $this->view->params['breadcrumbs'] = [
                    ['label' => '???????????? ??????????????', 'url' => '/client'],
                    ['label' => '?????? ????????????', 'url' => '/client/orders'],
                    ['label' => '?????????? '.$order->order_number, 'url' => '/client/order?order_id='.$order->order_id],
                    ['label' => '?????????????????? ?????????????????? ?? ????????????'],
                ];

                if ($document->load(Yii::$app->request->post())) {

                    // ???????????? ????????????????????
                    $transaction = \Yii::$app->db->beginTransaction();

                    $document->order_id = $order->order_id;
                    $document->user_id = \Yii::$app->user->identity->id;
                    $document->create_date = time();
                    $document->uploader = 1;
                    $document->name = 'tmp_name';

                    if ($document->save()) {

                        // ???????????????? ??????????
                        $file_name = $order->order_id.'_'.time();
                        $document->file = UploadedFile::getInstance($document, 'name');
                        if (!empty($document->name)) {
                            $document->file->saveAs(\Yii::$app->params['documents_full_path'].'/'.$file_name.'.'.$document->file->extension);
                            $document->name = $file_name.'.'.$document->file->extension;
                            $document->save();

                            // ?????????? ????????????????????
                            $transaction->commit();

                        } else {
                            $transaction->rollback();
                            return false;
                        }

                        // ???????????????? email
                        $document->send_email($this->contacts->email, 'admin', $order);
                        $document->send_email(\Yii::$app->user->identity->email, 'user', $order);

                        $success = '???????????????? ???????????????? ??????????????.';

                        \Yii::$app->session->setFlash('success', $success);
                        return $this->redirect('order?order_id='.$order->order_id);
                    } else {
                        $transaction->rollback();
                        return false;
                    }
                }

                return $this->render('upload_document', [
                    'document' => $document,
                    'order' => $order,
                ]);

            } else {
                echo '?????? ?????????? ?????????????? ????????????????????????.';
            }
        } else {
            echo '???????????? ???????????? ???? ????????????????????.';
        }
    }

    public function actionDocumentsRequest($order_id)
    {
        // Ajax ??????????????????
        if (\Yii::$app->request->isAjax) {
            $document_request = new DocumentRequest();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($document_request->load(\Yii::$app->request->post())) {
                return ActiveForm::validate($document_request);
            }
        }

        $order = Order::find()->where(['order_id' => (int)$order_id])->one();

        if (isset($order->order_id) && $order->order_id) {

            if ($order->user_id == \Yii::$app->user->identity->id) {

                $this->view->params['breadcrumbs'] = [
                    ['label' => '???????????? ??????????????', 'url' => '/client'],
                    ['label' => '?????? ????????????', 'url' => '/client/orders'],
                    ['label' => '?????????? '.$order->order_number, 'url' => '/client/order?order_id='.$order->order_id],
                    ['label' => '???????????????????????? ??????????????????'],
                ];

                $document_request = new DocumentRequest();

                if ($document_request->load(\Yii::$app->request->post())) {

                    $document_request->create_date = time();
                    $document_request->status = 1;
                    $document_request->date_from = \Yii::$app->formatter->asTimestamp($document_request->date_from);
                    $document_request->date_to = \Yii::$app->formatter->asTimestamp($document_request->date_to);
                    $document_request->order_id = $order->order_id;
                    $document_request->user_id = \Yii::$app->user->identity->id;

                    if ($document_request->save()) {

                        // ???????????????? email
                        $document_request->send_email($this->contacts->email, 'admin', $order);
                        $document_request->send_email(\Yii::$app->user->identity->email, 'user', $order);

                        $success = '?????? ???????????? ???????????????????? ?????????????????? ??????????????.';

                        \Yii::$app->session->setFlash('success', $success);
                        return $this->redirect('/client/order?order_id='.$order->order_id);
                    } else {
                        return false;
                    }
                }

                $document_request->contact_person = $order->user->name;
                $document_request->phone = $order->user->phone;
                $document_request->email = $order->user->email;

                return $this->render('documents_request', ['document_request' => $document_request, 'order' => $order]);
            } else {
                echo '?????? ?????????? ?????????????? ????????????????????????.';
            }
        } else {
            echo '???????????? ???????????? ???? ????????????????????.';
        }
    }

    public function actionFeedbackRequest($order_id)
    {
        // Ajax ??????????????????
        if (\Yii::$app->request->isAjax) {
            $feedback_request = new FeedbackRequest();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($feedback_request->load(\Yii::$app->request->post())) {
                return ActiveForm::validate($feedback_request);
            }
        }

        $order = Order::find()->where(['order_id' => (int)$order_id])->one();

        if (isset($order->order_id) && $order->order_id) {

            if ($order->user_id == \Yii::$app->user->identity->id) {

                $this->view->params['breadcrumbs'] = [
                    ['label' => '???????????? ??????????????', 'url' => '/client'],
                    ['label' => '?????? ????????????', 'url' => '/client/orders'],
                    ['label' => '?????????? '.$order->order_number, 'url' => '/client/order?order_id='.$order->order_id],
                    ['label' => '???????????????? ??????????????????'],
                ];

                $feedback_request = new FeedbackRequest();

                if ($feedback_request->load(\Yii::$app->request->post())) {

                    $feedback_request->create_date = time();
                    $feedback_request->status = 1;
                    $feedback_request->order_id = $order->order_id;
                    $feedback_request->user_id = \Yii::$app->user->identity->id;

                    if ($feedback_request->save()) {

                        // ???????????????? email
                        $feedback_request->send_email($this->contacts->email, 'admin', $order);
                        $feedback_request->send_email(\Yii::$app->user->identity->email, 'user', $order);

                        $success = '?????? ???????????? ?????????????????? ??????????????.';

                        \Yii::$app->session->setFlash('success', $success);
                        return $this->redirect('/client/order?order_id='.$order->order_id);
                    } else {
                        return false;
                    }
                }

                $feedback_request->contact_person = $order->user->name;
                $feedback_request->phone = $order->user->phone;
                $feedback_request->email = $order->user->email;

                return $this->render('feedback_request', ['feedback_request' => $feedback_request, 'order' => $order]);
            } else {
                echo '?????? ?????????? ?????????????? ????????????????????????.';
            }
        } else {
            echo '???????????? ???????????? ???? ????????????????????.';
        }
    }

  public function actionLkChangeAddress($order_id)
{
    $order = Order::find()->where(['order_id' => (int)$order_id])->one();
    $text_lk_change = LkChange::find()->where(['page'=>'lk-change-address'])->one();

  $this->view->params['breadcrumbs'] = [
                        ['label' => '???????????? ??????????????', 'url' => '/client'],
                        ['label' => '?????? ????????????', 'url' => '/client/orders'],
                        ['label' => '?????????? '.$order->order_number, 'url' => '/client/order?order_id='.$order->order_id],
                        ['label' => '???????????????? ?????????? ????????????????'],
                    ];
    return $this->render('lk_change_address', [
        'order' => $order,
        'text_lk_change' => $text_lk_change
     ]);
}

public function actionLkChangePickUp($order_id)
{
  $order = Order::find()->where(['order_id' => (int)$order_id])->one();
  $text_lk_change = LkChange::find()->where(['page'=>'lk-change-pick-up'])->one();
  $this->view->params['breadcrumbs'] = [
                        ['label' => '???????????? ??????????????', 'url' => '/client'],
                        ['label' => '?????? ????????????', 'url' => '/client/orders'],
                        ['label' => '?????????? '.$order->order_number, 'url' => '/client/order?order_id='.$order->order_id],
                        ['label' => '?????????????????????????? ???????????? ?????????? ??????????????????????'],
                    ];
  return $this->render('lk_change_pick_up', [
      'order' => $order,
      'text_lk_change' => $text_lk_change
   ]);
}
public function actionLkChangeCityDelivery($order_id)
{
  $order = Order::find()->where(['order_id' => (int)$order_id])->one();
  $text_lk_change = LkChange::find()->where(['page'=>'lk-change-city-delivery'])->one();
  $this->view->params['breadcrumbs'] = [
                        ['label' => '???????????? ??????????????', 'url' => '/client'],
                        ['label' => '?????? ????????????', 'url' => '/client/orders'],
                        ['label' => '?????????? '.$order->order_number, 'url' => '/client/order?order_id='.$order->order_id],
                        ['label' => '???????????????? ???????????????? ???? ????????????'],
                    ];
  return $this->render('lk_change_city_delivery', [
      'order' => $order,
      'text_lk_change' => $text_lk_change
   ]);
}
    public function actionOrderEditAddress($order_id)
    {

        // Ajax ??????????????????
        if (\Yii::$app->request->isAjax) {
            $order_edit_address = new OrderEditAddressForm();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($order_edit_address->load(\Yii::$app->request->post())) {
                return ActiveForm::validate($order_edit_address);
            }
        }

        $order = Order::find()->where(['order_id' => (int)$order_id])->one();

        if (isset($order->order_id) && $order->order_id) {

            if ($order->user_id == \Yii::$app->user->identity->id) {

                if ($order->status == 1 || $order->status == 2) {

                    $this->view->params['breadcrumbs'] = [
                        ['label' => '???????????? ??????????????', 'url' => '/client'],
                        ['label' => '?????? ????????????', 'url' => '/client/orders'],
                        ['label' => '?????????? '.$order->order_number, 'url' => '/client/order?order_id='.$order->order_id],
                        ['label' => '???????????????????????????? ???????????? ????????????????'],
                    ];

                    $order_edit_address = new OrderEditAddressForm();
                    $order_edit_address->address = $order->recipient->address;

                    if ($order_edit_address->load(\Yii::$app->request->post())) {

                        // ???????? ?????? ???????? ??????????????
                        if ($order->recipient->address != $order_edit_address->address) {

                            // ???????????? ????????????????????
                            $transaction = \Yii::$app->db->beginTransaction();

                            $address = new Address();

                            // ???????????????????? ????????????
                            $address->address = $order_edit_address->address;

                            $address->create_date = time();
                            $address->user_id = \Yii::$app->user->identity->id;
                            $address->type = $order->recipient->type;
                            $address->contact_person = $order->recipient->contact_person;
                            $address->phone = $order->recipient->phone;
                            if (!$address->save()) {
                                $transaction->rollback();
                                return false;
                            }

                            if ($order->recipient->type == 1) {

                                $individual_address = new IndividualAddress();

                                $individual_address->address_id = $address->address_id;
                                $individual_address->full_name = $order->recipient->individualAddress['full_name'];
                                $individual_address->country = $order->recipient->individualAddress['country'];
                                $individual_address->identification = $order->recipient->individualAddress['identification'];
                                $individual_address->identification_series = $order->recipient->individualAddress['identification_series'];
                                $individual_address->identification_number = $order->recipient->individualAddress['identification_number'];
                                if (!$individual_address->save()) {
                                    $transaction->rollback();
                                    return false;
                                }

                            } elseif ($order->recipient->type == 2) {

                                $entity_address = new EntityAddress();

                                $entity_address->address_id = $address->address_id;
                                $entity_address->legal_form_id = $order->recipient->entityAddress['legal_form_id'];
                                $entity_address->country = $order->recipient->entityAddress['country'];
                                $entity_address->name = $order->recipient->entityAddress['name'];
                                $entity_address->inn = $order->recipient->entityAddress['inn'];
                                $entity_address->save();
                                if (!$entity_address->save()) {
                                    $transaction->rollback();
                                    return false;
                                }
                            }

                            // ????????????????????
                            if ($order->payer_id == $order->recipient_id) {
                                $order->payer_id = $address->address_id;
                            }
                            // ???????????? ???? ?????????? ?????????? ????????????????????
                            $order->recipient_id = $address->address_id;
                            if (!$order->save()) {
                                $transaction->rollback();
                                return false;
                            }

                            // ?????????? ????????????????????
                            $transaction->commit();

                            // ???????????????? email
                            $order_edit_address->send_email($this->contacts->email, 'admin', $order);
                            $order_edit_address->send_email(\Yii::$app->user->identity->email, 'user', $order);

                            $success = '?????????? ???????????????????????????? ??????????????.';

                            \Yii::$app->session->setFlash('success', $success);
                            return $this->redirect('/client/order?order_id='.$order->order_id);
                        } else {

                            $success = '???? ???????????? ???? ????????????????.';

                            \Yii::$app->session->setFlash('success', $success);
                            return $this->redirect('/client/order?order_id='.$order->order_id);
                        }
                    }

                    return $this->render('order_edit_address', [
                      'order' => $order,
                      'order_edit_address' => $order_edit_address,
                    ]);
                } else {
                    echo 'C?????????? ???????????? ???? ?????????????????? ???????????????? ????????????.';
                }
            } else {
                echo '?????? ?????????? ?????????????? ????????????????????????.';
            }
        } else {
            echo '???????????? ???????????? ???? ????????????????????.';
        }
    }

    public function actionOrderEditContacts($order_id)
    {
        // Ajax ??????????????????
        if (\Yii::$app->request->isAjax) {
            $order_edit_contacts = new OrderEditContactsForm();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($order_edit_contacts->load(\Yii::$app->request->post())) {
                return ActiveForm::validate($order_edit_contacts);
            }
        }

        $order = Order::find()->where(['order_id' => (int)$order_id])->one();

        if (isset($order->order_id) && $order->order_id) {

            if ($order->user_id == \Yii::$app->user->identity->id) {

                if ($order->status == 1 || $order->status == 2) {

                    $this->view->params['breadcrumbs'] = [
                        ['label' => '???????????? ??????????????', 'url' => '/client'],
                        ['label' => '?????? ????????????', 'url' => '/client/orders'],
                        ['label' => '?????????? '.$order->order_number, 'url' => '/client/order?order_id='.$order->order_id],
                        ['label' => '???????????????????????????? ???????????????????? ????????????????????'],
                    ];

                    $order_edit_contacts = new OrderEditContactsForm();
                    $order_edit_contacts->phone = $order->recipient->phone;
                    $order_edit_contacts->contact_person = $order->recipient->contact_person;

                    if ($order_edit_contacts->load(\Yii::$app->request->post())) {

                        // ???????? ?????? ???????? ??????????????
                        if ($order->recipient->phone != $order_edit_contacts->phone || $order->recipient->contact_person != $order_edit_contacts->contact_person) {

                            // ???????????? ????????????????????
                            $transaction = \Yii::$app->db->beginTransaction();

                            $address = new Address();

                            // ???????????????????? ????????????
                            $address->contact_person = $order_edit_contacts->contact_person;
                            $address->phone = $order_edit_contacts->phone;

                            $address->create_date = time();
                            $address->user_id = \Yii::$app->user->identity->id;
                            $address->type = $order->recipient->type;
                            $address->address = $order->recipient->address;
                            if (!$address->save()) {
                                $transaction->rollback();
                                return false;
                            }

                            if ($order->recipient->type == 1) {

                                $individual_address = new IndividualAddress();

                                $individual_address->address_id = $address->address_id;
                                $individual_address->full_name = $order->recipient->individualAddress['full_name'];
                                $individual_address->country = $order->recipient->individualAddress['country'];
                                $individual_address->identification = $order->recipient->individualAddress['identification'];
                                $individual_address->identification_series = $order->recipient->individualAddress['identification_series'];
                                $individual_address->identification_number = $order->recipient->individualAddress['identification_number'];
                                if (!$individual_address->save()) {
                                    $transaction->rollback();
                                    return false;
                                }

                            } elseif ($order->recipient->type == 2) {

                                $entity_address = new EntityAddress();

                                $entity_address->address_id = $address->address_id;
                                $entity_address->legal_form_id = $order->recipient->entityAddress['legal_form_id'];
                                $entity_address->country = $order->recipient->entityAddress['country'];
                                $entity_address->name = $order->recipient->entityAddress['name'];
                                $entity_address->inn = $order->recipient->entityAddress['inn'];
                                $entity_address->save();
                                if (!$entity_address->save()) {
                                    $transaction->rollback();
                                    return false;
                                }
                            }

                            // ????????????????????
                            if ($order->payer_id == $order->recipient_id) {
                                $order->payer_id = $address->address_id;
                            }
                            // ???????????? ???? ?????????? ?????????? ????????????????????
                            $order->recipient_id = $address->address_id;
                            if (!$order->save()) {
                                $transaction->rollback();
                                return false;
                            }

                            // ?????????? ????????????????????
                            $transaction->commit();

                            // ???????????????? email
                            $order_edit_contacts->send_email($this->contacts->email, 'admin', $order);
                            $order_edit_contacts->send_email(\Yii::$app->user->identity->email, 'user', $order);

                            $success = '?????????? ???????????????????????????? ??????????????.';

                            \Yii::$app->session->setFlash('success', $success);
                            return $this->redirect('/client/order?order_id='.$order->order_id);
                        } else {

                            $success = '???? ???????????? ???? ????????????????.';

                            \Yii::$app->session->setFlash('success', $success);
                            return $this->redirect('/client/order?order_id='.$order->order_id);
                        }
                    }

                    return $this->render('order_edit_contacts', ['order' => $order, 'order_edit_contacts' => $order_edit_contacts]);
                } else {
                    echo 'C?????????? ???????????? ???? ?????????????????? ???????????????? ????????????.';
                }
            } else {
                echo '?????? ?????????? ?????????????? ????????????????????????.';
            }
        } else {
            echo '???????????? ???????????? ???? ????????????????????.';
        }
    }

    public function actionOrderEditPickUp($order_id)
    {
        // Ajax ??????????????????
        if (\Yii::$app->request->isAjax) {
            $order_edit_pick_up = new OrderEditPickUpForm();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($order_edit_pick_up->load(\Yii::$app->request->post())) {
                return ActiveForm::validate($order_edit_pick_up);
            }
        }

        $order = Order::find()->where(['order_id' => (int)$order_id])->one();

        if (isset($order->order_id) && $order->order_id) {

            if ($order->user_id == \Yii::$app->user->identity->id) {

                if ($order->status == 1 || $order->status == 2) {

                    $this->view->params['breadcrumbs'] = [
                        ['label' => '???????????? ??????????????', 'url' => '/client'],
                        ['label' => '?????? ????????????', 'url' => '/client/orders'],
                        ['label' => '?????????? '.$order->order_number, 'url' => '/client/order?order_id='.$order->order_id],
                        ['label' => '?????????????????????????? ???????????? ??????????'],
                    ];

                    $order_edit_pick_up = new OrderEditPickUpForm();
                    $order_data = $this->get_order_data($order);
                    $order_edit_pick_up->pick_up_date = $order_data->pick_up_date;

                    if ($order_edit_pick_up->load(\Yii::$app->request->post())) {

                        if (\Yii::$app->formatter->asTimestamp($order_edit_pick_up->pick_up_date) != $order_data->pick_up_date) {

                            $order_data->pick_up_date = \Yii::$app->formatter->asTimestamp($order_edit_pick_up->pick_up_date);
                            $order_data->from = $order->from;
                            $order_data->to = $order->to;
                            $order_data->save();

                            // ???????????????? email
                            $order_edit_pick_up->send_email($this->contacts->email, 'admin', $order);
                            $order_edit_pick_up->send_email(\Yii::$app->user->identity->email, 'user', $order);

                            $success = '?????????? ???????????????????????????? ??????????????.';

                            \Yii::$app->session->setFlash('success', $success);
                            return $this->redirect('/client/order?order_id='.$order->order_id);
                        } else {

                            $success = '???? ???????????? ???? ????????????????.';

                            \Yii::$app->session->setFlash('success', $success);
                            return $this->redirect('/client/order?order_id='.$order->order_id);
                        }
                    }

                    return $this->render('order_edit_pick_up', ['order' => $order, 'order_edit_pick_up' => $order_edit_pick_up]);
                } else {
                    echo 'C?????????? ???????????? ???? ?????????????????? ???????????????? ????????????.';
                }
            } else {
                echo '?????? ?????????? ?????????????? ????????????????????????.';
            }
        } else {
            echo '???????????? ???????????? ???? ????????????????????.';
        }
    }

    public function actionOrderEditCityDelivery($order_id)
    {
        // Ajax ??????????????????
        if (\Yii::$app->request->isAjax) {
            $order_edit_city_delivery = new OrderEditCityDeliveryForm();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($order_edit_city_delivery->load(\Yii::$app->request->post())) {
                return ActiveForm::validate($order_edit_city_delivery);
            }
        }

        $order = Order::find()->where(['order_id' => (int)$order_id])->one();

        if (isset($order->order_id) && $order->order_id) {

            if ($order->user_id == \Yii::$app->user->identity->id) {

                if ($order->status == 1 || $order->status == 2) {

                    $this->view->params['breadcrumbs'] = [
                        ['label' => '???????????? ??????????????', 'url' => '/client'],
                        ['label' => '?????? ????????????', 'url' => '/client/orders'],
                        ['label' => '?????????? '.$order->order_number, 'url' => '/client/order?order_id='.$order->order_id],
                        ['label' => '?????????????? ???????????????? ???? ????????????'],
                    ];

                    $order_data = $this->get_order_data($order);

                    $order_edit_city_delivery = new OrderEditCityDeliveryForm();
                    $order_edit_city_delivery->address = $order->recipient->address;
                    $order_edit_city_delivery->city_delivery = $order_data->city_delivery;

                    if ($order_edit_city_delivery->load(\Yii::$app->request->post())) {

                        // ???????? ?????? ???????? ??????????????
                        if ($order->recipient->address != $order_edit_city_delivery->address || $order_edit_city_delivery->city_delivery != $order_data->city_delivery) {

                            // ???????????? ????????????????????
                            $transaction = \Yii::$app->db->beginTransaction();

                            $address = new Address();

                            // ???????????????????? ????????????
                            $address->address = $order_edit_city_delivery->address;

                            $address->create_date = time();
                            $address->user_id = \Yii::$app->user->identity->id;
                            $address->type = $order->recipient->type;
                            $address->contact_person = $order->recipient->contact_person;
                            $address->phone = $order->recipient->phone;
                            if (!$address->save()) {
                                $transaction->rollback();
                                return false;
                            }

                            $order_data->city_delivery = 1;
                            $order_data->from = $order->from;
                            $order_data->to = $order->to;
                            if (!$order_data->save()) {
                                $transaction->rollback();
                                return false;
                            }

                            if ($order->recipient->type == 1) {

                                $individual_address = new IndividualAddress();

                                $individual_address->address_id = $address->address_id;
                                $individual_address->full_name = $order->recipient->individualAddress['full_name'];
                                $individual_address->country = $order->recipient->individualAddress['country'];
                                $individual_address->identification = $order->recipient->individualAddress['identification'];
                                $individual_address->identification_series = $order->recipient->individualAddress['identification_series'];
                                $individual_address->identification_number = $order->recipient->individualAddress['identification_number'];
                                if (!$individual_address->save()) {
                                    $transaction->rollback();
                                    return false;
                                }

                            } elseif ($order->recipient->type == 2) {

                                $entity_address = new EntityAddress();

                                $entity_address->address_id = $address->address_id;
                                $entity_address->legal_form_id = $order->recipient->entityAddress['legal_form_id'];
                                $entity_address->country = $order->recipient->entityAddress['country'];
                                $entity_address->name = $order->recipient->entityAddress['name'];
                                $entity_address->inn = $order->recipient->entityAddress['inn'];
                                $entity_address->save();
                                if (!$entity_address->save()) {
                                    $transaction->rollback();
                                    return false;
                                }
                            }

                            // ????????????????????
                            if ($order->payer_id == $order->recipient_id) {
                                $order->payer_id = $address->address_id;
                            }
                            // ???????????? ???? ?????????? ?????????? ????????????????????
                            $order->recipient_id = $address->address_id;
                            if (!$order->save()) {
                                $transaction->rollback();
                                return false;
                            }

                            // ?????????? ????????????????????
                            $transaction->commit();

                            // ???????????????? email
                            $order_edit_city_delivery->send_email($this->contacts->email, 'admin', $order);
                            $order_edit_city_delivery->send_email(\Yii::$app->user->identity->email, 'user', $order);

                            $success = '?????????? ???????????????????????????? ??????????????.';

                            \Yii::$app->session->setFlash('success', $success);
                            return $this->redirect('/client/order?order_id='.$order->order_id);
                        } else {

                            $success = '???? ???????????? ???? ????????????????.';

                            \Yii::$app->session->setFlash('success', $success);
                            return $this->redirect('/client/order?order_id='.$order->order_id);
                        }
                    }

                    return $this->render('order_edit_city_delivery', ['order' => $order, 'order_edit_city_delivery' => $order_edit_city_delivery]);
                } else {
                    echo 'C?????????? ???????????? ???? ?????????????????? ???????????????? ????????????.';
                }
            } else {
                echo '?????? ?????????? ?????????????? ????????????????????????.';
            }
        } else {
            echo '???????????? ???????????? ???? ????????????????????.';
        }
    }
}
