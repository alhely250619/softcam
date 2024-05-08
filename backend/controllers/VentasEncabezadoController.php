<?php

namespace backend\controllers;

use app\models\VentasEncabezado;
use backend\models\VentasEncabezadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\VentasDetalle;
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
    public function actionCreate()
    {
        $model = new VentasEncabezado();
        $detalleModel = new VentasDetalle();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Id' => $model->Id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);

        // Si se envía un formulario y se carga correctamente, se intenta guardar la venta encabezado
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                // Si se envía un formulario y se carga correctamente, se intenta guardar la venta encabezado
                // Guardar la venta encabezado
                $model->save();
                // Asignar el ID del encabezado a la relación con el detalle
                $detalleModel->VentasEncabezado_Id = $model->Id; // Ajustar según los nombres de los campos en tu modelo
                // Si el detalle se carga correctamente, guardarlo
                if ($detalleModel->load(Yii::$app->request->post()) && $detalleModel->save()) {
                    // Redirigir a la vista de detalles de la venta encabezado
                    return $this->redirect(['view', 'Id' => $model->Id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
    
        return $this->render('create', [
            'model' => $model,
            'detalleModel' => $detalleModel, // Pasar el modelo de detalle a la vista
        ]);
        
    }

    /**
     * Updates an existing VentasEncabezado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id)
    {
        $model = $this->findModel($Id);
        $detalleModel  = $this-> VentasDetalle();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Id' => $model->Id]);
        }

        return $this->render('update', [
            'model' => $model,
            'detallModel'=>$detalleModel,
        ]);
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