<?php

namespace common\models\queries;

/**
 * This is the ActiveQuery class for [[\common\models\DocumentRequest]].
 *
 * @see \common\models\DocumentRequest
 */
class DocumentRequestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\DocumentRequest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\DocumentRequest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
