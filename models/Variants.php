<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "variants".
 *
 * @property integer $id
 * @property integer $products_id
 * @property string $type
 * @property integer $price
 *
 * @property Accounting[] $accountings
 * @property Products $products
 */
class Variants extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'variants';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['products_id', 'type', 'price'], 'required'],
            [['products_id', 'price'], 'integer'],
            [['type'], 'string', 'max' => 255],
            [['products_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['products_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'products_id' => 'Products ID',
            'type' => 'Type',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountings()
    {
        return $this->hasMany(Accounting::className(), ['variants_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Products::className(), ['id' => 'products_id']);
    }

    public static function getVariantsList($products_id)
    {
        $data = Variants::find()
            ->where(['products_id'=>$products_id])
            ->select(['id','type AS name'])->asArray()->all();

        return $data;
    }

}
