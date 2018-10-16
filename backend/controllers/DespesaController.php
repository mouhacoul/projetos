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
            //load data into models from request
            $beneficiarioModel->load(Yii::$app->request->post());
            $fornecedorModel->load(Yii::$app->request->post());
            $itemModel->load(Yii::$app->request->post());

            $beneficiarioModel->save();

            //checa se fornecedor ja existe
            $fornecedor = Fornecedor::find()->where([
                'nome' => $fornecedorModel->nome,
                'cpf_cnpj' => $fornecedorModel->cpf_cnpj
            ])->one();
            //se ja existe, apenas atribui o id para a despesa
            if(isset($fornecedor) && $fornecedor->id){
                $despesaModel->id_fornecedor = $fornecedor->id;
            }else{
                //se nao existe, um novo é criado
                $fornecedorModel->save();
                $despesaModel->id_fornecedor = $fornecedorModel->id;
            }

            $item = Item::find()->where(['numero_item' => $itemModel->numero_item])->one();
            if(isset($item) && $item->id){
                $despesaModel->id_item = $item->id;
            }
            $despesaModel->id_beneficiario = $beneficiarioModel->id;

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

        if(isset($fornecedor)){
            return $fornecedor->cpf_cnpj;
        }else{
            return "";
        }
    }

    public function actionGetitemdesc($numero, $projeto, $tipo){
        $item = Item::find()->where([
            'numero_item' => $numero,
            'id_projeto' => $projeto,
            'tipo_item' => $tipo
            ])->one();

        return isset($item) && $item->descricao ? $item->descricao : "";
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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
