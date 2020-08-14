<?php

namespace app\models;

use app\models\Lote;
use app\models\Cobros;

use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;


//***********************************************************************
//me hace falta arreglar la actualización cuando se de un cambio de sexo
//cambiar los valores normales
//***********************************************************************

class LoteForm extends Model
{
    private $_lote;
    private $_cobros;

    private $_zona;
    private $_anyomes;


    public function rules()
    {
        return [
            [['Lote'], 'required'],
            [['Cobros'], 'safe'],
        ];
    }

    public function afterValidate()
    {
        if (!Model::validateMultiple($this->getAllModels())) {
            $this->addError(null); // add an empty error to prevent saving
        }
        parent::afterValidate();
    }

    public function save()
    {


        //$this->actualizarExamenes();
        //if (!$this->validate()) 
        //  return false;
        $transaction = Yii::$app->db->beginTransaction();
        //Guardar Lote
        if (!$this->Lote->save()) {
            $transaction->rollBack();
            return false;
        }
        //Guardar lista de cobros
        if (!$this->saveCobros()) {
            $transaction->rollBack();
            $this->_lote->save();
            return false;
        }
        //Finalizar transacción
        $transaction->commit();
        return true;
    }


    public function cargarCobros($zona, $anyomes)
    {
        $this->_zona = $zona;
        $this->_anyomes = $anyomes;

        $this->_cobros = [];

        $result = Cobros::find()
            ->where(['anyomes' => $anyomes, 'zona' => $zona, 'totalcobrado' => '0'])
            ->all();

        foreach ($result as $resultado) {
            $tmp = new Cobros;
            $tmp->attributes = $resultado->attributes;
            $this->_cobros[$resultado->idcobro] = $tmp;
            $this->_cobros[$resultado->idcobro]->setAttributes($tmp);
        }
    }


    public function saveCobros()
    {

        // $resultados= Cobrosexamen::getCobrosxamenbyidresultado($this->_id_orden);
        $fecha = date("Y-m-d");
        $total = 0;
        foreach ($this->_cobros as $key => $resultado) {

            if (!($resultado instanceof Cobros)) {
                $resultado = Cobros::findOne(['idcobro' => $key]);

                $resultado->mesespagados = $resultado->mesespagados;
                $resultado->totalcobrado = $resultado->totalcobrado;
                $resultado->factura = $resultado->factura;
                $resultado->contrasenya = $resultado->contrasenya;
                $resultado->lote_idlote = $this->Lote->idlote;
                $total = $total + $resultado->totalcobrado;
            }
            if ($resultado->totalcobrado > 0) 
                $resultado->lote_idlote = $this->_lote->idlote;
            else
                $resultado->lote_idlote = '';
            $resultado->fecha = $fecha;
            $resultf = Servicioscontratados::findOne($resultado->idservicioscontratados);
            $resultf->mesesnopagados = $resultf->mesesnopagados - $resultado->mesespagados;

            
            
                if ((!$resultado->save()) || (!$resultf->save()))
                    return false;
            
        }
        $this->_lote-> totalcobrado =$total;
        return true;
    }


    public function getLote()
    {
        return $this->_lote;
    }

    public function setLote($orden)
    {
        if ($orden instanceof Lote) {
            $this->_lote = $orden;
            $this->_lote->fecha = date('Y-m-d H:i:s');
        } else if (is_array($orden)) {
            $this->_lote->setAttributes($orden);
            $this->_lote->fecha = date('Y-m-d H:i:s');
        }
    }

    public function getCobros()
    {
        if ($this->_cobros === null) {
            $this->_cobros =  [];
        }
        return $this->_cobros;
    }

    public function getCobro($key)
    {
        $resultado = $key && strpos($key, 'new') === false ? Cobros::findOne($key) : false;
        if (!$resultado) {
            $resultado = new Cobros();
            $resultado->loadDefaultValues();
        }
        return $resultado;
    }

    public function setCobros($resultados)
    {

        //unset($resultados['__id__']); // remove the hidden "new Cobros" row
        $this->_cobros = [];
        foreach ($resultados as $key => $resultado) {
            if (is_array($resultado)) {
                $this->_cobros[$key] = $this->getCobro($key);
                $this->_cobros[$key]->setAttributes($resultado);
            } elseif ($resultado instanceof Cobros) {
                $this->_cobros[$resultado->id] = $resultado;
            }
        }
    }

    public function errorSummary($form)
    {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
            $errorList = $form->errorSummary($model, [
                'header' => '<p>Please fix the following errors for <b>' . $id . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    private function getAllModels()
    {
        $models = [
            'Lote' => $this->orden,
        ];
        foreach ($this->resultados as $id => $resultado) {
            $models['Cobros.' . $id] = $this->resultados[$id];
        }
        return $models;
    }
}
