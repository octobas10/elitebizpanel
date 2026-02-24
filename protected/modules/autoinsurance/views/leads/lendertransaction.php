<?php ini_set('display_errors',1);error_reporting(E_ALL);?>
<style>
.left-column,.right-column {float: left;}
.left-column {width: 30%;}
.right-column {	width: 100%;}
.morecontent span {	display: none;}
.comment {width: 400px;}
</style>
<h4>Browse Lender Transaction</h4>
<?php 
Yii::app()->clientScript->registerScript('search',
	"$('#list_leads_id').submit(function(){
		$('#lender_transaction').yiiGridView('update', {
			data: $(this).serialize() 
		});
		return false;
	});
");
?>
<div class="row-fluid">
	<div class="span12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",));
		$form=$this->beginWidget('CActiveForm',array('id'=>'list_leads_id','enableAjaxValidation' => false));
		?>
		<table class="table table-striped table-hover table-bordered table-condensed">
			<tr>
				<td style="width: 100px"><b>Date Range : </b>
					<?php
						$date = Yii::app()->getRequest()->getParam('date', 'Today');
						$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
							'id' => 'Filter_date',
							'name' => 'date',
							'value' => $date,
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
								array('empty'=>'All Lenders'));
					?>
				</td>
				<td style="width: 100px"><b>Ping Status:</b>
					<br>
					<?php
						$ping_status = Yii::app()->getRequest()->getParam('ping_status');
						echo CHtml::radioButtonList('ping_status', ''.$ping_status.'',
								array(''=>'ANYTHING', '1' => 'ACCEPTED', '0' => 'REJECTED','-1' => 'ERROR'),
								array('labelOptions'=>array('style'=>'display:inline')));
					?>
				</td>
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
		<?php
		$this->endWidget();
		$this->endWidget();
		?>
	</div>
</div>
<?php
$dataProvider = new CArrayDataProvider($rawData);
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'lender_transaction',
	'dataProvider' => $dataProvider,
	'afterAjaxUpdate' => 'more_less',
	'columns' => array(
		array(
			'name' => 'date',
			'header' => 'Date Time',
			//'value'=> $data->date.'-'.$data->affiliate_transactions_id,
			'htmlOptions' => array(
				'style' => 'width:150px;'
			)
		),
		array(
			'name' => 'lender_name',
			'header' => 'Lender',
			'htmlOptions' => array(
				'style' => 'width:150px;'
			)
		),
		array(
			'name' => 'ping_request',
			'header' => 'Ping Request',
			'value' => 'urldecode($data["ping_request"])',
			'htmlOptions' => array(
				'style' => 'word-wrap:break-word;',
				'class' => 'comment more'
			)
		),
		array(
			'name' => 'ping_response',
			'header' => 'Ping Response',
			'value' => 'html_entity_decode($data["ping_response"])',
			'htmlOptions' => array(
				'style' => 'word-wrap:break-word;',
				'class' => 'comment more'
			)
		),
		array(
			'name' => 'ping_status',
			'header' => 'Ping Status',
			'value' => function($res) {
				if($res['ping_status'] == '1') {
					echo ACCEPTED;
				} else if($res['ping_status'] == '0') {
					echo REJECTED;
				} else if($res['ping_status'] == '-1') {
					echo ERROR;
				}
			},
			'htmlOptions' => array(
				'style' => 'width:150px;'
			)
		),
		array(
			'name' => 'ping_time',
			'header' => 'Ping Time',
			'htmlOptions' => array(
				'style' => 'width:50px;'
			)
		),
		array(
			'name' => 'post_request',
			'header' => 'Post Request',
			'value' => 'urldecode($data["post_request"])',
			'htmlOptions' => array(
				'style' => 'word-wrap:break-word;',
				'class' => 'comment more'
			)
		),
		array(
			'name' => 'post_response',
			'header' => 'Post Response',
			'value' => 'html_entity_decode($data["post_response"])',
			'htmlOptions' => array(
				'style' => 'word-wrap:break-word;',
				'class' => 'comment more'
			)
		),
		array(
			'name' => 'post_status',
			'header' => 'Post Status',
			'value' => function($res) {
				if($res['post_status'] == '1') {
					echo ACCEPTED;
				} else if($res['post_status'] == '0') {
					echo REJECTED;
				} else if($res['post_status'] == '-1') {
					echo ERROR;
				}
			},
			'htmlOptions' => array(
				'style' => 'width:150px;'
			)
		),
		array(
			'name' => 'ping_price',
			'header' => 'Ping Price',
			'htmlOptions' => array(
				'style' => 'width:90px;'
			)
		),

	)
));
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
