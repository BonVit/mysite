<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Accounting */

$this->title = 'Create Accounting';
$this->params['breadcrumbs'][] = ['label' => 'Accountings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
