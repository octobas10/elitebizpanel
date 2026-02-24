<style>
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
		Find A New Or Used Car Loan Quickly&nbsp;
		<a href="http://www.elitedebtcleaners.com">Click Here</a>
	</p>
	<p>
		<a href="http://www.elitedebtcleaners.com" target="_blank">
			<img alt="Get a payday advance up to $1500" src="<?php echo Yii::app()->params['httphost'].Yii::app()->params['backEnd']?>/email_creatives/<?php echo $creatives['image_name']?>">
		</a>
	</p>
	<p>
		Please apply at
		<a href="http://www.elitedebtcleaners.com" target="_blank">http://www.elitedebtcleaners.com</a>
		and we will match you with the best lender in the area that accepts your auto loan application.&nbsp;
		<a href="http://www.elitedebtcleaners.com" target="_blank">Click Here</a>
		<br>
	</p>
	<p>
		elitedebtcleaners.com<br> 138-07 82nd Drive <br> Briarwood, NY 11435<br> Update Email Settings
		<a style="text-decoration: underline; text-underline: single" href="http://www.elitecashwire.com/removeme.php">http://www.elitecashwire.com/removeme.php</a>
	</p>
	<br>
</div>

<p>Copy and paste below code on your email draft</p>
<p class="cut_and_paste">
<code name="clipboard-text" id="clipboard-text">
&lt;p&gt;<br />
Find A New Or Used Car Loan Quickly <br />
&lt;a href="http://www.elitedebtcleaners.com"&gt;Click Here&lt;/a&gt;<br />
&lt;/p&gt;<br />
&lt;p&gt;<br />
&lt;a href="http://www.elitedebtcleaners.com" target="_blank"&gt;<br />
&lt;img alt="Get a payday advance up to $1500" src="<?php echo Yii::app()->params['httphost'].Yii::app()->params['backEnd']?>/email_creatives/<?php echo $creatives['image_name']?>"&gt;<br />
&lt;/a&gt;<br />
&lt;/p&gt;<br />
&lt;p&gt;<br />
Please apply at<br />
&lt;a href="http://www.elitedebtcleaners.com" target="_blank"&gt;http://www.elitedebtcleaners.com&lt;/a&gt;<br />
and we will match you with the best lender in the area that accepts your auto loan application. <br />
&lt;a href="http://www.elitedebtcleaners.com" target="_blank"&gt;Click Here&lt;/a&gt;<br />
&lt;br&gt;<br />
&lt;/p&gt;<br />
&lt;p&gt;<br />
elitedebtcleaners.com&lt;br&gt; 138-07 82nd Drive &lt;br&gt; Briarwood, NY 11435&lt;br&gt; Update Email Settings<br />
&lt;a style="text-decoration: underline; text-underline: single" href="http://www.elitecashwire.com/removeme.php"&gt;http://www.elitecashwire.com/removeme.php&lt;/a&gt;<br />
&lt;/p&gt;<br />
</code>
</p>
<button id="target-to-copy" data-clipboard-target="clipboard-text">Click To Copy</button><br/>
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
});
</script>
