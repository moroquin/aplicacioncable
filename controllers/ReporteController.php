<?php

namespace app\controllers;

use app\models\Datosgen;
use app\models\Zona;
use app\models\Servicios;
use mPDF;
use Yii;

class ReporteController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $servicios = Servicios::listadoServicios(TRUE);
        $zonas = Zona::listadoZonasreporte();




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
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
        $zona = (isset($_POST['zona']) && (($_POST['zona']) !== '')) ? $_POST['zona'] : '*';
        $servicio = (isset($_POST['servicio']) && (($_POST['servicio']) !== '')) ? $_POST['servicio'] : '*';

        if (isset($_POST['ingresospordia']))
            return $this->ingresopordia($fecha, $zona, $servicio);
        else if (isset($_POST['ingresospormes']))
            return $this->ingresopormes($fecha, $zona, $servicio);
        else if (isset($_POST['activosmes']))
            return $this->activosmes($fecha, $zona, $servicio);
        else if (isset($_POST['morososmes']))
            return $this->morososmes($fecha, $zona, $servicio);
        else if (isset($_POST['suspendidos']))
            return $this->suspendidos($fecha, $zona, $servicio);
        else if (isset($_POST['reconectados']))
            return $this->reconectados($fecha, $zona, $servicio);
        else if (isset($_POST['recordatorio']))
            return $this->recordatorio($fecha, $zona, $servicio);
        else if (isset($_POST['cobroszonames']))
            return $this->cobrozonames($fecha, $zona, $servicio);

            

        return "fecha $fecha";
    }

    public function ingresopordia($fecha, $zona, $servicio)
    {
        $nomjasperreport = '/reports/ingdiarios/controlServicios1';
        $inputControls = array(
            'empleado_id' => 1,
            'fecha' => $fecha,
        );
        $nomrepo = 'IngresosDiarios-' . $fecha . '.pdf';
        return $this->generarReporte($nomjasperreport,$inputControls, $nomrepo);
    }

    



    public function ingresopormes($fecha, $zona, $servicio)
    {
        $fecha = substr($fecha,0,-6);
        $nomjasperreport = '/reports/reporte2/controlServicios2';
        $inputControls = array(
            'id_empleado' => 1,
            'fecha' => $fecha,
        );
        $nomrepo = 'IngresosMes-' . $fecha . '.pdf';
        return $this->generarReporte($nomjasperreport,$inputControls, $nomrepo);

        
    }

    public function activosmes($fecha, $zona, $servicio)
    {
        $zona = ($zona!='0')?$zona:'*';

        $nomjasperreport = '/reports/reporte3/controlServicios3';
        $inputControls = array(
            'id_usuario' => 1,
            'nombreZona' => $zona,
            'estado' => 'Activo'
        );
        $nomrepo = 'ActivosMes-' . date("Y-m-d H:i:s") . '.pdf';
        return $this->generarReporte($nomjasperreport,$inputControls, $nomrepo);
    }

    

    public function morososmes($fecha, $zona, $servicio)
    {

        $zona = ($zona!='0')?$zona:'*';

        $nomjasperreport = '/reports/reporte3/controlServicios3';
        $inputControls = array(
            'id_usuario' => 1,
            'nombreZona' => $zona,
            'estado' => 'Moroso'
        );
        $nomrepo = 'MorososMes-' . date("Y-m-d H:i:s") . '.pdf';
        return $this->generarReporte($nomjasperreport,$inputControls, $nomrepo);
        
    }

    public function reconectados($fecha, $zona, $servicio)
    {
        [$anyo,$mes,$dia] = explode('-',$fecha,);
        $anyo +=0;
        $mes +=0;

        $nomjasperreport = '/reports/contratosreconectados.jrxml';
        $inputControls = array(
            'mes' => $mes,
            'anyo' => $anyo
        );
        $nomrepo = 'ReconectadosMes-' . date("Y-m-d H:i:s") . '.pdf';
        return $this->generarReporte($nomjasperreport,$inputControls, $nomrepo);
 
    }

    public function recordatorio($fecha, $zona, $servicio)
    {
        

        $nomjasperreport = '/reports/recordatoriopago.jrxml';
        $inputControls = array(
            'anyomes' => $this->getanyomes($fecha)
        );
        $nomrepo = 'RecordatoriopagoMes-' . date("Y-m-d H:i:s") . '.pdf';
        return $this->generarReporte($nomjasperreport,$inputControls, $nomrepo);
    }

    public function cobrozonames($fecha, $zona, $servicio)
    {
        

        $nomjasperreport = '/reports/repocobroszonames.jrxml';
        $inputControls = array(
            'anyomes' => $this->getanyomes($fecha)
        );
        $nomrepo = 'CobroZonaMes-' . date("Y-m-d H:i:s") . '.pdf';
        return $this->generarReporte($nomjasperreport,$inputControls, $nomrepo);
    }

    

    public function suspendidos($fecha, $zona, $servicio)
    {  

        $nomjasperreport = '/reports/contratossupendidos.jrxml';
        $inputControls = null;
        $nomrepo = 'SuspendidosMes-' . date("Y-m-d H:i:s") . '.pdf';
        return $this->generarReporte($nomjasperreport,$inputControls, $nomrepo);
    }


    private function getanyomes($fecha){
        [$anyo,$mes,$dia] = explode('-',$fecha,);
        $mes = $mes +0;
        return $anyo.'-'.$mes;
    }


    private function generarReporte($nomjasperreport,$inputControls, $nomrepo){
        $c = new \Jaspersoft\Client\Client(
            "http://localhost:8080/jasperserver",
            "jasperadmin",
            "jasperadmin"
        );
        $c->setRequestTimeout(60);
        $report = $c->reportService()->runReport($nomjasperreport, 'pdf', null, null, $inputControls);
        
        $options = ['Content-Type' => 'application/pdf', 'inline' => true, 'Content-Disposition' => 'inline'];
        Yii::$app->response->setDownloadHeaders($nomrepo, 'application/pdf', true);

        return Yii::$app->response->sendContentAsFile($report, $nomrepo, $options);

    }

}
