<?php

use app\models\VentasEncabezado;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\VentasEncabezadoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ventas';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="ventas-encabezado-index" >

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nueva Venta', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Fecha Creación',
                'value' => 'Fecha_create',
                
            ],
            'Total',
            'Nota',
            [
                'label' => 'Alumno',
                'value' => function ($searchAlumnos) {
                    return $searchAlumnos->alumnos->Matricula . ' - '.$searchAlumnos->alumnos->Apellido.' '.$searchAlumnos->alumnos->Nombre;
                }
            ],
            [
                'label' => 'Estatus',
                'value' => function ($searchEstatus) {
                return $searchEstatus->estatusencabezado->Nombre;
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
