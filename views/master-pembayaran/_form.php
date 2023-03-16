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
* @var app\models\MasterPembayaran $model
* @var app\components\annex\ActiveForm $form
*/

?>

<?php $form = ActiveForm::begin([
    'id' => 'MasterPembayaran',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error'
]);
?>
<?php echo $form->errorSummary($model); ?>

<div class="clearfix"></div>
<div class="d-flex  flex-wrap">

	<?= $form->field($model, 'nomor_rekening', \app\components\Constant::COLUMN())->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'nama_bank', \app\components\Constant::COLUMN())->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'atas_nama', \app\components\Constant::COLUMN())->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'keterangan', \app\components\Constant::COLUMN())->textarea(['rows' => 6]) ?>
	<?= $form->field($model, 'status', \app\components\Constant::COLUMN())->textInput() ?>
    <div class="clearfix"></div>
</div>
<hr/>
<div class="row">
    <div class="col-md-offset-3 col-md-10">
        <?=  Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('cruds', 'Simpan'), ['class' => 'btn btn-success']); ?>
        <?php if(Yii::$app->request->isAjax == false) : ?>
        <?=  Html::a('<i class="fa fa-chevron-left"></i> ' . Yii::t('cruds', 'Kembali'), ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif ?>
    </div>
</div>
<?php ActiveForm::end(); ?>