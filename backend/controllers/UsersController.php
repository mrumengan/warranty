<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserProfile;
use yii\base\Security;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'update', 'create', 'delete'],
                        'allow' => true,
                        'roles' => ['Admin'],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['>', 'id', 1]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new \backend\models\User();
        $user = new User();
        $profile = new UserProfile();

        if ($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            $is_valid = $model->validate();
            if($is_valid) $profile->user_id = 1;
            $is_valid = $profile->validate() && $is_valid;

            if ($is_valid) {
                $user = $model->save(false);
                $profile->user_id = $user->id;
                if(count($model->roles) == 1 && $model->roles[0] == 'Member') {
                    $profile->type = 'MEMBER';
                } else {
                    $profile->type = 'USER';
                }
                $profile->save(false);
                return $this->redirect(['/users']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user,
            'profile' => $profile
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new \backend\models\User();
        $user = $this->findModel($id);
        $profile = UserProfile::findOne(['user_id' => $id]);

        if ($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            $is_valid = $model->validate();
            $is_valid = $profile->validate() && $is_valid;
            $model->id = $id;

            if ($is_valid) {
                $user->save(false);
                $profile->save(false);
            }

            if($model->password != null && trim($model->password) != '') {
                $password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                $user->password_hash = $password;
                $user->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        
        return $this->render('update', [
            'model' => $model,
            'user' => $user,
            'profile' => $profile
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user = $this->findModel($id);
        $user->status = 0;
        $user->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
