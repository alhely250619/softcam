<?php

use app\models\Ventasdetalle;
use app\models\Ventasencabezado;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\ArrayDataProvider;

/** @var yii\web\View $this */
/** @var app\models\VentasEncabezado $model */
/** @var yii\widgets\ActiveForm $form */
use yii\db\Query;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\ActionColumn;

// Consultas para traer alumnos 
$query = (new Query())
    ->select(['alumnos.id', 'alumnos.nombre','alumnos.apellido','alumnos.matricula'])
    ->from('ventasencabezado')
    ->join('RIGHT JOIN', 'alumnos', 'alumnos.id = ventasencabezado.alumnos_id'); 

// Ejecutar la consulta y obtener los datos
$data = $query->all();

// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$out = [];
$out[NULL]  = 'Seleccione alumno';
foreach ($data as $d) {
    $out[$d['id']]  = $d['matricula'] . ' - '.$d['apellido'].' '.$d['nombre'];
}

// Consultas para traer estatus
$query = (new Query())
->select(['estatusencabezado.id', 'estatusencabezado.nombre']) // La lista de columnas se pasa como un array
->from('ventasencabezado')
->join('RIGHT JOIN', 'estatusencabezado', 'estatusencabezado.id = ventasencabezado.estatusencabezado_id'); 
// Ejecutar la consulta y obtener los datos
$data = $query->all();
// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$outEncabezado = [];
$outEncabezado[NULL]  = 'Seleccione estado';
foreach ($data as $d) {
    $outEncabezado[$d['id']]  = $d['nombre'];
}

?>

<div class="ventas-encabezado-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Alumnos_Id')->dropDownList($out, ['id' => 'alumnos-encabezado']) ?>

    <?= $form->field($model, 'EstatusEncabezado_Id')->dropDownList($outEncabezado, ['id' => 'estatus-encabezado']) ?>

</div>


