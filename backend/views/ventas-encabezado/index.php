<?php

use app\models\VentasEncabezado;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\VentasEncabezadoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Listado de Ventas';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="ventas-encabezado-index" id="page-wrapper" ng-app="ventaApp" ng-controller="VentasController">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nueva Venta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Fecha_create',
            'Total',
            'Estatus',
            [
                'label' => 'Alumno',
                'value' => function ($searchAlumnos) {
                return $searchAlumnos->alumnos->Matricula;
                }
            ],
            //'Fecha_update',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, VentasEncabezado $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Id' => $model->Id]);
                 }
            ],
        ],
    ]); ?>


</div>
