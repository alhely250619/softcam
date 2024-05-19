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

   < <style>
    .custom-navbar {
        background-color: #3498DB !important; /* Color de fondo personalizado */
    }

    .custom-navbar .navbar-nav .nav-link {
        color: white !important; /* Color de las letras */
        font-weight: bold !important; /* Letras en negrita */
    }

    .custom-navbar .navbar-brand {
        color: white !important; /* Color de la marca */
        font-weight: bold !important; /* Marca en negrita */
    }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>



<header>
    <?php
    NavBar::begin([//PARA EL MENU
        'brandLabel' => 'SOFTCAM',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            //'class' => 'navbar navbar-expand-md navbar-dark bg-primary fixed-top', /// cabiar color
            //'class' => 'navbar', 'style' => 'background-color: #e3f2fd;',
            //'class' => 'navbar navbar-expand-md', 'style' => 'background-color: #3498DB; position: fixed; top: 0; width: 100%;',
            'class' => 'navbar navbar-expand-md custom-navbar fixed-top',

        ],
    ]);

    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
        ['label' => 'Productos', 'url' => ['/productos/index']],
        ['label' => 'Ventas', 'url' => ['/ventas-encabezado/index']],
        ['label' => 'Pagos', 'url' => ['/pagos/index']],
        ['label' => 'Alumnos', 'url' => ['/alumnos/index']],
        ['label' => 'Tallas', 'url' => ['/tallas/index']],
        ['label' => 'Conceptos de pago', 'url' => ['/conceptos/index']],
        ['label' => 'Métodos de pago', 'url' => ['/metodo-pago/index']],
        ['label' => 'Categoría productos', 'url' => ['/categoria-productos/index']],
        ['label' => 'Genero de producto', 'url' => ['/genero/index']],
    ];
    //Aqui se loguea el usuario en el backend
    if (Yii::$app->user->isGuest) {  //aqui se detecta el logueo
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    }else
    {     
        
        //titulo de menu con opcion, se agrega el menu
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Alumnos', 'url' => ['/alumnos/index']],
            ['label' => 'Ventas', 'url' => ['/ventas-encabezado/index']],
            //['label' => 'Venta Detalle', 'url' => ['/ventas-detalle/index']],
        ];
        //Aqui se loguea el usuario en el backend
        if (Yii::$app->user->isGuest) {  //aqui se detecta el logueo
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        }else
        {   
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
                            'template'=>'<a href="{url}" class="href_class">{label}</a>',
                            'items' =>[ ['label' => 'Productos', 'url' => ['/productos']],
                                        ['label' => 'Tallas', 'url' => ['/tallas']],
                                        ['label' => 'Categoria de Productos', 'url' => ['/categoria-productos']],
                                        ['label' => 'Genero de Productos', 'url' => ['/genero']],
                                        ],
                            ];  
        }
    }    
   

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
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
