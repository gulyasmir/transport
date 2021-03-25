<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;

use common\models\DedicatedTransportCar;
use common\models\DedicatedTransportTruck;
use common\models\GeneralCargoLetter;
use common\models\GeneralCargoManyPlaces;
use common\models\GeneralCargoOnePlace;

use common\models\User;
use common\models\Documents;
use common\models\FeedbackRequest;
use common\models\DocumentRequest;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'logout'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['admin', 'customer'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
      $dedicated_car = DedicatedTransportCar::find()->all();
      $start_count_dedicated_car = count($dedicated_car);

      $model = DedicatedTransportTruck::find()->all();
      $start_count_dedicated_truck = count($model);

      $model = GeneralCargoLetter::find()->all();
      $start_count_general_cargo_letter = count($model);

      $model = GeneralCargoManyPlaces::find()->all();
      $start_count_general_cargo_many_places = count($model);

      $model = GeneralCargoOnePlace::find()->all();
      $start_count_general_cargo_one_place = count($model);
      //
      $model = User::find()->all();
      $start_count_user = count($model);

      $model = Documents::find()->all();
      $start_count_documents = count($model);

      $model = FeedbackRequest::find()->all();
      $start_count_feedback_request = count($model);

      $model = DocumentRequest::find()->all();
      $start_count_document_request = count($model);

      $session = Yii::$app->session;


        $session->set('start_count_dedicated_car', $start_count_dedicated_car);
        $session->set('start_count_dedicated_truck', $start_count_dedicated_truck);
        $session->set('start_count_general_cargo_letter', $start_count_general_cargo_letter);
        $session->set('start_count_general_cargo_many_places', $start_count_general_cargo_many_places);
        $session->set('start_count_general_cargo_one_place', $start_count_general_cargo_one_place);

        $session->set('start_count_user', $start_count_user);
        $session->set('start_count_documents', $start_count_documents);
        $session->set('start_count_feedback_request', $start_count_feedback_request);
        $session->set('start_count_document_request', $start_count_document_request);

        return $this->render('index');
    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {

          return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        $session = Yii::$app->session;
      $session->close(); // закрываем сессию админа
      $session->destroy();
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
