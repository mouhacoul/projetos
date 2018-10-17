<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "beneficiario".
 *
 * @property int $id
 * @property string $nome
 * @property string $rg
 * @property string $orgao_emissor
 * @property string $nivel_academico
 *
 * @property Despesa[] $despesas
 */
class Beneficiario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'beneficiario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'string', 'max' => 200],
            [['orgao_emissor'], 'string', 'max' => 20],
            [['nivel_academico'], 'string', 'max' => 100],
            [['rg'], 'number'],
            [['rg'], 'unique'],
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
            'rg' => 'RG',
            'orgao_emissor' => 'Órgão Emissor',
            'nivel_academico' => 'Nível Acadêmico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDespesas()
    {
        return $this->hasMany(Despesa::className(), ['id_beneficiario' => 'id']);
    }
}
