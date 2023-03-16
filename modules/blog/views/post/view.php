<?php

/**
 * Autogenerated From GII
 * modified by Defri Indra M
 * 2021
 */

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use app\components\annex\Tabs;

/**
 * @var yii\web\View $this
 * @var app\modules\blog\models\Post $model
 */

$this->title = Yii::t('cruds', 'Post') . ' : ' . $model->title;
?>
<div class="giiant-crud post-view">
    <?php if (Yii::$app->request->isAjax == false) : ?>
        <!-- menu buttons -->
        <p class='pull-left'>
            <?= Html::a('<span class="fa fa-pencil"></span> ' . Yii::t('cruds', 'Ubah'), ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a('<span class="fa fa-plus"></span> ' . Yii::t('cruds', 'Tambah Baru'), ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('<span class="fa fa-trash"></span> ' . Yii::t('cruds', 'Hapus'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        </p>
        <p class="pull-right">
            <?= Html::a('<span class="fa fa-list"></span> ' . Yii::t('cruds', 'Daftar Post'), ['index'], ['class' => 'btn btn-default']) ?>
        </p>
    <?php endif ?>

    <div class="clearfix"></div>

    

    <div class="row">
        <div class="col-md-12">
            <!-- show detail article -->
            <div class="card card-default">
                <div class="card-body">
                    <h3>
                        <?= $model->title ?>
                    </h3>
                    <span style="font-size: .8rem; color: #999">
                        <?= Yii::t('cruds', 'Dibuat pada') ?> <?= Yii::$app->formatter->asIddate($model->created_at) ?>
                    </span>
                    <hr>
                    <!-- content -->
                    <div class="row">
                        <div class="col-md-12">
                            <?= $model->content ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>