<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Datosgen extends Model
{
    public $fecha;

    public function rules()
    { 
        return [
            // Application Name
            
            ['fecha', 'string', 'max' => 150],

            // Application Backend Theme
            /*['appBackendTheme', 'required'],

            // Application Frontend Theme
            ['appFrontendTheme', 'required'],

            // Cache Class
            ['cacheClass', 'required'],
            ['cacheClass', 'string', 'max' => 128],

            // Application Tour
            ['appTour', 'boolean']*/
        ];
    }

    public function attributeLabels()
    {
        return [
            'fecha'          => 'Fecha reporte',
            
        ];
    }
}