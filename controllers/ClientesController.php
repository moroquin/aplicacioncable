<?php

namespace app\controllers;

use Yii;
use app\models\Clientes;
use app\models\Zona;
use app\models\ClientesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientesController implements the CRUD actions for Clientes model.
 */
class ClientesController extends Controller
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
     * Lists all Clientes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clientes model.
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
     * Creates a new Clientes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clientes();
        $zonas = Zona::listadoZonas();
        $zona = new Zona();
        $zona->nombrezona = "Escribe aqui . . .";

        if ($model->load(Yii::$app->request->post()) && $zona->load(Yii::$app->request->post()) && $model->guardar($zona)) {
            return $this->redirect(['view', 'id' => $model->idcliente]);
        }

        return $this->render('create', [
            'model' => $model,
            'zonas' => $zonas,
            'zona' => $zona,
        ]);
    }

    /**
     * Updates an existing Clientes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $zonas = Zona::listadoZonas();
        $zona = new Zona();
        $zona->nombrezona = "Escribe aqui . . .";

        if ($model->load(Yii::$app->request->post()) && $zona->load(Yii::$app->request->post()) && $model->guardar($zona)) {
            return $this->redirect(['view', 'id' => $model->idcliente]);
        }

        return $this->render('update', [
            'model' => $model,
            'zonas' => $zonas,
            'zona' => $zona,
        ]);
    }

    /**
     * Deletes an existing Clientes model.
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
     * Finds the Clientes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clientes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clientes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
