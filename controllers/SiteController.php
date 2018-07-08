<?php

namespace app\controllers;

use app\models\Notifications;
use app\models\Project;
use app\models\RoleApplications;
use app\models\Users;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout', 'search'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'search' => ['post'],
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

    public function actionHome()
    {
        $user = Users::findOne(['id' => Yii::$app->user->id]);
        $actors = Users::find()->where(['type' => 'Actor'])->andWhere(['is_featured' => 1])->limit('4')->all();
        $filmmakers = Users::find()->where(['type' => 'Filmmaker'])->andWhere(['is_featured' => 1])->limit('4')->all();
        $active_projects = Project::find()->where(['status' => 'Active'])->orderBy('id desc')->limit('3')->all();
        $featured_projects = Project::find()->where(['is_featured' => 1])->orderBy('id desc')->limit('12')->all();
        return $this->render('index', [
            'user' => $user,
            'featured_actors' => $actors,
            'featured_filmmakers' => $filmmakers,
            'active_projects' => $active_projects,
            'featured_projects' => $featured_projects
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->render('welcome');
        }
        return $this->redirect(['site/home']);
    }

    public function actionActors()
    {
        $user = Users::findOne(['id' => Yii::$app->user->id]);
        $actors = Users::find()->where(['type' => 'Actor'])->all();
        return $this->render('actors', [
            'user' => $user,
            'actors' => $actors
        ]);
    }

    public function actionProjects()
    {
        $user = Users::findOne(['id' => Yii::$app->user->id]);
        $projects = Project::find()->all();
        return $this->render('projects', [
            'user' => $user,
            'projects' => $projects,
            'query' => null,
        ]);
    }

    public function actionRequests()
    {
        if (Yii::$app->user->isGuest) {
            return $this->render('welcome');
        }
        $id = Yii::$app->user->id;
        $user = Users::findOne(['id' => $id]);
        $notifications = Notifications::find()->where(['message_to_id' => $user->id])->all();
        return $this->render('notifications', [
            'user' => $user,
            'notifications' => $notifications
        ]);
    }

    public function actionRoleRequests()
    {
        if (Yii::$app->user->isGuest) {
            return $this->render('welcome');
        }
        $user = Users::findOne(['id' => Yii::$app->user->id]);
        $requests = RoleApplications::find()->where(['request_to_id' => $user->id])->all();
        return $this->render('role_requests', [
            'user' => $user,
            'requests' => !empty($requests) ? $requests : ''
        ]);
    }

    public function actionUserProjects($email)
    {
        $user = Users::findOne(['id' => Yii::$app->user->id]);
        $model = Users::findOne(['email' => $email]);
        $projects = $model->userProjects;
        return $this->render('user-projects', [
            'user' => $user,
            'projects' => $projects,
            'model' => $model
        ]);
    }

    public function actionTermsAndConditions(){
        return $this->render('termsAndConditions');
    }

    public function actionFilmmakers()
    {
        $user = Users::findOne(['id' => Yii::$app->user->id]);
        $filmmakers = Users::find()->where(['type' => 'Filmmaker'])->all();
        return $this->render('filmmakers', [
            'user' => $user,
            'filmmakers' => $filmmakers
        ]);
    }

    public function actionSearch()
    {
        $user = Users::findOne(['id' => Yii::$app->user->id]);

        if (isset($_POST["name"])) {
            $name = $_POST["name"];
            $type = $_POST["type"];
            if ($type == 1) {
                $actors = Users::find()
                    ->andWhere(['type' => 'Actor'])
                    ->andWhere(['like', 'name', $name])
                    ->orderBy('name')
                    ->all();
                echo $this->render('actorSearch', [
                    'user' => $user,
                    'actors' => $actors,
                    'query' => $name,
                    'type' => $type
                ]);
            } else if ($type == 2) {
                $filmmakers = Users::find()
                    ->andWhere(['type' => 'Filmmaker'])
                    ->andWhere(['like', 'name', $name])
                    ->orderBy('name')
                    ->all();
                echo $this->render('filmmakerSearch', [
                    'user' => $user,
                    'filmmakers' => $filmmakers,
                    'query' => $name,
                    'type' => $type
                ]);
            } else if ($type == 3) {
                $projects = Project::find()->where(['like', 'name_of_production', $name])
                    ->orderBy('name_of_production')
                    ->all();
                echo $this->render('projectSearch', [
                    'user' => $user,
                    'projects' => $projects,
                    'query' => $name,
                    'type' => $type,
                    'pgenre' => null,
                    'ptype' => null,
                ]);
            }
        }
    }

    public function actionProjectSearch()
    {
        $user = Users::findOne(['id' => Yii::$app->user->id]);

        if (isset($_POST["pgenre"])) {
            $genre = $_POST["pgenre"];
            $type = $_POST["ptype"];
            if ($genre == "All") {
                if ($type == "All") {
                    $projects = Project::find()->orderBy('name_of_production')->all();
                } else {
                    $projects = Project::find()->where(['status' => $type])
                        ->orderBy('name_of_production')
                        ->all();
                }
            } else if ($type == "All") {
                $projects = Project::find()->where(['type' => $genre])
                    ->orderBy('name_of_production')
                    ->all();
            } else {
                $projects = Project::find()->where(['type' => $genre])
                    ->andWhere(['status' => $type])
                    ->orderBy('name_of_production')
                    ->all();
            }
            echo $this->render('projectSearch', [
                'user' => $user,
                'projects' => $projects,
                'pgenre' => $genre,
                'ptype' => $type,
                'query' => null,
            ]);

        }
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
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->render('signup');
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $id = Yii::$app->user->id;
        $user = Users::findOne(['id' => $id]);
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
