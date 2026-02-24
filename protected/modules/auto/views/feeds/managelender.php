<?php
/* @var $this AutoFeedLendersController */
/* @var $model AutoFeedLenders */

$this->breadcrumbs=array(
	'Auto Feed Lenders'=>array('listlender'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AutoFeedLenders', 'url'=>array('listlender')),
	array('label'=>'Create AutoFeedLenders', 'url'=>array('createlender')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#auto-feed-lenders-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Manage Auto Feed Lenders</h1>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchlender',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'auto-feed-lenders-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'feed_lender_name',
		'password',
		'parameter1',
		'parameter2',
		'parameter3',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
