<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fornecedor".
 *
 * @property int $id
 * @property string $nome
 * @property string $cpf_cnpj
 */
class Fornecedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fornecedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'string', 'max' => 120],
            [['cpf_cnpj'], 'number'],
            [['nome', 'cpf_cnpj'], 'required'],
            [['nome', 'cpf_cnpj'], 'unique', 'targetAttribute' => ['nome', 'cpf_cnpj'], 'message' => 'Fornecedor já cadastrado']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cpf_cnpj' => 'CPF/CNPJ',
        ];
    }
}
