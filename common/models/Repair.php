<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%repair}}".
 *
 * @property int $id
 * @property int|null $user_parts_id
 * @property string $problem
 * @property string|null $received_at
 * @property string|null $notification_at
 * @property string|null $tech_recevied_at
 * @property string|null $action_taken
 * @property string|null $tech_done_at
 * @property string|null $admin_tested_at
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property User $userPart
 */
class Repair extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%repair}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            BlameableBehavior::className(),

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_parts_id', 'created_by', 'updated_by'], 'integer'],
            [['problem'], 'required'],
            [['problem', 'action_taken'], 'string'],
            [['received_at', 'notification_at', 'tech_recevied_at', 'tech_done_at', 'admin_tested_at', 'created_at', 'updated_at'], 'safe'],
            // [['user_parts_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_parts_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_parts_id' => Yii::t('app', 'User Parts ID'),
            'problem' => Yii::t('app', 'Problem'),
            'received_at' => Yii::t('app', 'Received At'),
            'notification_at' => Yii::t('app', 'Notification At'),
            'tech_recevied_at' => Yii::t('app', 'Tech Recevied At'),
            'action_taken' => Yii::t('app', 'Action Taken'),
            'tech_done_at' => Yii::t('app', 'Tech Done At'),
            'admin_tested_at' => Yii::t('app', 'Admin Tested At'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[UserPart]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserParts()
    {
        return $this->hasOne(UserParts::className(), ['id' => 'user_parts_id']);
    }
}
