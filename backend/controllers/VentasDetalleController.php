<?php

namespace backend\controllers;

use app\models\VentasDetalle;
use app\models\Ventasencabezado;
use backend\models\VentasDetalleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VentasDetalleController implements the CRUD actions for VentasDetalle model.
 */
class VentasDetalleController extends Controller
{
    public $layout = 'blank';
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
     * Lists all VentasDetalle models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VentasDetalleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VentasDetalle model.
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
     * Creates a new VentasDetalle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($VentasEncabezado_Id = NULL, $EstatusEncabezado_Id=null, $Alumnos_Id = NULL)
    {
        $model = new VentasDetalle();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if ($model->VentasEncabezado_Id == NULL) {
                    return $this->redirect(['ventas-encabezado/create', 'ProcessCreate' => 1, 'EstatusEncabezado_Id' => $EstatusEncabezado_Id, 'Alumnos_Id' => $Alumnos_Id]);
                } else {
                    return $this->redirect(['ventas-encabezado/update', 'Id' => $model->VentasEncabezado_Id, 'ProcessUpdate' => 1, 'EstatusEncabezado_Id' => $EstatusEncabezado_Id, 'Alumnos_Id' => $Alumnos_Id]);
                }
            }
        } else {
            $model->loadDefaultValues();
            $model->VentasEncabezado_Id = $VentasEncabezado_Id;
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VentasDetalle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id, $EstatusEncabezado_Id=null, $Alumnos_Id = NULL)
    {
        $model = $this->findModel($Id);
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if ($model->VentasEncabezado_Id == NULL) {
                    return $this->redirect(['ventas-encabezado/create', 'ProcessCreate' => 1, 'EstatusEncabezado_Id' => $EstatusEncabezado_Id, 'Alumnos_Id' => $Alumnos_Id]);
                } else {
                    return $this->redirect(['ventas-encabezado/update', 'Id' => $model->VentasEncabezado_Id, 'ProcessUpdate' => 1, 'EstatusEncabezado_Id' => $EstatusEncabezado_Id, 'Alumnos_Id' => $Alumnos_Id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VentasDetalle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id, $VentasEncabezado_Id = NULL, $EstatusEncabezado_Id=null, $Alumnos_Id = NULL)
    {
        $this->findModel($Id)->delete();

        if ($VentasEncabezado_Id == NULL) {
            return $this->redirect(['ventas-encabezado/create', 'ProcessCreate' => 1, 'EstatusEncabezado_Id' => $EstatusEncabezado_Id, 'Alumnos_Id' => $Alumnos_Id]);
        } else {
            return $this->redirect(['ventas-encabezado/update', 'Id' => $VentasEncabezado_Id, 'ProcessUpdate' => 1, 'EstatusEncabezado_Id' => $EstatusEncabezado_Id, 'Alumnos_Id' => $Alumnos_Id]);
        }
    }

    /**
     * Finds the VentasDetalle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @return VentasDetalle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id)
    {
        if (($model = VentasDetalle::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
