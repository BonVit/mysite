<?php
/**
 * Created by PhpStorm.
 * User: bonar
 * Date: 11/15/2016
 * Time: 8:08 PM
 */
namespace app\models;

use yii\base\Model;

class ProductsList extends Model
{
    public $products_id, $variants_id, $products_price, $date;

    public $accounting_variant;

    public function rules()
    {
        $this->accounting_variant = 0;
        return [
            [['products_id', 'variants_id', 'products_price', 'accounting_variant', 'date'], 'required'],
            [['products_price'], 'integer'],
        ];
    }

}