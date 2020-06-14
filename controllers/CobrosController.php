<?php

namespace app\controllers;

use Yii;
use app\models\Cobros;
use app\models\Clientes;
use app\models\Cobropormes;
use app\models\CobrosSearch;
use app\models\Servicioscontratados;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * CobrosController implements the CRUD actions for Cobros model.
 */
class CobrosController extends Controller
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

    private function getAnyomes()
    {
        return date("Y-m");
    }

    /**
     * Lists all Cobros models.
     * @return mixed
     */
    public function actionIndex() 
    {
        $searchModel = new CobrosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $mesanyo = $this->getAnyomes();
        if ((Cobropormes::find()->where(['cobrosmes' => $mesanyo])->count()) > 0)
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCobrosmes()
    {
        $anyomes = $this->getAnyomes();

        if ((Cobropormes::find()->where(['cobrosmes' => $anyomes])->count()) == 0) {
            $model2 = new Cobropormes();
            $model2->cobrosmes = $anyomes;
            $model2->generado = 1;
            $model2->save();
            $servicioscontratados = Servicioscontratados::find()->where(['nombreestado' => 'Aprobado'])->all();
            

            foreach ($servicioscontratados as $serviciocontratado) {
                
                $serviciocontratado->setMesnopagado();

                $model = new Cobros();
                //$model->mesespagados = ;
                $model->mesesporcobrar = $serviciocontratado->getMesnopagado();
                $model->totalporcobrar = $serviciocontratado->getDeuda();
                $model->zona = $serviciocontratado->getZona();
                $model->idempleado = 1;
                $model->anyomes = $anyomes;
                $model->idservicioscontratados = $serviciocontratado->getId();
                $model->mesespagados = 0;
                $model->totalcobrado = 0;
                $model->contrasenya = '';
                $model->factura = '';

                //meses por pagar

                $model->save();
                    
            }

            return $this->redirect(['index']);
        }


        
    }

    /**
     * Creates a new Cobros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cobros();

        $serviciocliente = Servicioscontratados::getIdserviciocliente();
        $model->anyomes = $this->getAnyomes();
        $model->fecha = date("Y-m-d");
        $cobropormes = Cobropormes::getListado();

        $model->idempleado = 1;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect(['view', 'id' => $model->idcobro]);
        }

        return $this->render('create', [
            'model' => $model,

            'serviciocliente' => $serviciocliente,
            'cobropormes' => $cobropormes,
            
        ]);
    }


    /**
     * Creates a new Cobros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionLote()
    {
        $zona = 'Barrio cenizal';
        $anyomes = $this->getAnyomes();

        $lote = Cobros::getCobros($zona, $anyomes);
        $serviciocliente = Servicioscontratados::getIdservicioclientecompleto();

        
        if (Yii::$app->request->post() ) {
          // $lote = Yii::$app->request->post('lote');
            var_dump(Yii::$app->request->bodyParams);
            /*foreach ($lote as $cobro) {


                $result1 = Cobros::findOne($cobro->idcobro);
                $result1->mesespagados = $cobro->mesespagados;
                $result1->totalcobrado = $cobro->totalcobrado;
                $result1->save();

                $result = Servicioscontratados::findOne($cobro->idservicioscontratados);
                $result->mesesnopagados = $result->mesesnopagados - $cobro->mesespagados;
                $result->save();
                $result->save();
               // $cobro->guardar();
            }
            return $this->redirect(['index']);
            */
        }else

        return $this->render('lote', [
            'serviciocliente' => $serviciocliente,
            'lote' => $lote,
        ]);
    }

    public function actionGetinfocontrato($id){
        $infocontrato = Servicioscontratados::findOne($id);
            echo Json::encode($infocontrato);
      //echo 'hola';

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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idcobro]);
        }

        return $this->render('update', [
            'model' => $model,
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
