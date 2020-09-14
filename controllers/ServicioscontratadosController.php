<?php

namespace app\controllers;

use Yii;
use app\models\Servicios;
use app\models\Clientes;
use app\models\Zona;
use app\models\Estado;
use app\models\Servicioscontratados;
use app\models\ServicioscontratadosSearch;
use app\models\Empleados;
use app\models\User;
use app\models\Puestos;
use app\models\Puesto;
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
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModel = new ServicioscontratadosSearch();
        $searchModel->iniEstadocontrato();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $servicios = Servicios::listadoServicios(TRUE);

        $estados = Estado::listadoEstados();



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'servicios' => $servicios,

            'estados' =>  $estados,
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }

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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }


        $model = new Clientes();
        $zonas = Zona::listadoZonas();
        $zona = new Zona();
        $zona->nombrezona = "Escribe aqui . . .";
        $model->nombrezona = '0';





        $modelservicios = new Servicioscontratados();

        $modelservicios->detmesesporpagar = "";
        $servicios = Servicios::listadoServicios(TRUE);
        $tarifas = Servicios::listadoTarifas(TRUE);
        $clientes = Clientes::listadoClientes();

        $estados = Estado::listadoEstados();


        if ($modelservicios->load(Yii::$app->request->post())) {

            $modelservicios->cobropactado = Servicios::getTarifa($modelservicios->idservicio);

            if ($modelservicios->mesesnopagados == null || $modelservicios->mesesnopagados == '')
                $modelservicios->mesesnopagados = 1;

            $anyomes = CobrosController::getAnyomes();

            if ($modelservicios->mesesnopagados <= 0)
                $modelservicios->detmesesporpagar = "Adelantado " . $modelservicios->mesesnopagados;
            else
                $modelservicios->detmesesporpagar = CobrosController::getMesesAtrazados($anyomes, $modelservicios->mesesnopagados);


            if ($modelservicios->idcliente == 1) {

                if ($model->load(Yii::$app->request->post()) && $zona->load(Yii::$app->request->post()) && $model->guardar($zona) && $modelservicios->guardar($model))
                    return $this->redirect(['view', 'id' => $modelservicios->idservicioscontratados]);
            } else {
                $modelservicios->nombrezona = Clientes::findOne($modelservicios->idcliente)->getZona();
                if ($modelservicios->save())
                    return $this->redirect(['view', 'id' => $modelservicios->idservicioscontratados]);
            }


            // && 

        }

        return $this->render('create', [
            'modelservicios' => $modelservicios,
            'servicios' => $servicios,
            'clientes' => $clientes,
            'tarifas' => $tarifas,



            'model' => $model,
            'zonas' => $zonas,
            'zona' => $zona,

            'estados' => $estados,
        ]);
    }





 public function actionClientes(){
    $clientes = Clientes::find()->all();
    foreach ($clientes as $cliente){
        $cliente->actualizarEspaciosblanco();
        $cliente->save();
    }
    
 }



/*



    public function actionImporta()
    {

        $clientes = Clientes::find()->all();
        foreach ($clientes as $cliente){
            $cliente->actualizarEspaciosblanco();
            $cliente->save();
        }

        $servicioscontratados = Servicioscontratados::find()->all();

        $anyomes = CobrosController::getAnyomes();

        $salida = ''; 

        foreach ($servicioscontratados as $serviciocontratado) {

            $cliente = Clientes::findOne($serviciocontratado->idcliente);
            $serviciocontratado->detmesesporpagar = ' - ';
            $serviciocontratado->contratonumero = $cliente->correlativo;



            $serviciocontratado->cobropactado = Servicios::getTarifa($serviciocontratado->idservicio);

            if ($serviciocontratado->mesesnopagados == null || $serviciocontratado->mesesnopagados == '')
                $serviciocontratado->mesesnopagados = 1;

            

            if ($serviciocontratado->mesesnopagados <= 0)
                $serviciocontratado->detmesesporpagar = "Adelantado " . $serviciocontratado->mesesnopagados;
            else
                $serviciocontratado->detmesesporpagar = CobrosController::getMesesAtrazados($anyomes, $serviciocontratado->mesesnopagados);

            $serviciocontratado->nombrezona = $cliente->getZona();



            if ($serviciocontratado->validate()) {
                $serviciocontratado->save();
                
            }
            else
            $salida=$salida .'-error: '. $cliente->correlativo . ' ' . print_r($serviciocontratado->getErrors());

            
        }
        return $salida;
    }











*/




    /**
     * Updates an existing Servicioscontratados model.
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
        $modelsec3 = Puesto::findOne($modelsec2->puestos_idpuestos);
        if($modelsec3->nivel > 1 ){
            return $this->redirect(['index']);
        }
        
        $modelservicios = $this->findModel($id);


        $model = Clientes::findOne($modelservicios->idcliente);
        $zonas = Zona::listadoZonas();
        $zona = new Zona();
        $zona->nombrezona = "Escribe aqui . . .";
        $model->nombrezona = '0';




        $servicios = Servicios::listadoServicios(TRUE);
        $tarifas = Servicios::listadoTarifas(TRUE);
        $clientes = Clientes::listadoClientes();

        $estados = Estado::listadoEstados();



        if ($modelservicios->load(Yii::$app->request->post())) {


            $anyomes = CobrosController::getAnyomes();

            if ($modelservicios->mesesnopagados <= 0)
                $modelservicios->detmesesporpagar = "Adelantado " . (-$modelservicios->mesesnopagados);
            else
                $modelservicios->detmesesporpagar = CobrosController::getMesesAtrazados($anyomes, $modelservicios->mesesnopagados);

            if ($modelservicios->save())
                return $this->redirect(['view', 'id' => $modelservicios->idservicioscontratados]);
        }

        return $this->render('update', [
            'modelservicios' => $modelservicios,
            'servicios' => $servicios,
            'clientes' => $clientes,
            'tarifas' => $tarifas,


            'model' => $model,
            'zonas' => $zonas,
            'zona' => $zona,

            'estados' => $estados,
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
