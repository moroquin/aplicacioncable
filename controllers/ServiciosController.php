<?php

namespace app\controllers;

use Yii;
use app\models\Servicios;
use app\models\ServiciosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiciosController implements the CRUD actions for Servicios model.
 */
class ServiciosController extends Controller
{


    /**
     * Array de servicios para no crecar una tabla por estos tres servicios. 
     */
    private $serviciosDisponibles = [
        "Internet" => "Internet",
        "Cable" => "Cable",
        "Teléfono" => "Teléfono",
        "Internet y Cable" => "Internet y Cable",
        "Teléfono, internet y Cable" => "Teléfono, internet y Cable",
        
    ];


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
     * Lists all Servicios models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect(['indexx', 'disponible' => 0]);
    }

    /**
     * Lists all Servicios models.
     * @param integer $disponible
     * @return mixed
     */
    public function actionIndexx($disponible)
    {
        $searchModel = new ServiciosSearch();
        $searchModel->disponible =  ($disponible == 0) ? 1 : 0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Servicios model.
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
     * Creates a new Servicios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Servicios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
            //return $this->redirect(['view', 'id' => $model->idservicio]);
        }

        return $this->render('create', [
            'model' => $model,
            'serviciosDisponibles' => $this->serviciosDisponibles,
        ]);
    }

    /**
     * Updates an existing Servicios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idservicio]);
        }

        return $this->render('update', [
            'model' => $model,
            'serviciosDisponibles' => $this->serviciosDisponibles,
        ]);
    }

    /**
     * Deletes an existing Servicios model.
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
     * Finds the Servicios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Servicios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Servicios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

      /**
     * Updates an existing Servicios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatealta($id)
    {
        $model = $this->findModel($id);
        $model->disponible = ($model->disponible == 0) ? 1 : 0;
        $model->save();
        return $this->redirect(['update', 'id' => $model->idservicio]);
    }
}
