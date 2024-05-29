<?php

namespace backend\controllers;

use app\models\Alumnos;
use app\models\VentasEncabezado;
use backend\models\VentasEncabezadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\VentasDetalle;
use app\models\PAgos;
use yii\db\Query;
use yii\web\Response;
use Yii;
/**
 * VentasEncabezadoController implements the CRUD actions for VentasEncabezado model.
 */
class VentasEncabezadoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all VentasEncabezado models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VentasEncabezadoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VentasEncabezado model.
     * @param int $Id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id)
    {
        return $this->render('view', [
            'model' => $this->findModel($Id),
        ]);
    }

    /**
     * Creates a new VentasEncabezado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($ProcessCreate = 0, $EstatusEncabezado_Id = NULL, $Alumnos_Id = NULL)
    {
        $model = new VentasEncabezado();
        $detalleModel = new VentasDetalle();
        $pagosModel = new Pagos();

        // Verificar si se está enviando un formulario
        if ($this->request->isPost) {
            // Cargar datos del formulario en el modelo de ventas encabezado
            if ($model->load($this->request->post())) {
                // Guardar el modelo de ventas encabezado
                if ($model->save()) {
                    $ventasDetalleNull = VentasEncabezado::getVentasDetalleNull();
                    foreach ($ventasDetalleNull as $ventaDetalle) {
                        $ventaDetalle->VentasEncabezado_Id = $model->Id;
                        $ventaDetalle->save(); 
                    }

                    $pagosNull = VentasEncabezado::getPagosNull();
                    foreach ($pagosNull as $pagos) {
                        $pagos->VentasEncabezado_Id = $model->Id;
                        $pagos->save(); 
                    }
                    return $this->redirect(['view', 'Id' => $model->Id]);
                }
            }
        } else {
            if ($ProcessCreate == 0) {
                // Obtener todos los VentasDetalle con VentaEncabezado_Id igual a null
                $ventasDetalleNull = VentasEncabezado::getVentasDetalleNull();
                $pagosNull = VentasEncabezado::getPagosNull();
    
                // Iterar sobre los registros y eliminarlos
                foreach ($ventasDetalleNull as $ventaDetalle) {
                    $ventaDetalle->delete();
                }
                foreach ($pagosNull as $pagos) {
                    $pagos->delete();
                }
            }
            // Cargar valores predeterminados para el modelo de ventas encabezado
            $model->loadDefaultValues();
            $model->EstatusEncabezado_Id = $EstatusEncabezado_Id;
            $model->Alumnos_Id = $Alumnos_Id;
        }

        if ($model->Alumnos_Id > 0) {
            $dAlumno = VentasEncabezado::getAlumnoById($model->Alumnos_Id);
            $model->Alumnos_Txt = $dAlumno->Matricula . ' - ' . $dAlumno->Apellido . ' ' . $dAlumno->Nombre;
        }

        $dFolio = VentasEncabezado::getNextFolio();
        $model->Folio = $dFolio;

        // Renderizar la vista con los modelos
        return $this->render('create', [
            'model' => $model,
            'detalleModel' => $detalleModel,
            'pagosModel' => $pagosModel,
        ]);
    }

    /**
     * Updates an existing VentasEncabezado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id, $ProcessUpdate = 0, $EstatusEncabezado_Id = NULL, $Alumnos_Id = NULL, $Pagos_Id = NULL)
    {
        $model = $this->findModel($Id);
        $detalleModel = new VentasDetalle();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $ventasDetalleNull = VentasEncabezado::getVentasDetalleNull();
            $pagosNull = VentasEncabezado::getPagosNull();
            foreach ($ventasDetalleNull as $ventaDetalle) {
                $ventaDetalle->VentasEncabezado_Id = $model->Id;
                $ventaDetalle->save(); 
            }
            foreach ($pagosNull as $pagos) {
                $pagos->VentasEncabezado_Id = $model->Id;
                $pagos->save(); 
            }
            return $this->redirect(['view', 'Id' => $model->Id]);
        }
        if ($ProcessUpdate == 0) {
            // Obtener todos los VentasDetalle con VentaEncabezado_Id igual a null
            $ventasDetalleNull = VentasEncabezado::getVentasDetalleNull();
            $pagosNull = VentasEncabezado::getPagosNull();

            // Iterar sobre los registros y eliminarlos
            foreach ($ventasDetalleNull as $ventaDetalle) {
                $ventaDetalle->delete();
            }
            foreach ($pagosNull as $pagos) {
                $pagos->delete();
            }
            
        } else {
            $model->EstatusEncabezado_Id = $EstatusEncabezado_Id;
            $model->Alumnos_Id = $Alumnos_Id;
            $model->Pagos_Id =$Pagos_Id;
        }
        if ($model->Alumnos_Id > 0) {
            $dAlumno = VentasEncabezado::getAlumnoById($model->Alumnos_Id);
                $model->Alumnos_Txt = $dAlumno->Matricula . ' - ' . $dAlumno->Apellido . ' ' . $dAlumno->Nombre;
        }
        
        return $this->render('update', [
            'model' => $model,
            'detalleModel' => $detalleModel, // Pasar el modelo de detalle a la vista
        ]);

    }
    public function actionUserList($q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $query = (new Query())
            ->select(['alumnos.id', 'alumnos.nombre', 'alumnos.apellido', 'alumnos.matricula'])
            ->from('ventasencabezado')
            ->join('RIGHT JOIN', 'alumnos', 'alumnos.id = ventasencabezado.alumnos_id')
            ->where(['like', 'alumnos.matricula', $q])
            ->orWhere(['like', 'alumnos.apellido', $q])
            ->orWhere(['like', 'alumnos.nombre', $q])
            ->limit(10)
            ->all();

        $suggestions = [];
        foreach ($query as $row) {
            $suggestions[] = $row['matricula'] . ' - ' . $row['apellido'] . ' ' . $row['nombre'];
        }

        return $suggestions;
    }
    public function actionBuscarID($q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $query = (new Query())
            ->select(['alumnos.id', 'alumnos.nombre', 'alumnos.apellido', 'alumnos.matricula'])
            ->from('alumnos')
            ->where(['like', 'alumnos.matricula', $q])
            ->orWhere(['like', 'alumnos.apellido', $q])
            ->orWhere(['like', 'alumnos.nombre', $q])
            ->limit(10)
            ->all();

        $suggestions = [];
        foreach ($query as $row) {
            $suggestions[] = [
                'id' => $row['id']
            ];
        }

        return $suggestions;
    }

    /**
     * Deletes an existing VentasEncabezado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id)
    {
        Ventasdetalle::deleteAll(['VentasEncabezado_Id' => $Id]);
        Pagos::deleteAll(['VentasEncabezado_Id' => $Id]);
        $this->findModel($Id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VentasEncabezado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @return VentasEncabezado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id)
    {
        if (($model = VentasEncabezado::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}