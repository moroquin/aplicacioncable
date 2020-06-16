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

    public function actionIndexlote(){
        $searchModel = new LoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $zona = new Zona;
        $listadozonas = Zona::getArrayzonas();

        $anyomes = $this->getAnyomes();

        if ($zona->load(Yii::$app->request->post()) ) {
            return $this->redirect(['lote','zona'=>$listadozonas[$zona->nombrezona],'anyomes'=>$anyomes]);
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

    //    $zona = 'Barrio cenizal';
     //   $anyomes = $this->getAnyomes();
        $serviciocliente = Servicioscontratados::getIdservicioclientecompleto();

        $model = new LoteForm();
        $model->lote = new Lote();
        $model->lote->loadDefaultValues();
        
        $model->cargarCobros($zona, $anyomes);
        $model->lote->anyomes=$anyomes;
        $model->lote->zona=$zona;
        $model->lote->totalcobrado=0;
        $loteForm=Yii::$app->request->post('LoteForm');
        $model->setAttributes(Yii::$app->request->post());
        
       // $model->cobros->setAttributes(Yii::$app->request->post());
        

        if (Yii::$app->request->post() && $model->save() ){
            
            Yii::$app->getSession()->setFlash('success', 'Lote de cobros de zona '.$zona. ' registrado correctamente. ');
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

    public function actionGetinfocontrato($id){
        $infocontrato = Servicioscontratados::findOne($id);
            echo Json::encode($infocontrato);
      //echo 'hola';

    }


    public function actionVerlote($id){
        $lote = Lote::findOne($id);

        $searchModel = new CobrosSearch();
        $searchModel->idlote = $lote->idlote;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['lote_idlote'=>$lote->idlote]);
        

        return $this->render('viewlote', [
            'lote' => $lote,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
