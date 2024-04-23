<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Genero $model */

$this->title = 'Create Genero';
$this->params['breadcrumbs'][] = ['label' => 'Generos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genero-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
