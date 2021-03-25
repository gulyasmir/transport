<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;

$this->params['breadcrumbs'][] = $this->title;
?>

<section class="other-section error-section">
    <div class="container">
        <div class="site-error">
        
            <h1 class="section-title"><?= Html::encode($this->title) ?></h1>
        
            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>
        </div>
    </div>
</section>