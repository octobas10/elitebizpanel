<?php
$this->breadcrumbs = array(
	'Lender Affiliate Setting' => array(
		'create' 
	),
	'Create' 
);
$this->menu = array(
	array(
		'label' => 'Lender Setup',
		'url' => array(
			'lenders/index' 
		) 
	),
	array(
		'label' => 'Affiliate Setup',
		'url' => array(
			'affiliates/index' 
		) 
	) 
);
?>
<h4>Lender Affiliate Settings</h4>
<?php
echo $this->renderPartial('_form',array(
	'model' => $model,
	'affiliate' => $affiliate,
	'lender' => $lender,
	'rendring' => $rendring 
));
?>
