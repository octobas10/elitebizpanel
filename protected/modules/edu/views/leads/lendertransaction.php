<?php ini_set('display_errors',1);error_reporting(E_ALL);?>
<style>
.left-column,.right-column {float: left;}
.left-column {width: 30%;}
.right-column {	width: 100%;}
.morecontent span {	display: none;}
.comment {width: 400px;}
.pager {display:none;}
.summary {font-size: 14px; margin: 0 0 5px 5px;font-weight: bold;}
          @media screen and (max-width: 767px){
        .table-responsive>.table>tbody>tr>td .comment{
            width:100% !important;
        }
    }
</style>
<h4>Browse Lender Transaction</h4>
<div class="row-fluid">
	<div class="span12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",));
		$form=$this->beginWidget('CActiveForm',array('id' => 'list_leads_id','enableAjaxValidation' => false));
		?>
        <div class="table-responsive">
		<table class="table table-striped table-hover table-bordered table-condensed">
			<tr>
				<td style="width: 100px"><b>Date Range : </b>
					<?php
						// $date = Yii::app()->getRequest()->getParam('date');
						$date = $_SESSION['date_search_criteria'];
						if(isset($date) && !empty($date)){
						}
						else{
							$date = Yii::app()->getRequest()->getParam('date', 'Today');
						}
						$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
							'id' => 'Filter_date',
							'name' => 'date',
							'value' => '' . $date . '',
							'options' => array(
								'arrows' => true,
								'closeOnSelect'=>true
							),
							'htmlOptions' => array(
								'class' => 'inputClass'
							)
							));
					?>
				</td>
				<td style="width: 100px"><b>Lenders :</b>
					<br>
					<?php
						$lender_id = Yii::app()->getRequest()->getParam('lender_id');
						echo Chtml::listBox('lender_id', ''.$lender_id. '',
								CHtml::listData(LenderDetails::model()->findAll(),'id','name'),
								array('size'=>'15','empty'=>'All Lenders'));
					?>
				</td>
				<!-- 
				<td style="width: 100px"><b>Ping Status:</b>
					<br>
					<?php
						$ping_status = Yii::app()->getRequest()->getParam('ping_status');
						echo CHtml::radioButtonList('ping_status', ''.$ping_status.'',
								array(''=>'ANYTHING', '1' => ACCEPTED, '0' => REJECTED,'-1' => ERROR),
								array('labelOptions'=>array('style'=>'display:inline')));
					?>
				</td> -->
				<td style="width: 100px"><b>Post Sent:</b>
					<br>
					<?php
						$post_sent = Yii::app()->getRequest()->getParam('post_sent');
						echo CHtml::radioButtonList('post_sent', ''.$post_sent.'',
								array(''=>'ANYTHING', '1' => 'Yes', '0' => 'No'),
								array('labelOptions'=>array('style'=>'display:inline')));
					?>
				</td>
				<td style="width: 100px"><b>Post Status:</b>
					<br>
					<?php
						$post_status = Yii::app()->getRequest()->getParam('post_status');
						echo CHtml::radioButtonList('post_status', ''.$post_status.'',
								array(''=>'ANYTHING', '1' => ACCEPTED, '0' => REJECTED,'-1' => ERROR),
								array('labelOptions'=>array('style'=>'display:inline')));
					?>
				</td>
				<td><b>Action :</b>
					<br>
					<?php echo CHtml::submitButton('Search',array('class'=>'btn btn btn-primary')); ?>
				</td>
			</tr>
		</table>
        </div>
		<?php
		$this->endWidget();
		$this->endWidget();
		?>
	</div>
</div>

<div class="row-fluid">
<div class="span12">
<div class="summary">Total Transactions: <?php echo $total; ?></div>
      <div class="table-responsive">
