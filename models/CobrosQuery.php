<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cobros]].
 *
 * @see Cobros
 */
class CobrosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Cobros[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Cobros|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
