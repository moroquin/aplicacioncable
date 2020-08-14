<?php

namespace app\controllers;

use Yii;
use app\models\Cobros;
use app\models\Zona;
use app\models\Clientes;
use app\models\Lote;
use app\models\LoteSearch;
use app\models\LoteForm;
use app\models\Cobropormes;
use app\models\CobrosSearch;
use app\models\Servicioscontratados;
use app\models\Empleados;
use app\models\User;
use app\models\Puestos;
use app\models\Puesto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * CobrosController implements the CRUD actions for Cobros model.
 */
class CobrosController extends Controller
{



    private static $nombreMes = array(
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo',
        4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
        7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre',
        10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    );

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

    public static function getAnyomes()
    {
        $anyomes = Cobropormes::findOne(['generado' => 1]);

        return $anyomes->cobrosmes;
    }

    private static function addAnyomes()
    {
        $anyomes = Cobropormes::findOne(['generado' => 1]);


        list($y, $m) = explode('-', $anyomes->cobrosmes);
        $m++;
        if ($m > 12) {
            $y++;
            $m = 1;
        }
        $anyomes->cobrosmes =  $y . '-' . $m;
        $anyomes->save();

        return $anyomes->cobrosmes;
    }

    private static function siguienteAnyomes()
    {
        $anyomes = Cobropormes::findOne(['generado' => 1]);


        list($y, $m) = explode('-', $anyomes->cobrosmes);
        $m++;
        if ($m > 12) {
            $y++;
            $m = 1;
        }

        return $y . '-' . $m;
    }

    private static function componerMes($mes)
    {

        if ($mes <= 0) {
            $mes = 12 + $mes;
        }

        return $mes;
    }


    public static function getMesesAtrazados($anyomes, $meses)
    {

        list($y, $m) = explode('-', $anyomes);
        $result = '';
        if ($meses >= 12) {
            $result = (12 - $meses) . ' meses, ';
            $meses -= 12;
        }
        $m = $m + 0;
        for ($i = 1; $i <= $meses; $i++) {
            $result = (($result === '') ? '' : $result . ', ')
                . CobrosController::$nombreMes[CobrosController::componerMes(($m - ($meses - $i)))];
        }

        return $result;
    }


    public static function getMesesPagados($anyomes, $meses, $cant)
    {

        list($y, $m) = explode('-', $anyomes);
        $result = '';
        for ($i = 1; $i <= $cant; $i++) {
            $result = (($result === '') ? '' : $result . ', ')
                . CobrosController::$nombreMes[CobrosController::componerMes($m - ($meses - $i))];
        }

        return $result;
    }



