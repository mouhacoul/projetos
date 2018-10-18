<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Item;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DespesaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Despesas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="despesa-index">

    <p>
        <?= Html::a('Cadastrar', ['despesa/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'id',
            [
                'attribute' => 'id_item',
                'label' => 'Item',
                'value' => function($model) {
                    $item = Item::findOne($model->id_item);
                    return isset($item) ? $item->descricao : "Item não registrado";
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->getStatus()[$model->status];
                }
            ],
            'objetivo',
            'pendencias',
            [
                'label' => 'Valor total',
                'value' => function($model){
                    return "R$" . ($model->valor_unitario * $model->qtde);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} &nbsp;{delete}'
            ],
        ],
        'emptyText' => 'Nenhum resultado encontrado.',
        'showOnEmpty' => true,
    ]); ?>
</div>
