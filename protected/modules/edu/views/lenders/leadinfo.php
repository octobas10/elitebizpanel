<h4>Lead Infomation Report for Lender: <?php echo isset($posts[0]['lender_name']) ? $posts[0]['lender_name'] : '';?></h4>
<div class="row-fluid">
	<div class="span12">
		<div class="searched_data">
			<br>
			<p>Date: <?php echo date('Y-m-d',strtotime($_REQUEST['date']));?></p>
			<?php
				$txt = $exportcsv = '';
				if(Yii::app()->request->getParam('duplicate_ping')==1){
					$txt = 'Duplicate Pings';
				}elseif(Yii::app()->request->getParam('ping_status')==1){
					$txt = 'Accepted Pings';
					$exportcsv = CHtml::Button('Export CSV',array('class'=>'btn btn btn-primary','name'=>'export','id'=>'exportcsv'));
				}elseif(Yii::app()->request->getParam('post_sent')==1){
					$txt = 'Accepted Pings and Post Sent';
					$exportcsv = CHtml::Button('Export CSV',array('class'=>'btn btn btn-primary','name'=>'export','id'=>'exportcsv'));
				}elseif(Yii::app()->request->getParam('post_status')==1){
					$txt = 'Accepted Pings and Accepted Post';
					$exportcsv = CHtml::Button('Export CSV',array('class'=>'btn btn btn-primary','name'=>'export','id'=>'exportcsv'));
				}elseif(Yii::app()->request->getParam('lead_returned')==1){
					$txt = 'Returned Lead';
					$exportcsv = CHtml::Button('Export CSV',array('class'=>'btn btn btn-primary','name'=>'export','id'=>'exportcsv'));
				}elseif(Yii::app()->request->getParam('final')==1){
					$txt = 'Final Lead';
					$exportcsv = CHtml::Button('Export CSV',array('class'=>'btn btn btn-primary','name'=>'export','id'=>'exportcsv'));
				}else{
					$txt = 'Ping Sent';
				}
				echo $txt ? '<p>'.$txt.'</p>'.$exportcsv : '';
				?>
		</div>
		<table class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<th>Sr.</th>
					<th>Date</th>
					<th>Ping Request</th>
					<th>Ping Response</th>
					<th>Ping Price</th>
					<th>Post Request</th>
					<th>Post Response</th>
					<th>Post Price</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i=1;
					foreach($posts as $lead_info_report){?>
				<tr>
					<td>
						<p><?php echo ($page = Yii::app()->request->getParam('page')) ? (($page-1) * 10 + $i) : $i;?></p>
					</td>
					<td>
						<p class="comment more" style="word-wrap:break-word;width:115px"><?php echo $lead_info_report['date'];?></p>
					</td>
					<td>
						<p class="comment more" style="word-wrap:break-word;width:200px"><?php echo urldecode($lead_info_report['ping_request']);?></p>
					</td>
					<td>
						<p class="comment more" style="word-wrap:break-word;width:200px"><?php echo htmlentities($lead_info_report['ping_response']);?></p>
					</td>
					<td>
						<p class="comment more" style="word-wrap:break-word;width:200px"><?php echo htmlentities($lead_info_report['ping_price']);?></p>
					</td>
					<td>
						<p class="comment more" style="word-wrap:break-word;width:200px"><?php echo urldecode($lead_info_report['post_request']);?></p>
					</td>
					<td>
						<p class="comment more" style="word-wrap:break-word;width:200px"><?php echo htmlentities($lead_info_report['post_response']);?></p>
					</td>
					<td>
						<p class="comment more" style="word-wrap:break-word;width:200px"><?php echo htmlentities($lead_info_report['post_price']);?></p>
					</td>
				</tr>
				<?php $i++;
					}
				if(isset($NoDataFound)){ echo '<tr><td colspan="6" align="center"><div class="alert alert-danger" align="center"><h4>No data found for this criteria.</h4></div></td></tr>'; }
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
	.morecontent span { display: none; }
	.comment { width: 400px; }
	table{ text-align: center;vertical-align: middle;}
	.searched_data { margin-bottom: 10px; float: left; width: 100%;}
	.searched_data p {float: left; margin-right: 79px; font-weight: bold; font-size: 16px;}
</style>
<script>
	$(document).ready(function(){
	    var showChar = 120;
	    var ellipsestext = "...";
	    var moretext = "more";
	    var lesstext = "less";
	    $('.more').each(function() {
	        var content = $(this).html();
	        if(content.length > showChar) {
	            var c = content.substr(0, showChar);
	            var h = content.substr(showChar-1, content.length - showChar);
	            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
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
	    $("#exportcsv").click(function(){
		    var att_name =  $(this).prop('name');
		    var att_value = $(this).prop('value');
		    window.location = window.location.href+'&'+att_name+'='+att_value
	    });
	});
</script>
