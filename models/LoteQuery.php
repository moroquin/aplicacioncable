<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Lote]].
 *
 * @see Lote
 */
class LoteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Lote[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Lote|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
