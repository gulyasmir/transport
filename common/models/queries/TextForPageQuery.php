<?php

namespace common\models\queries;

/**
 * This is the ActiveQuery class for [[\common\models\TextForPage]].
 *
 * @see \common\models\TextForPage
 */
class TextForPageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\TextForPage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\TextForPage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
