<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerJsFile('@web/assets/angular-1.5.7/angular.min.js', ['position' => \yii\web\View::POS_HEAD]); ?>
    <?php $this->head() ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header class="nav-disenio">
    <?php
    NavBar::begin([//PARA EL MENU
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-dark navbar-expand-md', 'style' => 'background-color: #016cbc; position: fixed; top: 0; width: 100%;',
        ],
    ]);
    //Aqui se loguea el usuario en el backend
    if (Yii::$app->user->isGuest) {  //aqui se detecta el logueo
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    }else
    {   
        //Aqui se loguea el usuario en el backend
        if (Yii::$app->user->isGuest) {  //aqui se detecta el logueo
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        }else
        {
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Alumnos', 'url' => ['/alumnos/index']],
                ['label' => 'Venta', 'url' => ['/ventas-encabezado/index']],
            ];
            
            //titulo de menu con opcion, se agrega el menu
            $menuItems[] = ['label' => 'Pagos', 'url' => ['/site/index'],
                'options' =>['class' =>'dropdown'],
                'template'=>'<a href="{url}" class="href_class">{label}</a>',
                'items' =>[ ['label' => ' Pagos', 'url' => ['/pagos']],
                            ['label' => 'Concepto de Pagos', 'url' => ['/conceptos']],
                            ['label' => 'Método de Pagos', 'url' => ['/metodo-pago']],    
                            ],
                ];  
                
            $menuItems[] = ['label' => 'Productos', 'url' => ['/site/index'],
                            'options' =>['class' =>'dropdown'],
                            'template'=>'<a href="{url}" class="">{label}</a>',
                            'items' =>[ ['label' => 'Productos', 'url' => ['/productos']],
                                        ['label' => 'Tallas', 'url' => ['/tallas']],
                                        ['label' => 'Categoria de Productos', 'url' => ['/categoria-productos']],
                                        ['label' => 'Genero de Productos', 'url' => ['/genero']],
                                        ],
                            ];  
        }
    }
    echo '<img class= "img-logo" src="imagenes/logo-softcam.png">';

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto'],
        'items' => $menuItems,
    ]);

    if (Yii::$app->user->isGuest) {
        echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
    } else {
        echo '<li class="btn btn-outline-primary dropdown no-arrow text-white">'
        . '<img class="img-profile rounded-circle img-small" src="imagenes/profile.png">'
        . Html::encode(Yii::$app->user->identity->username)
        . '</span>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            '<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Cerrar Sesión',
            ['class' => 'dropdown-item']
        )
        . Html::endForm()
        . '</li>';
    }

    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0 pt-3">
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
?>
<style>
    /* Estilos para el modal */
    .img-small {
        margin-right: 5px;
        margin-left: -10px;
    }
    .img-logo {
        width: 200px;
        height: 50px;
        margin-left: -5%;
        margin-right: 1%;
    }
</style>