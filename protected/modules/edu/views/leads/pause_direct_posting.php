<!--
 * @since : 23-12-2016 03:40 PM
 * @author : Siddharajsinh Maharaul
 * @functionality : Added page for creating paused direct posting affilieates and sub_id combination
-->
<style>
.left-column, .right-column {float: left;}
.left-column {width: 30%;}
.right-column {width: 100%;}
.nodatafound{color: red;font-family: sans-serif;font-size: 14px;text-align: center;}
.select2-container{width: 70% !important;}
</style>
<link href="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/vendor/select2/css/select2.min.css" rel="stylesheet">
<h4>Pause Direct Posting</h4>
    <div class="row-fluid">
      <div class="alert alert-success" id="alert-success" style="display:none;" role="alert">
      </div>
      <div class="alert alert-danger" id="alert-danger" style="display:none;" role="alert">
      </div>
    	<div class="span12">
        <?php $form = $this->beginWidget('CActiveForm',array ('id' => 'pause_direct_post','enableAjaxValidation' => false ,'method' => 'post')); ?>
        <input type="hidden" name="paused_affiliate_id" id="paused_affiliate_id" >
      	<table class="table table-striped table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <th>Affiliate</th>
                    <th>Sub Id</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tr>
              <td style="width: 100px">
                <?php
                echo Chtml::dropDownList('promo_code', '',get_affiliate_name_and_promocode(), array('style'=>'width:auto;','id'=>'promo_code','empty'=>'Select Affiliate'));
                ?>
              </td>
              <td>
                  <select id="sub_ids" name="sub_ids[]" multiple="">
                    
                  </select>
              </td>
              <td><?php //echo CHtml::submitButton('Save',array('class'=>'btn btn btn-primary','id'=>'save_details','name'=>'submit')); ?>
                  <div class="btn btn btn-primary" id="save_details">Save</div>

              </td>
            </tr>
            </div>
        </table>
        <?php $this->endWidget(); ?>
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
<script src="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/vendor/select2/js/select2.min.js"></script>
<script type="text/javascript">
  $("#sub_ids").select2({
    tags: true
  });

  // Save Paused Affiliate Details
  function savePausedAffiliate(promo_code,sub_ids,paused_affiliate_id){
      if(promo_code){
          if(!paused_affiliate_id){
              paused_affiliate_id = '';
          }
          $.ajax({
              url:'<?php echo Yii::app()->createUrl('edu/leads/PauseDirectPost'); ?>',
              type:'POST',
              data:{promo_code:promo_code,sub_ids:sub_ids,paused_affiliate_id:paused_affiliate_id,isAjax:1},
              dataType:'JSON',
              success:function(res){
                  if(res.flag && res.id){
                      $('#paused_affiliate_id').val(res.id);
                      $('#alert-success').html('Affiliate Sub Id(s) Saved.');
                      $('#alert-success').show();
                      hideAlert();
                  }else{
                      $('#paused_affiliate_id').val('');  
                      $('#alert-danger').html('Affiliate Sub Ids Not Saved. Try Again.');
                      $('#alert-danger').show();
                      hideAlert();
                  }
              }
          })
      }
  }

  function getPausedAffiliate(promo_code){
        if(promo_code){
            $.ajax({
              url:'<?php echo Yii::app()->createUrl('edu/leads/PauseDirectPost'); ?>',
              type:'POST',
              data:{promo_code:promo_code,isAjax:2},
              dataType:'JSON',
              success:function(res){
                  if(res.flag){
                      $('#sub_ids').html('');
                      if(res.data){
                        $.each(res.data,function(i,val){
                            $('#sub_ids').append('<option value="'+val.sub_id+'" selected>'+val.sub_id+'</ption>');
                        });
                      }
                      if(res.id){
                        $('#paused_affiliate_id').val(res.id);
                      }              
                      $('#sub_ids').change();
                  }else{
                      $('#paused_affiliate_id').val('');  
                      $('#sub_ids').html('').change();
                  }
              }
          })
        }
  }

  function hideAlert(){
      setTimeout(function(){
        $('#alert-danger').hide().html('');
        $('#alert-success').hide().html('');
      },3000)
  }

  $(document).on('click','#save_details',function(){
      if($('#paused_affiliate_id').val()){
          if($('#promo_code').val()){
              savePausedAffiliate($('#promo_code').val(),$('#sub_ids').val(),$('#paused_affiliate_id').val());
          }
      }else{
          if($('#promo_code').val() && $('#sub_ids').val()){
              savePausedAffiliate($('#promo_code').val(),$('#sub_ids').val());
          }else{
              $('#alert-danger').html('Please select Affiliate and Sub Id');
              $('#alert-danger').show();
              hideAlert();
          }
      }
  });

  /**
   * @since : 26-12-2016 10:39 AM
   * @author : Siddharajsinh Maharaul
   * @functionality : Get Affiliate Details by passing promo code
   */
  $(document).on('change','#promo_code',function(){
      if($(this).val()){
          getPausedAffiliate($(this).val());
      }else{
          $('#paused_affiliate_id').val('');  
          $('#sub_ids').html('').change();
      }
  });

</script>