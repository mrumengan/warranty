<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $type
 * @property string|null $address
 * @property string|null $mobile
 * @property string|null $notes
 *
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{
    public static $types = [
        'USER' => 'User',
        'MEMBER' => 'Member'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['type'], 'string', 'max' => 10],
            [['address', 'notes'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'type' => Yii::t('app', 'Type'),
            'address' => Yii::t('app', 'Address'),
            'mobile' => Yii::t('app', 'Mobile'),
            'notes' => Yii::t('app', 'Notes'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
