<h4>Browse Transaction</h4>
<div class="row-fluid">
<div class="span12">
<?php 
$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",)); 
$form=$this->beginWidget('CActiveForm', array('id' => 'list_leads_id', 'enableAjaxValidation' => false ));
$filter = Yii::app()->getRequest()->getParam('filter',date('m/d/Y'));
$promo_code = Yii::app()->getRequest()->getParam('promo_code'); 
$lenders = Yii::app()->getRequest()->getParam('lenders');
$ping_status = Yii::app()->getRequest()->getParam('ping_status');
$post_status = Yii::app()->getRequest()->getParam('post_status');
$field = Yii::app()->getRequest()->getParam('field','email');
$field_value = Yii::app()->getRequest()->getParam('field_value');
$time = Yii::app()->getRequest()->getParam('time','hour');
$post_request = Yii::app()->getRequest()->getParam('post_request');
?>
<table class="table table-striped table-hover table-bordered table-condensed">
<tr>
	<td style="line-height:0px;width:150px;"><br/>
	<?php echo CHtml::radioButtonList(
			'time',''.$time.'',array(
				'hour'=>'1 hour',
				'day'=>'1 day',
				'week'=>'1 week',
				'month'=>'1 month',
				'quarter'=>'3 months',
				'specific_date'=>'Specific Date'
			),array('labelOptions'=>array('style'=>'display:inline'))
		);
	?>
	</td>
	<td style="width:100px;" class="datehide"><b>Date Range : </b>
	<?php
		$this->widget('ext.EDateRangePicker.EDateRangePicker',array(
	    	'id'=>'Filter_date',
	    	'name'=>'filter',
	    	'value'=>$filter,
	    	'options'=>array('arrows'=>true,'closeOnSelect'=>true),
	    	'htmlOptions'=>array('class'=>'inputClass'),
    	));
	?>
	</td>
	<td style="width:94px;"><b>Promo code :</b><br>
	<?php echo CHtml::textField('promo_code', ''.$promo_code.'', array('style'=>'width:62px;')); ?>
	</td>
	<td style="width:145px;"><b>Ping Response :</b><br>
	<?php echo CHtml::radioButtonList('ping_status', ''.$ping_status.'', 
			array(''=>'ANYTHING', '1' => 'ACCEPTED', '0' => 'REJECTED','-1' => 'ERROR'), 
			array('labelOptions'=>array('style'=>'display:inline')));
	?>
	</td>
	<td style="width:145px;"><b>Post Delivery Status</b><br>
	<?php echo CHtml::radioButtonList('post_request', ''.$post_request.'', 
			array(''=>'ANYTHING', '1' => 'Yes', '0' => 'No'), 
			array('labelOptions'=>array('style'=>'display:inline')));
	?>
	</td>
	<td style="width:145px;"><b>Post Response :</b><br>
	<?php echo CHtml::radioButtonList('post_status', ''.$post_status.'', 
			array(''=>'ANYTHING', '1' => 'ACCEPTED', '0' => 'REJECTED','-1' => 'ERROR'), 
			array('labelOptions'=>array('style'=>'display:inline')));
	?>
	</td>
	<td style="width:130px;"><b>Fields :</b><br>
	<?php echo CHtml::radioButtonList('field',''.$field.'', 
			array('email'=>'Email','first_name' => 'First Name', 'last_name' => 'Last Name', 'ipaddress' => 'IP Address', 'phone' => 'Primary Phone'),	
			array('labelOptions' => array('style'=>'display:inline')));
	?>
	</td>	
	<td><b>Field Value:<b></b></b><br>
	<?php echo(CHtml::textArea('field_value',''.$field_value.'')); ?>
	</td>
	<td><b>Action :</b><br>
	<?php echo CHtml::submitButton('Search',array('class'=>'btn btn btn-primary')); ?><br><br>
	<?php echo CHtml::button('Reset',array('class'=>'btn btn btn-primary','id'=>'reset')); ?>
	</td>
