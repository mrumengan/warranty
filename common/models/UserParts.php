<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%user_parts}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $version
 * @property int $type
 * @property string|null $parts_code
 * @property string|null $notes
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $user
 * @property MissingHexohm $missingHexohm
 */
class UserParts extends \yii\db\ActiveRecord
{
    public $nice_name;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_parts}}';
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
            [['user_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['version'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 20],
            [['parts_code'], 'string', 'max' => 10],
            [['notes'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
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
            'version' => Yii::t('app', 'Version'),
            'type' => Yii::t('app', 'Type'),
            'parts_code' => Yii::t('app', 'Parts Code'),
            'notes' => Yii::t('app', 'Notes'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
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

    public function getNicename()
    {
        return $this->type .' '. $this->version;
    }

    /**
     * Gets query for [[MissingHexohm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMissingHexohm()
    {
        return $this->hasOne(MissingHexohm::className(), ['hexohm_id' => 'id']);
    }

}
