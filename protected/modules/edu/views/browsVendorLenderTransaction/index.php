<style>
.left-column,.right-column {float: left;}
.left-column {width: 30%;}
.right-column {width: 100%;}
.rtime label {display: inline;}
.datehide {display: none;}
.summary {font-size: 14px; margin: 0 0 5px 5px;font-weight: bold;}
</style>
<h4>Vendor Lender Transaction</h4>
<?php Yii::app()->clientScript->registerScript('search', " $('#list_leads_id').submit(function(){ $('#lender_transaction').yiiGridView('update', { data: $(this).serialize() }); return false; }); "); ?>
<div class="row">
    <div class="col-sm-12">
        <?php $this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",)); ?>
        <?php $form=$this->beginWidget('CActiveForm', array( 'id'=>'list_leads_id', 'enableAjaxValidation'=>false, )); 

						//$date = Yii::app()->getRequest()->getParam('date');
                        $date = $_SESSION['date_search_criteria'];
						if(isset($date) && !empty($date)){
						}
						else{
							$date = Yii::app()->getRequest()->getParam('date', 'Today');
						}
		?>
          <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <td style="width:100px"><b>Date range : </b>
                        <?php $this->widget('ext.EDateRangePicker.EDateRangePicker', array('id' => 'Filter_date', 'name' => 'date', 'value' => '' . $date . '', 'options' => array('arrows' => true,'closeOnSelect'=>true ), 'htmlOptions' => array('class' => 'inputClass' ) )); ?>
                    </td>
                    <td style="width:100px"><b>Lenders :</b>
                        <br>
                        <?php
                        $feed_lender_name = Yii::app()->getRequest()->getParam('feed_lender_name');
                        echo Chtml::listBox( 'feed_lender_name', ''.$feed_lender_name. '',
                        		CHtml::listData(EduFeedLenders::model()->findAll(),'feed_lender_name','feed_lender_name'),array('style' => 'width:auto;'));
                        ?>
                    </td>
                    <!--<td style="width:100px"><b>Response :</b>
                        <br>
                        <?php 
                        $response=!empty($_REQUEST['response']) ? $_REQUEST['response'] : ''; 
                        echo CHtml::dropDownList('response', ''.$response. '', array( '1' => ACCEPTED,'0' => REJECTED,'-1' => ERROR), array('empty' => 'ANYTHING')); 
                        ?>
                    </td>-->
                    <td><b>Action :</b>
                        <br>
                        <?php echo CHtml::submitButton( 'search',array( 'class'=>'btn btn btn-primary')); ?><br><br>
	<?php echo CHtml::button('Reset',array('class'=>'btn btn btn-primary','id'=>'reset')); ?>
                    </td>
                </tr>
        </table>
            </div>
        <?php $this->endWidget();?>
        <?php $this->endWidget(); ?>
    </div>
</div>
	
<div class="row-fluid">
<div class="span12">
<div class="summary">Total Transactions: <?php if(isset($NoDataFound)) { echo "0"; } else { echo $total; } ?></div>
      <div class="table-responsive">
<table id="posts" class="table table-striped table-hover table-bordered table-condensed">
<thead>
	<tr>
		<th>Date</th>
		<th>Lender</th>
		<th>Vendor</th>
		<!--
		 * author : vatsal gadhia
		 * modification : Ping Fields Commented
		 * modification date : 22-07-2016 5:45 pm
		 -->
		<!--<th>Ping Sent</th>
		<th>Ping Accepted</th>-->
		<th>Post Sent</th>
		<th>Post Accepted</th>
	</tr>
</thead>
<tbody>
<?php
if(isset($rawData) && !empty($rawData)){
foreach ($rawData as $len_ven_trans) { ?>
	<tr class="post">
		<td style="width:150px;"><?php echo $len_ven_trans['date']; ?></td>
		<td style="width:150px;"><?php echo $len_ven_trans['lender']; ?></td>
		<td style="width:150px;">
			<?php //echo $len_ven_trans['feed_vendor_id'];
			  foreach($vendor_rawData as $vendor_data)
			  {
				  if($len_ven_trans['feed_vendor_id']==$vendor_data['id']){
					  echo $vendor_data['first_name']; continue;
				  }
			  }
			?>
		<!--
		 * author : vatsal gadhia
		 * modification : Ping Fields Commented
		 * modification date : 22-07-2016 5:45 pm
		 -->
		</td>
		<!--<td style="width:150px;"><?php //echo $len_ven_trans['ping_sent']; ?></td>
		<td style="width:150px;"><?php //echo $len_ven_trans['ping_accepted']; ?></td>-->
		<td style="width:150px;"><?php echo $len_ven_trans['post_sent']; ?></td>
		<td style="width:150px;"><?php echo $len_ven_trans['post_accepted']; ?></td>
	</tr>
<?php }}
else
{
	if(empty($posts)){ echo '<tr><td colspan="7" align="center"><div class="alert alert-danger" align="center"><h4>No data found for this criteria.</h4></div></td></tr>'; }
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