    /**
     * Lists all Cobros models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModel = new CobrosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $mesanyo = null;



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mesanyo' => $mesanyo,
        ]);
    }

    /**
     * Displays a single Cobros model.
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

    public function actionMes()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $anyomes = $this->siguienteAnyomes();
        $anyomesant = $this->getAnyomes();

        return $this->render('mes', [
            'anyomes' => $anyomes,
            'anyomesant' => $anyomesant,
        ]);
    }



    public function actionCobrosmes()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }

        $salida = '';

        $anyomes = $this->addAnyomes();


        $model2 = new Cobropormes();
        $model2->cobrosmes = $anyomes;
        $model2->generado = 1;
        $model2->save();
        $servicioscontratados = Servicioscontratados::find()
            ->where(['nombreestado' => 'Moroso'])
            ->orWhere(['nombreestado' => 'Activo'])
            ->all();


        foreach ($servicioscontratados as $serviciocontratado) {

            $serviciocontratado->setMesnopagado();

            if ($serviciocontratado->mesesnopagados <= 0)
                //{
                $serviciocontratado->detmesesporpagar = "Pagos adelantados " . (-$serviciocontratado->mesesnopagados);
            //  $serviciocontratado->save();

            //} else {
            else
                $serviciocontratado->detmesesporpagar = CobrosController::getMesesAtrazados($anyomes, $serviciocontratado->getMesnopagado());

            $serviciocontratado->save();
            //   if (!$serviciocontratado->save())
            //     $salida=$salida .'-error: '.  print_r($serviciocontratado->getErrors());

            $model = new Cobros();
            //$model->mesespagados = ;

            $model->zona = $serviciocontratado->getZona();
            $model->idempleado = 1;
            $model->anyomes = $anyomes;
            $model->idservicioscontratados = $serviciocontratado->getId();
            $model->mesespagados = 0;
            $model->mesespagadosdet = ' ';
            $model->totalcobrado = 0;
            $model->contrasenya = '';
            $model->factura = '';
            $model->idcliente = $serviciocontratado->idcliente;



            //meses por pagar

            $model->mesesporcobrar = $serviciocontratado->getMesnopagado();

            $model->mesesporcobrardet = $serviciocontratado->detmesesporpagar;
            $model->totalporcobrar = $serviciocontratado->getDeuda();
            if ($model->mesesporcobrar < 0) {
                $model->mesespagados = $serviciocontratado->getMesnopagado();
                $model->mesesporcobrar = 0;
            }



            $model->save();
            //if (!$model->save())
            //  $salida=$salida .'-error: '.  print_r($model->getErrors());
            //    }
        }

        return $this->redirect(['index']);


        // return $salida;
    }

    /**
     * Creates a new Cobros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }

        $model = new Cobros();

        $serviciocliente = Servicioscontratados::getIdserviciocliente();
        $model->anyomes = $this->getAnyomes();
        $model->fecha = date("Y-m-d");
        $cobropormes = Cobropormes::getListado();

        $model->idempleado = 1;

        if ($model->load(Yii::$app->request->post()) && $model->guardarnuevo()) {

            return $this->redirect(['view', 'id' => $model->idcobro]);
        }

        return $this->render('create', [
            'model' => $model,

            'serviciocliente' => $serviciocliente,
            'cobropormes' => $cobropormes,

        ]);
    }


    /**
     * Updates an existing Cobros model.
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
        if ($modelsec3->nivel > 1) {
            return $this->redirect(['index']);
        }

        $model = $this->findModel($id);

        //        $model = new Cobros::findOne([$id]);

        $serviciocliente = Servicioscontratados::getIdserviciocliente();
        $cobropormes = Cobropormes::getListado();



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idcobro]);
        }


        return $this->render('update', [
            'model' => $model,

            'serviciocliente' => $serviciocliente,
            'cobropormes' => $cobropormes,

        ]);
    }





    public function actionIndexlote()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }

        $searchModel = new LoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $zona = new Zona;
        $listadozonas = Zona::getArrayzonas();

        $anyomes = $this->getAnyomes();

        if ($zona->load(Yii::$app->request->post())) {
            return $this->redirect(['lote', 'zona' => $listadozonas[$zona->nombrezona], 'anyomes' => $anyomes]);
        }


        return $this->render('indexlote', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

            'zona' => $zona,

            'listadozonas' => $listadozonas,
            'anyomes' => $anyomes,
        ]);
    }

    /**
     * Creates a new Cobros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionLote($zona, $anyomes)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }

        //    $zona = 'Barrio cenizal';
        //   $anyomes = $this->getAnyomes();
        $serviciocliente = Servicioscontratados::getIdservicioclientecompleto();

        $model = new LoteForm();
        $model->lote = new Lote();
        $model->lote->loadDefaultValues();

        $model->cargarCobros($zona, $anyomes);
        $model->lote->anyomes = $anyomes;
        $model->lote->zona = $zona;
        $model->lote->totalcobrado = 0;
        $loteForm = Yii::$app->request->post('LoteForm');
        $model->setAttributes(Yii::$app->request->post());

        // $model->cobros->setAttributes(Yii::$app->request->post());


        if (Yii::$app->request->post() && $model->save()) {

            Yii::$app->getSession()->setFlash('success', 'Lote de cobros de zona ' . $zona . ' registrado correctamente. ');
            /*     return $this->render('lote', [
                'serviciocliente' => $serviciocliente,
                'model' => $model,
            ]);
*/
            return $this->redirect(['indexlote']);
            //return $this->redirect(['index']);
        }




        return $this->render('lote', [
            'serviciocliente' => $serviciocliente,
            'model' => $model,
            'zona' => $zona,
        ]);
    }

    public function actionGetinfocontrato($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $infocontrato = Servicioscontratados::findOne($id);
        echo Json::encode($infocontrato);
        //echo 'hola';

    }


    public function actionVerlote($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $lote = Lote::findOne($id);

        $searchModel = new CobrosSearch();
        $searchModel->idlote = $lote->idlote;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['lote_idlote' => $lote->idlote]);


        return $this->render('viewlote', [
            'lote' => $lote,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }





    /**
     * Deletes an existing Cobros model.
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
     * Finds the Cobros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cobros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cobros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
