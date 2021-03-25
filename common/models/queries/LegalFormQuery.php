<?php

namespace common\models\queries;

/**
 * This is the ActiveQuery class for [[\common\models\LegalForm]].
 *
 * @see \common\models\LegalForm
 */
class LegalFormQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\LegalForm[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\LegalForm|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
