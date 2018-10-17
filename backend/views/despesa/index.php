<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
    <?php 
    

    $dataProvider = new \yii\data\SqlDataProvider([
        'sql' => 'select * from despesa',
    ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           // ['add'=>"asd"],
            'valor_unitario',
            'qtde',
            'status',
            'numero_cheque',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
