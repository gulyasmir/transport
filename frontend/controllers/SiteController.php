<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Article;
use common\models\News;

use common\models\TextForPage;

use yii\data\ActiveDataProvider;

use common\models\ContactShops;
use common\models\Contact;
/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['customer', 'admin'],
                    ],
                ],
            ],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */

     public function actionContact()
     {
        $query = Contact::find()->one();
        $shops = ContactShops::find()->all();

        $text_for_page = TextForPage::find()->where(['page'=>'contact'])->one();

         $model = new ContactForm();
         if ($model->load(Yii::$app->request->post()) && $model->validate()) {
             if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                 Yii::$app->session->setFlash('success', 'Спасибо за обращение! Мы свяжемся с Вами в ближайшее время');
             } else {
                 Yii::$app->session->setFlash('error', 'Неправильный email');
             }

             return $this->refresh();
         } else {
             return $this->render('contact', [
                 'model' => $model,
                 'query' => $query,
                 'shops' => $shops,
                 'text_for_page' => $text_for_page,
             ]);
         }
     }


    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {

            // Форма поиска с главной
            if (count(\Yii::$app->request->post('SearchForm'))) {

                // .......ОБРАБОТКА ПОИСКА........

                $session = \Yii::$app->session;
                $session->set('auth_rediret', 'search');

                return $this->redirect('login');
            }
        }

        // Статьи вкладками
        $articles_tab = Article::find()
            ->where('date <= :date AND view = :view', [':date' => strtotime(date('d.m.Y')), ':view' => 2])
            ->limit(3)
            ->orderBy(['article_id' => SORT_DESC])
        ->all();

        // Статьи блоком
        $articles_block = Article::find()
            ->where('date <= :date AND view = :view', [':date' => strtotime(date('d.m.Y')), ':view' => 1])
          ->orderBy(['article_id' => SORT_DESC])
        ->all();

        // Новости блоком
        $news_block = News::find()
            ->where('1 = 1')
          //  ->limit(4)
            ->orderBy(['news_id' => SORT_DESC])
        ->all();


        $text_for_page = TextForPage::find()->where(['page'=>'index'])->one();


        return $this->render('index', [
            'articles_block' => $articles_block,
            'articles_tab' => $articles_tab,
            'news_block' => $news_block,
            'text_for_page' => $text_for_page,
        ]);
    }

    public function actionArticles($id = false)
    {

        // Статья
        if ($id) {
            $id = (int)$id;

            $article = Article::find()
                ->where('article_id = :article_id', [':article_id' => $id])
            ->one();

            return $this->render('article_one', [
                'article' => $article,

            ]);

        // Статьи
        } else {

            $text_for_page = TextForPage::find()->where(['page'=>'articles'])->one();
            $dataProvider = new ActiveDataProvider([
                'query' => Article::find()->where('date <= :date', [':date' => strtotime(date('d.m.Y'))])->orderBy(['article_id' => SORT_DESC]),
                'pagination' => [
                    'pageSize' => \Yii::$app->params['articles_per_page'],
                ],
            ]);

            return $this->render('articles', [
                'dataProvider' => $dataProvider,
                'text_for_page' => $text_for_page,
            ]);
        }
    }

    public function actionNews($id = false)
    {
        // Статья
        if ($id) {
            $id = (int)$id;

            $new = News::find()
                ->where('news_id = :news_id', [':news_id' => $id])
            ->one();

            return $this->render('news_one', [
                'new' => $new,
            ]);

        // Статьи
        } else {

    $text_for_page = TextForPage::find()->where(['page'=>'news'])->one();
            $dataProvider = new ActiveDataProvider([
                'query' => News::find()->where('1 = 1')->orderBy(['news_id' => SORT_DESC]),
                'pagination' => [
                    'pageSize' => \Yii::$app->params['news_per_page'],
                ],
            ]);

            return $this->render('news', [
                'dataProvider' => $dataProvider,
                  'text_for_page' => $text_for_page,
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
          //  return $this->goHome();
        return $this->redirect('client/index');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $session = \Yii::$app->session;
            if (($auth_rediret = $session->get('auth_rediret')) !== null) {
                if ($auth_rediret == 'order') {
                    return $this->redirect('order');
                } elseif ($auth_rediret == 'search') {
                    return $this->goHome();
                }
            }
        //    return $this->goHome();
          return $this->redirect('client/index');
        } else {
            $text_for_page = TextForPage::find()->where(['page'=>'login'])->one();

            $model->password = '';

            return $this->render('login', [
                'model' => $model,
                  'text_for_page' => $text_for_page,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $text_for_page = TextForPage::find()->where(['page'=>'about'])->one();
        return $this->render('about', [
              'text_for_page' => $text_for_page,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {

          $text_for_page = TextForPage::find()->where(['page'=>'registration'])->one();

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {

                     $session = \Yii::$app->session;
                    if (($auth_rediret = $session->get('auth_rediret')) !== null) {
                        if ($auth_rediret == 'order') {
                            return $this->redirect('order');
                        } elseif ($auth_rediret == 'search') {
                            return $this->goHome();
                        }
                    }
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
              'text_for_page' => $text_for_page,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте свою почту для дальнейших инструкций.');

                //return $this->goHome();
                return $this->redirect('request-password-reset');
            } else {
                Yii::$app->session->setFlash('error', 'Извините, мы не можем восстановить пароль для введенного вами Email адреса.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен.');

            //return $this->goHome();
            return $this->redirect('login');
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
