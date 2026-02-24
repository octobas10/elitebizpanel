<!--
 * @since : 03-12-2016 11:43 AM
 * @author : Siddharajsinh Maharaul
 * @functionality : Added page for get details for EmailToLeadUsers
-->
<style>
.left-column, .right-column {float: left;}
.left-column {width: 30%;}
.right-column {width: 100%;}
.nodatafound{color: red;font-family: sans-serif;font-size: 14px;text-align: center;}
</style>
<!--
/**
 * @since : 03-12-2016 03:13 PM
 * @author : Siddharajsinh Maharaul
 * @functionality : Changed Title For Email Report
 */
-->
<h4>Email To Lead Submissions Users</h4>
<div class="row-fluid">
    <div class="span12">
    <?php
    $this->beginWidget('zii.widgets.CPortlet',array('title'=>"Search"));
    $form = $this->beginWidget('CActiveForm',array ('action' => $this->createUrl('affiliates/EmailToLeadUsers'),'id' => 'list_leads_id','enableAjaxValidation' => false ,'method' => 'get'));
    ?>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <td>
                <b>Lead Status :</b><br>
                <select name="lead_status">
                    <!-- 
                    /**
                     * @since : 21-12-2016 09:17 PM
                     * @author : Siddharajsinh Maharaul
                     * @functionality : Changed from select status to all option
                     */
                     -->
                    <option value="all">All</option>
                    <option value="1" <?php echo (isset($lead_status) && ($lead_status == 1) ? 'selected' : '' ); ?> >Lead Accecped</option>
                    <option value="2" <?php echo (isset($lead_status) && ($lead_status == 2) ? 'selected' : '' ); ?>>Lead Rejected Or Returned</option>
                    <option value="3" <?php echo (isset($lead_status) && ($lead_status == 3) ? 'selected' : '' ); ?>>No Lender</option>
                </select>
            </td>
            <td>
                <b>States :</b><br>
                <select name="state">
                    <!-- 
                    /**
                     * @since : 21-12-2016 09:17 PM
                     * @author : Siddharajsinh Maharaul
                     * @functionality : Changed from select states to all option
                     */
                     -->
                    <option value="all">All</option>
                    <?php
                        if(isset($t_states) && !empty($t_states)){
                            foreach($t_states as $t_state){
                                echo '<option value="'.$t_state['state'].'" '.(isset($s_state) && ($s_state == $t_state['state']) ? 'selected' : '' ).' >'.$t_state['state'].'</option>';
                            }
                        }
                    ?>
                </select>
            </td>
            <td>
                <b>Zipcodes :</b><br>
                <select name="zipcode">
					  <!-- 
					  /**
					   * @since : 21-12-2016 09:17 PM
					   * @author : Siddharajsinh Maharaul
					   * @functionality : Changed from select zipcodes to all option
					   */
					   -->
					  <option value="all">All</option>
					<?php
					  if(isset($t_zipcodes) && !empty($t_zipcodes)){
						  foreach($t_zipcodes as $t_zipcode){
							  echo '<option value="'.$t_zipcode['zipcode'].'" '.(isset($zip_code) && ($zip_code == $t_zipcode['zipcode']) ? 'selected' : '' ).'>'.$t_zipcode['zipcode'].'</option>';
						  }
					  }
					?>
                </select>
            </td>
            <td>
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
    <h4>E-Mail</h4>
    <div class="row-fluid">
    	<div class="span12">

        <?php $form = $this->beginWidget('CActiveForm',array ('action' => $this->createUrl('affiliates/SendEmailToLeadUsers?lead_status='.$lead_status.'&state='.$s_state.'&zipcode='.$zip_code),'id' => 'list_leads_id','enableAjaxValidation' => false ,'method' => 'post')); ?>
      	<table class="table table-striped table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tr>
              <td><textarea type="text" name="subject" cols="40" rows="3"></textarea></td>
              <td><textarea type="text" name="message" cols="40" rows="3"></textarea></td>
              <td><?php echo CHtml::submitButton('Send Mail',array('class'=>'btn btn btn-primary','name'=>'submit')); ?></td>
            </tr>
            </div>
        </table>
        <?php $this->endWidget(); ?>

    		<table class="table table-striped table-hover table-bordered table-condensed">
    			<thead>
    				<tr>
    					<th>Sr.</th>
    					<th>Name</th>
    					<th>Email</th>
    					<th>State</th>
    					<th>Zip</th>
    					<th>Submission Date</th>
    				</tr>
    			</thead>
    			<tbody>
    				<?php
                  if(!empty($t_result)){
                      foreach($t_result as $key => $t_data){
                          echo '<tr>';
                              echo '<td>'.($key+1).'</td>';
                              echo '<td>'.$t_data['first_name'].' '.$t_data['last_name'].'</td>';
                              echo '<td>'.$t_data['email'].'</td>';
                              echo '<td>'.$t_data['state'].'</td>';
                              echo '<td>'.$t_data['zip'].'</td>';
                              echo '<td>'.$t_data['sub_date'].'</td>';
                          echo '</tr>';
                      }
                  }else{
                      echo '<tr><td colspan="6" align="center"><div class="alert alert-danger" align="center"><h4>No Lead Found.</h4></div></td></tr>';
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
