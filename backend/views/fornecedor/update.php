<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Fornecedor */

$this->title = 'Editar Fornecedor: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Fornecedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="fornecedor-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
