<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Despesa;
use backend\models\Fornecedor;
use backend\models\Beneficiario;
use backend\models\Item;

/* @var $this yii\web\View */
/* @var $model backend\models\Despesa */

$this->title = "Despesa " . $despesaModel->id;
$this->params['breadcrumbs'][] = ['label' => 'Despesas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="despesa-view">

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $despesaModel->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $despesaModel->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $despesaModel,
        'attributes' => [
            'id',
            [
                'attribute' => 'valor_unitario',
                'value' => function($model){
                    return "R$" . ($model->valor_unitario ? $model->valor_unitario : "0");
                }
            ],
            'qtde',
            [
                'label' => 'Valor total',
                'value' => function($model){
                    return "R$" . ($model->valor_unitario * $model->qtde);
                }
            ],
            'tipo_desp',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->getStatus()[$model->status];
                }
            ],
            [
                'attribute' => 'data_emissao_NF',
                'value' => function($model){
                    return isset($model->data_emissao_NF) ? date('d/m/Y', strtotime($model->data_emissao_NF)) : null;
                }
            ],
            'pendencias:ntext',
            'numero_cheque',
            [
                'attribute' => 'data_pgto',
                'value' => function($model){
                    return isset($model->data_pgto) ? date('d/m/Y', strtotime($model->data_pgto)) : null;
                }
            ],
            'nf_recibo',
            'objetivo:ntext',
            [
                'attribute' => 'id_beneficiario',
                'label' => 'Beneficiário',
                'value' => function($model) {
                    $b = Beneficiario::findOne($model->id_beneficiario);
                    return isset($b) ? $b->nome . " - " . $b->rg : "Beneficiário não registrado";
                }
            ],
            [
                'attribute' => 'id_fornecedor',
                'label' => 'Fornecedor',
                'value' => function($model) {
                    $f = Fornecedor::findOne($model->id_fornecedor);
                    return isset($f) ? $f->nome . " - " . $f->cpf_cnpj : "Fornecedor não registrado";
                }
            ],
            [
                'attribute' => 'id_item',
                'label' => 'Item',
                'value' => function($model) {
                    $item = Item::findOne($model->id_item);
                    return isset($item) ? $item->descricao : "Item não registrado";
                }
            ],
        ],
    ]) ?>

</div>
