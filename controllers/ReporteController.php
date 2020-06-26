<?php

namespace app\controllers;

use app\models\Datosgen;
use app\models\Zona;
use app\models\Servicios;
use Yii;

class ReporteController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $servicios = Servicios::listadoServicios(TRUE);
        $zonas = Zona::listadoZonas();




        return $this->render('index', [
            'servicios' => $servicios,
            'zonas' => $zonas,
        ]);
    }



    public function actionIngresospordia($fecha)
    {
        return 'fecha: ' . $fecha;
    }

    public function actionGeneral()
    {


        $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
        $zona = (isset($_POST['zona'])&&(($_POST['zona'])!=='')) ? $_POST['zona'] : '*';
        $servicio = (isset($_POST['servicio'])&&(($_POST['servicio'])!=='')) ? $_POST['servicio'] : '*';

        if (isset($_POST['ingresospordia']))
            return $this->ingresopordia($fecha, $zona, $servicio);
        else if (isset($_POST['ingresospormes']))
            return $this->ingresopormes($fecha, $zona, $servicio);
        else if (isset($_POST['activosmes']))
            return $this->activosmes($fecha, $zona, $servicio);
        else if (isset($_POST['morososmes']))
            return $this->morososmes($fecha, $zona, $servicio);
        else if (isset($_POST['debaja']))
            return $this->debaja($fecha, $zona, $servicio);



        return "fecha $fecha";
    }

    public function ingresopordia($fecha, $zona, $servicio)
    {

        return "ingreso diafecha: $fecha. zona: $zona. Servicio: $servicio.";
        /*
        
    $tmporden=Orden::find()->where(['id_orden'=>$id])->one();
    if ($tmporden->resultado_completo==0){
        $tmporden->resultado_completo=1;
        $tmporden->save();
    }

    $c = new \Jaspersoft\Client\Client(
            "http://localhost:8080/jasperserver",
            "jasperadmin",
            "jasperadmin"
          );    
    $c->setRequestTimeout(60);    

    if ($tipo==1)
      $nomjasperreport='/labcastillo/pm_resultado_examen';
    else
      $nomjasperreport='/labcastillo/seg_resultado_examen';


    $inputControls = array(
                'pr_id_orden' => $id,
                'SUBREPORT_DIR' => '/labcastillo/',
                'ext' => '',
            );

    $nomrepo = 'Resultados-'.$id.'_'.date("Y-m-d H:i:s").'.pdf';
    $report = $c->reportService()->runReport($nomjasperreport, 'pdf', null, null, $inputControls);

    $options = ['Content-Type'=>'application/pdf','inline'=>true,'Content-Disposition'=> 'inline'];
    Yii::$app->response->setDownloadHeaders($nomrepo,'application/pdf',true);

    return Yii::$app->response->sendContentAsFile( $report,$nomrepo,$options);

        */
    }

    public function ingresopormes($fecha, $zona, $servicio)
    {

        return "ingreso mes fecha: $fecha. zona: $zona. Servicio: $servicio.";
    }

    public function activosmes($fecha, $zona, $servicio)
    {

        return "activos fecha: $fecha. zona: $zona. Servicio: $servicio.";
    }


    public function morososmes($fecha, $zona, $servicio)
    {

        return "morosos fecha: $fecha. zona: $zona. Servicio: $servicio.";
    }

    public function debaja($fecha, $zona, $servicio)
    {

        return "de baja fecha: $fecha. zona: $zona. Servicio: $servicio.";
    }


    
}
