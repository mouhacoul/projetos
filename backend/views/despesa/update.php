<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Despesa */

$this->title = 'Editar despesa: ' . $despesaModel->id;
$this->params['breadcrumbs'][] = ['label' => 'Despesas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $despesaModel->id, 'url' => ['view', 'id' => $despesaModel->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="despesa-update">

    <?= $this->render('_form', [
        'despesaModel' => $despesaModel,
        'fornecedorModel' => $fornecedorModel,
        'beneficiarioModel' => $beneficiarioModel,
        'itemModel' => $itemModel,
        'fornecedores' => $fornecedores,
        'despesapassagemModel' => $despesapassagemModel,
        'despesadiariaModel'  => $despesadiariaModel,
    ]) ?>

</div>
