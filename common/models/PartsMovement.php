<?php

namespace common\models;

use Yii;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%parts_movement}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parts_id', 'supplier_id', 'qty', 'price', 'updated_by', 'created_by'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['type'], 'string', 'max' => 20],
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
            'parts_id' => Yii::t('app', 'Parts ID'),
            'type' => Yii::t('app', 'Type'),
            'supplier_id' => Yii::t('app', 'Supplier ID'),
            'batch_no' => Yii::t('app', 'Batch No'),
            'qty' => Yii::t('app', 'Qty'),
            'price' => Yii::t('app', 'Price'),
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
}
