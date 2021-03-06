<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\filters\AjaxAccess;
use common\models\LoginForm;
use common\models\News;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use DateTime;
use common\models\UserData;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['logout', 'signup', 'index'],
                'rules' => [
//                    [
//                        'actions' => ['signup'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
                    [
                        'actions' => ['login','request-password-reset','reset-password'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'ajax' => [
                'class' => AjaxAccess::className(),
                'only' => ['vote']
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
     * @inheritdoc
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
    public function actionIndex()
    {
        $upcomingBd = [];
        $birthdays = UserData::findBySql('SELECT
            id,
            first_name,
            birthday,
            birthday + INTERVAL(YEAR(CURRENT_TIMESTAMP) - YEAR(birthday)) + 0 YEAR AS currbirthday,
            birthday + INTERVAL(YEAR(CURRENT_TIMESTAMP) - YEAR(birthday)) + 1 YEAR AS nextbirthday
        FROM user_data
        WHERE birthday IS NOT NULL
        HAVING currbirthday >= CURRENT_TIMESTAMP
        ORDER BY CASE
            WHEN currbirthday >= CURRENT_TIMESTAMP THEN currbirthday
            ELSE nextbirthday
        END
        LIMIT 3')->all();
        foreach ($birthdays as $birthday) {
            $date = new DateTime($birthday->birthday);
            array_push($upcomingBd, [
                'name' => $birthday->first_name,
                'birthday' => $date->format('j F'),
                'id' => $birthday->id
            ]);
        }
        $newsDataProvider = new \yii\data\ActiveDataProvider([
            'query' => News::find()->with('author')->orderBy('date DESC')->active(),
            'totalCount' => 3,
            'pagination' => [
                'pageSize' => 3
            ]
        ]);
//        \common\helpers\Logger::warn($newsDataProvider->getModels());
        return $this->render('index', [
            'birthdays' => $upcomingBd,
            'newsDataProvider' => $newsDataProvider
        ]);
    }
    
    public function actionOfficeMap(){
        return $this->render('officeMap');
    }
    
    public function actionVote(){
//        \common\helpers\Logger::warn(Yii::$app->request->post());
        $model = new \common\models\UserPollValue();
        if($model->load(Yii::$app->request->post())){
            $model->user_id = Yii::$app->user->id;
            $model->save();
            return \common\widgets\PollWidget::widget();
        }
        \common\helpers\Logger::warn('here');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
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
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'login';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
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
        $this->layout = 'login';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
