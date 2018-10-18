<?php

namespace backend\controllers;

use Yii;
use backend\models\Despesa;
use backend\models\DespesaSearch;
use backend\models\Fornecedor;
use backend\models\FornecedorSearch;
use backend\models\Beneficiario;
use backend\models\Item;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DespesaController implements the CRUD actions for Despesa model.
 */
class DespesaController extends Controller
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
     * Lists all Despesa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DespesaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Despesa model.
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
     * Creates a new Despesa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $despesaModel = new Despesa();
        $fornecedorModel = new Fornecedor();
        $beneficiarioModel = new Beneficiario();
        $itemModel = new Item();

        $fornecedores = $fornecedorModel->find()->orderBy('nome ASC')->all();
        $listaFornecedores = [];
        foreach($fornecedores as $f){
            $listaFornecedores[] = $f->nome;
        }
        if ($despesaModel->load(Yii::$app->request->post())) {

            $beneficiarioModel->load(Yii::$app->request->post());
            $fornecedorModel->load(Yii::$app->request->post());
            $itemModel->load(Yii::$app->request->post());

            if(!empty($beneficiarioModel->nome) || !empty($beneficiarioModel->rg)){
                $beneficiarioModel->save();
                $despesaModel->id_beneficiario = $beneficiarioModel->id;
            }

            if(!empty($fornecedorModel->nome) || !empty($fornecedorModel->cpf_cnpj)){
                $fornecedor = Fornecedor::find()->where(['cpf_cnpj' => $fornecedorModel->cpf_cnpj])->one();
                if(!isset($fornecedor)){
                    $fornecedorModel->save();
                    $despesaModel->id_fornecedor = $fornecedorModel->id;    
                }else{
                    $despesaModel->id_fornecedor = $fornecedor->id;
                }
            }

            $despesaModel->save();
            return $this->redirect(['index']);
            
        }

        return $this->render('create', [
            'despesaModel' => $despesaModel,
            'fornecedorModel' => $fornecedorModel,
            'beneficiarioModel' => $beneficiarioModel,
            'itemModel' => $itemModel,
            'fornecedores' => $listaFornecedores
        ]);
    }

    public function actionGetfornecedorinfo($nome){
        $fornecedor = Fornecedor::find()->where(['nome' => $nome])->one();

        return $this->asJson(isset($fornecedor) ? $fornecedor : ["id" => null]);
    }

    public function actionGetiteminfo($numero, $projeto = 1, $tipo){
        $item = Item::find()->where([
            'numero_item' => $numero,
            'id_projeto' => $projeto,
            'tipo_item' => $tipo
            ])->one();

        return $this->asJson(isset($item) ? $item : ["id" => null]);
    }

    /**
     * Updates an existing Despesa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $despesaModel = $this->findModel($id);
        if(isset($despesaModel)){
            $fornecedorModel = Fornecedor::findOne($despesaModel->id_fornecedor);
            $beneficiarioModel = Beneficiario::findOne($despesaModel->id_beneficiario);
            $itemModel = Item::findOne($despesaModel->id_item);
    
            $fornecedorModel = isset($fornecedorModel) ? $fornecedorModel : new Fornecedor();
            $beneficiarioModel = isset($beneficiarioModel) ? $beneficiarioModel : new Beneficiario();
            $itemModel = isset($itemModel) ? $itemModel : new Item();

            $fornecedores = $fornecedorModel->find()->orderBy('nome ASC')->all();
            $listaFornecedores = [];
            foreach($fornecedores as $f){
                $listaFornecedores[] = $f->nome;
            }
    
        }
        
        if ($despesaModel->load(Yii::$app->request->post())) {

            $beneficiarioModel->load(Yii::$app->request->post());
            $fornecedorModel->load(Yii::$app->request->post());
            $itemModel->load(Yii::$app->request->post());

            if(!empty($beneficiarioModel->nome) || !empty($beneficiarioModel->rg)){
                $beneficiario = Beneficiario::find()->where(['rg' => $beneficiarioModel->rg])->one();
                if(!isset($beneficiario)){
                    $beneficiarioModel->save();
                    $despesaModel->id_beneficiario = $beneficiarioModel->id;
                }else{
                    if($beneficiarioModel->nome != "") $beneficiario->nome = $beneficiarioModel->nome;
                    if($beneficiarioModel->orgao_emissor != "") $beneficiario->orgao_emissor = $beneficiarioModel->orgao_emissor;
                    if($beneficiarioModel->nivel_academico != "") $beneficiario->nivel_academico = $beneficiarioModel->nivel_academico;
                    $beneficiario->save();
                    $despesaModel->id_beneficiario = $beneficiario->id;
                }
            }else{
                $despesaModel->id_beneficiario = null;
            }

            if(!empty($fornecedorModel->nome) || !empty($fornecedorModel->cpf_cnpj)){
                $fornecedor = Fornecedor::find()->where(['cpf_cnpj' => $fornecedorModel->cpf_cnpj])->one();
                if(!isset($fornecedor)){
                    $fornecedorModel->save();
                    $despesaModel->id_fornecedor = $fornecedorModel->id;    
                }else{
                    if($fornecedor->nome != $fornecedorModel->nome){
                        $fornecedorModel->save();
                    }
                    $despesaModel->id_fornecedor = $fornecedor->id;
                }
            }

            $despesaModel->save();
            return $this->redirect(['index']);
            
        }

        return $this->render('update', [
            'despesaModel' => $despesaModel,
            'fornecedorModel' => $fornecedorModel,
            'beneficiarioModel' => $beneficiarioModel,
            'itemModel' => $itemModel,
            'fornecedores' => $listaFornecedores
        ]);
    }

    /**
     * Deletes an existing Despesa model.
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
     * Finds the Despesa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Despesa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Despesa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
