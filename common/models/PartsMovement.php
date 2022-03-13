<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%parts_movement}}".
 *
 * @property int $id
 * @property int|null $parts_id
 * @property string|null $type
 * @property int|null $supplier_id
 * @property string|null $batch_no
 * @property int|null $qty
 * @property int|null $price
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 * @property Parts $parts
 * @property Supplier $supplier
 * @property User $updatedBy
 */
class PartsMovement extends \yii\db\ActiveRecord
{
    public static $types = ['CONSUMED' => 'Consumed', 'ADDED' => 'Received'];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%parts_movement}}';
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
            [['parts_id', 'supplier_id', 'qty', 'price', 'updated_by', 'created_by'], 'integer'],
            [['moved_at', 'updated_at', 'created_at'], 'safe'],
            [['moved_at'], 'required'],
            [['type'], 'string', 'max' => 20],
            [['remarks'], 'string', 'max' => 500],
            [['batch_no'], 'string', 'max' => 45],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['parts_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parts::className(), 'targetAttribute' => ['parts_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'id']],
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
            'parts_id' => Yii::t('app', 'Parts'),
            'type' => Yii::t('app', 'Type'),
            'supplier_id' => Yii::t('app', 'Supplier'),
            'batch_no' => Yii::t('app', 'Batch No'),
            'qty' => Yii::t('app', 'Qty'),
            'price' => Yii::t('app', 'Price'),
            'remarks' => Yii::t('app', 'Notes'),
            'moved_at' => Yii::t('app', 'Moved At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
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
     * Gets query for [[Parts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParts()
    {
        return $this->hasOne(Parts::className(), ['id' => 'parts_id']);
    }

    /**
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
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

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if (strpos($this->moved_at, '/') == 2) {
            $this->moved_at = substr($this->moved_at, 6, 4) . '-' . substr($this->moved_at, 0, 2) . '-'
                . substr($this->moved_at, 3, 2). ' '
                . substr($this->moved_at, 11, 2) .':' . substr($this->moved_at, 14, 2) .':00';
        }
        if($this->type == 'ADDED') {
            $this->qty = ABS($this->qty);
        } else {
            $this->qty = ABS($this->qty) * -1;
        }

        return true;

    }

}
