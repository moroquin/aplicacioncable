<?php

namespace app\controllers;

use Yii;
use app\models\Empleados;
use app\models\Puesto;
use app\models\EmpleadosSearch;
use app\models\PuestoSearch;
use app\models\User;
use app\models\Puestos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmpleadosController implements the CRUD actions for Empleados model.
 */
class EmpleadosController extends Controller
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
     * Lists all Empleados models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $searchModel = new EmpleadosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Empleados model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $model = $this->findModel($id);
        $model1 = Puesto::findOne($model->puestos_idpuestos); 
        $model2 = User::findOne($id);
        return $this->render('view', [
            'model' => $model,
            'model1' => $model1,
            'model2' => $model2,
        ]);
    }

    /**
     * Creates a new Empleados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $model = new Empleados();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idempleado]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Empleados model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $modelsec1 = User::findOne(Yii::$app->user->id);
        $modelsec2 = Empleados::findOne($modelsec1->empleados_idempleado);
        $modelsec3 = Puestos::findOne($modelsec2->puestos_idpuestos);
        if($modelsec3->nivel > 1 ){
            return $this->redirect(['index']);
        }
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idempleado]);
        }
        $puestos = [];
        $tmp = Puesto::find()->all();
        foreach($tmp as $puest){

            $puestos[$puest->idpuestos] ="Puesto: ".$puest->nombre; 
        }
        return $this->render('update', [
            'model' => $model,
            'puestos' => $puestos,
        ]);
    }

    /**
     * Deletes an existing Empleados model.
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
     * Finds the Empleados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empleados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empleados::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionCambioestado($id, $estado){
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $model = User::findOne($id);
        $model1 = Empleados::findOne($model->empleados_idempleado);
        $model->estado = $estado;
        $model->load(Yii::$app->request->post());
        $model->save();
        return $this->redirect(['view', 'id' => $model1->idempleado]);
    }
}
