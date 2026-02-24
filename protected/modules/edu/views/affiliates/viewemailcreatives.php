<style>
/**
 ** author : vatsal gadhia
 ** modification : 1) word-wrap property removed from ".email_creative" 2) link changed from "http://www.higherlearningmarketers.com/" to "http://www.higherlearningmarketers.com"
 ** date : 22-08-2016
*/
.email_creative {
	margin: 20px 0;
	border: 1px solid;
	padding: 10px;
}
code {
	display: block;
/* 	white-space: nowrap; */
/* 	color: #444; */
/* 	background-color: #444; */
	padding: 1em;
	border: 1px solid #d1d1d1;
	overflow: auto;
	width: 97%;
	height: auto;
}
.txtright {
  text-align: right;
}
.title{
	margin: 10px 0 10px 0; 
	font-size: 18px;
	font-weight: bold;
	text-align: center;
/* 	border-bottom: 1px solid; */
}
p.cut_and_paste {
	margin: 0;
}
button#target-to-copy {
  margin: 10px 0;
  padding: 0 2px;
  border-radius:
}
</style>
<p class="title">Email Creatives</p>
<div class="email_creative">
	<p>
        <u></u><a href="http://www.higherlearningapp.com?promo_code=<?php echo Yii::app()->user->id;?>">Higher Learning App</a></u>&nbsp;
		<?php echo $creatives['creative_subject_line']?>
	</p>
	<p>
		<a href="http://www.higherlearningapp.com?promo_code=<?php echo Yii::app()->user->id;?>" target="_blank">
			<img alt="Higher Learning App" src="<?php echo Yii::app()->params['httphost'].Yii::app()->params['backEnd']?>/edu_email_creatives/<?php echo $creatives['image_name']?>" class="img-responsive">
		</a>
	</p>
    <p>
        <u><a href="http://www.higherlearningapp.com?promo_code=<?php echo Yii::app()->user->id;?>">Higher Learning App</a></u><?php echo $creatives['creative_from_line']?><br/>
        <a target="_blank" style="text-decoration: underline; text-underline: single" href="http://www.higherlearningapp.com/removeme.php">Unsubscribe</a>
    </p>

<!--
	<p>
		Please apply at
		<a href="http://www.higherlearningmarketers.com" target="_blank">http://www.higherlearningmarketers.com</a>
		and we will match you with the best lender in the area that accepts your educational loan application.&nbsp;
		<a href="http://www.higherlearningmarketers.com" target="_blank">Click Here</a>
		<br>
	</p>
	<p>
		higherlearningmarketers.com<br> 138-07 82nd Drive <br> Briarwood, NY 11435<br> Update Email Settings
		 <a style="text-decoration: underline; text-underline: single" href="http://www.elitecashwire.com/removeme.php">http://www.elitecashwire.com/removeme.php</a> 
		<a target="_blank" style="text-decoration: underline; text-underline: single" href="http://www.higherlearningapp.com/removeme.php">http://www.higherlearningapp.com/removeme.php</a>
	</p>
-->
	<br>
</div>

<p>Copy and paste below code on your email draft for landing page 1</p>
<p class="cut_and_paste">
<code name="clipboard-text" id="clipboard-text">
&lt;p&gt;<br />
    &lt;a href="http://www.higherlearningapp.com?promo_code=<?php echo Yii::app()->user->id;?>"&gt;Higher Learning App&lt;/a&gt;<br />
<?php echo $creatives['creative_subject_line']?> <br />

&lt;/p&gt;<br />
&lt;p&gt;<br />
&lt;a href="http://www.higherlearningapp.com?promo_code=<?php echo Yii::app()->user->id;?>" target="_blank"&gt;<br />
&lt;img alt="Higher learning app" src="<?php echo Yii::app()->params['httphost'].Yii::app()->params['backEnd']?>/edu_email_creatives/<?php echo $creatives['image_name']?>"&gt;<br />
&lt;/a&gt;<br />
&lt;/p&gt;<br />
&lt;p&gt;<br />
    &lt;u&gt; &lt;a href="http://www.higherlearningapp.com?promo_code=<?php echo Yii::app()->user->id;?>"&gt;Higher Learning App&lt;/a&gt;&lt;/u&gt;
 <?php echo htmlentities($creatives['creative_from_line']); ?>&lt;br /&gt;<br />
    &lt;a target="_blank" style="text-decoration: underline; text-underline: single" href="http://www.higherlearningapp.com/removeme.php"&gt;Unsubscribe&lt;/a&gt;
