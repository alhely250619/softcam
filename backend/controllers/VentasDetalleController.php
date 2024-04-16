<?php

namespace backend\controllers;

use app\models\VentasDetalle;
use app\models\VentasDetalleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VentasDetalleController implements the CRUD actions for VentasDetalle model.
 */
class VentasDetalleController extends Controller
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
     * @param int $Tallas_Id Tallas ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id, $Tallas_Id)
    {
        return $this->render('view', [
            'model' => $this->findModel($Id, $Tallas_Id),
        ]);
    }

    /**
     * Creates a new VentasDetalle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new VentasDetalle();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Id' => $model->Id, 'Tallas_Id' => $model->Tallas_Id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VentasDetalle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @param int $Tallas_Id Tallas ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id, $Tallas_Id)
    {
        $model = $this->findModel($Id, $Tallas_Id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Id' => $model->Id, 'Tallas_Id' => $model->Tallas_Id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VentasDetalle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @param int $Tallas_Id Tallas ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id, $Tallas_Id)
    {
        $this->findModel($Id, $Tallas_Id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VentasDetalle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @param int $Tallas_Id Tallas ID
     * @return VentasDetalle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id, $Tallas_Id)
    {
        if (($model = VentasDetalle::findOne(['Id' => $Id, 'Tallas_Id' => $Tallas_Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
