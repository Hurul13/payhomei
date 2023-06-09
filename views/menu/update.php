<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Menu $model
 */

$this->title = Yii::t('cruds', 'Ubah Menu') . ' - ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Edit');
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card m-b-30">
            <div class="card-body">
                <?php echo $this->render('_form', [
                    'model' => $model,
                ]); ?>
            </div>
        </div>
    </div>
</div>