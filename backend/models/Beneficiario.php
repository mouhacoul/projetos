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
            [['rg', 'orgao_emissor'], 'string', 'max' => 20],
            [['nivel_academico'], 'string', 'max' => 100],
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
            'rg' => 'Rg',
            'orgao_emissor' => 'Orgao Emissor',
            'nivel_academico' => 'Nivel Academico',
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
