<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">

    <h1 class="display-4"> Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <a href="<?= \yii\helpers\Url::to(['/ventas-encabezado/create']) ?>">
                <img src="<?= Yii::$app->request->baseUrl ?>/imagenes/ventas.png" alt="Descripción de la imagen" class="img-fluid" width="100" height="100">
            </a>
            <h2>Venta</h2>
            <p>Salida</p>



                
            </div>
            <div class="col-lg-4">
                <h2>Pago</h2>

                <p>.</p>

                <p><a class="btn" href="<?= \yii\helpers\Url::to(['/pagos/create']) ?>"> pago </a></p>
            </div>
            <div class="col-lg-4">
                <h2>Producto</h2>

                <p>.</p>

                <p><a class="btn" href="<?= \yii\helpers\Url::to(['/productos/create']) ?>"> productos </a></p>
            </div>
        </div>

    </div>
</div>
