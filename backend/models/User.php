<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\rbac\DbManager;

/**
 *
 * @property string $password
 * @property string $username
 * @property int $status
 * @property int $role
 */
class User extends Model
{

    public $id;
    public $status;
    public $roles;
    public $username;
    public $password;
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['roles', function ($attribute, $params) {
                if(!is_array($this->role)){
                     $this->addError('role','Role is not array!');
                 }
            }],
            [['email', 'username'], 'required'],
            ['email', 'email'],
            [['id', 'status'], 'integer'],
            ['password', 'safe'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'roles' => Yii::t('app', 'Roles'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function save() {
        $user = \common\models\User::findOne(['username' => $this->username]);

        if($user) {

            $user->status = $this->status;
            $user->email = $this->email;

            // echo '<pre>';
            // print_r($this->attributes);
            // print_r($user->attributes);
            // die('debug');

            $auth = new DbManager;
            $auth->init();
            $auth->revokeAll($user->id);
            foreach($this->roles as $user_role) {
                $role = $auth->getRole($user_role);
                try {
                    $assignment = $auth->assign($role, $user->id);
                } catch (yii\db\Exception $e) {
                    Yii::warning($e->__toString(), 'database');
                }
            }

            return $user->save();
        } else {
            // new user
            $user = new \common\models\User();
            $password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $user->password_hash = $password;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = $this->status;
            $user->auth_key = \Yii::$app->security->generateRandomString();
            if($user->save()) {
                $auth = new DbManager;
                $auth->init();
                foreach($this->roles as $user_role) {
                    $role = $auth->getRole($user_role);
                    try {
                        $assignment = $auth->assign($role, $user->id);
                    } catch (yii\db\Exception $e) {
                        Yii::warning($e->__toString(), 'database');
                    }
                }
                return $user;
            }

            return false;
        }
    }
}
