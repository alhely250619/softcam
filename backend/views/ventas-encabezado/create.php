<?php

use yii\helpers\Html;
use yii\helpers\Url;

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
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('alumnos-encabezado').addEventListener('input', function () {
        var query = this.value;

        if (query.length > 2) {
            fetch("<?= Url::to(['ventas-encabezado/user-list']) ?>&q=" + encodeURIComponent(query))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    var suggestions = document.getElementById('suggestions');
                    suggestions.innerHTML = ''; // Clear previous suggestions
                    
                    data.forEach(function (item) {
                        var option = document.createElement('option');
                        option.value = item;
                        suggestions.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }
    });
});
</script>