<table id="posts" class="table table-striped table-hover table-bordered table-condensed">
<thead>
	<tr>
		<th>Date Time</th>
		<th>Lender</th>
		<!--
		 * author : vatsal gadhia
		 * modification : Ping Fields Commented
		 * modification date : 22-07-2016 5:45 pm
		 -->
		<!--<th>Ping Request</th>
		<th>Ping Response</th>
		<th>Ping Status</th>-->
		<th>Post Request</th>
		<th>Post Response</th>
		<th>Post Status</th>
		<!--
		 * author : vatsal gadhia
		 * modification : Ping Fields Commented
		 * modification date : 22-07-2016 5:45 pm
		 -->
		<!--<th>Ping Price</th>-->
	</tr>
</thead>
<tbody>
<?php
if(isset($posts) && !empty($posts)){
foreach ($posts as $len_trans) {
	$lender_ping_response = !empty($len_trans['post_request']) ? $len_trans['post_request'] : $len_trans['ping_request'];
	$lender_post_response = !empty($len_trans['post_response']) ? $len_trans['post_response'] : $len_trans['ping_response'];
	$lender_status = !empty($len_trans['post_status']) ? $len_trans['post_status'] : $len_trans['ping_status'];
	
	//echo $len_trans['post_status'].'<-->'.$len_trans['ping_status'].'--'.$lender_status;
	?>
	<tr class="post">
		<td style="width:150px;"><?php echo $len_trans['date']; ?></td>
		<td style="width:150px;"><?php echo $len_trans['lender_name']; ?></td>
		<!--<td><p class="comment more" style="word-wrap:break-word;width:200px"><?php //echo urldecode($len_trans['ping_request']); ?></p></td>-->
		<!--<td><p class="comment more" style="word-wrap:break-word;width:200px"><?php //echo html_entity_decode($len_trans['ping_response']); ?></p></td>-->
		<!--<td style="width:150px;">
			<?php
				/*if($len_trans['ping_status'] == '1') {
					echo ACCEPTED;
				} else if($len_trans['ping_status'] == '0') {
					echo REJECTED;
				} else if($len_trans['ping_status'] == '-1') {
					echo ERROR;
				}*/
			?>
		</td>-->
		<td><p class="comment more" style="word-wrap:break-word;width:200px"><?php echo urldecode($lender_ping_response); ?></p></td>
		<td style="word-break: break-all;width:200px;"><p><?php echo htmlentities($lender_post_response); ?></p></td>
		<td style="width:150px;">
			<?php
				if($lender_status == '1') {
					echo ACCEPTED;
				} else if($lender_status == '0' || $lender_status == '2') {
					echo REJECTED;
				} else if($lender_status == '-1') {
					echo ERROR;
				}
			?>
		</td>
		<!--
		 * author : vatsal gadhia
		 * modification : Ping Fields Commented
		 * modification date : 22-07-2016 5:45 pm
		 -->
		<!--<td style="width:100px;"><?php //echo $len_trans['ping_price']; ?></td>-->
	</tr>
<?php }
}
else
{
	if(empty($posts)){ echo '<tr><td colspan="9" align="center"><div class="alert alert-danger" align="center"><h4>No data found for this criteria.</h4></div></td></tr>'; }
}
?>
</tbody>
</table>
    </div>
</div>
</div>
<?php
/**Generate Paggination Link*/
$this->widget('CLinkPager', array('pages' => $pages));
?>
<script>
	function more_less(){
		var showChar = 120;
	    var ellipsestext = "...";
	    var moretext = "more";
	    var lesstext = "less";
	    $('.more').each(function(){
	        var content = $(this).html();
	        if(content.length > showChar){
	            var c = content.substr(0, showChar);
	            var h = content.substr(showChar, content.length - showChar);
	            var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h;
	            html += '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
	            $(this).html(html);
	        }
	    });
	    $(".morelink").click(function(){
	        if($(this).hasClass("less")){
	            $(this).removeClass("less");
	            $(this).html(moretext);
	        }else{
	            $(this).addClass("less");
	            $(this).html(lesstext);
	        }
	        $(this).parent().prev().toggle();
	        $(this).prev().toggle();
	        return false;
	    });
	}
	$(document).ready(function(){
		more_less();
	});
</script>
