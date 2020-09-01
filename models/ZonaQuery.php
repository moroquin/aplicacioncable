<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Zona]].
 *
 * @see Zona
 */
class ZonaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Zona[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Zona|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
