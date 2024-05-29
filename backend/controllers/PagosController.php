<?php

namespace backend\controllers;

use app\models\Pagos;
use backend\models\PagosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use kartik\mpdf\Pdf;

/**
 * PagosController implements the CRUD actions for Pagos model.
 */
class PagosController extends Controller
{	    
    public $layout = 'blank';
    public function actionViewPdf($id)
    {
        // Obtener el modelo de pago correspondiente al ID proporcionado
        $model = $this->findModel($id);
    
        // Renderizar la vista 'viewpdf' con el modelo de pago
        $content = $this->renderPartial('viewpdf', [
            'model' => $model,
        ]);
    
        // Configurar el componente Pdf
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, 
            'format' => Pdf::FORMAT_A4, 
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}', 
            'options' => ['title' => 'Pago PDF'],
            'methods' => [ 
                'SetHeader'=>['Krajee Report Header'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
    
        // Retornar el PDF renderizado
        return $pdf->render();
    }
    
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
     * Lists all Pagos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PagosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $this->layout = 'main';
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pagos model.
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
     * Creates a new Pagos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($bandera = 0, $VentasEncabezado_Id = NULL, $EstatusEncabezado_Id=null, $Alumnos_Id = NULL)
    {
        $model = new Pagos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if ($bandera == 0) { // Pago realizado fuera de una venta
                    if ($model->VentasEncabezado_Id == NULL) {
                        return $this->redirect(['ventas-encabezado/create', 'ProcessCreate' => 1, 'EstatusEncabezado_Id' => $EstatusEncabezado_Id, 'Alumnos_Id' => $Alumnos_Id]);
                    } else {
                        return $this->redirect(['ventas-encabezado/update', 'Id' => $model->VentasEncabezado_Id, 'ProcessUpdate' => 1, 'EstatusEncabezado_Id' => $EstatusEncabezado_Id, 'Alumnos_Id' => $Alumnos_Id]);
                    }
                } else {
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
            $model->VentasEncabezado_Id = $VentasEncabezado_Id;
        }
        if ($bandera == 1) { // Pago realizado fuera de una venta
            $this->layout = 'main';
        }
        $model->bandera = $bandera;

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pagos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id, $bandera = 0, $EstatusEncabezado_Id=null, $Alumnos_Id = NULL)
    {
        $model = $this->findModel($Id);
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if ($bandera == 0) { // Pago realizado fuera de una venta
                    if ($model->VentasEncabezado_Id == NULL) {
                        return $this->redirect(['ventas-encabezado/create', 'ProcessCreate' => 1, 'EstatusEncabezado_Id' => $EstatusEncabezado_Id, 'Alumnos_Id' => $Alumnos_Id]);
                    } else {
                        return $this->redirect(['ventas-encabezado/update', 'Id' => $model->VentasEncabezado_Id, 'ProcessUpdate' => 1, 'EstatusEncabezado_Id' => $EstatusEncabezado_Id, 'Alumnos_Id' => $Alumnos_Id]);
                    }
                } else {
                    return $this->redirect(['index']);
                }
            }
        }

        if ($bandera == 1) { // Pago realizado fuera de una venta
            $this->layout = 'main';
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pagos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id, $bandera = 0, $VentasEncabezado_Id = NULL, $EstatusEncabezado_Id = null, $Alumnos_Id = NULL)
    {
        $this->findModel($Id)->delete();

        if ($bandera == 0) {
            if ($VentasEncabezado_Id != NULL) {
                return $this->redirect(['ventas-encabezado/update', 'Id' => $VentasEncabezado_Id, 'ProcessUpdate' => 1, 'EstatusEncabezado_Id' => $EstatusEncabezado_Id, 'Alumnos_Id' => $Alumnos_Id]);
            } else {
                return $this->redirect(['ventas-encabezado/create', 'ProcessCreate' => 1, 'EstatusEncabezado_Id' => $EstatusEncabezado_Id, 'Alumnos_Id' => $Alumnos_Id]);
            }
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Pagos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @return Pagos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id)
    {
        if (($model = Pagos::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
