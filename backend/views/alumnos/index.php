<?php

use app\models\Alumnos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AlumnosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Lista de Alumnos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumnos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       <!-- <?= Html::a('Regitrar Alumnos', ['create'], ['class' => 'btn btn-primary']) ?> -->
       <?= Html::a('Registrar Alumnos', ['create'], ['class' => 'btn btn-primary', 'style' => 'background-color:  #3498DB; border-color:  #3498DB;']) ?>

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Matricula',
            'Nombre',
            'Apellido',
            'Sexo',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Alumnos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Id' => $model->Id]);
                 }
            ],
        ],
    ]); ?>


</div>
