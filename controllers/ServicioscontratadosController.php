<?php

namespace app\controllers;

use Yii;
use app\models\Servicios;
use app\models\Clientes;
use app\models\Zona;
use app\models\Servicioscontratados;
use app\models\ServicioscontratadosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServicioscontratadosController implements the CRUD actions for Servicioscontratados model.
 */
class ServicioscontratadosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Servicioscontratados models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicioscontratadosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $servicios = Servicios::listadoServicios(TRUE);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'servicios' => $servicios,
        ]);
    }

    /**
     * Displays a single Servicioscontratados model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Servicioscontratados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {


        $model = new Clientes();
        $zonas = Zona::listadoZonas();
        $zona = new Zona();
        $zona->nombrezona = "Escribe aqui . . .";


        $modelservicios = new Servicioscontratados();
        $servicios = Servicios::listadoServicios(TRUE);
        $tarifas = Servicios::listadoTarifas(TRUE);
        $clientes = Clientes::listadoClientes();

        if ($modelservicios->load(Yii::$app->request->post()) && $modelservicios->save()) {
            return $this->redirect(['view', 'id' => $model->idservicioscontratados]);
        }

        return $this->render('create', [
            'modelservicios' => $modelservicios,
            'servicios' => $servicios,
            'clientes' => $clientes,
            'tarifas' => $tarifas,


            'model' => $model,
            'zonas' => $zonas,
            'zona' => $zona,
        ]);
    }

    /**
     * Updates an existing Servicioscontratados model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idservicioscontratados]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Servicioscontratados model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Servicioscontratados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Servicioscontratados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Servicioscontratados::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}