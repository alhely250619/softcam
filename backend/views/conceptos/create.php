<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Conceptos $model */

$this->title = 'Create Conceptos';
$this->params['breadcrumbs'][] = ['label' => 'Conceptos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conceptos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
