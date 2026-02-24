<style>
.left-column,.right-column {float: left;}
.left-column {width: 30%;}
.right-column {width: 100%;}
.datehide {display: none;}
</style>
<div class="row-fluid">
    <div class="span12">
        <?php $this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",)); ?>
        <?php $form=$this->beginWidget('CActiveForm', 
        		array( 'id'=>'list_leads_id', 
        		//'name'=>'listleads', 
        		'enableAjaxValidation'=>false
        )); ?>
        <table class="table table-striped table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <td style="line-height:0px">
                        <br/>
                        <?php $time = !empty($_REQUEST['time']) ? $_REQUEST['time'] : 'hour'; ?>
                        <?php echo CHtml::radioButtonList('time', $time, array(
							    'hour' => '1 hour',
							    'day' => '1 day',
							    'week' => '1 week',
							    'month' => '1 month',
							    'quarter' => '3 months',
							    'specific_date' => 'specific Date'
							), array(
							    'labelOptions' => array(
							        'style' => 'display:inline'
							    )
							));
						?>
					</td>
                    <td style="width:100px" class="datehide"><b>Date range : </b>
                        <?php
							$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
							    'id' => 'Filter_date',
							    'name' => 'filter',
							    'value' => '' . @date('m/d/Y') . '',
							    'options' => array(
							        'arrows' => true
							    ),
							    'htmlOptions' => array(
							        'class' => 'inputClass'
							    )
							));
						?>
                    </td>
                    <td><b>Action :</b>
                        <br>
                        <?php echo CHtml::submitButton( 'search',array( 'class'=>'btn btn btn-primary')); ?>
                </tr>
        </table>
        <?php $this->endWidget();?>
        <?php $this->endWidget(); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <table class="table table-striped table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <?php //print_r($aff_tran_obj); exit; //echo 'count:'.count($aff_tran_obj); ?>
        			<?php $rejected=($aff_tran_obj[0]['submissions'] - $aff_tran_obj[0]['accepted']); ?>
                </tr>
                <tr>
                    <th>Count[Redirected No]</th>
                    <th>Count[Redirected Yes]</th>
                    <th>Total Posted Leads</th>
                </tr>
                <tr>
                    <td>
                        <p style="word-wrap:break-word;width:400px">
                            <?php echo htmlentities($rejected); ?>
                        </p>
                    </td>
                    <td>
                        <p style="word-wrap:break-word;width:400px">
                            <?php echo htmlentities($aff_tran_obj[0]['accepted']); ?>
                        </p>
                    </td>
                    <td>
                        <p style="word-wrap:break-word;width:400px">
                            <?php echo htmlentities($aff_tran_obj[0]['submissions']); ?>
                        </p>
                    </td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<style>
.morecontent span {display: none;}
.comment {width: 400px;}
</style>
<script>
    $(document).ready(function(){
        var showChar = 120;
        var ellipsestext = "...";
        var moretext = "more";
        var lesstext = "less";
        $('.more').each(function(){
            var content = $(this).html();
            if(content.length > showChar){
                var c = content.substr(0, showChar);
                var h = content.substr(showChar - 1, content.length - showChar);
                var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
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

        $("input[name=time]").click(function(){
            if(jQuery(this).val() == 'specific_date'){
                $('.datehide').show();
            }else{
                $('.datehide').hide();
            }
        });
    });
</script>
