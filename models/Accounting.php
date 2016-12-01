<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accounting".
 *
 * @property integer $id
 * @property integer $variants_id
 * @property integer $price
 * @property string $operation_type
 * @property integer $date
 *
 * @property Variants $variants
 */
class Accounting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accounting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['variants_id', 'price', 'date'], 'required'],
            [['variants_id', 'price', 'date'], 'integer'],
            [['operation_type'], 'string', 'max' => 255],
            [['variants_id'], 'exist', 'skipOnError' => true, 'targetClass' => Variants::className(), 'targetAttribute' => ['variants_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'variants_id' => 'Variants ID',
            'price' => 'Price',
            'operation_type' => 'Operation Type',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariants()
    {
        return $this->hasOne(Variants::className(), ['id' => 'variants_id']);
    }
}
