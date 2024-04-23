<?php
use yii\db\Query;
use yii\helpers\Json;

// Definir la consulta para obtener todos los encabezados de ventas con sus fechas
$query = (new Query())
->select(['conceptos.id', 'conceptos.nombre']) // La lista de columnas se pasa como un array
->from('pagos')
->join('INNER JOIN', 'conceptos', 'conceptos.id = pagos.conceptos_id'); 


// Ejecutar la consulta y obtener los datos
$data = $query->all();

// Crear un array de salida con los IDs como valor y las fechas como etiquetas
$out = [];
foreach ($data as $d) {
    $out[$d['id']] = $d['nombre'];
}
