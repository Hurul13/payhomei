<?php

/**
 * Autogenerated From GII
 * modified by Defri Indra M
 * 2021
 */

use app\components\ModalButton;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\blog\models\search\PostSearch $searchModel
 */

$this->title = Yii::t('cruds', 'Post');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12 mb-2">
    <?= $this->render('_search', ['model' => $searchModel]) ?>
</div>

<?= ListView::widget([
    // layout
    'layout' => '{items}{pager}',
    'dataProvider' => $dataProvider,
    // custom link pager
    'pager' => [
        'class' => 'app\components\annex\LinkPager',
        'options' => [
            'class' => 'pagination pagination-sm no-margin pull-right',
        ],
    ],
    'options' => ['class' => 'row'],
    'itemOptions' => ['class' => 'col-md-3 col-sm-2 col-xs-1 mb-4'],
    // view file for rendering each data item
    'itemView' => '_partial_index',
]); ?>