</tr>
</table><?php $this->endWidget(); $this->endWidget(); ?>
</div>
</div>
<div class="row-fluid">
<div class="span12">
<div class="summary">Total Transactions: <?php echo $total; ?></div>
<table id="posts" class="table table-striped table-hover table-bordered table-condensed">
<thead>
	<tr>
		<!--<th>Trans ID</th>-->
		<th>Date</th>
		<th>Affiliate(Code)</th>
		<th>Affiliate Transaction</th>
		<th>Lender Transaction</th>
	</tr>
</thead>
<tbody>
<?php foreach ($posts as $aff_trans) {?>
	<tr class="post">
		<!--<td><?php echo $aff_trans['id']; ?></td>-->
		<td><?php echo $aff_trans['date']; ?></td>
		<td><?php $model = AffiliateUser::model()->findByPk($aff_trans['promo_code']); echo $model->user_name.' ('.$aff_trans['promo_code'].')'; ?></td>
		<td>
			<?php if($aff_trans['ping_request']){?>
			<p><b>Ping Request</b></p>
			<p style="word-wrap:break-word;width:400px"><?php echo urldecode($aff_trans['ping_request']);?></p>
			<?php }?>
			
			<?php if($aff_trans['ping_time']!='0.0000'){?>
			<p><b>Ping response time</b></p>
			<p style="word-wrap:break-word;width:400px"><?php echo urldecode($aff_trans['ping_time']);?></p>
			<?php }?>
			
			<?php if($aff_trans['ping_response']){?>
			<p><b>Ping Response</b></p>
			<p style="word-wrap:break-word;width:400px"><?php echo htmlentities($aff_trans['ping_response']); ?>	</p>
			<?php }?>
			
			<?php if($aff_trans['ping_request']){?>
			<p><b>Ping Status</b></p>
			<p style="word-wrap:break-word;width:400px"><?php if($aff_trans['ping_status']=='1'){echo 'ACCEPTED';}elseif($aff_trans['ping_status']=='0'){echo 'REJECTED';}elseif($aff_trans['ping_status']=='-1'){echo 'ERROR';} ?></p>
			<?php }?>
			
			<?php if($aff_trans['post_request']){?>
			<p><b>Post Request</b></p>
			<p style="word-wrap:break-word;width:400px"><?php echo urldecode($aff_trans['post_request']);?></p>
			<?php }?>
			
			<?php if($aff_trans['post_response']){?>
			<p><b>Post Response</b></p>
			<p style="word-wrap:break-word;width:400px"><?php echo htmlentities($aff_trans['post_response']); ?>	</p>
			<?php }?>
			
			<?php if($aff_trans['post_request']){?>
			<p><b>Post Status</b></p>
			<?php if($aff_trans['post_request']){ ?>
			<p style="word-wrap:break-word;width:400px"><?php if($aff_trans['post_status']=='1'){echo 'ACCEPTED';}elseif($aff_trans['post_status']=='0'){echo 'REJECTED';}elseif($aff_trans['post_status']=='-1'){echo 'ERROR';} ?></p>
			<?php }} ?>
			<?php if($aff_trans['post_time']!='0.0000'){?>
			<p><b>Post response time</b></p>
			<p style="word-wrap:break-word;width:400px"><?php echo urldecode($aff_trans['post_time']);?></p>
			<?php }?>
		</td>
		<td>
			<?php foreach ($aff_trans->lender_trnas as $len_trans) { ?>
			<table class="table table-striped table-hover table-bordered table-condensed">
				<tr>
					<td><?php echo $len_trans['lender_name']; ?></td>
					<td>
						<?php if($len_trans['ping_request']){?>
						<p><b>Ping Data</b></p>
						<p class="comment more" style="word-wrap:break-word;width:400px">
						<?php //echo htmlentities($len_trans['ping_request']); ?>
						<?php echo htmlentities(urldecode($len_trans['ping_request'])); ?>
						</p>
						<?php }?>
						
						<?php if($len_trans['ping_response']){?>
						<p><b>Ping Response</b></p>
						<p style="word-wrap:break-word;width:400px">
						<?php echo htmlentities($len_trans['ping_response']); ?>
						</p>
						<?php }?>
						
						<?php if($len_trans['ping_response']){?>
						<p><b>Ping Status</b></p>
						<p style="word-wrap:break-word;width:400px">
						<?php if($len_trans['ping_status']=='1'){echo 'ACCEPTED';}elseif($len_trans['ping_status']=='0'){echo 'REJECTED';}elseif($len_trans['ping_status']=='-1'){echo 'ERROR';} ?>
						</p>
						<?php }?>
						
						<?php if($len_trans['ping_time']!='0.00'){?>
						<p><b>Ping Time</b></p>
						<p style="word-wrap:break-word;width:400px">
						<?php echo htmlentities($len_trans['ping_time']); ?>
						</p>
						<?php }?>
						
						<?php if($len_trans['post_request']!=''){?>
						<p><b>Post Data</b></p>
						<p class="comment more" style="word-wrap:break-word;width:400px">
						<?php echo htmlentities(urldecode($len_trans['post_request'])); ?>
						</p>
						<?php }?>
						
						<?php if($len_trans['post_response']!=''){?>
						<p><b>Post Response</b></p>
						<p style="word-wrap:break-word;width:400px"><?php echo htmlentities(html_entity_decode($len_trans['post_response'])); ?>
						</p>
						<?php }?>
						
						<?php if(($len_trans['post_status']!='') && ($len_trans['post_request']!='')){?>
						<p><b>Post Status</b></p>
						<p style="word-wrap:break-word;width:400px">
						<?php if($len_trans['post_status']=='1'){echo 'ACCEPTED';}elseif($len_trans['post_status']=='0'){echo 'REJECTED';}elseif($len_trans['post_status']=='-1'){echo 'ERROR';} ?>
						</p>
						<?php }?>
						<?php if($len_trans['post_time']!='0.00'){?>
						<p><b>Post Time</b></p>
						<p style="word-wrap:break-word;width:400px">
						<?php echo htmlentities($len_trans['post_time']); ?>
						</p>
						<?php }?>
						<?php if($len_trans['exit_url']){?>
						<p><b>Exit Url(Redirect URL)</b></p>
						<p class="comment more" style="word-wrap:break-word;width:400px">
						<?php echo htmlentities($len_trans['exit_url']); ?>
						</p>
						<?php }?>
					</td>
					<td>
						<p><b>Ping Price</b></p>
						<?php echo '$'.$len_trans['ping_price']; ?></p>
						<p><b>Post Price</b></p>
						<?php echo '$'.$len_trans['post_price']; ?></p>
						</p>
					</td>
				</tr>
			</table>
			<?php } ?>
		</td>
	</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<?php
/**Generate Paggination Link*/
$this->widget('CLinkPager', array('pages' => $pages));
?>
<style>
.morecontent span { display: none; }
.comment { width: 400px; }
textarea#field_value {width: 200px;}
#reset { width: 78px;}
.datehide{display:none;}
.infinite_navigation{display: none;}
.summary {font-size: 14px; margin: 0 0 5px 5px;font-weight: bold;}
</style>
<script>
$(document).ready(function() {
    var showChar = 120;
    var ellipsestext = "...";
    var moretext = "more";
    var lesstext = "less";
    $('.more').each(function() {
        var content = $(this).html();
        if(content.length > showChar) {
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
            $(this).html(html);
        }
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });


    if('<?php echo $time;?>'=='specific_date') $('.datehide').show();
    
	$("input[name=time]").click(function(){
		if(jQuery(this).val()=='specific_date'){
			$('.datehide').show();
		}else{
			$('.datehide').hide();
		}
	});

	$("#reset").click(function(){
		$.ajax({
			url: '<?php echo Yii::app()->createUrl('ajax'); ?>/?reset=browse_searched_parameters',
			success: function(data) {
				window.location = window.location.pathname;
			}
		});
	});
});
</script>
