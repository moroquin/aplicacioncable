<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\Empleados;
use app\models\User;
use app\models\Puesto;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        if (!Yii::$app->user->isGuest) {
           $model1 = User::findOne(Yii::$app->user->id);
           $model2 = Empleados::findOne($model1->empleados_idempleado);
           echo $model2->nombre;
        }else{
            return $this->render('about');
        }

    }
    
    public function actionAddAdmin() {
        $model = User::find()->where(['username' => 'admin'])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = 'admin';
            $user->email = 'admin@devreadwrite.com';
            $user->empleados_idempleado = 1;
            $user->setPassword('admin');
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'good';
            }
        }
    }
    public function actionRegistrar()
    {

 
        $model = new Empleados();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $puesto = Puesto::findOne($model->puestos_idpuestos);
            return $this->redirect(['signup', 'id' => $model->idempleado, 'acceso' => $puesto->nivel]);
        }
        $puestos = [];
        $tmp = Puesto::find()->all();
        foreach($tmp as $puest){

            $puestos[$puest->idpuestos] ="Puesto: ".$puest->nombre; 
        }
        return $this->render('/empleados/create', [
            'model' => $model,
            'puestos' => $puestos,
        ]);
 
    }
    public function actionSignup($id, $acceso)
    {
        $model = new SignupForm();
        $model->idempleado = $id;
        $model->permiso = $acceso;
        $model->estado = 1;
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();
            
            return $this->goHome();
                
        }
        
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    public function actionActualizarcontra($id){
        $model = new SignupForm();
        $model1 = User::findOne($id);
        $model2 = Empleados::findOne($model1->empleados_idempleado);
        if ($model->load(Yii::$app->request->post())){
            $model1->setPassword($model->password);
            $model1->save(); 
            return $this->redirect(['/empleados/view', 'id' => $model1->empleados_idempleado]);
        }
        
        return $this->render('actualizar', [
            'model' => $model,
            'model2' => $model2,
        ]);
    }
}
