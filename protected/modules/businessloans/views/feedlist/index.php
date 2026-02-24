<?php
/* @var $this FeedlistController */

$this->breadcrumbs=array(
	'Feedlist',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<h1> List Items and Manufacturers </h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
			/*'type'=>'striped bordered condensed',*/
			//'htmlOptions'=>array('class'=>'table table-striped table-bordered table-condensed'),
			'dataProvider'=>$affiliate,
			'template'=>"{items}",
			'columns'=>array(
				array('name'=>'id', 'header'=>'#'),
				array('name'=>'first_name', 'header'=>'First name'),
				array('name'=>'last_name', 'header'=>'Last name'),
				array('name'=>'email', 'header'=>'Email'),
				array('name'=>'createdAt', 'header'=>'Date'),
				
			),
		)); ?>
