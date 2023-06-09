<?php

/**
 * Autogenerated From GII
 * modified by Defri Indra M
 * 2021
 */

use yii\helpers\Html;
use app\components\annex\ActiveForm;
use \app\components\annex\Tabs;
use dosamigos\selectize\SelectizeTextInput;

/**
 * @var yii\web\View $this
 * @var app\modules\android\models\AndroidRoute $model
 * @var app\components\annex\ActiveForm $form
 */

?>

<?php $form = ActiveForm::begin([
    'id' => 'AndroidRoute',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error'
]);
?>
<?php echo $form->errorSummary($model); ?>

<div class="clearfix"></div>
<div class="d-flex  flex-wrap">

    <?= $form->field($model, 'nama_route', \app\components\Constant::COLUMN())->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'butuh_login', \app\components\Constant::COLUMN())->dropDownList($model::getButuhLoginStatuses(), [
        'prompt' => Yii::t('cruds', 'Pilih')
    ]) ?>
    <?= $form->field($model, 'params', \app\components\Constant::COLUMN(1))->widget(SelectizeTextInput::class, [
        'options' => ['class' => 'form-control'],
        'clientOptions' => [
            'plugins' => ['remove_button'],
            'valueField' => 'id',
            'labelField' => 'label',
            'searchField' => ['label'],
            'create' => true,
        ],
    ]) ?>
    <?= $form->field($model, 'keterangan', \app\components\Constant::COLUMN(1))->textarea(['rows' => 6]) ?>
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