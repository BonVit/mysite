<?php

namespace app\controllers;

use app\models\Products;
use app\models\ProductsList;
use app\models\Variants;
use MongoDB\BSON\Javascript;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: bonar
 * Date: 11/15/2016
 * Time: 8:13 PM
 */

class ListController extends Controller
{


    public function actionList()
    {
        $model = new ProductsList();



        $products = Products::find()->all();

        $items =  ArrayHelper::map($products,'id','name');;
        return $this->render('list',['model'=>$model, 'items'=>$items]);
    }

    public function actionVariant()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $product_id = $parents[0];
                $out = Variants::getVariantsList($product_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }



}
