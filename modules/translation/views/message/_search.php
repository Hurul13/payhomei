<?php

/**
 * Autogenerated From GII
 * modified by Defri Indra M
 * 2021
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\search\SourceMessageSearch $model
 * @var yii\widgets\ActiveForm $form
 */

$kategori_list = \yii\helpers\ArrayHelper::map(\app\modules\translation\models\SourceMessage::find()->distinct(['category'])->select(['category'])->all(), "category", "category");
$bahasa_list = \yii\helpers\ArrayHelper::map(\app\modules\translation\models\Message::find()->distinct(['language'])->select(['language'])->all(), "language", "language");
?>

<div class="card card-default mb-3">
    <div class="card-body">
        <div class="source-message-search">
            <?= Html::beginForm([], "GET"); ?>

            <div class="form-group">
                <?= Html::dropDownList("kategori", Yii::$app->request->get('kategori'), $kategori_list, ['class' => 'form-control', 'prompt' => 'Kategori']) ?>
            </div>
            <!-- <div class="form-group">
                <?= Html::dropDownList("bahasa", Yii::$app->request->get('bahasa'), $bahasa_list, ['class' => 'form-control', 'prompt' => 'Bahasa']) ?>
            </div> -->

            <div class="form-group">
                <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']); ?>
                <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']); ?>
            </div>
            <?= Html::endForm(); ?>
        </div>
    </div>
</div>