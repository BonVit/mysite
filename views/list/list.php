<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\widgets\DatePicker;

$form = ActiveForm::begin();

echo $form->field($model, 'products_id')->dropDownList($items,[
    'prompt' => 'Оберіть продукт...'])->
label('Продукти:');
echo $form->field($model, 'variants_id')->widget(DepDrop::classname(), [
    'pluginOptions'=>[
        'depends'=>[Html::getInputId($model, 'products_id')],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/list/variant'])
    ],
])->label('Моделі:');


echo $form->field($model, 'products_price')->textInput(['disabled' => true])->label('Введіть ціну:');

echo $form->field($model, 'accounting_variant')->radioList([
    '0' => 'Прихід',
    '1' => 'Розхід',
])->label('');


//echo $form->field($model,'date')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => '2014-01-01']]);
echo $form->field($model,'date')->widget(DatePicker::className(), [
    //'name' => 'dp_2',
    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
    //'value' => '23-Feb-1982',
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'dd-M-yyyy'
    ]
])->label('Введіть дату:');


?>

<?= Html::submitButton('Додати', ['class' => 'btn btn-primary', 'value' => 'add', 'name'=> 'submit']) ?>

<?php

$script = <<< JS
    $('#productslist-variants_id').on('change', function() {
        if($(this).val() != '')
            $('#productslist-products_price').attr('disabled', false);
        else 
            $('#productslist-products_price').attr('disabled', true);
    });
    
    $('#productslist-products_id').on('change', function() {
        $('#productslist-products_price').attr('disabled', true);
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);

ActiveForm::end();
?>
