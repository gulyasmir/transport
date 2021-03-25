<?php

namespace common\models\queries;

/**
 * This is the ActiveQuery class for [[\common\models\FeedbackRequest]].
 *
 * @see \common\models\FeedbackRequest
 */
class FeedbackRequestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\FeedbackRequest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\FeedbackRequest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
