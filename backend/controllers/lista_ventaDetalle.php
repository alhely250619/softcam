
<?php
use yii\db\Query;
use yii\helpers\Json;


$sql_ventadetalle = "SELECT VE.fecha
  , VE.alumnos_id 
FROM ventasdetalle AS VD 
INNER JOIN ventasencabezado VE ON VE.id = VD.ventasencabezado_id";
$command = $query_ventadetalle->createCommand();
 $data = $command->queryAll();
 foreach ($data as $d) {
  $out[] = ['value' => $d['email']];
 }
 echo Json::encode($out);

