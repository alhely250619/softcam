<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CategoriaProductos $model */

$this->title = 'Create Categoria Productos';
$this->params['breadcrumbs'][] = ['label' => 'Categoria Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-productos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
