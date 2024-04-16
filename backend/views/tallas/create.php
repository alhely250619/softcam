<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tallas $model */

$this->title = 'Create Tallas';
$this->params['breadcrumbs'][] = ['label' => 'Tallas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tallas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
