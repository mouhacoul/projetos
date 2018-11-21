<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "despesa".
 *
 * @property int $id
 * @property double $valor_unitario
 * @property int $qtde
 * @property int $tipo_desp
 * @property string $status
 * @property string $data_emissao_NF
 * @property string $pendencias
 * @property string $numero_cheque
 * @property string $data_pgto
 * @property string $nf_recibo
 * @property string $objetivo
 * @property int $id_beneficiario
 * @property int $id_fornecedor
 * @property int $id_item
 *
 * @property Beneficiario $beneficiario
 * @property Fornecedor $fornecedor
 * @property Item $item
 * @property DespesaDiaria $despesadiaria
 * @property DespesaPassagem $despesapsassagem
 */
class Despesa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'despesa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return 
            [[['valor_unitario'], 'number'],
            [['tipo_desp'], 'required'],
            [['id_beneficiario', 'id_fornecedor', 'id_item'], 'integer'],
            [['qtde'], 'integer', 'min' => 1],
            [['data_emissao_NF', 'data_pgto'], 'safe'],
            [['pendencias', 'objetivo'], 'string'],
            [['status'], 'string', 'max' => 20],
            [['numero_cheque', 'nf_recibo'], 'string', 'max' => 50],
            [['id_beneficiario'], 'exist', 'skipOnError' => true, 'targetClass' => Beneficiario::className(), 'targetAttribute' => ['id_beneficiario' => 'id']],
            [['id_fornecedor'], 'exist', 'skipOnError' => true, 'targetClass' => Fornecedor::className(), 'targetAttribute' => ['id_fornecedor' => 'id']],
            [['id_item'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['id_item' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valor_unitario' => 'Valor unitário',
            'qtde' => 'Quantidade',
            'tipo_desp' => 'Tipo de despesa',
            'status' => 'Status',
            'data_emissao_NF' => 'Data de emissão NF',
            'pendencias' => 'Pendências',
            'numero_cheque' => 'Número do cheque',
            'data_pgto' => 'Data de pagamento',
            'nf_recibo' => 'NF/Recibo',
            'objetivo' => 'Objetivo',
            'id_beneficiario' => 'Id. Beneficiario',
            'id_fornecedor' => 'Id. Fornecedor',
            'id_item' => 'Id. Item',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeneficiario()
    {
        return $this->hasOne(Beneficiario::className(), ['id' => 'id_beneficiario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFornecedor()
    {
        return $this->hasOne(Fornecedor::className(), ['id' => 'id_fornecedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'id_item']);
    }

     /**
      * @return \yii\db\ActiveQuery
      */
    /* public function getDespesaDiaria()
     {
         return $this->hasMany(DespesaDiaria::className(), ['id_depesa' => 'id']);
     }*/


    /**
     * @return \yii\db\ActiveQuery
     */

    /* public function getDespesaPassagem()
     {
        return $this->hasMany(DespesaPassagem::className(), ['id_despesa' => 'id']);
     }*/

    /**
     * @return Array
     */
    public function getTiposDespesa()
    {
        $tipos = [
            0 => '- Selecionar um tipo de despesa.. -',
            1 => 'Material permanente',
            2 => 'Material de consumo',
            3 => 'Passagem nacional',
            4 => 'Passagem internacional',
            5 => 'Diária nacional',
            6 => 'Diária internacional',
            7 => 'Serviço de terceiro'
        ];

        return $tipos;
    }

    /**
     * @return Array
     */
    public function getStatus()
    {
        $status = [
            1 => '',
            2 => 'Emitida',
            3 => 'Pago',
            4 => 'Pendente',
            5 => 'Finalizado',
            6 => 'Entregue',
            7 => 'Mudança de trecho',
            8 => 'Mover despesa'
        ];

        return $status;
    }


}
