<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\VentasEncabezado $model */
/** @var app\models\VentasDetalle $detalleModel */


$this->title = 'Nueva venta';
$this->params['breadcrumbs'][] = ['label' => 'Ventas Encabezados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div >
    <div>
        <div class="ventas-encabezado-create">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
                'detalleModel' => $detalleModel,
            ]) ?>

        </div>
    </div>
</div>