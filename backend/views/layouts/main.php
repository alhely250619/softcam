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
    <?php $this->head() ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
            'class' => 'navbar navbar-expand-md', 'style' => 'background-color: #01579B; position: fixed; top: 0; width: 100%;',

        ],
    ]);

    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    //Aqui se loguea el usuario en el backend
    if (Yii::$app->user->isGuest) {  //aqui se detecta el logueo
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    }else
    {     
        
        //titulo de menu con opcion, se agrega el menu
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            //['label' => 'Alumnos', 'url' => ['/alumnos/index']],
            //['label' => 'Venta Encabezado', 'url' => ['/ventas-encabezado/index']],
            //['label' => 'Venta Detalle', 'url' => ['/ventas-detalle/index']],
        ];
        //Aqui se loguea el usuario en el backend
        if (Yii::$app->user->isGuest) {  //aqui se detecta el logueo
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        }else
        {
            $menuItems[] = ['label' => 'Alumnos', 'url' => ['/site/index'],
            'options' =>['class' =>'dropdown'],
            'template'=>'<a href="{url}" class="href_class">{label}</a>',
            'items' =>[ ['label' => 'Alumnos', 'url' => ['/alumnos']],  
                        ],
            ];  

            $menuItems[] = ['label' => 'Ventas', 'url' => ['/site/index'],
            'options' =>['class' =>'dropdown'],
            'template'=>'<a href="{url}" class="href_class">{label}</a>',
            'items' =>[ ['label' => 'Venta Encabezado', 'url' => ['/ventas-encabezado']],
                        ['label' => 'Ventas Detalle', 'url' => ['/ventas-detalle']],  
                        ],
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
