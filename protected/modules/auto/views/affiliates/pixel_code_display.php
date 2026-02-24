<?php
$seconds = 1;
if($pixel>0){
	$pixel=$pixel-1;
	$exit_url = Yii::app()->params['httphost'].Yii::app()->params['backEnd'].'/index.php/'.Yii::app()->params['campaign'].'/affiliates/pixelCodeDisplay?pixel='.$pixel.'&affiliate_trans_id='.$affiliate_trans_id;
	$patterns = array('/ebpleadid/', '/ebpsubid/', '/ebptransid/','/ebpsub2id/');
	$replacements = array($lead_id,$sub_id,$affiliate_trans_id,$sub_id2);
	$pixel_code = urldecode($pixel_code);
	$pixel_code = preg_replace($patterns, $replacements, $pixel_code);
}else{
	header('Location:'.$exit_url);exit;
}
?>
<meta http-equiv="Refresh" content="<?php echo $seconds; ?>;url=<?php echo $exit_url;?>" />
<p>
<?php 
if($pixel_type == 1){
	file_get_contents($pixel_code);
}else{
	//echo html_entity_decode($pixel_code);
	echo $pixel_code;
}
?>
</p>
