<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'year',
            'name_of_production',
            'type',
            'company',
            'status',
            'is_featured',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete} {feature}',
                'buttons' => [
                    'feature' => function ($url, $model, $key) {
                        if ($model->is_featured == 0) {
                            return Html::a('Feature', ['feature', 'id' => $model->id]);
                        } else if ($model->is_featured == 1) {
                            return Html::a('UnFeature', ['unfeature', 'id' => $model->id]);
                        }
                    }],
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
