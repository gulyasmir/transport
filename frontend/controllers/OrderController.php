<?php

namespace frontend\controllers;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Address;
use common\models\EntityAddress;
use common\models\IndividualAddress;
use common\models\Order;
use common\models\DedicatedTransportCar;
use common\models\DedicatedTransportTruck;
use common\models\GeneralCargoOnePlace;
use common\models\GeneralCargoManyPlaces;
use common\models\GeneralCargoLetter;
use common\models\Rate;
use frontend\models\SenderForm;
use frontend\models\RecipientForm;
use frontend\models\PayerForm;
use frontend\models\TermsForm;

class OrderController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            // Проверка доступа сделана на уровне action
            //'access' => [
            //    'class' => AccessControl::className(),
            //    'only' => ['index'],
            //    'rules' => [
            //        [
            //            'actions' => ['index'],
            //            'allow' => true,
            //            'roles' => ['customer'],
            //        ],
            //    ],
            //],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['POST'],
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


  public function actionUpdateprice(){
  if(\Yii::$app->request->isAjax){

      $data = \Yii::$app->request->post();
//print_r($data['id']);
 //echo $data->id;
      $order = Order::find()->where(['order_id' => (int)$data['order']])->one();
      $order->route_length  = $data['routeLength'] ;
      $order->calculated_price  = $data['calculated_price'] ;
      $order->save();
        return true;
    }
  return true;

  }

    public function actionIndex()
    {
        //if (!\Yii::$app->request->isAjax) {
        //    echo "<pre>";print_r($_POST);die('___');
        //}

        if (\Yii::$app->user->isGuest) {

            // Форма расчета с главной
            $calculation_post = \Yii::$app->request->post('CalculationForm');
            if (count($calculation_post)) {

                $calculation_post['city_pick_up'] = isset($calculation_post['city_pick_up']) ? 1 : 0;
                $calculation_post['city_delivery'] = isset($calculation_post['city_delivery']) ? 1 : 0;

                $session = \Yii::$app->session;
                $session->set('auth_rediret', 'order');

                // Сессия для заполнения формы расчета (Откуда и Куда)
                $session->set('order_calculation_from', $calculation_post['from']);
                $session->set('order_calculation_to', $calculation_post['to']);
                $session->set('order_calculation_city_pick_up', $calculation_post['city_pick_up']);
                $session->set('order_calculation_city_delivery', $calculation_post['city_delivery']);
            }

            return $this->redirect('login');
        }

        // Текущая вкладка заказа и тип заказа
        $order_tab = \Yii::$app->request->post('main_tab');
        $form_type = '';
        if ($order_tab == 'cargo') {
            $form_type = \Yii::$app->request->post('cargo_composition');
        } elseif ($order_tab == 'dedicated') {
            $form_type = \Yii::$app->request->post('shipping_types');
        }

        // Сценарии адресов
        $sender_model = new SenderForm();
        $sender_form_post = \Yii::$app->request->post('SenderForm');
        if (mb_stripos($sender_form_post['individual_entity'], 'entity') !== false) {
            $sender_model->scenario = 'entity';
        } elseif (mb_stripos($sender_form_post['individual_entity'], 'individual') !== false) {
            $sender_model->scenario = 'individual';
        } elseif (mb_stripos($sender_form_post['individual_entity'], 'address') !== false) {
            $sender_model->scenario = 'address';
        }
        $recipient_model = new RecipientForm();
        $recipient_form_post = \Yii::$app->request->post('RecipientForm');
        if (mb_stripos($recipient_form_post['individual_entity'], 'entity') !== false) {
            $recipient_model->scenario = 'entity';
        } elseif (mb_stripos($recipient_form_post['individual_entity'], 'individual') !== false) {
            $recipient_model->scenario = 'individual';
        } elseif (mb_stripos($recipient_form_post['individual_entity'], 'address') !== false) {
            $recipient_model->scenario = 'address';
        }
        $payer_model = new PayerForm();

        // Типы заказов
        $car_model = new DedicatedTransportCar();
        $truck_model = new DedicatedTransportTruck();
        $one_model = new GeneralCargoOnePlace();
        $many_model = new GeneralCargoManyPlaces();
        $letter_model = new GeneralCargoLetter();

        // Адреса отправителей и получателей
        $identification = \Yii::$app->params['identification'];
        $sender_entity_adresses = EntityAddress::find()->joinWith('address')->where(['{{%address}}.user_id' => \Yii::$app->user->identity->id, '{{%address}}.type' => 1])->all();
        $sender_individual_adresses = IndividualAddress::find()->joinWith('address')->where(['{{%address}}.user_id' => \Yii::$app->user->identity->id, '{{%address}}.type' => 1])->all();
        $sender_address_list = [];
        if (count($sender_entity_adresses)) {
            foreach($sender_entity_adresses as $sender_entity_adress) {
                $sender_address_list[$sender_entity_adress->address_id] =
                    "{$sender_entity_adress->legalForm->name} &laquo;{$sender_entity_adress->name}&raquo;, {$sender_entity_adress->country}, ИНН: {$sender_entity_adress->inn}, {$sender_entity_adress->address->address}, {$sender_entity_adress->address->contact_person}, {$sender_entity_adress->address->phone}";
            }
        }
        if (count($sender_individual_adresses)) {
            foreach($sender_individual_adresses as $sender_individual_adress) {
                $sender_address_list[$sender_individual_adress->address_id] =
                    "{$sender_individual_adress->full_name}, {$sender_individual_adress->country}, {$sender_individual_adress->address->address}, Документ: {$identification[$sender_individual_adress->identification]} {$sender_individual_adress->identification_series} {$sender_individual_adress->identification_number}, {$sender_individual_adress->address->phone}";
            }
        }
        $recipient_entity_adresses = EntityAddress::find()->joinWith('address')->where(['{{%address}}.user_id' => \Yii::$app->user->identity->id, '{{%address}}.type' => 2])->all();
        $recipient_individual_adresses = IndividualAddress::find()->joinWith('address')->where(['{{%address}}.user_id' => \Yii::$app->user->identity->id, '{{%address}}.type' => 2])->all();
        $recipient_address_list = [];
        if (count($recipient_entity_adresses)) {
            foreach($recipient_entity_adresses as $recipient_entity_adress) {
                $recipient_address_list[$recipient_entity_adress->address_id] =
                    "{$recipient_entity_adress->legalForm->name} &laquo;{$recipient_entity_adress->name}&raquo;, {$recipient_entity_adress->country}, ИНН: {$recipient_entity_adress->inn}, {$recipient_entity_adress->address->address}, {$recipient_entity_adress->address->contact_person}, {$recipient_entity_adress->address->phone}";
            }
        }
        if (count($recipient_individual_adresses)) {
            foreach($recipient_individual_adresses as $recipient_individual_adress) {
                $recipient_address_list[$recipient_individual_adress->address_id] =
                    "{$recipient_individual_adress->full_name}, {$recipient_individual_adress->country}, {$recipient_individual_adress->address->address}, Документ: {$identification[$recipient_individual_adress->identification]} {$recipient_individual_adress->identification_series} {$recipient_individual_adress->identification_number}, {$recipient_individual_adress->address->phone}";
            }
        }

        // Черновики из базы
        $car_draft = DedicatedTransportCar::find()->joinWith('order')->where(['{{%order}}.user_id' => \Yii::$app->user->identity->id, 'is_draft' => 1])->one();
        $truck_draft = DedicatedTransportTruck::find()->joinWith('order')->where(['{{%order}}.user_id' => \Yii::$app->user->identity->id, 'is_draft' => 1])->one();
        $one_draft = GeneralCargoOnePlace::find()->joinWith('order')->where(['{{%order}}.user_id' => \Yii::$app->user->identity->id, 'is_draft' => 1])->one();
        $many_draft = GeneralCargoManyPlaces::find()->joinWith('order')->where(['{{%order}}.user_id' => \Yii::$app->user->identity->id, 'is_draft' => 1])->one();
        $letter_draft = GeneralCargoLetter::find()->joinWith('order')->where(['{{%order}}.user_id' => \Yii::$app->user->identity->id, 'is_draft' => 1])->one();


        /**********************/
        /* Сохранение адресов */
        /**********************/
        if (!\Yii::$app->request->isAjax && $form_type) {

            // НАЧАЛО ТРАНЗАКЦИИ
            $transaction = \Yii::$app->db->beginTransaction();

            // Сохраненяем отправителя
            if ($sender_model->load(\Yii::$app->request->post())) {

                // Выбран адрес
                if ($sender_model->individual_entity == 'address-sender' && $sender_model->address_id) {
                    $sender_address = Address::find()->where(['address_id' => $sender_model->address_id])->one();
                } else {

                    // Сохраняем основной адрес отправителя
                    $sender_address = new Address();
                    $sender_address->create_date = time();
                    if ($sender_model->individual_entity == 'entity-sender') {
                        $sender_address->contact_person = $sender_model->entity_contact_person;
                        $sender_address->phone = $sender_model->entity_phone;
                        $sender_address->address = $sender_model->entity_address;
                    } elseif ($sender_model->individual_entity == 'individual-sender') {
                        $sender_address->contact_person = $sender_model->individual_contact_person;
                        $sender_address->phone = $sender_model->individual_phone;
                        $sender_address->address = $sender_model->individual_address;
                    }
                    $sender_address->user_id = \Yii::$app->user->identity->id;
                    $sender_address->type = 1; // Отправитель
                    if (!$sender_address->save()) {
                        $transaction->rollback();
                        return false;
                    }
                }

                // Юр
                if ($sender_model->individual_entity == 'entity-sender') {

                    // Сохраняем адрес отправителя юр
                    $entity_address = new EntityAddress();
                    $entity_address->address_id = $sender_address->address_id;
                    $entity_address->legal_form_id = $sender_model->entity_legal_form_id;
                    $entity_address->name = $sender_model->entity_name;
                    $entity_address->country = $sender_model->entity_country;
                    $entity_address->inn = $sender_model->entity_inn;

                    $entity_address->kpp = $sender_model->entity_kpp;

                    if (!$entity_address->save()) {
                        $transaction->rollback();
                        return false;
                    }

                // Физ
                } elseif ($sender_model->individual_entity == 'individual-sender') {

                    // Сохраняем адрес отправителя физ
                    $individual_address = new IndividualAddress();
                    $individual_address->address_id = $sender_address->address_id;
                    $individual_address->full_name = $sender_model->individual_full_name;
                    $individual_address->country = $sender_model->individual_country;
                    $individual_address->identification = $sender_model->individual_identification;
                    $individual_address->identification_series = $sender_model->individual_identification_series;
                    $individual_address->identification_number = $sender_model->individual_identification_number;
                    $individual_address->identification_uvd = $sender_model->individual_identification_uvd;
                    $individual_address->identification_date = $sender_model->individual_identification_date;

                    if (!$individual_address->save()) {
                        $transaction->rollback();
                        return false;
                    }
                }
            }

            // Сохраненяем получателя
            if ($recipient_model->load(\Yii::$app->request->post())) {

                // Выбран адрес
                if ($recipient_model->individual_entity == 'address-recipient' && $recipient_model->address_id) {
                    $recipient_address = Address::find()->where(['address_id' => $recipient_model->address_id])->one();
                } else {

                    // Сохраняем основной адрес получателя
                    $recipient_address = new Address();
                    $recipient_address->create_date = time();
                    if ($recipient_model->individual_entity == 'entity-recipient') {
                        $recipient_address->contact_person = $recipient_model->entity_contact_person;
                        $recipient_address->phone = $recipient_model->entity_phone;
                        $recipient_address->address = $recipient_model->entity_address;
                    } elseif ($recipient_model->individual_entity == 'individual-recipient') {
                        $recipient_address->contact_person = $recipient_model->individual_contact_person;
                        $recipient_address->phone = $recipient_model->individual_phone;
                        $recipient_address->address = $recipient_model->individual_address;
                    }
                    $recipient_address->user_id = \Yii::$app->user->identity->id;
                    $recipient_address->type = 2; // Получатель
                    if (!$recipient_address->save()) {
                        $transaction->rollback();
                        return false;
                    }
                }

                // Юр
                if ($recipient_model->individual_entity == 'entity-recipient') {

                    // Сохраняем адрес получателя юр
                    $entity_address = new EntityAddress();
                    $entity_address->address_id = $recipient_address->address_id;
                    $entity_address->legal_form_id = $recipient_model->entity_legal_form_id;
                    $entity_address->name = $recipient_model->entity_name;
                    $entity_address->country = $recipient_model->entity_country;
                    $entity_address->inn = $recipient_model->entity_inn;

                      $entity_address->kpp = $sender_model->entity_kpp;

                    if (!$entity_address->save()) {
                        $transaction->rollback();
                        return false;
                    }

                // Физ
                } elseif ($recipient_model->individual_entity == 'individual-recipient') {

                    // Сохраняем адрес получателя физ
                    $individual_address = new IndividualAddress();
                    $individual_address->address_id = $recipient_address->address_id;
                    $individual_address->full_name = $recipient_model->individual_full_name;
                    $individual_address->country = $recipient_model->individual_country;
                    $individual_address->identification = $recipient_model->individual_identification;
                    $individual_address->identification_series = $recipient_model->individual_identification_series;
                    $individual_address->identification_number = $recipient_model->individual_identification_number;

                    $individual_address->identification_uvd = $sender_model->individual_identification_uvd;
                    $individual_address->identification_date = $sender_model->individual_identification_date;
                    if (!$individual_address->save()) {
                        $transaction->rollback();
                        return false;
                    }
                }
            }

            // Сохраненяем плательщика
            if ($payer_model->load(\Yii::$app->request->post())) {
                if ($payer_model->sender_or_recipient == 1) {
                    $payer_address_id = $sender_address->address_id;
                } elseif ($payer_model->sender_or_recipient == 2) {
                    $payer_address_id = $recipient_address->address_id;
                }
            }
        }


        /************************/
        /* Cборный груз 1 место */
        /************************/
        $one_post = \Yii::$app->request->post('GeneralCargoOnePlace');
        if (count($one_post) && $form_type == 'one') {

            // Ajax валидация
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                if (
                    $one_model->load(\Yii::$app->request->post()) &&
                    $sender_model->load(\Yii::$app->request->post()) &&
                    $recipient_model->load(\Yii::$app->request->post()) &&
                    $payer_model->load(\Yii::$app->request->post())
                ) {
                    return array_merge(
                        ActiveForm::validate($one_model),
                        ActiveForm::validate($sender_model),
                        ActiveForm::validate($recipient_model),
                        ActiveForm::validate($payer_model)
                    );
                }
            }

            // Заказ
            if (\Yii::$app->request->post('save_order') !== null) {

                $is_draft = 0;
                $success = 'Расчет заказа сформирован успешно.';

                //$delete_draft = 1;

            // Черновик
            } elseif (\Yii::$app->request->post('draft_order') !== null) {

                $is_draft = 1;
                $success = 'Расчет заказа сохранен в черновик успешно.';

                //$delete_draft = 0;
            }

            if (isset($one_draft->gc_one_place_id) && $one_draft->gc_one_place_id) {
                $one_model = $one_draft;
            }

            // Сохранение
            if ($one_model->load(\Yii::$app->request->post())) {

                // Если уже создан заказ (черновик)
                if (isset($one_model->order->order_id) && $one_model->order->order_id && mb_stripos($one_model->order->order_number, 'СО-') !== false) {
                    $order = $one_model->order;
                } else {
                    $order = new Order();
                }


                // Сохраняем основной заказ
                $order->create_date = time();
                $order->order_number = '';
                $order->from = $one_model->from;
                $order->to = $one_model->to;
                $order->user_id = \Yii::$app->user->identity->id;
                $order->sender_id = $sender_address->address_id;
                $order->recipient_id = $recipient_address->address_id;
                $order->payer_id = $payer_address_id;
                //$order->status = $is_draft ? 0 : 1; // Новый заказ в обработке, если не черновик
                $order->status = 0; // Далее в подтверждении выставится статус
                if (!$order->save()) {
                    $transaction->rollback();
                    return false;
                }
                $order->order_number = \Yii::$app->params['order_prefix']['one'].$order->order_id;
                if (!$order->save()) {
                    $transaction->rollback();
                    return false;
                }

                // Сохранение типа заказа
                $one_model->order_id = $order->order_id;
                $one_model->user_id = \Yii::$app->user->identity->id;
                $one_model->pick_up_date = \Yii::$app->formatter->asTimestamp($one_model->pick_up_date);
                $one_model->loading_operations = isset($one_post['loading_operations']) ? 1 : 0;
                $one_model->territory_entry = isset($one_post['territory_entry']) ? 1 : 0;
                $one_model->city_pick_up = isset($one_post['city_pick_up']) ? 1 : 0;
                $one_model->city_delivery = isset($one_post['city_delivery']) ? 1 : 0;
                //$one_model->is_draft = $is_draft;
                $one_model->is_draft = 1;

                if ($one_model->save()) {

                    //if (!$is_draft) {
                    //    $one_model->send_email($this->contacts->email, 'admin');
                    //    $one_model->send_email(\Yii::$app->user->identity->email, 'user');
                    //}

                    // КОНЕЦ ТРАНЗАКЦИИ
                    $transaction->commit();

                    // Удаляем сессию расчета заказа (Откуда и Куда)
                    $this->remove_order_calculation_session();

                    //// Удаление черновика
                    //if ($delete_draft) {
                    //    if (isset($one_draft->gc_one_place_id) && $one_draft->gc_one_place_id) {
                    //        $one_draft->delete();
                    //    }
                    //}

                    \Yii::$app->session->setFlash('success', $success);
                    if ($is_draft) {
                        return $this->redirect('order');
                    } else {
                        return $this->redirect('order/confirmation?order_id='.$order->order_id);
                    }
                }
            }
        } else {

            // Отображаем черновик в расчете заказа
            if (isset($one_draft->gc_one_place_id) && $one_draft->gc_one_place_id) {
                $one_model = $one_draft;
                $one_model->pick_up_date = date('d.m.Y', $one_model->pick_up_date);

                $one_model->from = $one_model->order->from;
                $one_model->to = $one_model->order->to;

                // Отправитель
                $sender_model->individual_entity = 'address-sender';
                $sender_model->address_id = $one_model->order->sender_id;

                // Получатель
                $recipient_model->individual_entity = 'address-recipient';
                $recipient_model->address_id = $one_model->order->recipient_id;

                // Плательщик
                if (isset($one_model->order->payer->type) && $one_model->order->payer->type) {

                    $payer_model->sender_or_recipient = $one_model->order->payer->type;
                    $sender_model->address_id = $one_model->order->sender_id;
                }
            }
        }


        /*******************************/
        /* Cборный груз несколько мест */
        /*******************************/
        $many_post = \Yii::$app->request->post('GeneralCargoManyPlaces');
        if (count($many_post) && $form_type == 'many') {

            // Ajax валидация
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                if (
                    $many_model->load(\Yii::$app->request->post()) &&
                    $sender_model->load(\Yii::$app->request->post()) &&
                    $recipient_model->load(\Yii::$app->request->post()) &&
                    $payer_model->load(\Yii::$app->request->post())
                ) {
                    return array_merge(
                        ActiveForm::validate($many_model),
                        ActiveForm::validate($sender_model),
                        ActiveForm::validate($recipient_model),
                        ActiveForm::validate($payer_model)
                    );
                }
            }

            // Заказ
            if (\Yii::$app->request->post('save_order') !== null) {

                $is_draft = 0;
                $success = 'Расчет заказа сформирован успешно.';

                //$delete_draft = 1;

            // Черновик
            } elseif (\Yii::$app->request->post('draft_order') !== null) {

                $is_draft = 1;
                $success = 'Расчет заказа сохранен в черновик успешно.';

                //$delete_draft = 0;
            }

            if (isset($many_draft->gc_many_places_id) && $many_draft->gc_many_places_id) {
                $many_model = $many_draft;
            }

            // Сохранение
            if ($many_model->load(\Yii::$app->request->post())) {

                // Если уже создан заказ (черновик)
                if (isset($many_model->order->order_id) && $many_model->order->order_id && mb_stripos($many_model->order->order_number, 'СМ-') !== false) {
                    $order = $many_model->order;
                } else {
                    $order = new Order();
                }

                // Сохраняем основной заказ
                $order->create_date = time();
                $order->order_number = '';
                $order->from = $many_model->from;
                $order->to = $many_model->to;
                $order->user_id = \Yii::$app->user->identity->id;
                $order->sender_id = $sender_address->address_id;
                $order->recipient_id = $recipient_address->address_id;
                $order->payer_id = $payer_address_id;
                //$order->status = $is_draft ? 0 : 1; // Новый заказ в обработке, если не черновик
                $order->status = 0; // Далее в подтверждении выставится статус
                if (!$order->save()) {
                    $transaction->rollback();
                    return false;
                }
                $order->order_number = \Yii::$app->params['order_prefix']['many'].$order->order_id;
                if (!$order->save()) {
                    $transaction->rollback();
                    return false;
                }

                // Сохранение типа заказа
                $many_model->order_id = $order->order_id;
                $many_model->user_id = \Yii::$app->user->identity->id;
                $many_model->pick_up_date = \Yii::$app->formatter->asTimestamp($many_model->pick_up_date);
                $many_model->loading_operations = isset($many_post['loading_operations']) ? 1 : 0;
                $many_model->territory_entry = isset($many_post['territory_entry']) ? 1 : 0;
                $many_model->city_pick_up = isset($many_post['city_pick_up']) ? 1 : 0;
                $many_model->city_delivery = isset($many_post['city_delivery']) ? 1 : 0;
                //$many_model->is_draft = $is_draft;
                $many_model->is_draft = 1;

                if ($many_model->save()) {

                    //if (!$is_draft) {
                    //    $many_model->send_email($this->contacts->email, 'admin');
                    //    $many_model->send_email(\Yii::$app->user->identity->email, 'user');
                    //}

                    // КОНЕЦ ТРАНЗАКЦИИ
                    $transaction->commit();

                    // Удаляем сессию расчета заказа (Откуда и Куда)
                    $this->remove_order_calculation_session();

                    //// Удаление черновика
                    //if ($delete_draft) {
                    //    if (isset($many_draft->gc_many_places_id) && $many_draft->gc_many_places_id) {
                    //        $many_draft->delete();
                    //    }
                    //}

                    \Yii::$app->session->setFlash('success', $success);
                    if ($is_draft) {
                        return $this->redirect('order');
                    } else {
                        return $this->redirect('order/confirmation?order_id='.$order->order_id);
                    }
                }
            }
        } else {

            // Отображаем черновик в расчете заказа
            if (isset($many_draft->gc_many_places_id) && $many_draft->gc_many_places_id) {
                $many_model = $many_draft;
                $many_model->pick_up_date = date('d.m.Y', $many_model->pick_up_date);

                $many_model->from = $many_model->order->from;
                $many_model->to = $many_model->order->to;

                // Отправитель
                $sender_model->individual_entity = 'address-sender';
                $sender_model->address_id = $many_model->order->sender_id;

                // Получатель
                $recipient_model->individual_entity = 'address-recipient';
                $recipient_model->address_id = $many_model->order->recipient_id;

                // Плательщик
                if (isset($many_model->order->payer->type) && $many_model->order->payer->type) {

                    $payer_model->sender_or_recipient = $many_model->order->payer->type;
                    $sender_model->address_id = $many_model->order->sender_id;
                }
            }
        }


        /***********************/
        /* Cборный груз письмо */
        /***********************/
        $letter_post = \Yii::$app->request->post('GeneralCargoLetter');
        if (count($letter_post) && $form_type == 'letter') {

            // Ajax валидация
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                if (
                    $letter_model->load(\Yii::$app->request->post()) &&
                    $sender_model->load(\Yii::$app->request->post()) &&
                    $recipient_model->load(\Yii::$app->request->post()) &&
                    $payer_model->load(\Yii::$app->request->post())
                ) {
                    return array_merge(
                        ActiveForm::validate($letter_model),
                        ActiveForm::validate($sender_model),
                        ActiveForm::validate($recipient_model),
                        ActiveForm::validate($payer_model)
                    );
                }
            }

            // Заказ
            if (\Yii::$app->request->post('save_order') !== null) {

                $is_draft = 0;
                $success = 'Расчет заказа сформирован успешно.';

                //$delete_draft = 1;

            // Черновик
            } elseif (\Yii::$app->request->post('draft_order') !== null) {

                $is_draft = 1;
                $success = 'Расчет заказа сохранен в черновик успешно.';

                //$delete_draft = 0;
            }

            if (isset($letter_draft->gc_letter_id) && $letter_draft->gc_letter_id) {
                $letter_model = $letter_draft;
            }

            // Сохранение
            if ($letter_model->load(\Yii::$app->request->post())) {

                // Если уже создан заказ (черновик)
                if (isset($letter_model->order->order_id) && $letter_model->order->order_id && mb_stripos($letter_model->order->order_number, 'СП-') !== false) {
                    $order = $letter_model->order;
                } else {
                    $order = new Order();
                }

                // Сохраняем основной заказ
                $order->create_date = time();
                $order->order_number = '';
                $order->from = $letter_model->from;
                $order->to = $letter_model->to;
                $order->user_id = \Yii::$app->user->identity->id;
                $order->sender_id = $sender_address->address_id;
                $order->recipient_id = $recipient_address->address_id;
                $order->payer_id = $payer_address_id;
                //$order->status = $is_draft ? 0 : 1; // Новый заказ в обработке, если не черновик
                $order->status = 0; // Далее в подтверждении выставится статус
                if (!$order->save()) {
                    $transaction->rollback();
                    return false;
                }
                $order->order_number = \Yii::$app->params['order_prefix']['letter'].$order->order_id;
                if (!$order->save()) {
                    $transaction->rollback();
                    return false;
                }

                // Сохранение типа заказа
                $letter_model->order_id = $order->order_id;
                $letter_model->user_id = \Yii::$app->user->identity->id;
                $letter_model->pick_up_date = \Yii::$app->formatter->asTimestamp($letter_model->pick_up_date);
                $letter_model->territory_entry = isset($letter_post['territory_entry']) ? 1 : 0;
                $letter_model->city_pick_up = isset($letter_post['city_pick_up']) ? 1 : 0;
                $letter_model->city_delivery = isset($letter_post['city_delivery']) ? 1 : 0;
                //$letter_model->is_draft = $is_draft;
                $letter_model->is_draft = 1;

                if ($letter_model->save()) {

                    //if (!$is_draft) {
                    //    $letter_model->send_email($this->contacts->email, 'admin');
                    //    $letter_model->send_email(\Yii::$app->user->identity->email, 'user');
                    //}

                    // КОНЕЦ ТРАНЗАКЦИИ
                    $transaction->commit();

                    // Удаляем сессию расчета заказа (Откуда и Куда)
                    $this->remove_order_calculation_session();

                    //// Удаление черновика
                    //if ($delete_draft) {
                    //    if (isset($letter_draft->gc_letter_id) && $letter_draft->gc_letter_id) {
                    //        $letter_draft->delete();
                    //    }
                    //}

                    \Yii::$app->session->setFlash('success', $success);
                    if ($is_draft) {
                        return $this->redirect('order');
                    } else {
                        return $this->redirect('order/confirmation?order_id='.$order->order_id);
                    }
                }
            }
        } else {

            // Отображаем черновик в расчете заказа
            if (isset($letter_draft->gc_letter_id) && $letter_draft->gc_letter_id) {
                $letter_model = $letter_draft;
                $letter_model->pick_up_date = date('d.m.Y', $letter_model->pick_up_date);

                $letter_model->from = $letter_model->order->from;
                $letter_model->to = $letter_model->order->to;

                // Отправитель
                $sender_model->individual_entity = 'address-sender';
                $sender_model->address_id = $letter_model->order->sender_id;

                // Получатель
                $recipient_model->individual_entity = 'address-recipient';
                $recipient_model->address_id = $letter_model->order->recipient_id;

                // Плательщик
                if (isset($letter_model->order->payer->type) && $letter_model->order->payer->type) {

                    $payer_model->sender_or_recipient = $letter_model->order->payer->type;
                    $sender_model->address_id = $letter_model->order->sender_id;
                }
            }
        }


        /*****************************/
        /* Выделенный транспорт фура */
        /*****************************/
        $truck_post = \Yii::$app->request->post('DedicatedTransportTruck');
        if (count($truck_post) && $form_type == 'truck') {

            // Ajax валидация
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                if (
                    $truck_model->load(\Yii::$app->request->post()) &&
                    $sender_model->load(\Yii::$app->request->post()) &&
                    $recipient_model->load(\Yii::$app->request->post()) &&
                    $payer_model->load(\Yii::$app->request->post())
                ) {
                    return array_merge(
                        ActiveForm::validate($truck_model),
                        ActiveForm::validate($sender_model),
                        ActiveForm::validate($recipient_model),
                        ActiveForm::validate($payer_model)
                    );
                }
            }

            // Заказ
            if (\Yii::$app->request->post('save_order') !== null) {

                $is_draft = 0;
                $success = 'Расчет заказа сформирован успешно.';

                //$delete_draft = 1;

            // Черновик
            } elseif (\Yii::$app->request->post('draft_order') !== null) {

                $is_draft = 1;
                $success = 'Расчет заказа сохранен в черновик успешно.';

                //$delete_draft = 0;
            }

            if (isset($truck_draft->dt_truck_id) && $truck_draft->dt_truck_id) {
                $truck_model = $truck_draft;
            }

            // Сохранение
            if ($truck_model->load(\Yii::$app->request->post())) {

                // Если уже создан заказ (черновик)
                if (isset($truck_model->order->order_id) && $truck_model->order->order_id && mb_stripos($truck_model->order->order_number, 'ВФ-') !== false) {
                    $order = $truck_model->order;
                } else {
                    $order = new Order();
                }

                // Сохраняем основной заказ
                $order->create_date = time();
                $order->order_number = '';
                $order->from = $truck_model->from;
                $order->to = $truck_model->to;
                $order->user_id = \Yii::$app->user->identity->id;
                $order->sender_id = $sender_address->address_id;
                $order->recipient_id = $recipient_address->address_id;
                $order->payer_id = $payer_address_id;
                //$order->status = $is_draft ? 0 : 1; // Новый заказ в обработке, если не черновик
                $order->status = 0; // Далее в подтверждении выставится статус
                if (!$order->save()) {
                    $transaction->rollback();
                    return false;
                }
                $order->order_number = \Yii::$app->params['order_prefix']['truck'].$order->order_id;
                if (!$order->save()) {
                    $transaction->rollback();
                    return false;
                }

                // Сохранение типа заказа
                $truck_model->order_id = $order->order_id;
                $truck_model->user_id = \Yii::$app->user->identity->id;
                $truck_model->pick_up_date = \Yii::$app->formatter->asTimestamp($truck_model->pick_up_date);
                $truck_model->loading_operations = isset($truck_post['loading_operations']) ? 1 : 0;
                $truck_model->territory_entry = isset($truck_post['territory_entry']) ? 1 : 0;
                $truck_model->city_pick_up = isset($truck_post['city_pick_up']) ? 1 : 0;
                $truck_model->city_delivery = isset($truck_post['city_delivery']) ? 1 : 0;
                $truck_model->filling = isset($truck_post['filling']) ? 1 : 0;
                $truck_model->hard_package = isset($truck_post['hard_package']) ? 1 : 0;
                $truck_model->pallet_transparent = isset($truck_post['pallet_transparent']) ? 1 : 0;
                $truck_model->pallet_black = isset($truck_post['pallet_black']) ? 1 : 0;
                $truck_model->tent_remove_to = isset($truck_post['tent_remove_to']) ? 1 : 0;
                $truck_model->tent_remove_from = isset($truck_post['tent_remove_from']) ? 1 : 0;
                $truck_model->pallet_board_pack = isset($truck_post['pallet_board_pack']) ? 1 : 0;
                if ($truck_model->semi_trailer_type == 1) {
                    $truck_model->tent_hard_board = isset($truck_post['tent_hard_board']) ? 1 : 0;
                    $truck_model->tent_removable_top_beam = isset($truck_post['tent_removable_top_beam']) ? 1 : 0;
                    $truck_model->tent_removable_side_beam = isset($truck_post['tent_removable_side_beam']) ? 1 : 0;
                } else {
                    $truck_model->tent_hard_board = 0;
                    $truck_model->tent_removable_top_beam = 0;
                    $truck_model->tent_removable_side_beam = 0;
                }
                //$truck_model->is_draft = $is_draft;
                $truck_model->is_draft = 1;

                if ($truck_model->save()) {

                    //if (!$is_draft) {
                    //    $truck_model->send_email($this->contacts->email, 'admin');
                    //    $truck_model->send_email(\Yii::$app->user->identity->email, 'user');
                    //}

                    // КОНЕЦ ТРАНЗАКЦИИ
                    $transaction->commit();

                    // Удаляем сессию расчета заказа (Откуда и Куда)
                    $this->remove_order_calculation_session();

                    //// Удаление черновика
                    //if ($delete_draft) {
                    //    if (isset($truck_draft->dt_truck_id) && $truck_draft->dt_truck_id) {
                    //        $truck_draft->delete();
                    //    }
                    //}

                    \Yii::$app->session->setFlash('success', $success);
                    if ($is_draft) {
                        return $this->redirect('order');
                    } else {
                        return $this->redirect('order/confirmation?order_id='.$order->order_id);
                    }
                }
            }
        } else {

            // Отображаем черновик в расчете заказа
            if (isset($truck_draft->dt_truck_id) && $truck_draft->dt_truck_id) {
                $truck_model = $truck_draft;
                $truck_model->pick_up_date = date('d.m.Y', $truck_model->pick_up_date);

                $truck_model->from = $truck_model->order->from;
                $truck_model->to = $truck_model->order->to;

                // Отправитель
                $sender_model->individual_entity = 'address-sender';
                $sender_model->address_id = $truck_model->order->sender_id;

                // Получатель
                $recipient_model->individual_entity = 'address-recipient';
                $recipient_model->address_id = $truck_model->order->recipient_id;

                // Плательщик
                if (isset($truck_model->order->payer->type) && $truck_model->order->payer->type) {

                    $payer_model->sender_or_recipient = $truck_model->order->payer->type;
                    $sender_model->address_id = $truck_model->order->sender_id;
                }
            }
        }


        /*****************************/
        /* Выделенный транспорт машина */
        /*****************************/
        $car_post = \Yii::$app->request->post('DedicatedTransportCar');
        if (count($car_post) && $form_type == 'car') {

            // Ajax валидация
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                if (
                    $car_model->load(\Yii::$app->request->post()) &&
                    $sender_model->load(\Yii::$app->request->post()) &&
                    $recipient_model->load(\Yii::$app->request->post()) &&
                    $payer_model->load(\Yii::$app->request->post())
                ) {
                    return array_merge(
                        ActiveForm::validate($car_model),
                        ActiveForm::validate($sender_model),
                        ActiveForm::validate($recipient_model),
                        ActiveForm::validate($payer_model)
                    );
                }
            }

            // Заказ
            if (\Yii::$app->request->post('save_order') !== null) {

                $is_draft = 0;
                $success = 'Расчет заказа сформирован успешно.';

                //$delete_draft = 1;

            // Черновик
            } elseif (\Yii::$app->request->post('draft_order') !== null) {

                $is_draft = 1;
                $success = 'Расчет заказа сохранен в черновик успешно.';

                //$delete_draft = 0;
            }

            if (isset($car_draft->dt_car_id) && $car_draft->dt_car_id) {
                $car_model = $car_draft;
            }

            // Сохранение
            if ($car_model->load(\Yii::$app->request->post())) {

                // Если уже создан заказ (черновик)
                if (isset($car_model->order->order_id) && $car_model->order->order_id && mb_stripos($car_model->order->order_number, 'ВМ-') !== false) {
                    $order = $car_model->order;
                } else {
                    $order = new Order();
                }

                // Сохраняем основной заказ
                $order->create_date = time();
                $order->order_number = '';
                $order->from = $car_model->from;
                $order->to = $car_model->to;
                $order->user_id = \Yii::$app->user->identity->id;
                $order->sender_id = $sender_address->address_id;
                $order->recipient_id = $recipient_address->address_id;
                $order->payer_id = $payer_address_id;
                //$order->status = $is_draft ? 0 : 1; // Новый заказ в обработке, если не черновик
                $order->status = 0; // Далее в подтверждении выставится статус
                if (!$order->save()) {
                    $transaction->rollback();
                    return false;
                }
                $order->order_number = \Yii::$app->params['order_prefix']['car'].$order->order_id;
                if (!$order->save()) {
                    $transaction->rollback();
                    return false;
                }

                // Сохранение типа заказа
                $car_model->order_id = $order->order_id;
                $car_model->user_id = \Yii::$app->user->identity->id;
                $car_model->pick_up_date = \Yii::$app->formatter->asTimestamp($car_model->pick_up_date);
                $car_model->loading_operations = isset($car_post['loading_operations']) ? 1 : 0;
                $car_model->territory_entry = isset($car_post['territory_entry']) ? 1 : 0;
                $car_model->city_pick_up = isset($car_post['city_pick_up']) ? 1 : 0;
                $car_model->city_delivery = isset($car_post['city_delivery']) ? 1 : 0;
                $car_model->filling = isset($car_post['filling']) ? 1 : 0;
                $car_model->hard_package = isset($car_post['hard_package']) ? 1 : 0;
                $car_model->pallet_transparent = isset($car_post['pallet_transparent']) ? 1 : 0;
                $car_model->pallet_black = isset($car_post['pallet_black']) ? 1 : 0;
                $car_model->tent_remove_to = isset($car_post['tent_remove_to']) ? 1 : 0;
                $car_model->tent_remove_from = isset($car_post['tent_remove_from']) ? 1 : 0;
                $car_model->pallet_board_pack = isset($car_post['pallet_board_pack']) ? 1 : 0;
                //$car_model->is_draft = $is_draft;
                $car_model->is_draft = 1;

                if ($car_model->save()) {

                    //if (!$is_draft) {
                    //    $car_model->send_email($this->contacts->email, 'admin');
                    //    $car_model->send_email(\Yii::$app->user->identity->email, 'user');
                    //}

                    // КОНЕЦ ТРАНЗАКЦИИ
                    $transaction->commit();

                    // Удаляем сессию расчета заказа (Откуда и Куда)
                    $this->remove_order_calculation_session();

                    //// Удаление черновика
                    //if ($delete_draft) {
                    //    if (isset($car_draft->dt_car_id) && $car_draft->dt_car_id) {
                    //        $car_draft->delete();
                    //    }
                    //}

                    \Yii::$app->session->setFlash('success', $success);
                    if ($is_draft) {
                        return $this->redirect('order');
                    } else {
                        return $this->redirect('order/confirmation?order_id='.$order->order_id);
                    }
                }
            }
        } else {

            // Отображаем черновик в расчете заказа
            if (isset($car_draft->dt_car_id) && $car_draft->dt_car_id) {
                $car_model = $car_draft;
                $car_model->pick_up_date = date('d.m.Y', $car_model->pick_up_date);

                $car_model->from = $car_model->order->from;
                $car_model->to = $car_model->order->to;

                // Отправитель
                $sender_model->individual_entity = 'address-sender';
                $sender_model->address_id = $car_model->order->sender_id;

                // Получатель
                $recipient_model->individual_entity = 'address-recipient';
                $recipient_model->address_id = $car_model->order->recipient_id;

                // Плательщик
                if (isset($car_model->order->payer->type) && $car_model->order->payer->type) {

                    $payer_model->sender_or_recipient = $car_model->order->payer->type;
                    $sender_model->address_id = $car_model->order->sender_id;
                }
            }
        }


        /*****************************/
        /* Расчет заказа с главной */
        /*****************************/
        // POST данные
        $calculation_post = \Yii::$app->request->post('CalculationForm');
        // Данные из сессии
        $session = \Yii::$app->session;
        $calculation_session = [];
        if ($session->get('order_calculation_from') !== null) {
            $calculation_session = [
                'from' => $session->get('order_calculation_from'),
                'to' => $session->get('order_calculation_to'),
                'city_pick_up' => $session->get('order_calculation_city_pick_up'),
                'city_delivery' => $session->get('order_calculation_city_delivery'),
            ];
        }

        if (count($calculation_post) || count($calculation_session)) {

            if (\Yii::$app->request->post('calculating_submit') !== null) {

                $calculation_post['city_pick_up'] = isset($calculation_post['city_pick_up']) ? 1 : 0;
                $calculation_post['city_delivery'] = isset($calculation_post['city_delivery']) ? 1 : 0;

                $calculation_data = $calculation_post;

            } elseif ($calculation_session['from'] !== null) {

                $calculation_data = $calculation_session;
            }

            $car_post = ['DedicatedTransportCar' => $calculation_data];
            $truck_post = ['DedicatedTransportTruck' => $calculation_data];
            $one_post = ['GeneralCargoOnePlace' => $calculation_data];
            $many_post = ['GeneralCargoManyPlaces' => $calculation_data];
            $letter_post = ['GeneralCargoLetter' => $calculation_data];

            $sender_post = ['SenderForm' => $calculation_data];
            $recipient_post = ['RecipientForm' => $calculation_data];
            $payer_post = ['PayerForm' => $calculation_data];

            $car_model->load($car_post);
            $truck_model->load($truck_post);
            $one_model->load($one_post);
            $many_model->load($many_post);
            $letter_model->load($letter_post);

            $sender_model->load($sender_post);
            $recipient_model->load($recipient_post);
            $payer_model->load($payer_post);
        }

        $this->view->params['breadcrumbs'] = [
            ['label' => 'Расчет заказа'],
        ];

        if (!$sender_model->individual_entity) {
            $sender_model->individual_entity = 'entity-sender';
        }

        if (!$recipient_model->individual_entity) {
            $recipient_model->individual_entity = 'entity-recipient';
        }

        if (!$payer_model->sender_or_recipient) {
            $payer_model->sender_or_recipient = 2;
        }

        return $this->render('index', [
            'car_model' => $car_model,
            'truck_model' => $truck_model,
            'one_model' => $one_model,
            'many_model' => $many_model,
            'letter_model' => $letter_model,
            'sender_model' => $sender_model,
            'recipient_model' => $recipient_model,
            'payer_model' => $payer_model,
            'sender_address_list' => $sender_address_list,
            'recipient_address_list' => $recipient_address_list,
        ]);
    }

    public function actionConfirmation($order_id)
    {
      //$this->view->registerJsFile('/js/map.js');
        // Ajax валидация
        if (\Yii::$app->request->isAjax) {

            $terms = new TermsForm();

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $post = \Yii::$app->request->post();
            if (!isset($post['TermsForm'])) {
                $post['TermsForm'] = [
                    'terms' => 0
                ];
            }
            if ($terms->load($post)) {
                return ActiveForm::validate($terms);
            }
        }

        $order = Order::find()->where(['order_id' => (int)$order_id])->one();

    $type_order = mb_substr($order->order_number, 0, 2);

    switch ($type_order) {
      case 'СО':  $id_rate = 1;
        break;
      case 'СМ':  $id_rate = 2;
        break;
      case 'СП':  $id_rate = 3;
        break;
      case 'ВФ':  $id_rate = 4;
        break;
      case 'ВМ':  $id_rate = 5;
        break;

      default: $id_rate = 1;
  }

  $rate = Rate::find()->where(['id' => $id_rate])->one();

        if (isset($order->order_id) && $order->order_id) {

            if ($order->user_id == \Yii::$app->user->identity->id) {

                if ($order->status == 0) {

                    // Подтверждение
                    if (\Yii::$app->request->post('confirm_order') !== null) {

                        // НАЧАЛО ТРАНЗАКЦИИ
                        $transaction = \Yii::$app->db->beginTransaction();

                        // Основной заказ
                        $order->status = 1; // В обработке
                        if (!$order->save()) {
                            $transaction->rollback();
                            return false;
                        }

                        // Тип заказа
                        $order_data = $this->get_order_data($order);
                        $order_data->from = $order->from;
                        $order_data->to = $order->to;
                        $order_data->is_draft = 0;
                        if (!$order_data->update()) {
                            $transaction->rollback();
                            return false;
                        }

                        // КОНЕЦ ТРАНЗАКЦИИ
                        $transaction->commit();

                        // Отсылаем email
                        $order_data->send_email($this->contacts->email, 'admin');
                        $order_data->send_email(\Yii::$app->user->identity->email, 'user');

                        $success = "Заказ успешно подтвержден.";

                        \Yii::$app->session->setFlash('success', $success);
                        return $this->redirect('/client/order?order_id='.$order->order_id);

                    // Отмена
                    } elseif (\Yii::$app->request->post('decline_order') !== null) {

                        // Ничего не делаем с заказом он останется черновиком

                        $success = "Заказ отменен.";

                        \Yii::$app->session->setFlash('success', $success);
                        return $this->redirect('/order');
                    }

                    $this->view->params['breadcrumbs'] = [
                        ['label' => 'Подтверждение заказа '.$order->order_number],
                    ];

                    return $this->render('confirmation_order', [
                      'order' => $order,
                      'terms' => new TermsForm(),
                      'rate' => $rate
                    ]);
                } else {
                    echo 'Это заказ уже подтвержден.';
                }
            } else {
                echo 'Это заказ другого пользователя.';
            }
        } else {
            echo 'Такого заказа не существует.';
        }
    }

    function remove_order_calculation_session() {
        $session = \Yii::$app->session;
        $session->remove('order_calculation_from');
        $session->remove('order_calculation_to');
        $session->remove('order_calculation_city_pick_up');
        $session->remove('order_calculation_city_delivery');
    }
}
