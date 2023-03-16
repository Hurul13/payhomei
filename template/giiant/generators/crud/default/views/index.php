<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var app\template\giiant\generators\crud\Generator $generator
 */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

/** @var \yii\db\ActiveRecord $model */
$model = new $generator->modelClass;
$model->setScenario('crud');
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    /** @var \yii\db\ActiveRecord $model */
    $model = new $generator->modelClass;
    $safeAttributes = $model->safeAttributes();
    if (empty($safeAttributes)) {
        $safeAttributes = $model->getTableSchema()->columnNames;
    }
}

echo "<?php\n";
?>
/**
 * Autogenerated From GII
 * modified by Defri Indra M
 * 2021
 */

use app\components\ModalButton;
use yii\helpers\Html;
use yii\helpers\Url;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var <?= ltrim($generator->searchModelClass, '\\') ?> $searchModel
*/

$this->title = <?=
$generator->generateString(Inflector::camel2words(
    StringHelper::basename($generator->modelClass)
)) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>

<p>

    <?php if($generator->ajaxForm == false) :?>
        <?= "<?= " ?>Html::a('<i class="fa fa-plus"></i>' . <?= $generator->generateString('Tambah Baru') ?>, ['create'], ['class' => 'btn btn-success']) ?>
    <?php else: ?>
        <?= "<?= " ?>ModalButton::a('<i class="fa fa-plus"></i>' . <?= $generator->generateString('Tambah Baru') ?>, ['create'], ['class' => 'btn btn-success', 'title' => <?= $generator->generateString('Tambah Baru') ?>]) ?>
    <?php endif; ?>
</p>


<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "<?php \yii\widgets\Pjax::begin(['id'=>'pjax-main', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert(\"yo\")}']]) ?>\n"; ?>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <?= "<?= " ?>GridView::widget([
                        'layout' => '{summary}{items}{pager}',
                        'dataProvider' => $dataProvider,
                        'pager'        => [
                            'class'          => app\components\annex\LinkPager::className(),
                            'firstPageLabel' => <?= $generator->generateString('First') ?>,
                            'lastPageLabel'  => <?= $generator->generateString('Last') ?>
                        ],
                        'filterModel' => $searchModel,
                        'tableOptions' => ['class' => 'table table-striped table-borderless table-hover'],
                        'headerRowOptions' => ['class'=>'x'],
                        'columns' => [

                            <?php
                            // action buttons first
                            if($generator->ajaxForm == false) :
                            echo "\\app\\components\\ActionButton::getButtons(['template' => '{view} {update}']),\n";
                            else:
                            echo "\\app\\components\\ActionAjaxButton::getButtons(['template' => '{view} {update}']),\n";
                            endif;

                            $count = 0;
                            echo "\n"; // code-formatting

                            $blacklist = ['flag','created_by','created_at','updated_at','updated_by', 'id'];
                            foreach ($safeAttributes as $attribute) {
                                $format = trim($generator->columnFormat($attribute,$model));
                                if ($format == false) continue;
                                if (++$count < $generator->gridMaxColumns && in_array($attribute, $blacklist) == false) {
                                    echo "\t\t\t\t{$format}\n";
                                } else {
                                    echo "\t\t\t/*{$format}*/\n";
                                }
                            }
                            
                            // action buttons first
                            if($generator->ajaxForm == false) :
                            echo "\\app\\components\\ActionButton::getButtons(['template' => '{delete}']),\n";
                            else:
                            echo "\\app\\components\\ActionAjaxButton::getButtons(['template' => '{delete}']),\n";
                            endif;

                            ?>
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
        <?= "<?php \yii\widgets\Pjax::end() ?>\n"; ?>
        <?php else: ?>

            <?= "<?= " ?> ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => function ($model, $key, $index, $widget) {
                    return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                },
            ]); ?>

        <?php endif; ?>
