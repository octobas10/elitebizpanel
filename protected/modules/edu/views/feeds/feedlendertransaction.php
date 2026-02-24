<style>
.left-column,.right-column {float: left;}
.left-column {width: 30%;}
.right-column {width: 100%;}
.rtime label {display: inline;}
.datehide {display: none;}
.summary {font-size: 14px; margin: 0 0 5px 5px;font-weight: bold;}
</style>
<h4>Feed Lender Transaction</h4>  
<?php

// $date = Yii::app()->getRequest()->getParam('date');
$date = $_SESSION['date_search_criteria'];
if(isset($date) && !empty($date)){
}
else{
	$date = Yii::app()->getRequest()->getParam('date', 'Today');
}
?>
<div class="row-fluid">
    <div class="span12">
        <?php $this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",)); ?>
        <?php $form=$this->beginWidget('CActiveForm', array( 'id'=>'list_leads_id', 'enableAjaxValidation'=>false, )); ?>
        <table class="table table-striped table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <td style="width:100px"><b>Date range : </b>
                        <?php $this->widget('ext.EDateRangePicker.EDateRangePicker', array('id' => 'Filter_date', 'name' => 'date', 'value' => ''.$date.'', 'options' => array('arrows' => true,'closeOnSelect'=>true ), 'htmlOptions' => array('class' => 'inputClass' ) )); ?>
                    </td>
                    <td style="width:100px"><b>Lenders :</b>
                        <br>
                        <?php
                        $feed_lender_name = Yii::app()->getRequest()->getParam('feed_lender_name');
                        echo Chtml::listBox( 'feed_lender_name', ''.$feed_lender_name. '',
                        		CHtml::listData(EduFeedLenders::model()->findAll(),'feed_lender_name','feed_lender_name'),array('style' => 'width:auto;'));
                        ?>
                    </td>
                    <td style="width:100px"><b>Response :</b>
                        <br>
                        <?php 
                        $response=!empty($_REQUEST['response']) ? $_REQUEST['response'] : ''; 
                        echo CHtml::dropDownList('response', ''.$response. '', array( '1' => ACCEPTED,'0' => REJECTED,'-1' => ERROR), array('empty' => 'ANYTHING')); 
                        ?>
                    </td>
                    <td><b>Action :</b>
                        <br>
                        <?php echo CHtml::submitButton( 'search',array( 'class'=>'btn btn btn-primary')); ?><br><br>
	<?php echo CHtml::button('Reset',array('class'=>'btn btn btn-primary','id'=>'reset')); ?>
                    </td>
                </tr>
        </table>
        <?php $this->endWidget();?>
        <?php $this->endWidget(); ?>
    </div>
</div>
<div class="row-fluid">
<div class="span12">
<div class="summary">Total Transactions: <?php if(isset($NoDataFound)) { echo "0"; } else { echo $total; } ?></div>
<table id="posts" class="table table-striped table-hover table-bordered table-condensed">
<thead>
	<tr>
		<th>ID</th>
		<th>Feed Lender Name</th>
		<th>Date</th>
		<th>Request</th>
		<th>Full Response</th>
		<th>Response</th>
	</tr>
</thead>
<tbody>
<?php
if(isset($rawData) && !empty($rawData)){
foreach ($rawData as $len_ven_trans) { ?>
	<tr class="post">
		<td style="width:150px;"><?php echo $len_ven_trans['id']; ?></td>
		<td style="width:150px;"><?php echo $len_ven_trans['feed_lender_name']; ?></td>
		<td style="width:150px;"><?php echo $len_ven_trans['date']; ?></td>
		<td style="width:150px;"><p class="comment more" style="word-wrap:break-word;"><?php echo $len_ven_trans['request']; ?></p></td>
		<td style="width:150px;"><?php echo $len_ven_trans['full_response']; ?></td>
		<td style="width:150px;">
			<?php
				if($len_ven_trans['response']=='1'){
					echo "ACCEPTED";
				}else if($len_ven_trans['response']=='0'){
					echo "REJECTED";
				}else if($len_ven_trans['response']=='-1'){
					echo "ERROR";
				}else{
					echo "ERROR";
				}
			?>
		</td>
	</tr>
<?php }}
else
{
	if(empty($posts)){ echo '<tr><td colspan="6" align="center"><div class="alert alert-danger" align="center"><h4>No data found for this criteria.</h4></div></td></tr>'; }
}
?>
</tbody>
</table>
</div>
</div>
<?php
/**Generate Paggination Link*/
$this->widget('CLinkPager', array('pages' => $pages));
?>
<style>
    .morecontent span {
        display: none;
    }
    .comment {
        width: 400px;
    }
</style>
<script>
    $(document).ready(function() {

        var showChar = 120;
        var ellipsestext = "...";
        var moretext = "more";
        var lesstext = "less";
        $('.more').each(function() {
            var content = $(this).html();

            if (content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar - 1, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                $(this).html(html);
            }

        });

        $(".morelink").click(function() {
            if ($(this).hasClass("less")) {
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
		
		$("#reset").click(function(){
			var fullurl = window.location.pathname;
			var url = fullurl.split("/page")[0];
			document.location = url;
		});

    });
</script>
