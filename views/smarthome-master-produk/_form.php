<?php

/**
 * Autogenerated From GII
 * modified by Defri Indra M
 * 2021
 */

use yii\helpers\Html;
use app\components\annex\ActiveForm;
use \app\components\annex\Tabs;

/**
 * @var yii\web\View $this
 * @var app\models\SmarthomeMasterProduk $model
 * @var app\components\annex\ActiveForm $form
 */

?>

<?php $form = ActiveForm::begin([
    'id' => 'SmarthomeMasterProduk',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error'
]);
?>
<?php echo $form->errorSummary($model); ?>

<div class="clearfix"></div>
<div class="d-flex  flex-wrap">

    <?= $form->field($model, 'kode_produk', \app\components\Constant::COLUMN(1))->textInput(['maxlength' => true]) ?>
    <!-- <?= $form->field($model, 'digunakan', \app\components\Constant::COLUMN())->textInput() ?>
    <?= $form->field($model, 'reset', \app\components\Constant::COLUMN())->textInput() ?> -->
    <div class="clearfix"></div>
</div>
<hr />
<div class="row">
    <div class="col-md-offset-3 col-md-10">
        <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('cruds', 'Simpan'), ['class' => 'btn btn-success']); ?>
        <?php if (Yii::$app->request->isAjax == false) : ?>
            <?= Html::a('<i class="fa fa-chevron-left"></i> ' . Yii::t('cruds', 'Kembali'), ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif ?>
    </div>
</div>
<?php ActiveForm::end(); ?>