<?php

namespace app\controllers;

use app\components\StringsHelper;
use app\models\ActorAttributes;
use app\models\ActorSkills;
use app\models\LoginForm;
use app\models\User;
use Yii;
use app\models\Users;
use yii\helpers\StringHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    private $userType;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'update' => ['POST'],
                    'uimage' => ['POST'],
                    'uvideo' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'uploadPhoto' => [
                'class' => 'budyaga\cropper\actions\UploadAction',
                'url' => 'http://www.fastcast.ca/images/profile_pics',
                'path' => '@app/images/profile_pics',
                'maxSize' => '99999999',
                /*'url' => 'http://eatwithalfred.com/chef/images/chef',*/
                /*'path' => '/var/www/html/chef/images/chef',*/
            ]
        ];
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionProfile()
    {
        $id = Yii::$app->user->id;
        $user = self::findModel($id);
        if ($user->type === "Actor") {
            $actorSkills = new ActorSkills();
            $actorAttributes = ActorAttributes::findOne(['actor_id' => $id]);
            if (empty($actorAttributes)) {
                $actorAttributes = new ActorAttributes();
            }
            return $this->render('actorsProfile', [
                'model' => $user,
                'modelSkills' => $actorSkills,
                'modelAttributes' => $actorAttributes,
            ]);
        } else if ($user->type === "Filmmaker") {
            return $this->render('filmmakersProfile', [
                'model' => $user,
            ]);
        }
        return $this->redirect(['site/login']);
    }


    public function actionViewProfile($email)
    {
        $model = Users::find()->where(['id' => Yii::$app->user->id])->one();
        $user = self::findModelByEmail($email);
        if (Yii::$app->user->id == $user->id) {
            return $this->redirect(['users/profile']);
        }
        if ($user->type === "Actor") {
            return $this->render('viewActorProfile', [
                'model' => $model,
                'user' => $user,
            ]);
        } else if ($user->type === "Filmmaker") {
            return $this->render('viewFilmmakerProfile', [
                'model' => $model,
                'user' => $user,
            ]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'profile' page.
     * @return mixed
     */
    public function actionRegister()
    {
        if (isset($_GET['type'])) {
            $this->userType = $_GET['type'];
            if ($this->userType == "Actor" || $this->userType == "Filmmaker") {
                $model = new Users();
                $model->type = $this->userType;
                if ($model->load(Yii::$app->request->post())) {
                    $model->email_token = time() . rand();
                    if ($model->save()) {

                        $html = "<a href='http://www.fastcast.ca/index.php?r=users/email-verification?email=" . $model->email . "&token=" . $model->email_token . "'>Register</a>";

                        Yii::$app->mailer->compose()
                            ->setTo($model->email)
                            ->setFrom(['FastCast.ca@gmail.com'])
                            ->setSubject('FastCast :: Email Verification')
                            ->setHtmlBody($html)
                            ->send();

                        $loginModel = new LoginForm();
                        $loginModel->username = $model->email;
                        $loginModel->password = $model->password;
                        if ($loginModel->login()) {
                            return $this->redirect(['profile']);
                        }
                    }
                } else {
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEmailVerification($email, $token)
    {
        $user = Users::find()->where(['email' => $email, 'email_token' => $token])->one();
        if (!empty($user)) {
            $user->email_verified = 1;
            if ($user->save()) {
                $loginModel = new LoginForm();
                $loginModel->username = $user->email;
                $loginModel->password = $user->password;
                if ($loginModel->login()) {
                    return $this->goBack();
                }
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'profile' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = $this->findModel(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->website_link)) {
                if (!(substr($model->website_link, 0, 8) == "https://") && substr($model->website_link, 0, 7) != "http://") {
                    $model->website_link = "http://" . $model->website_link;
                }
            }
            $model->save(false);
            return $this->redirect(['profile']);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUvideo()
    {
        $model = $this->findModel(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post())) {
            if (StringsHelper::getYoutubeVimeoLink($model->demo_reel)) {
                $model->demo_reel = StringsHelper::getYoutubeVimeoLink($model->demo_reel);
                $model->save(false);
            }
        }
        return $this->redirect(['profile']);
    }

    public function actionUimage()
    {
        $model = $this->findModel(Yii::$app->user->id);
        $old = $model->profile_picture;
        if ($model->load(Yii::$app->request->post())) {
            if (isset($model->profile_picture)) {
                $img = $model->profile_picture;
                if (!is_null($old)) {
                    if (unlink('images/profile_pics/' . $old)) {

                    }
                }
                $i = strripos($img, '/');
                $model->profile_picture = substr($img, $i + 1);
                $model->save();
            }
        }
        return $this->redirect(['profile']);
    }

    public function actionUresume()
    {
        $model = $this->findModel(Yii::$app->user->id);
        $old = $model->resume;
        if ($model->load(Yii::$app->request->post())) {
            $model->resume = UploadedFile::getInstance($model, 'resume');
            if (isset($model->resume)) {
                $name = $model->id . time() . rand() . "." . $model->resume->extension;
                if ($model->uploadResume($name)) {
                    if (!is_null($old)) {
                        unlink('resume/' . $old);
                    }
                    $model->resume = $name;
                    $model->save(false);
                }
            }
        }
        return $this->redirect(['profile']);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelByEmail($email)
    {
        if (($model = Users::findOne(['email' => $email])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTest()
    {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