<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <br>
            
            <?php $url = Url::to(['ventas-detalle/create', 'VentasEncabezado_Id' => $model->Id, 'EstatusEncabezado_Id' => $model->EstatusEncabezado_Id, 'Alumnos_Id' => $model->Alumnos_Id]); ?>
            <div class="form-group text-end">
                <a id="btn-agregar-detalle" href="<?= $url ?>" class="btn btn-primary">Agregar Producto</a>
            </div>
            <div id="mi-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="detalle-container"></div>
                </div>
            </div>
            <!-- Script para cargar el formulario de venta detalle dinámicamente -->
            <script>
                var estatusEncabezadoDropdown = document.getElementById('estatus-encabezado');
                var alumnosEncabezadoDropdown = document.getElementById('alumnos-encabezado');

                // Obtener el botón para agregar detalle
                var btnAgregarDetalle = document.getElementById('btn-agregar-detalle');

                // Escuchar el evento de cambio en el campo desplegable
                estatusEncabezadoDropdown.addEventListener('change', function() {
                    // Actualizar la URL del botón con el nuevo valor seleccionado
                    var selectedValue = this.value;
                    var newUrl = '<?= Url::to(['ventas-detalle/create', 'VentasEncabezado_Id' => $model->Id]) ?>&EstatusEncabezado_Id=' + selectedValue + '&Alumnos_Id='+alumnosEncabezadoDropdown.value;
                    btnAgregarDetalle.setAttribute('href', newUrl);
                    
                    <?php foreach ($model->ventasdetalles as $index => $detalleModel): ?>
                        document.getElementById("btn-actualizar-detalle<?= $index ?>").setAttribute('href',  '<?= Url::to(['ventas-detalle/update', 'Id' => $detalleModel->Id]) ?>&EstatusEncabezado_Id=' + estatusEncabezadoDropdown.value + '&Alumnos_Id='+selectedValue2);
                        document.getElementById("btn-eliminar-detalle<?= $index ?>").setAttribute('href',  '<?= Url::to(['ventas-detalle/update', 'Id' => $detalleModel->Id]) ?>&VentasEncabezado_Id='+$detalleModel.VentasEncabezado_Id+'&EstatusEncabezado_Id=' + estatusEncabezadoDropdown.value + '&Alumnos_Id='+selectedValue2);
                    <?php endforeach; ?>
                });

                alumnosEncabezadoDropdown.addEventListener('change', function() {
                    // Actualizar la URL del botón con el nuevo valor seleccionado
                    var selectedValue2 = this.value;
                    var newUrl = '<?= Url::to(['ventas-detalle/create', 'VentasEncabezado_Id' => $model->Id]) ?>&EstatusEncabezado_Id=' + estatusEncabezadoDropdown.value + '&Alumnos_Id='+selectedValue2;
                    btnAgregarDetalle.setAttribute('href', newUrl);
                    
                    <?php foreach ($model->ventasdetalles as $index => $detalleModel): ?>
                        document.getElementById("btn-actualizar-detalle<?= $index ?>").setAttribute('href',  '<?= Url::to(['ventas-detalle/update', 'Id' => $detalleModel->Id]) ?>&EstatusEncabezado_Id=' + estatusEncabezadoDropdown.value + '&Alumnos_Id='+selectedValue2);
                        document.getElementById("btn-eliminar-detalle<?= $index ?>").setAttribute('href',  '<?= Url::to(['ventas-detalle/update', 'Id' => $detalleModel->Id]) ?>&VentasEncabezado_Id='+$detalleModel.VentasEncabezado_Id+'&EstatusEncabezado_Id=' + estatusEncabezadoDropdown.value + '&Alumnos_Id='+selectedValue2);
                    <?php endforeach; ?>
                });

                document.getElementById("btn-agregar-detalle").addEventListener("click", function(event) {
                    event.preventDefault();
                    var urlFormularioDetalle = this.href;
                    fetch(urlFormularioDetalle)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById("detalle-container").innerHTML = html;
                    })
                    .catch(error => console.error('Error al cargar el formulario de venta detalle:', error));
                });
                // Obtener el botón para abrir el modal
                var btnAbrirModal = document.getElementById("btn-agregar-detalle");

                // Obtener el modal
                var modal = document.getElementById("mi-modal");

                // Obtener el elemento <span> que cierra el modal
                var spanCerrar = document.getElementsByClassName("close")[0];

                // Cuando el usuario hace clic en el botón, abre el modal
                btnAbrirModal.onclick = function() {
                modal.style.display = "block";
                }

                // Cuando el usuario hace clic en <span> (x), cierra el modal
                spanCerrar.onclick = function() {
                modal.style.display = "none";
                }

                // Cuando el usuario hace clic en cualquier parte fuera del modal, ciérralo
                window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
                }
            </script>
            <br>
            <table class="table table-hover table-light">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Campos para los detalles de ventas -->
                    <?php  $totalGeneral = 0; ?>
                    <?php foreach ($model->ventasdetalles as $index => $detalleModel): ?>
                        <tr>
                            <td><?php
                                // Obtener el nombre del producto utilizando el ID del producto en $detalleModel
                                $producto = \app\models\Productos::findOne($detalleModel->Productos_id);
                                echo $producto ? $producto->Nombre : 'Producto no encontrado';
                            ?></td>
                            <td style="width: 120px;"><?= $detalleModel->Cantidad ?></td>
                            <td style="width: 120px;"><?php
                                // Obtener el nombre del producto utilizando el ID del producto en $detalleModel
                                $producto = \app\models\Productos::findOne($detalleModel->Productos_id);
                                echo $producto ? $producto->Precio : 'Producto no encontrado';
                            ?></td>
                            <td style="width: 120px;">
                                <?php
                                    // Calcular el subtotal multiplicando el precio por la cantidad
                                    $subtotal = $producto->Precio * $detalleModel->Cantidad;
                                    echo $subtotal;
                                    $totalGeneral += $subtotal; 
                                ?>
                            </td>
                            <td style="width: 150px;">
                                <!-- Botones de actualizar y eliminar obtenidos del controlador -->
                                <?= \yii\helpers\Html::a('<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"></path></svg>', ['ventas-detalle/update', 'Id' => $detalleModel->Id, 'EstatusEncabezado_Id' => $model->EstatusEncabezado_Id, 'Alumnos_Id' => $model->Alumnos_Id],[ 'Id' => 'btn-actualizar-detalle'.$index, 'class' => 'btn btn-xs btn-primary btn-actualizar-detalle'])  ?>
                                <?= \yii\helpers\Html::a('<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"></path></svg>', ['ventas-detalle/delete', 'Id' => $detalleModel->Id, 'VentasEncabezado_Id' => $detalleModel->VentasEncabezado_Id, 'EstatusEncabezado_Id' => $model->EstatusEncabezado_Id, 'Alumnos_Id' => $model->Alumnos_Id], [
                                    'Id' => 'btn-eliminar-detalle'.$index,
                                    'class' => 'btn btn-xs btn-danger',
                                    'data-confirm' => '¿Estás seguro de que quieres eliminar este registro?',
                                    'data-method' => 'post',
                                ]) ?>
                            </td>
                        </tr>
                        <!-- Otros campos de detalles de ventas -->
                    <?php endforeach; ?>
                    <?php if (count($model->ventasdetalles) <= 0 ) {?>
                        <tr>
                            <td colspan="12">
                                No hay productos agregados
                            </td>
                        </tr>
                    <?php } ?> 
                </tbody>
                
            </table>
            
            <div id="mi-modal-detalle" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="detalle-containerU"></div>
                </div>
            </div>
            <?php foreach ($model->ventasdetalles as $index => $detalleModel): ?>
            <script>
                document.getElementById("btn-actualizar-detalle<?= $index ?>").addEventListener("click", function(event) {
                    event.preventDefault();
                    var urlFormularioDetalle = this.href;
                    fetch(urlFormularioDetalle)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById("detalle-containerU").innerHTML = html;
                            document.getElementById("mi-modal-detalle").style.display = "block"; // Mostrar el modal de detalle
                        })
                        .catch(error => console.error('Error al cargar el formulario de venta detalle:', error));
                });

                // Obtener el elemento <span> que cierra el modal
                var spanCerrarDetalle = document.getElementById("mi-modal-detalle").getElementsByClassName("close")[0];

                // Cuando el usuario hace clic en <span> (x), cierra el modal
                spanCerrarDetalle.onclick = function() {
                    document.getElementById("mi-modal-detalle").style.display = "none";
                }

                // Cuando el usuario hace clic en cualquier parte fuera del modal, ciérralo
                window.onclick = function(event) {
                    if (event.target == document.getElementById("mi-modal-detalle")) {
                        document.getElementById("mi-modal-detalle").style.display = "none";
                    }
                }
                </script>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div>
    <div>
        <?= $form->field($model, 'Total')->textInput(['value' => $totalGeneral, 'readonly' => true]) ?>
        <?= $form->field($model, 'Nota')->textInput() ?>
                    </br>
    </div>
    <?php if(count($model->ventasdetalles) > 0) { ?>
        <div  class="form-group" >
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php } else { ?>
        <div  class="form-group" >
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary', 'disabled' => true]) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
</div>
<style>
    /* Estilos para el modal */
.modal {
  display: none; /* Por defecto, el modal está oculto */
  position: fixed; /* Posicionamiento fijo para mantenerlo en el centro */
  z-index: 1; /* Valor alto para asegurar que esté encima de otros elementos */
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto; /* Permitir desplazamiento si el contenido del modal es demasiado grande */
  background-color: rgba(0,0,0,0.4); /* Fondo oscuro semi-transparente */
}

/* Estilos para el contenido del modal */
.modal-content {
  background-color: #fefefe;
  margin: 0% auto; /* Margen superior e inferior para centrar verticalmente */
  margin-top: 10%;
  padding-left: 10px;
  border: 1px solid #888;
  width: 80%; /* Ancho del contenido del modal */
}

/* Estilos para el botón de cierre (×) */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

</style>