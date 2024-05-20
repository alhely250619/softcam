<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CategoriaProductos $model */

$this->title = 'Modificar Categoria Producto';
$this->params['breadcrumbs'][] = ['label' => 'Categoria Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="categoria-productos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
