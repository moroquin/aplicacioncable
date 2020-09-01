<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cobropormes]].
 *
 * @see Cobropormes
 */
class CobropormesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Cobropormes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Cobropormes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
