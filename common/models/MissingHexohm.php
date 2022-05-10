<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%missing_hexohm}}".
 *
 * @property int $id
 * @property int|null $hexohm_id
 * @property string|null $missing_at
 * @property int|null $status 10 Missing, 20 Found
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property UserParts $hexohm
 */
class MissingHexohm extends \yii\db\ActiveRecord
{
    static $statuses = [
        10 => 'Missing',
        20 => 'Found'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%missing_hexohm}}';
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
            [['hexohm_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['missing_at', 'created_at', 'updated_at'], 'safe'],
            [['hexohm_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserParts::className(), 'targetAttribute' => ['hexohm_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hexohm_id' => Yii::t('app', 'Hexohm ID'),
            'missing_at' => Yii::t('app', 'Missing At'),
            'status' => Yii::t('app', 'Is Missing?'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Hexohm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHexohm()
    {
        return $this->hasOne(UserParts::className(), ['id' => 'hexohm_id']);
    }
}
