<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-4 mb-4">
        <h1 class="display-4"> Bienvenido!</h1>
    </div>
</br>
    <div class="body-content">

        <div class="row text-center">
            <div class="col-lg-4 mark pt-2 pb-2">
                <a class="text-dark" style="text-decoration: none;" href="<?= \yii\helpers\Url::to(['/pagos/create']) ?>">
                    <img src="<?= Yii::$app->request->baseUrl ?>/imagenes/credit-card.png" alt="Descripción de la imagen" class="img-fluid" width="100" height="100">
                    <h2>Nuevo Pago</h2>
                </a>
            </div>
            <div class="col-lg-4 mark pt-2 pb-2">
                <a class="text-dark" style="text-decoration: none;" href="<?= \yii\helpers\Url::to(['/ventas-encabezado/create']) ?>">
                    <img src="<?= Yii::$app->request->baseUrl ?>/imagenes/check-out.png" alt="Descripción de la imagen" class="img-fluid" width="100" height="100">
                    <h2>Nueva Venta</h2>
                </a>
            </div>
            <div class="col-lg-4 mark pt-2 pb-2">
                <a class="text-dark" style="text-decoration: none;" href="<?= \yii\helpers\Url::to(['/productos/create']) ?>">
                    <img src="<?= Yii::$app->request->baseUrl ?>/imagenes/tshirt.png" alt="Descripción de la imagen" class="img-fluid" width="100" height="100">
                    <h2>Nuevo Producto</h2>
                </a>
            </div>
        </div>

    </div>
</div>
<style>
    .mark {
        background-color: white;
        border-radius: 10px;
    }
    .mark:hover {
        background-color: rgb(241, 241, 241);
    }
</style>