<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TextForPage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Тексты для страниц сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="text-for-page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'page',
            'name_page',
            'title_text:ntext',
            'text:ntext',
            'title_seo',
            'description',
            'keywords',
        ],
    ]) ?>

</div>
