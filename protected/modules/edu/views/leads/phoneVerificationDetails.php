<!--
 * @since : 02-12-2016 12:54 PM
 * @author : Siddharajsinh Maharaul
 * @functionality : Added page for get details for phoneVerification
-->
<style>
.left-column, .right-column {float: left;}
.left-column {width: 30%;}
.right-column {width: 100%;}
.nodatafound{color: red;font-family: sans-serif;font-size: 14px;text-align: center;}
</style>
<h4>Phone Verification Details</h4>
<div class="row-fluid">
    <div class="span12">
    <?php
    $this->beginWidget('zii.widgets.CPortlet',array('title'=>"Search"));
    $form = $this->beginWidget('CActiveForm',array ('action' => $this->createUrl('leads/PhoneVerificationDetails'),'id' => 'list_leads_id','enableAjaxValidation' => false ,'method' => 'get'));
    ?>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <td style="vertical-align: middle;width:235px">
              <b>Date Range : </b>
            <?php
            /**
          	 * @since : 03-12-2016 10:09 AM
          	 * @author : Siddharajsinh Maharaul
          	 * @functionality : Added new format for date in option
        	  */
            $this->widget('ext.EDateRangePicker.EDateRangePicker', array(
            	'id' => 'Filter_date',
            	'name' => 'filter_date',
            	'value' => '',
            	'options' => array('arrows' => true,'closeOnSelect'=>true,'dateFormat'=>'dd|mm|yy'),
            	'htmlOptions' => array('class' => 'inputClass')
            ));
            ?>
            </td>
            <td style="text-align:left">
              <b>Action:</b><br/>
                <?php echo CHtml::submitButton('Search',array('class'=>'btn btn btn-primary','name'=>'search')); ?>
            </td>
        </tr>
    </table>
    <?php
    $this->endWidget();
    if(isset($NoDataFound)){ echo '<div class="alert alert-danger" align="center"><h4>No data found for this criteria.</h4></div>'; }
    $this->endWidget();
    ?>
    </div>
</div>
<?php if(isset($t_result)){ ?>
    <h4>Phone Verifications Report</h4>
    <div class="row-fluid">
    	<div class="span12">
    		<div class="searched_data">
    			<br>
          <!--
         * @since : 03-12-2016 10:08 AM
         * @author : Siddharajsinh Maharaul
         * @functionality : Replace Pipe with slash in date display
          -->
    			<p>Date: <?php echo str_replace('|','/',$s_dates);?></p>
    		</div>
    		<table class="table table-striped table-hover table-bordered table-condensed">
    			<thead>
    				<tr>
    					<th>Sr.</th>
    					<th>Phone Number</th>
    					<th>Valid</th>
    					<th>Date-Time</th>
    					<th>Cost</th>
    				</tr>
    			</thead>
    			<tbody>
    				<?php
                  /**
                  * @since : 03-12-2016 08:40 AM
                  * @author : Siddharajsinh Maharaul
                  * @functionality : Changed amount from 0.05 to 0.005
                  */
                  if(!empty($t_result)){
                      foreach($t_result as $key => $t_data){
                          echo '<tr>';
                              echo '<td>'.($key+1).'</td>';
                              echo '<td>'.$t_data['phone'].'</td>';
                              echo '<td>'.($t_data['is_valid'] == 1 ? 'Valid' : 'Not Valid' ).'</td>';
                              echo '<td>'.$t_data['verification_datetime'].'</td>';
                              echo '<td>$0.005</td>';
                          echo '</tr>';
                      }
                      echo '<tr><td colspan="4"></td><td>Total Amount : $'.(round((count($t_result)*0.005),2)).'</td></tr>';
                  }else{
                      echo '<tr><td colspan="5" align="center"><div class="alert alert-danger" align="center"><h4>No data found for this date.</h4></div></td></tr>';
                  }
    				?>
    			</tbody>
    		</table>
    	</div>
    </div>
    <?php
    	/**Generate Paggination Link*/
    	$this->widget('CLinkPager', array('pages' => $pages));
  }
	?>
<style>
	.morecontent span { display: none; }
	.comment { width: 400px; }
	table{ vertical-align: middle;}
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
				/**
				 * @since : 30-11-2016 11:49 AM
				 * @author : Siddharajsinh Maharaul
				 * @functionality : Checked URL contain get parameters or not if not then add "?" or add "&" for export csv get parameter
				 */
				var get_parameters = window.location.href.split('?');
				var symbol = '&';
				if(get_parameters.length <= 2){
						symbol = '?';
				}
		    window.location = window.location.href+symbol+att_name+'='+att_value
	    });
	});
</script>








<?php
  function getMonthsArray(){
  	for($i=0;$i<=11;$i++){
  		$months[] = $i;
  	}
  	return array(0 => 'Month:') + $months;
  }
  function getYearsArray(){
  	for($i=0;$i<=14;$i++){
  		$years[] = $i;
  	}
  	return array(0 => 'Year:') + $years;
  }
?>
