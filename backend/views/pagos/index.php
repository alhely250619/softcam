<?php

use app\models\Pagos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\PagosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pagos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagos-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Pagos', ['create', 'bandera' => 1], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'buscarFolios',
                'label' => 'Folio de la venta:',
                'value' => function ($model) {
                    return $model->ventasEncabezado->Folio;
                }
            ],
            'FechaHora_create',

            [
                'attribute' => 'buscarConceptos',
                'label' => 'Conceptos',
                'value' => function ($searchConceptos) {
                    return $searchConceptos->conceptos->Nombre;
                }
            ],
            [
                'attribute' => 'buscarMetodos',
                'label' => 'Método',
                'value' => function ($searchMetodo) {
                return $searchMetodo->metodoPago->Nombre;
                }
            ],
            'Monto',
            
            //'FechaHora_update',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pagos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Id' => $model->Id, 'bandera' => 1]);
                }
            ],
        ],
    ]); ?>
    


</div>