<?php
if($pixel>0){
	/*$pixel=$pixel-1;
	$exit_url = Yii::app()->params['httphost'].Yii::app()->params['backEnd'].'/index.php/'.Yii::app()->params['campaign'].'/affiliates/pixelCodeDisplay?pixel='.$pixel.'&affiliate_trans_id='.$affiliate_trans_id;*/
    if(strlen($pixel_code) > 0 && $pixel_code != 'NULL' && $pixel_code != ''){
					$patterns = array('/ebpleadid/', '/ebpsubid/', '/ebptransid/', '/ebp2subid/');
					$replacements = array($lead_id,$sub_id,$affiliate_trans_id,$sub_id2);
					$pixel_code = urldecode($pixel_code);
					$pixel_code = preg_replace($patterns, $replacements, $pixel_code);
				}
	for($pix=1;$pix<=$pixel;$pixel--) {
        
		if($pixel_type == 1){
//			$ch_pixel = curl_init($pixel_code);
//			curl_setopt($ch_pixel, CURLOPT_HEADER, 0);
//			curl_exec($ch_pixel);
//			curl_close($ch_pixel);
			// print_r($pixel_code);
          
		file_get_contents($pixel_code);
            
		}else{
			print_r($pixel_code);
			// echo html_entity_decode($pixel_code);
			// echo $pixel;
		}
	}
}
?>