</code>
</p>
<button id="target-to-copy" data-clipboard-target="clipboard-text">Click To Copy</button><br/>
<p>Copy and paste below code on your email draft for landing page 2</p>
<p class="cut_and_paste">
<code name="clipboard-text2" id="clipboard-text2">
&lt;p&gt;<br />
    &lt;a href="http://www.higherlearningapp.com/index.php/landpage?promo_code=<?php echo Yii::app()->user->id;?>"&gt;Higher Learning App&lt;/a&gt;<br />
<?php echo $creatives['creative_subject_line']?> <br />

&lt;/p&gt;<br />
&lt;p&gt;<br />
&lt;a href="http://www.higherlearningapp.com/index.php/landpage?promo_code=<?php echo Yii::app()->user->id;?>" target="_blank"&gt;<br />
&lt;img alt="Higher learning app" src="<?php echo Yii::app()->params['httphost'].Yii::app()->params['backEnd']?>/edu_email_creatives/<?php echo $creatives['image_name']?>"&gt;<br />
&lt;/a&gt;<br />
&lt;/p&gt;<br />
&lt;p&gt;<br />
    &lt;u&gt; &lt;a href="http://www.higherlearningapp.com/index.php/landpage?promo_code=<?php echo Yii::app()->user->id;?>"&gt;Higher Learning App&lt;/a&gt;&lt;/u&gt;
 <?php echo htmlentities($creatives['creative_from_line']); ?>&lt;br /&gt;<br />
    &lt;a target="_blank" style="text-decoration: underline; text-underline: single" href="http://www.higherlearningapp.com/removeme.php"&gt;Unsubscribe&lt;/a&gt;
</code>
</p>
<button id="target-to-copy2" data-clipboard-target="clipboard-text2">Click To Copy</button><br/>

<p>Copy and paste below code on your email draft for landing page 3</p>
<p class="cut_and_paste">
<code name="clipboard-text" id="clipboard-text3">
&lt;p&gt;<br />
    &lt;a href="http://www.higherlearningapp.com/index.php/landingpage/affiliates/landingpage4?promo_code=<?php echo Yii::app()->user->id;?>"&gt;Higher Learning App&lt;/a&gt;<br />
<?php echo $creatives['creative_subject_line']?> <br />

&lt;/p&gt;<br />
&lt;p&gt;<br />
&lt;a href="http://www.higherlearningapp.com/index.php/landingpage/affiliates/landingpage4?promo_code=<?php echo Yii::app()->user->id;?>" target="_blank"&gt;<br />
&lt;img alt="Higher learning app" src="<?php echo Yii::app()->params['httphost'].Yii::app()->params['backEnd']?>/edu_email_creatives/<?php echo $creatives['image_name']?>"&gt;<br />
&lt;/a&gt;<br />
&lt;/p&gt;<br />
&lt;p&gt;<br />
    &lt;u&gt; &lt;a href="http://www.higherlearningapp.com/index.php/landingpage/affiliates/landingpage4?promo_code=<?php echo Yii::app()->user->id;?>"&gt;Higher Learning App&lt;/a&gt;&lt;/u&gt;
 <?php echo htmlentities($creatives['creative_from_line']); ?>&lt;br /&gt;<br />
    &lt;a target="_blank" style="text-decoration: underline; text-underline: single" href="http://www.higherlearningapp.com/removeme.php"&gt;Unsubscribe&lt;/a&gt;
</code>
</p>
<button id="target-to-copy3" data-clipboard-target="clipboard-text3">Click To Copy</button><br/>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/zeroclipboard-2.2.0/ZeroClipboard.js"></script>
<script>
$(document).ready(function(){
	var clientTarget = new ZeroClipboard($("#target-to-copy"),{
   	moviePath: "zeroclipboard-2.2.0/ZeroClipboard.swf",
   	debug: false
   });
	clientTarget.on("load", function(clientTarget){
		$('#flash-loaded').fadeIn();
		clientTarget.on("complete", function(clientTarget, args){
			clientTarget.setText(args.text);
			$('#target-to-copy-text').fadeIn();
		});
	});
    var clientTarget = new ZeroClipboard($("#target-to-copy2"),{
   	moviePath: "zeroclipboard-2.2.0/ZeroClipboard.swf",
   	debug: false
   });
	clientTarget.on("load", function(clientTarget){
		$('#flash-loaded').fadeIn();
		clientTarget.on("complete", function(clientTarget, args){
			clientTarget.setText(args.text);
			$('#target-to-copy-text2').fadeIn();
		});
	});
    var clientTarget = new ZeroClipboard($("#target-to-copy3"),{
   	moviePath: "zeroclipboard-2.2.0/ZeroClipboard.swf",
   	debug: false
   });
	clientTarget.on("load", function(clientTarget){
		$('#flash-loaded').fadeIn();
		clientTarget.on("complete", function(clientTarget, args){
			clientTarget.setText(args.text);
			$('#target-to-copy-text3').fadeIn();
		});
	});
});
</script>
