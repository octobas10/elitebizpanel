var servicetimeout = 10000;
var tooltip_position =  '';
var apiKey = '';
var affiliateid = '';
var subaffiliateid = '';
var domainname = '';
var emailcallstatus = false;
var namecallstatus = false;
var jquerynoconflictinstance = false;
var ipcallstatus = false;
var phonecallstatus = false;
var addresscallstatus = false;
var captchaCall = false;
var subscribeServices = '';
var baseUrl = 'www.xverify.com';
var serverURL = baseUrl + "/services/";
var loaderImagePath =  baseUrl + "/images/loader.gif";
var myElementArray = Array();
var nametimeout = 10000;
var emailtimeout = 10000;
var phonetimeout = 10000;
var addresstimeout = 10000;
var iptimeout = 10000;
var is_mobile = false;
var mistake_words= new Array();
var service_captcha = new Array();
var tooltip_class = 'tooltip';
var tooltip_underprocess_class = 'xverify_tooltip_underprocess';
var tooltip_error_class = 'tooltip_error';
var tooltip_warning_class = 'tooltip_warning';
service_captcha["email"] = 0;
service_captcha["phone"] = 0;
service_captcha["address"] = 0;
service_captcha["name"] = 0;
service_captcha["ip"] = 0;

var showCaptchaDiv = 'xverify_captcha_popup';
var reCaptchaKey = '6LeLSNcSAAAAACXKRT7_5MwbKvRxUSXjnE05-nso';

function getInputElementsByAttributeFromAllForms(attributeName, attributeValue,fieldType){
	var $ = getJQueryInstance();
	fieldType = typeof fieldType !== 'undefined' ? fieldType : 'text';

	if(attributeName == 'class')
		return $('form :input[type="'+ fieldType +'"][' + attributeName + '*="' + attributeValue + '"]');
		
	return $('form :input[type="'+ fieldType +'"][' + attributeName + '="' + attributeValue + '"]');
}

function getInputElementsByAttributeFromSpecficForms(attributeName, attributeValue, formname){
	var $ = getJQueryInstance();
	if(attributeName == 'class')
		return $(formname).find('input[type="text"][' + attributeName + '*="' + attributeValue + '"]');
	return $(formname).find('input[type="text"][' + attributeName + '="' + attributeValue + '"]');
}
function initalizeServicesURL(){
	var jsHost = 'http://';
	if(document.location.protocol == 'https:')
	{
		jsHost = 'https://';
	}
	baseUrl = jsHost + baseUrl;
	serverURL = jsHost + serverURL;
	loaderImagePath = jsHost + loaderImagePath;
}
function initalizeDomainnameParameters(){
	var $ = getJQueryInstance();
	hostname = document.location.hostname;
	if( $.trim(hostname) !='' && hostname != undefined)
	{
		domainname = $.trim(hostname);
	}
}
function initalizeAffiliatesParameters(){
	var $ = getJQueryInstance();
	var allVars = getUrlVars();
	v1 = allVars['v1'];
	v2 = allVars['v2'];
	
	if( $.trim(v1) !='' && v1 != undefined)
	{
		affiliateid = $.trim(v1);
		
		if( $.trim(v2) !='' && v2 != undefined)
			subaffiliateid = v2;
	}
}

function getUrlVars()
{
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for(var i = 0; i < hashes.length; i++)
	{
	  hash = hashes[i].split('=');
	  vars.push(hash[0]);
	  vars[hash[0]] = hash[1];
	}
	return vars;
}
	
function checkServiceExist(serviceName){
	var serviceStr = subscribeServices;
	var serviceArray = serviceStr.split(",");
	
	var return_value = false;
	for(var i=0; i<serviceArray.length; i++)
	{
	  if(serviceName == serviceArray[i])
	  {
		return_value = true;
		break;
	  }
	}
	return return_value;
	
}
function bindAffilateInputFields(){
	
	//----------------- get Affiliate Input field value starts here-------------------------//
	var inputFields = getInputElementsByAttributeFromAllForms('id', 'v1','hidden');
	
	if(affiliateid == '' && inputFields.length > 0)
	{
		affiliateid = inputFields.val();
	}
	
	if(affiliateid == '')
	{
		var inputFields = getInputElementsByAttributeFromAllForms('name', 'v1','hidden');
	}
	
	if(affiliateid == '' && inputFields.length > 0)
	{
		affiliateid = inputFields.val();
	}
	
	if(affiliateid == '')
	{
		var inputFields = getInputElementsByAttributeFromAllForms('class', 'xverify_v1','hidden');
	}
	
	if(affiliateid == '' && inputFields.length > 0)
	{
		affiliateid = inputFields.val();
	}
		
	//----------------- Affiliate Input field value ends here-------------------------//

	//----------------- get Sub Affiliate Input field value starts here-------------------------//
	var inputFields = getInputElementsByAttributeFromAllForms('id', 'v2','hidden');
	
	if(subaffiliateid == '' && inputFields.length > 0)
	{
		subaffiliateid = inputFields.val();
	}

	if(subaffiliateid == '')
	{
		var inputFields = getInputElementsByAttributeFromAllForms('name', 'v2','hidden');
	}
	
	if(subaffiliateid == '' && inputFields.length > 0)
	{
		subaffiliateid = inputFields.val();
	}
	if(subaffiliateid == '')
	{
		var inputFields = getInputElementsByAttributeFromAllForms('class', 'xverify_v2','hidden');
	}
	
	if(subaffiliateid == '' && inputFields.length > 0)
	{
		subaffiliateid = inputFields.val();
	}

	//----------------- Sub Affiliate Input field value ends here-------------------------//
}
function bindRequiredInputFields(instance)
{
	if(instance == undefined || instance == 1)
	{
		jquerynoconflictinstance = true;
	}
	var $ = getJQueryInstance();
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || $( window ).width() <= 480 ) {
		is_mobile = true;
		tooltip_class = 'tooltip_mobile';
		tooltip_underprocess_class = 'xverify_tooltip_underprocess_mobile';
		tooltip_error_class = 'tooltip_error_mobile';
		tooltip_warning_class = 'tooltip_warning_mobile';
	}
	initializeVariables();
	initializeTimeOuts();
	initalizeServicesURL();
	initalizeAffiliatesParameters();
	initalizeDomainnameParameters();
	bindAffilateInputFields();
	bindRequiredInputFieldsByIdOrName();
	bindRequiredInputFieldsByClass();
	includeFiles();
}
function initializeVariables()
{
	var $ = getJQueryInstance();	
	tooltip_position =  $.getMessagePos();
	apiKey = $.getApiKey();
	subscribeServices = $.getServices();

}
function includeFiles()
{
	var $ = getJQueryInstance();
	$("body").append("<div id='"+showCaptchaDiv+"'></div>");
	$.getScript(baseUrl+'/sharedjs/recaptcha_ajax.js',function(data, textStatus, jqxhr){
	});
	
	$.getScript(baseUrl+'/sharedjs/jquery-ui.js',function(data, textStatus, jqxhr){
		var dialogOptions = {autoOpen : false, position : 'center', title : '', draggable : false, width : 350, 
			height : 180, resizable : false, showTitleBar: true, modal : true, dialogClass: 'ui-gray-dialog'};
		initializeDialog(showCaptchaDiv, dialogOptions);
	});
}
function captchaResponseHandler(servicename,field)
{
	var $ = getJQueryInstance();
	$('#recaptcha_response_field').keypress(function(event) {
	  if ( event.which == 13 ) {
		 verifyCaptchaRequest(servicename,field);
	   }
	});

}
function verifyCaptchaRequest(servicename,field) {
	var $ = getJQueryInstance();
	if(captchaCall === false)
	{
		
		var url = serverURL + "verify_captcha/?type=json&";
		var recaptcha_response_field = $( "#recaptcha_response_field" ).val();
		var recaptcha_challenge_field = $("#recaptcha_challenge_field" ).val();
		if($.trim(recaptcha_response_field) == '')
		{
			alert("Please enter captcha value")
			return ;
		}
		url = url + "callback=?";
		captchaCall = true;
		$.getJSON(
				  url, {"value" : recaptcha_response_field,"code" : recaptcha_challenge_field,"api_key":apiKey,'service_name':servicename},
				  function(json){
					  var status = json["status"];
					  captchaCall = false;
					  if(status == 'captcha_error')
					  {
						  Recaptcha.reload();
						  alert(json["message"]);
					  }
					  else
					  {
						  service_captcha[servicename] = 1;
						   field.trigger('change');
						  $("#"+showCaptchaDiv ).dialog('close');
					  }
		});
	}
}
function showRecaptcha(element_id,key,servicename,field){
	var $ = getJQueryInstance();
	$("#"+showCaptchaDiv ).dialog('open');
	Recaptcha.destroy();
	Recaptcha.create(key,
			 element_id,
		    {
		      theme: "red",
			  callback:function() {captchaResponseHandler(servicename,field) }
		    }
		  );
	}
function initializeDialog(containerNodeId, dialogOptions){
	var $ = getJQueryInstance();
	$("#" + containerNodeId).dialog(dialogOptions);
	if(dialogOptions.hasOwnProperty('showTitleBar') == true && dialogOptions.showTitleBar  == false){
		$('#' + containerNodeId).siblings('.ui-dialog-titlebar').hide();
	}
}	
function initializeTimeOuts()
{
	var gettimeoutstring = '';
	var $ = getJQueryInstance();
	functionstatus  = $.isFunction($.getServicesTimeOut);
	if(functionstatus)
	{
		gettimeoutstring = $.getServicesTimeOut();
		var serviceTimeOutArray = gettimeoutstring.split(",");
		var timeoutvalue = '';
		for(var i=0; i<serviceTimeOutArray.length; i++)
		{
			timeoutvalue = serviceTimeOutArray[i].split(":");
			if(timeoutvalue[0] == 'email')
			{
				emailtimeout = timeoutvalue[1] * 1000;
				emailtimeout = emailtimeout + 2000;
			}
			else if(timeoutvalue[0] == 'phone')
			{
				phonetimeout = timeoutvalue[1] * 1000;
				phonetimeout = phonetimeout + 2000;
			}
			else if(timeoutvalue[0] == 'address')
			{
				addresstimeout = timeoutvalue[1] * 1000;
				addresstimeout = addresstimeout + 2000;
			}
			else if(timeoutvalue[0] == 'name')
			{
				nametimeout = timeoutvalue[1] * 1000;
				nametimeout = nametimeout + 2000;
			}
			else if(timeoutvalue[0] == 'ip_verify')
			{
				iptimeout = timeoutvalue[1];
				iptimeout = iptimeout + 2000;
			}
		}
	}
}
function bindRequiredInputFieldsByIdOrName(){
	
	if(checkServiceExist('email'))
	{
		var inputElements = getInputElementsByAttributeFromAllForms("id", "email");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.bind('change', emailChangeHandler);
//		inputElements.bind('focus', fieldFocusHandler);
		
		inputElements = getInputElementsByAttributeFromAllForms("name", "email");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', emailChangeHandler);
		inputElements.bind('change', emailChangeHandler);
		
		inputElements = getInputElementsByAttributeFromAllForms("id", "email",'email');
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', emailChangeHandler);
		inputElements.bind('change', emailChangeHandler);
		
		inputElements = getInputElementsByAttributeFromAllForms("name", "email",'email');
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', emailChangeHandler);
		inputElements.bind('change', emailChangeHandler);
		
	}
	
	if(checkServiceExist('phone'))
	{
		var inputElements = getInputElementsByAttributeFromAllForms("name", "phone");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.bind('change', phoneChangeHandler);
				
		var inputElements = getInputElementsByAttributeFromAllForms("id", "phone");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', phoneChangeHandler);
		inputElements.bind('change', phoneChangeHandler);
		
		inputElements = getInputElementsByAttributeFromAllForms("name", "phone",'tel');
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.bind('change', phoneChangeHandler);
				
		inputElements = getInputElementsByAttributeFromAllForms("id", "phone",'tel');
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', phoneChangeHandler);
		inputElements.bind('change', phoneChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "cell");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', cellChangeHandler);
		inputElements.bind('change', cellChangeHandler);
				
		var inputElements = getInputElementsByAttributeFromAllForms("id", "cell");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', cellChangeHandler);
		inputElements.bind('change', cellChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "landline");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', landlineChangeHandler);
		inputElements.bind('change', landlineChangeHandler);
				
		var inputElements = getInputElementsByAttributeFromAllForms("id", "landline");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', landlineChangeHandler);
		inputElements.bind('change', landlineChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "voip");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', voipChangeHandler);
		inputElements.bind('change', voipChangeHandler);
				
		var inputElements = getInputElementsByAttributeFromAllForms("id", "voip");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', voipChangeHandler);
		inputElements.bind('change', voipChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "multifield_phone_1");
		inputElements.bind('change', multiPhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("id", "multifield_phone_1");
		inputElements.unbind('change', multiPhoneOtherFieldChangeHandler);
		inputElements.bind('change', multiPhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "multifield_phone_2");
		inputElements.bind('change', multiPhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("id", "multifield_phone_2");
		inputElements.unbind('change', multiPhoneOtherFieldChangeHandler);
		inputElements.bind('change', multiPhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "multifield_phone_3");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },multiPhoneToolTipBeforeShowHandler);
		inputElements.bind('change', multiPhoneChangeHandler);

		var inputElements = getInputElementsByAttributeFromAllForms("id", "multifield_phone_3");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },multiPhoneToolTipBeforeShowHandler);
		inputElements.unbind('change', multiPhoneChangeHandler);
		inputElements.bind('change', multiPhoneChangeHandler);
		
		
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "multifield_cell_1");
		inputElements.bind('change', multiCellPhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("id", "multifield_cell_1");
		inputElements.unbind('change', multiCellPhoneOtherFieldChangeHandler);
		inputElements.bind('change', multiCellPhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "multifield_cell_2");
		inputElements.bind('change', multiCellPhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("id", "multifield_cell_2");
		inputElements.unbind('change', multiCellPhoneOtherFieldChangeHandler);
		inputElements.bind('change', multiCellPhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "multifield_cell_3");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },multiCellPhoneToolTipBeforeShowHandler);
		inputElements.bind('change', multiCellPhoneChangeHandler);

		var inputElements = getInputElementsByAttributeFromAllForms("id", "multifield_cell_3");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },multiCellPhoneToolTipBeforeShowHandler);
		inputElements.unbind('change', multiCellPhoneChangeHandler);
		inputElements.bind('change', multiCellPhoneChangeHandler);
		
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "multifield_landline_1");
		inputElements.bind('change', multiLandlinePhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("id", "multifield_landline_1");
		inputElements.unbind('change', multiLandlinePhoneOtherFieldChangeHandler);
		inputElements.bind('change', multiLandlinePhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "multifield_landline_2");
		inputElements.bind('change', multiLandlinePhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("id", "multifield_landline_2");
		inputElements.unbind('change', multiLandlinePhoneOtherFieldChangeHandler);
		inputElements.bind('change', multiLandlinePhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "multifield_landline_3");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },multiLandlinePhoneToolTipBeforeShowHandler);
		inputElements.bind('change', multiLandlinePhoneChangeHandler);

		var inputElements = getInputElementsByAttributeFromAllForms("id", "multifield_landline_3");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },multiLandlinePhoneToolTipBeforeShowHandler);
		inputElements.unbind('change', multiLandlinePhoneChangeHandler);
		inputElements.bind('change', multiLandlinePhoneChangeHandler);
	}
	if(checkServiceExist('address'))
	{
		var inputElements = getInputElementsByAttributeFromAllForms("name", "street");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },addressToolTipBeforeShowHandler);
		inputElements.bind('change', streetChangeHandler);

		var inputElements = getInputElementsByAttributeFromAllForms("id", "street");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },addressToolTipBeforeShowHandler);
		inputElements.unbind('change', streetChangeHandler);
		inputElements.bind('change', streetChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "city");
		inputElements.bind('change', addressOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("id", "city");
		inputElements.unbind('change', addressOtherFieldChangeHandler);
		inputElements.bind('change', addressOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "state");
		inputElements.bind('change', addressOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("id", "state");
		inputElements.unbind('change', addressOtherFieldChangeHandler);
		inputElements.bind('change', addressOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "zip");
		inputElements.bind('change', addressOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("id", "zip");
		inputElements.unbind('change', addressOtherFieldChangeHandler);
		inputElements.bind('change', addressOtherFieldChangeHandler);
	}
	
	if(checkServiceExist('ip_verify'))
	{
		var inputElements = getInputElementsByAttributeFromAllForms("name", "ipverify");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.bind('change', ipVerifyChangeHandler);
				
		var inputElements = getInputElementsByAttributeFromAllForms("id", "ipverify");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', ipVerifyChangeHandler);
		inputElements.bind('change', ipVerifyChangeHandler);
	}
	
	if(checkServiceExist('name'))
	{
		var inputElements = getInputElementsByAttributeFromAllForms("name", "firstname");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },nameToolTipBeforeShowHandler);
		inputElements.bind('change', firstNameChangeHandler);

		var inputElements = getInputElementsByAttributeFromAllForms("id", "firstname");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },nameToolTipBeforeShowHandler);
		inputElements.unbind('change', firstNameChangeHandler);
		inputElements.bind('change', firstNameChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("name", "lastname");
		inputElements.bind('change', lastNameChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("id", "lastname");
		inputElements.unbind('change', lastNameChangeHandler);
		inputElements.bind('change', lastNameChangeHandler);
	}


}


function bindRequiredInputFieldsByClass(){
	if(checkServiceExist('email'))
	{
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_email");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', emailChangeHandler);
		inputElements.bind('change', emailChangeHandler);
		
		inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_email",'email');
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', emailChangeHandler);
		inputElements.bind('change', emailChangeHandler);
		
	}
	if(checkServiceExist('phone'))
	{
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_phone");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', phoneChangeHandler);
		inputElements.bind('change', phoneChangeHandler);
		
		inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_phone",'tel');
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', phoneChangeHandler);
		inputElements.bind('change', phoneChangeHandler);
				
		
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_cell");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', cellChangeHandler);
		inputElements.bind('change', cellChangeHandler);
				
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_landline");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', landlineChangeHandler);
		inputElements.bind('change',landlineChangeHandler);
				
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_voip");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });
		inputElements.unbind('change', voipChangeHandler);
		inputElements.bind('change', voipChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_multifield_phone_1");
		inputElements.bind('change', multiPhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_multifield_phone_2");
		inputElements.bind('change', multiPhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_multifield_phone_3");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },multiPhoneToolTipBeforeShowHandler);
		inputElements.unbind('change', multiPhoneChangeHandler);
		inputElements.bind('change', multiPhoneChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_multifield_landline_1");
		inputElements.bind('change', multiLandlinePhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_multifield_landline_2");
		inputElements.bind('change', multiLandlinePhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_multifield_landline_3");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },multiLandlinePhoneToolTipBeforeShowHandler);
		inputElements.unbind('change', multiCellPhoneChangeHandler);
		inputElements.bind('change', multiLandlinePhoneChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_multifield_cell_1");
		inputElements.bind('change', multiCellPhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_multifield_cell_2");
		inputElements.bind('change', multiCellPhoneOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_multifield_cell_3");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },multiCellPhoneToolTipBeforeShowHandler);
		inputElements.unbind('change', multiCellPhoneChangeHandler);
		inputElements.bind('change', multiCellPhoneChangeHandler);
	}
	
	if(checkServiceExist('address'))
	{
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_street");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },addressToolTipBeforeShowHandler);
		inputElements.unbind('change', streetChangeHandler);
		inputElements.bind('change', streetChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_city");
		inputElements.unbind('change', addressOtherFieldChangeHandler);
		inputElements.bind('change', addressOtherFieldChangeHandler);
		
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_state");
		inputElements.unbind('change', addressOtherFieldChangeHandler);
		inputElements.bind('change', addressOtherFieldChangeHandler);

		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_zip");
		inputElements.unbind('change', addressOtherFieldChangeHandler);
		inputElements.bind('change', addressOtherFieldChangeHandler);
	}
	
	if(checkServiceExist('ip_verify'))
	{
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_ipverify");
		bindToolTipOnInputElements(inputElements,{ message_position : tooltip_position });		
		inputElements.unbind('change', ipVerifyChangeHandler);
		inputElements.bind('change', ipVerifyChangeHandler);
			}
	
	if(checkServiceExist('name'))
	{
		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_firstname");
		bindToolTipOnMultiInputElements(inputElements,{ message_position : tooltip_position },nameToolTipBeforeShowHandler);
		inputElements.unbind('change', firstNameChangeHandler);
		inputElements.bind('change', firstNameChangeHandler);

		var inputElements = getInputElementsByAttributeFromAllForms("class", "xverify_lastname");
		inputElements.unbind('change', lastNameChangeHandler);
		inputElements.bind('change', lastNameChangeHandler);

	}

}

/****************************************** Get value from specific form via field *****************************************/
function getFiledValueByForm(form, fieldname)
{
	value = ''
	fieldElement = getInputElementsByAttributeFromSpecficForms('id',fieldname,form)
	if(fieldElement.length == 0)
	{
		fieldElement = getInputElementsByAttributeFromSpecficForms('name',fieldname,form)
		if(fieldElement.length == 0)
		{
			fieldclass = 'xverify_' + fieldname;
			fieldElement = getInputElementsByAttributeFromSpecficForms('class',fieldclass,form)
		}
	}
		
	if(fieldElement.length > 0)
	{
		value = fieldElement.val();
	}
	
	return value;
}


function getFiledElementByForm(form, fieldname)
{
	value = ''
	fieldElement = getInputElementsByAttributeFromSpecficForms('id',fieldname,form)
	if(fieldElement.length == 0)
	{
		fieldElement = getInputElementsByAttributeFromSpecficForms('name',fieldname,form)
		if(fieldElement.length == 0)
		{
			fieldclass = 'xverify_' + fieldname;
			fieldElement = getInputElementsByAttributeFromSpecficForms('class',fieldclass,form)
		}
	}
	return fieldElement;
}
/****************************************** Get value from specific form via field *****************************************/

/******************************************* Email Change Handler Function ********************************/

function emailChangeHandler(event){
	var $ = getJQueryInstance();
	var field = $(event.target);
	
	var serviceStatus = field.attr('service');
	if(serviceStatus == 0)
	{
		return;
	}
	
	var email = field.val();
	var parentForm = this.form;
	var tooltip = field.tooltip();
	var submitBtn = $(parentForm).find("input[type='submit']");
	
	myElementArray[tooltip.getConf('tip').tip] = 1;
	$(parentForm).attr('state','proccess');
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("input[type='image']");
	}
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("button[type='submit']");
	}
	submitBtn.attr('disabled', 'true');
	if(is_mobile == true){
		var position = field.offset();
		var newtop = 0;
		var newleft = 0;
		newtop = position.top + field.outerHeight();
		newleft = position.left;
		tip = tooltip.getTip();
		tip.css({'left':newleft+'px','top':newtop+'px'});
		field.css({'border':'inherit'});
	}
	if(checkEmailSyntax(email))
	{
		tip = tooltip.getTip();
		var spellCheck = checkDomainSpell(email);
		if( spellCheck == true)
		{
			tip.removeClass(tooltip_error_class);
			tip.addClass(tooltip_underprocess_class);
			if(is_mobile == true){
				field.css({'border':'inherit'});
				tip.html("Verifying...");
			}
			else
			{
				tip.html("Verifying... <img src='"+ loaderImagePath +"'  style='vertical-align:middle'/>");
			}
		}
		else
		{
			tip.removeClass(tooltip_underprocess_class);
			tip.addClass(tooltip_error_class);
			xverifySuggestEmail(email,spellCheck,tooltip,submitBtn,parentForm,field);
			return;
		}
//		field.attr('disabled', 'true');
	}
	else if($.trim(email) == '')
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			field.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter email address");
		}
		return;
	}
	else
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			field.css({'border':'2px solid #F00'});
			tip.html("Invalid Syntax");
		}
		else
		{
			tip.html("Invalid Email Syntax");
		}
		return;
	}
	
	emailServiceRequest(email,tooltip,submitBtn,parentForm,field );
}
function checkDomainSpell(email)
{
	emaildomainname = getDomainNameFromEmail(email);
	if(mistake_words[emaildomainname] == undefined)
	{
		return true;
	}
	else
	{
		newemail = email.replace(emaildomainname,mistake_words[emaildomainname]);
		return newemail;
	}
}
function xverifySuggestEmail(email,suggestedemail,tooltip,submitBtn,parentForm,field){
	var $ = getJQueryInstance();
	tip = tooltip.getTip();
	tip.html("<div align = 'left'><b>Did you mean: </b></div><div align = 'center'><a href='javascript:' alt='" + suggestedemail +"' class='xverify_suggest_email'>" + suggestedemail +"</a><br> OR <br><a href='javascript:' alt='" + email +"' class='xverify_suggest_email'>" + email +"</a></div>");
		
		$(".xverify_suggest_email").click(function() {
			email = $(this).attr('alt');
			field.val(email);
			tip.removeClass(tooltip_warning_class);
			tip.addClass(tooltip_underprocess_class);
			if(is_mobile == true){
				field.css({'border':'inherit'});
				tip.html("Verifying...");
			}
			else
			{
				tip.html("Verifying... <img src='"+ loaderImagePath +"'  style='vertical-align:middle'/>");
			}
  			emailServiceRequest(email,tooltip,submitBtn,parentForm,field,1);
			return false;
		});
}
/******************************************* Email Change Handler Function ********************************/

function formButtonCheckHandler(tooltip,submitBtn,parentForm)
{
	var $ = getJQueryInstance();
	for (var key in myElementArray)
		{
			if(myElementArray[key] == 1)
				{
					if(submitBtn.length > 0)
					{
						submitBtn.attr('disabled', 'true');
					}
					
					$(parentForm).attr('state','proccess');
					break;
				}
		}
}
/******************************************* Phone Change Handler Function ********************************/
function cellChangeHandler(event){
	phoneChangeHandler(event,'cell');
}
function landlineChangeHandler(event){
	phoneChangeHandler(event,'landline');
}
function voipChangeHandler(event){
	phoneChangeHandler(event,'voip');
}
function phoneChangeHandler(event,phoneType){
	var $ = getJQueryInstance();
	var field = $(event.target);
	var serviceStatus = field.attr('service');
	if(serviceStatus == 0)
	{
		return;
	}
	var phone = field.val();
	var parentForm = $(field).closest('form');
	var tooltip = field.tooltip();
	var submitBtn = $(parentForm).find("input[type='submit']");
	$(parentForm).attr('state','proccess');
	
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("input[type='image']");
	}
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("button[type='submit']");
	}
	submitBtn.attr('disabled', 'true');
	
	if(phoneType == undefined)
	{
		phoneType = '';
	}
	if(is_mobile == true){
		var position = field.offset();
		var newtop = 0;
		var newleft = 0;
		newtop = position.top + field.outerHeight();
		newleft = position.left;
		tip = tooltip.getTip();
		tip.css({'left':newleft+'px','top':newtop+'px'});
	}
	if(checkPhoneSyntax(phone))
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_error_class);
		tip.addClass(tooltip_underprocess_class);
		if(is_mobile == true){
			field.css({'border':'inherit'});
			tip.html("Verifying...");
		}
		else
		{
			tip.html("Verifying... <img src='"+ loaderImagePath +"' style='vertical-align:middle'/>");
		}
	}
	else if($.trim(phone) == '')
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			field.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter phone number");
		}
		return;
	}
	else
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			field.css({'border':'2px solid #F00'});
			tip.html("Invalid Syntax");
		}
		else
		{
			tip.html("Invalid Phone Syntax");
		}
		return;
	}
	
	phoneServiceRequest(phone,tooltip,submitBtn,phoneType,parentForm,field);
}

/******************************************* Phone Change Handler Function ********************************/

/******************************************* IP Change Handler Function ********************************/
function ipVerifyChangeHandler(event){
	var $ = getJQueryInstance();
	var field = $(event.target);
	var serviceStatus = field.attr('service');
	if(serviceStatus == 0)
	{
		return;
	}
	var ip_value = field.val();
	var parentForm = this.form;
	var tooltip = field.tooltip();
	var submitBtn = $(parentForm).find("input[type='submit']");
	
	$(parentForm).attr('state','proccess');
	
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("input[type='image']");
	}
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("button[type='submit']");
	}
	submitBtn.attr('disabled', 'true');
	if(is_mobile == true){
		var position = field.offset();
		var newtop = 0;
		var newleft = 0;
		newtop = position.top + field.outerHeight() + 3;
		newleft = position.left;
		tip = tooltip.getTip();
		tip.css({'left':newleft+'px','top':newtop+'px'});
	}
	ipsyntaxvalue = checkIpVerifySyntax(ip_value);
	if(ipsyntaxvalue == true)
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_error_class);
		tip.addClass(tooltip_underprocess_class);
		if(is_mobile == true){
			field.css({'border':'inherit'});
			tip.html("Verifying...");
		}
		else
		{
			tip.html("Verifying... <img src='"+ loaderImagePath +"' style='vertical-align:middle'/>");
		}
	}
	else if($.trim(ip_value) == '')
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			field.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter ip address");
		}
		return;
	}
	else
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		tip.html(ipsyntaxvalue);
		if(is_mobile == true){
			field.css({'border':'2px solid #F00'});
		}
		return;
	}
	
	ipVerifyServiceRequest(ip_value,tooltip,submitBtn,parentForm ,field);
}
/******************************************* IP Change Handler Function ********************************/

/******************************************* Name Handler Function ********************************/
function nameToolTipBeforeShowHandler(event)
{
	var $ = getJQueryInstance();
	var tooltip = event.currentTarget;
	element = tooltip.getTrigger();
	var parentForm = $(element).closest('form');
	var firstNameElement = getFiledElementByForm(parentForm,'firstname');
	var lastNameElement = getFiledElementByForm(parentForm,'lastname');
	
	var firstname = firstNameElement.val();
	var lastname = lastNameElement.val();
	if( firstname == '' || lastname == '')
	{
		event.preventDefault();
		return;
	}
}
function lastNameChangeHandler(event)
{
	var $ = getJQueryInstance();
	var field = $(event.target);
	var parentForm = this.form;
	var firstNameElement = getFiledElementByForm(parentForm,'firstname');
	firstNameElement.trigger('change'); 
}
function firstNameChangeHandler(event){
	var $ = getJQueryInstance();
	var inputfield = $(event.target);
	var serviceStatus = inputfield.attr('service');
	if(serviceStatus == 0)
	{
		return;
	}
	var firstname = inputfield.val();
	var parentForm = this.form;
	var tooltip = inputfield.tooltip();
	var submitBtn = $(parentForm).find("input[type='submit']");
	var lastname ='';
	var lastNameElement = '';
	
	$(parentForm).attr('state','proccess');
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("input[type='image']");
	}
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("button[type='submit']");
	}
	submitBtn.attr('disabled', 'true');
	if(is_mobile == true){
		var position = inputfield.offset();
		var newtop = 0;
		var newleft = 0;
		newtop = position.top + inputfield.outerHeight() + 3;
		newleft = position.left;
		tip = tooltip.getTip();
		tip.css({'left':newleft+'px','top':newtop+'px'});
	}
	
	
	/***************************** Code For Require Fields ****************************************/
	if($.trim(firstname) != '')
	{
		lastNameElement = getFiledElementByForm(parentForm,'lastname');
		lastname = lastNameElement.val();
	}
	
	/***************************** Code For Require Fields ****************************************/
	if($.trim(firstname) == '')
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter first name");
		}
		return;
	}
	else if($.trim(lastname) == '')
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter last name");
		}
		return;
	}
	else
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_error_class);
		tip.addClass(tooltip_underprocess_class);
		if(is_mobile == true){
			inputfield.css({'border':'inherit'});
			tip.html("Verifying...");
		}
		else
		{
			tip.html("Verifying... <img src='"+ loaderImagePath +"' style='vertical-align:middle'/>");
		}
	}
	
	names = new Object();
	names.firstname = firstname;
	names.lastname = lastname;

	elements = new Object();
	elements.firstname = inputfield;
	elements.lastname = lastNameElement;
	elements.form = parentForm;

	nameVerifyServiceRequest(names,tooltip,submitBtn,elements );
}

/******************************************* Name Handler Function ********************************/


/******************************************* Address Handler Function ********************************/

function addressToolTipBeforeShowHandler(event)
{
	var $ = getJQueryInstance();
	var tooltip = event.currentTarget;
	element = tooltip.getTrigger();
	var parentForm = $(element).closest('form');
	var streetElement = getFiledElementByForm(parentForm,'street');
	var zipElement = getFiledElementByForm(parentForm,'zip');
	
	var street = streetElement.val();
	var zip = zipElement.val();
	if( street == '' || zip == '')
	{
		event.preventDefault();
		return;
	}
}

function addressOtherFieldChangeHandler(event)
{
	var $ = getJQueryInstance();
	var field = $(event.target);
	var parentForm = this.form;
	var streetElement = getFiledElementByForm(parentForm,'street');
	streetElement.trigger('change'); 
}

function streetChangeHandler(event){
	var $ = getJQueryInstance();
	var inputfield = $(event.target);
	var serviceStatus = inputfield.attr('service');
	if(serviceStatus == 0)
	{
		return;
	}
	var streetaddress = inputfield.val();
	var parentForm = this.form;
	var tooltip = inputfield.tooltip();
	var submitBtn = $(parentForm).find("input[type='submit']");
	var zipElement = '';
	var cityElement = '';
	var stateElement = '';

	var zipcode = '';
	var city = '';
	var state = '';
	if(is_mobile == true){
		var position = inputfield.offset();
		var newtop = 0;
		var newleft = 0;
		newtop = position.top + inputfield.outerHeight() + 3;
		newleft = position.left;
		tip = tooltip.getTip();
		tip.css({'left':newleft+'px','top':newtop+'px'});
	}

	$(parentForm).attr('state','proccess');
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("input[type='image']");
	}
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("button[type='submit']");
	}
	submitBtn.attr('disabled', 'true');
	
	zipElement = getFiledElementByForm(parentForm,'zip');
	zipcode = zipElement.val();
	
	cityElement = getFiledElementByForm(parentForm,'city');
	city = cityElement.val();
	
	stateElement = getFiledElementByForm(parentForm,'state');
	state = stateElement.val();
	
	/***************************** Code For Require Fields ****************************************/
	if($.trim(streetaddress) == '')
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.removeClass(tooltip_warning_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter street address");
		}
		return;
	}
	else if($.trim(zipcode) == '')
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.removeClass(tooltip_warning_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter zip code");
		}
		return;
	}
	else
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_error_class);
		tip.removeClass(tooltip_warning_class);
		tip.addClass(tooltip_underprocess_class);
		if(is_mobile == true){
			inputfield.css({'border':'inherit'});
			tip.html("Verifying...");
		}
		else
		{
			tip.html("Verifying... <img src='"+ loaderImagePath +"' style='vertical-align:middle'/>");
		}
	}
	
	address = new Object();
	address.street = streetaddress;
	address.zip = zipcode;
	address.city = city;
	address.state = state;

	elements = new Object();
	elements.street = inputfield;
	elements.zip = zipElement;
	elements.city = cityElement;
	elements.state = stateElement;
	elements.form = parentForm;

	addressVerifyServiceRequest(address,tooltip,submitBtn,elements );
}
/******************************************* Address Handler Function ********************************/

/*************************************** Multi Field Phone Change Handler  *****************************/
function multiPhoneToolTipBeforeShowHandler(event)
{
	var $ = getJQueryInstance();
	var tooltip = event.currentTarget;
	element = tooltip.getTrigger();
	var parentForm = $(element).closest('form');
	var phone_1_Element = getFiledElementByForm(parentForm,'multifield_phone_1');
	var phone_2_Element = getFiledElementByForm(parentForm,'multifield_phone_2');
	var phone_3_Element = getFiledElementByForm(parentForm,'multifield_phone_3');
	
	var phone_1 = phone_1_Element.val();
	var phone_2 = phone_2_Element.val();
	var phone_3 = phone_3_Element.val();
	
	if(phone_3 != '')
	{
	}
	else if( phone_1 == '' || phone_2 == '' || phone_3 == '')
	{
		event.preventDefault();
		return;
	}
}
function multiPhoneOtherFieldChangeHandler(event)
{
	var $ = getJQueryInstance();
	var field = $(event.target);
	var parentForm = this.form;
	var inputElement = getFiledElementByForm(parentForm,'multifield_phone_3');
	inputElement.trigger('change'); 
}

function multiPhoneChangeHandler(event){
	var $ = getJQueryInstance();
	var inputfield = $(event.target);
	var serviceStatus = inputfield.attr('service');
	if(serviceStatus == 0)
	{
		return;
	}
	var streetaddress = inputfield.val();
	var parentForm = this.form;
	var tooltip = inputfield.tooltip();
	var submitBtn = $(parentForm).find("input[type='submit']");
	var phone_1_Element = '';
	var phone_2_Element = '';
	var phone_3_Element = '';

	var phone_1 = '';
	var phone_2 = '';
	var phone_3 = '';

	$(parentForm).attr('state','proccess');
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("input[type='image']");
	}
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("button[type='submit']");
	}
	submitBtn.attr('disabled', 'true');
	
	phone_1_Element = getFiledElementByForm(parentForm,'multifield_phone_1');
	phone_1 = phone_1_Element.val();
	
	phone_2_Element = getFiledElementByForm(parentForm,'multifield_phone_2');
	phone_2 = phone_2_Element.val();
	
	phone_3_Element = getFiledElementByForm(parentForm,'multifield_phone_3');
	phone_3 = phone_3_Element.val();
	
	phone = phone_1 + phone_2 + phone_3;
	/***************************** Code For Require Fields ****************************************/
	if($.trim(phone_1) == '' || phone_1.length != 3)
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter valid phone number");
		}
		return;
	}
	else if($.trim(phone_2) == '' || phone_2.length != 3)
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter valid phone number");
		}
		return;
	}
	else if($.trim(phone_3) == '' || phone_3.length != 4)
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter valid phone number");
		}
		return;
	}
	else if(checkPhoneSyntax(phone))
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_error_class);
		tip.addClass(tooltip_underprocess_class);
		if(is_mobile == true){
			tip.html("Verifying...");
		}
		else
		{
			tip.html("Verifying... <img src='"+ loaderImagePath +"'  style='vertical-align:middle'/>");
		}
	}
	else
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("Invalid Syntax");
		}
		else
		{
			tip.html("Invalid Phone Syntax");
		}
		return;
	}
	
	
	phoneServiceRequest(phone,tooltip,submitBtn,'',parentForm,inputfield);
}
/*************************************** Multi Field Phone Change Handler  *****************************/


/*************************************** Multi Field Cell Change Handler  *****************************/
function multiCellPhoneToolTipBeforeShowHandler(event)
{
	var $ = getJQueryInstance();
	var tooltip = event.currentTarget;
	element = tooltip.getTrigger();
	var parentForm = $(element).closest('form');
	var phone_1_Element = getFiledElementByForm(parentForm,'multifield_cell_1');
	var phone_2_Element = getFiledElementByForm(parentForm,'multifield_cell_2');
	var phone_3_Element = getFiledElementByForm(parentForm,'multifield_cell_3');
	
	var phone_1 = phone_1_Element.val();
	var phone_2 = phone_2_Element.val();
	var phone_3 = phone_3_Element.val();
	
	if(phone_3 != '')
	{
	}
	else if( phone_1 == '' || phone_2 == '' || phone_3 == '')
	{
		event.preventDefault();
		return;
	}
}
function multiCellPhoneOtherFieldChangeHandler(event)
{
	var field = $(event.target);
	var parentForm = this.form;
	var inputElement = getFiledElementByForm(parentForm,'multifield_cell_3');
	inputElement.trigger('change'); 
}

function multiCellPhoneChangeHandler(event){
	var $ = getJQueryInstance();
	var inputfield = $(event.target);
	var serviceStatus = inputfield.attr('service');
	if(serviceStatus == 0)
	{
		return;
	}
	var streetaddress = inputfield.val();
	var parentForm = this.form;
	var tooltip = inputfield.tooltip();
	var submitBtn = $(parentForm).find("input[type='submit']");
	var phone_1_Element = '';
	var phone_2_Element = '';
	var phone_3_Element = '';

	var phone_1 = '';
	var phone_2 = '';
	var phone_3 = '';

	$(parentForm).attr('state','proccess');
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("input[type='image']");
	}
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("button[type='submit']");
	}
	submitBtn.attr('disabled', 'true');
	
	phone_1_Element = getFiledElementByForm(parentForm,'multifield_cell_1');
	phone_1 = phone_1_Element.val();
	
	phone_2_Element = getFiledElementByForm(parentForm,'multifield_cell_2');
	phone_2 = phone_2_Element.val();
	
	phone_3_Element = getFiledElementByForm(parentForm,'multifield_cell_3');
	phone_3 = phone_3_Element.val();
	
	phone = phone_1 + phone_2 + phone_3;
	/***************************** Code For Require Fields ****************************************/
	if($.trim(phone_1) == '' || phone_1.length != 3)
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter valid cell number");
		}
		return;
	}
	else if($.trim(phone_2) == '' || phone_2.length != 3)
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter valid cell number");
		}
		return;
	}
	else if($.trim(phone_3) == '' || phone_3.length != 4)
	{
		tip = tooltip.getTip();
		tip.removeClass("xverify_tooltip_underprocess");
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter valid cell number");
		}
		return;
	}
	else if(checkPhoneSyntax(phone))
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_error_class);
		tip.addClass("xverify_tooltip_underprocess");
		if(is_mobile == true){
			tip.html("Verifying...");
		}
		else
		{
			tip.html("Verifying... <img src='"+ loaderImagePath +"'  style='vertical-align:middle'/>");
		}
	}
	else
	{
		tip = tooltip.getTip();
		tip.removeClass("xverify_tooltip_underprocess");
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Invalid Cell Phone Syntax");
		}
		return;
	}
	
	
	phoneServiceRequest(phone,tooltip,submitBtn,'cell',parentForm,inputfield);
}
/*************************************** Multi Field Cell Change Handler  *****************************/

/*************************************** Multi Field Landline Change Handler  *****************************/
function multiLandlinePhoneToolTipBeforeShowHandler(event)
{
	var $ = getJQueryInstance();
	var tooltip = event.currentTarget;
	element = tooltip.getTrigger();
	var parentForm = $(element).closest('form');
	var phone_1_Element = getFiledElementByForm(parentForm,'multifield_landline_1');
	var phone_2_Element = getFiledElementByForm(parentForm,'multifield_landline_2');
	var phone_3_Element = getFiledElementByForm(parentForm,'multifield_landline_3');
	
	var phone_1 = phone_1_Element.val();
	var phone_2 = phone_2_Element.val();
	var phone_3 = phone_3_Element.val();
	
	if(phone_3 != '')
	{
	}
	else if( phone_1 == '' || phone_2 == '' || phone_3 == '')
	{
		event.preventDefault();
		return;
	}
}
function multiLandlinePhoneOtherFieldChangeHandler(event)
{
	var $ = getJQueryInstance();
	var field = $(event.target);
	var parentForm = this.form;
	var inputElement = getFiledElementByForm(parentForm,'multifield_landline_3');
	inputElement.trigger('change'); 
}

function multiLandlinePhoneChangeHandler(event){
	var $ = getJQueryInstance();
	var inputfield = $(event.target);
	var serviceStatus = inputfield.attr('service');
	if(serviceStatus == 0)
	{
		return;
	}
	var streetaddress = inputfield.val();
	var parentForm = this.form;
	var tooltip = inputfield.tooltip();
	var submitBtn = $(parentForm).find("input[type='submit']");
	var phone_1_Element = '';
	var phone_2_Element = '';
	var phone_3_Element = '';

	var phone_1 = '';
	var phone_2 = '';
	var phone_3 = '';

	$(parentForm).attr('state','proccess');
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("input[type='image']");
	}
	if(submitBtn.length == 0)
	{
		submitBtn = $(parentForm).find("button[type='submit']");
	}
	submitBtn.attr('disabled', 'true');
	
	phone_1_Element = getFiledElementByForm(parentForm,'multifield_landline_1');
	phone_1 = phone_1_Element.val();
	
	phone_2_Element = getFiledElementByForm(parentForm,'multifield_landline_2');
	phone_2 = phone_2_Element.val();
	
	phone_3_Element = getFiledElementByForm(parentForm,'multifield_landline_3');
	phone_3 = phone_3_Element.val();
	
	phone = phone_1 + phone_2 + phone_3;
	/***************************** Code For Require Fields ****************************************/
	if($.trim(phone_1) == '' || phone_1.length != 3)
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter valid landline number");
		}
		return;
	}
	else if($.trim(phone_2) == '' || phone_2.length != 3)
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter valid landline number");
		}
		return;
	}
	else if($.trim(phone_3) == '' || phone_3.length != 4)
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("input required");
		}
		else
		{
			tip.html("Please enter valid landline number");
		}
		return;
	}
	else if(checkPhoneSyntax(phone))
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_error_class);
		tip.addClass(tooltip_underprocess_class);
		if(is_mobile == true){
			tip.html("Verifying...");
		}
		else
		{
			tip.html("Verifying... <img src='"+ loaderImagePath +"' style='vertical-align:middle'/>");
		}
	}
	else
	{
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			inputfield.css({'border':'2px solid #F00'});
			tip.html("Invalid Syntax");
		}
		else
		{
			tip.html("Invalid Landline Phone Syntax");
		}
		return;
	}
	
	
	phoneServiceRequest(phone,tooltip,submitBtn,'landline',parentForm,inputfield);
}
/*************************************** Multi Field Phone Change Handler  *****************************/


/****************************************** Field Tooltip Bind Function ************************************/
function bindToolTipOnInputElements(inputFields, options){
	var $ = getJQueryInstance();
	var cur_div_opc = 0.7;
	if(options == null){
		options = {message_position : "center left"};
	}
	if(is_mobile == true)
	{
		options = {message_position : "bottom center"};
		cur_div_opc = 1;
	}
	var date = new Date();
	var serviceStatus = '';
	milisec =  date.getTime();
	for (var i = 0; i < inputFields.length; i++)
	{
		field = $(inputFields[i]);
		currentTitle = field.attr('title');
		serviceStatus = field.attr('service');	
		
		if(serviceStatus == 0)
		{
			continue;
		}
		milisec =  date.getTime();
		divid =  'div_' + milisec + i + '_loadingmsg';
		addToolTipDiv(divid);
		
		field.tooltip({
			position: options.message_position,
			offset: [-2, 10],
			effect: "fade",
			opacity: cur_div_opc,
			tip: '#' + divid,
			events: { input: "change, focus" },
			onBeforeHide: toolTipOnBeforeHideHandler
		});
		
		if(currentTitle!=undefined)
		{
			field.attr('title',currentTitle);
		}
	}
}

function bindToolTipOnMultiInputElements(inputFields, options,toolTipShowHandler){
	var $ = getJQueryInstance();
	if(options == null){
		options = {message_position : "center right"};
	}
	var date = new Date();
	var serviceStatus = '';
	milisec =  date.getTime();
	
	for (var i = 0; i < inputFields.length; i++)
	{
		field = $(inputFields[i]);
		serviceStatus = field.attr('service');	
		if(serviceStatus == 0)
		{
			continue;
		}
		
		milisec =  date.getTime();
		divid =  'div_' + milisec + i + '_loadingmsg';
		addToolTipDiv(divid);
		
		field.tooltip({
			// place tooltip on the right edge
			position: options.message_position,
			// a little tweaking of the position
			offset: [-2, 10],
			// use the built-in fadeIn/fadeOut effect
			effect: "fade",
			// custom opacity setting
			opacity: 0.7,
			tip: '#' + divid,
			events: { input: "change, focus" },
			onBeforeHide: toolTipOnBeforeHideHandler,
			onBeforeShow: toolTipShowHandler
		});
	}
}
function toolTipOnBeforeHideHandler(event)
{
	var $ = getJQueryInstance();
	var tooltip = event.currentTarget;
	element = tooltip.getTrigger();
	var parentForm = $(element).closest('form');
	if($(parentForm).attr('state') == 'proccess')
	{
		event.preventDefault();
	}
}
function addToolTipDiv(divid){
	var $ = getJQueryInstance();
	var loading_div = "<div class='"+tooltip_underprocess_class+"' id='"+divid+"'></div>";
	$("body").prepend(loading_div);
}
/****************************************** Field Change Handler Function ************************************/

/*********************************************************** Syntax Check functions **********************************************/
function checkEmailSyntax(str){
	if(isGmailAddress(str) == true)
	{
		str = removePlusFromEmailAddress(str);
	}
	 reEmail = new RegExp(/^([a-zA-Z0-9])+([a-zA-Z0-9\+._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/);
	 if (!reEmail.test(str)) {
	  return false;
	}
	 return true
}
function removePlusFromEmailAddress(Email)
{
	var domain = Email.substring(Email.lastIndexOf('@')+1, Email.length);
	var emailHandle = Email.substring(0,Email.lastIndexOf('+'));
	if(emailHandle != '')
	{
		Email = emailHandle + '@' + domain ;
	}	
	return Email;
}
function isGmailAddress(str)
{
	if(getDomainFromEmail(str) == 'gmail')
		return true;
	else
		return false;	
}

function getDomainFromEmail(Email){
	var atsign = Email.substring(Email.lastIndexOf('@')+1, Email.length);
	atsign = atsign.substring(0,atsign.lastIndexOf('.'));
    atsign.toLowerCase();
	return atsign;
}

function getDomainNameFromEmail(Email){
	var atsign = Email.substring(Email.lastIndexOf('@')+1, Email.length);
    atsign.toLowerCase();
	return atsign;
}
	
function checkPhoneSyntax(str){
	if(str.length < 10){
	   return false
	}
	
	rePhoneNumber = new RegExp(/^[1-9]\d{3}\d{3}\d{4}$/);
	phoneNumberPattern = new RegExp(/^\d{3}[- ]?\d{3}[- ]?\d{4}$/);
	if (rePhoneNumber.test(str) || phoneNumberPattern.test(str)) {
	  return true;
	}
	return false;
}

function checkIpVerifySyntax (IPvalue) {
	errorString = "";
	theName = "IPaddress";
	var ipPattern = /^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/;
	var ipArray = IPvalue.match(ipPattern);
	if (IPvalue == "0.0.0.0")
		errorString = errorString + theName + ': '+IPvalue+' is a special IP address and cannot be used here.';
	else if (IPvalue == "255.255.255.255")
		errorString = errorString + theName + ': '+IPvalue+' is a special IP address and cannot be used here.';
	if (ipArray == null)
		errorString = errorString + theName + ': '+IPvalue+' is not a valid IP address.';
	else 
	{
		for (i = 0; i < 4; i++) {
			thisSegment = ipArray[i];
			if (thisSegment > 255) {
				errorString = errorString + theName + ': '+IPvalue+' is not a valid IP address.';
				i = 4;
			}
			if ((i == 0) && (thisSegment > 255)) {
				errorString = errorString + theName + ': '+IPvalue+' is a special IP address and cannot be used here.';
				i = 4;
			}
		}
	}
	extensionLength = 3;
	if (errorString == "")
		return true;
	else
		return errorString;
}


function checkNameField(first,last){
	var $ = getJQueryInstance();
	first = $.trim( first );
	last = $.trim( last );
	if(first == '' || last == '' )
	{
	   return false
	}
	
	return true	
}
/*********************************************************** Syntax Check functions **********************************************/


/************************************************************* Service Timeout functions ******************************************/
function emailServiceTimeOut(tooltip,submitBtn,parentForm){
	if(emailcallstatus == true)
	{
		var $ = getJQueryInstance();
		myElementArray[tooltip.getConf('tip').tip] = 0;
		submitBtn.removeAttr('disabled');
		$(parentForm).removeAttr('state');
		tooltip.hide();
	}
}

function phoneServiceTimeOut(tooltip,submitBtn,parentForm){
	if(phonecallstatus == true)
	{
		var $ = getJQueryInstance();
		myElementArray[tooltip.getConf('tip').tip] = 0;
		submitBtn.removeAttr('disabled');
		$(parentForm).removeAttr('state');
		tooltip.hide();
	}
}

function nameServiceTimeOut(tooltip,submitBtn,fieldElements){
	if(namecallstatus == true)
	{
		var $ = getJQueryInstance();
		myElementArray[tooltip.getConf('tip').tip] = 0;
		submitBtn.removeAttr('disabled');
		var parentForm = fieldElements.form;
		$(parentForm).removeAttr('state');
		tooltip.hide();
	}
}
	
	
function ipServiceTimeOut(tooltip,submitBtn,parentForm){
	
	if(ipcallstatus == true)
	{
		var $ = getJQueryInstance();
		myElementArray[tooltip.getConf('tip').tip] = 0;
		submitBtn.removeAttr('disabled');
		$(parentForm).removeAttr('state');
		tooltip.hide();
	}
}

function addressServiceTimeOut(tooltip,submitBtn,fieldElements){	
	if(addresscallstatus  == true)
	{
		var $ = getJQueryInstance();
		myElementArray[tooltip.getConf('tip').tip] = 0;
		submitBtn.removeAttr('disabled');
		var parentForm = fieldElements.form;
		$(parentForm).removeAttr('state');
		tooltip.hide();
	}
}
/************************************************************* Service Timeout functions ******************************************/

/************************************************************* Service Request functions ******************************************/
function emailServiceRequest(email,tooltip,button,parentForm,field,autocorrect) {
	var $ = getJQueryInstance();
	var url = serverURL + "emails/verify/?type=json&apikey="+ apiKey + "&domain="+ domainname +"&v1="+ affiliateid +"&v2="+ subaffiliateid + "&";
	
	url = url + "captcha_status=" + service_captcha["email"] + "&"	
	extrastring = getPostBackData(parentForm);
	if(extrastring != '')
	{
		url = url + extrastring;
	}
	url = url + "callback=?";
	if(autocorrect == undefined)
		autocorrect = 0;
	else
		autocorrect = 1;
	emailcallstatus = true;
	emailtimeOut = setTimeout(function() {emailServiceTimeOut(tooltip,button,parentForm);}, emailtimeout); 
	$.getJSON(
			  url, {"email" : email,"autocorrect":autocorrect},
			  function(json){
				emailcallstatus = false;  
				clearTimeout (emailtimeOut);
				var service_email = json["email"];	
				emailSuccessResponseHandler(service_email,tooltip,button,parentForm,field);
	});
}


function phoneServiceRequest(phone,tooltip,button,phoneType,parentForm,field) {
	var $ = getJQueryInstance();
	var url = serverURL + "phone/verify/?type=json&apikey="+ apiKey + "&domain="+ domainname + "&v1="+ affiliateid +"&v2="+ subaffiliateid + "&phonetype="+ phoneType +"&";
	url = url + "captcha_status=" + service_captcha["phone"] + "&"		
	extrastring = getPostBackData(parentForm);
	if(extrastring != '')
	{
		url = url + extrastring;
	}
	url = url + "callback=?";
	
	phonecallstatus = true;
	phonetimeOut = setTimeout(function() {phoneServiceTimeOut(tooltip,button,parentForm);}, phonetimeout); 
	$.getJSON(
			  url, {"phone" : phone},
			  function(json){
				phonecallstatus = false;  
				clearTimeout (phonetimeOut);
				var service_phone = json["phone"];	
				phoneSuccessResponseHandler(service_phone,tooltip,button,parentForm,field);
	});
}

function addressVerifyServiceRequest(address,tooltip,button,fieldElements) {
	var $ = getJQueryInstance();
	var url = serverURL + "address/verify/?type=json&apikey="+ apiKey + "&domain="+ domainname + "&v1="+ affiliateid +"&v2="+ subaffiliateid + "&";
	url = url + "captcha_status=" + service_captcha["address"] + "&"		
	extrastring = getPostBackData(fieldElements.form);
	if(extrastring != '')
	{
		url = url + extrastring;
	}
	url = url + "callback=?";
	
	addresscallstatus = true;
	addresstimeOut = setTimeout(function() {addressServiceTimeOut(tooltip,button,fieldElements);}, addresstimeout); 
	var address_param = {"street" : address.street, "zip" : address.zip, "city" : address.city, "state" : address.state};
	$.getJSON(
			   url, address_param, 
			  function(json){
				addresscallstatus = false;  
				clearTimeout (addresstimeOut);
				var service_address = json["address"];	
				addressSuccessResponseHandler(service_address,tooltip,button,fieldElements);
	});
}

function ipVerifyServiceRequest(ip,tooltip,button,parentForm,field) {
	var $ = getJQueryInstance();
	var url = serverURL + "ipdata/verify/?type=json&apikey="+ apiKey + "&domain="+ domainname + "&v1="+ affiliateid +"&v2="+ subaffiliateid +"&";
	url = url + "captcha_status=" + service_captcha["ip"] + "&"		
	extrastring = getPostBackData(parentForm);
	if(extrastring != '')
	{
		url = url + extrastring;
	}
	url = url + "callback=?";
	ipcallstatus = true;
	iptimeOut = setTimeout(function() {ipServiceTimeOut(tooltip,button,parentForm);}, iptimeout); 
	$.getJSON(
			   url, {"ip" : ip}, 
			  function(json){
				ipcallstatus = false;  
				clearTimeout (iptimeOut);
				var service_ip = json["ipdata"];	
				ipSuccessResponseHandler(service_ip,tooltip,button,parentForm,field);
	});
}

function nameVerifyServiceRequest(names,tooltip,button,fieldElements) {
	var $ = getJQueryInstance();
	var url = serverURL + "name/verify/?type=json&apikey="+ apiKey + "&domain="+ domainname + "&v1="+ affiliateid +"&v2="+ subaffiliateid + "&";
	url = url + "captcha_status=" + service_captcha["name"] + "&"		
	extrastring = getPostBackData(fieldElements.form);
	if(extrastring != '')
	{
		url = url + extrastring;
	}
	url = url + "callback=?";
	
	namecallstatus = true;
	nametimeOut = setTimeout(function() {nameServiceTimeOut(tooltip,button,fieldElements);}, nametimeout); 
	var name_param = {"firstname" : names.firstname, "lastname" : names.lastname};
	$.getJSON(
			   url, name_param, 
			  function(json){
				namecallstatus = false;  
				clearTimeout (nametimeOut);
				var service_name = json["name"];	
				nameSuccessResponseHandler(service_name,tooltip,button,fieldElements);
	});
}

/************************************************************* Service Request functions ******************************************/

/************************************************************* Service Success Response Handler functions ******************************************/

function emailSuccessResponseHandler(ajaxResponse,tooltip,submitBtn,parentForm,field ){
	var $ = getJQueryInstance();
	if(ajaxResponse.error){
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);		
		if(ajaxResponse.status == 'correction')
		{
			tip.addClass(tooltip_warning_class);
			user_email = ajaxResponse.user_email;
			correct_email = ajaxResponse.correct_email;
			xverifySuggestEmail(user_email,correct_email,tooltip,submitBtn,parentForm,field);
			return;
		}
		tip.addClass(tooltip_error_class);
		if(is_mobile == true){
			tip.html("Invalid");
			field.css({'border':'2px solid #F00'});
		}
		else
		{
			tip.html(ajaxResponse.message);
		}
		if(ajaxResponse.status == 'pending')
		{
			showRecaptcha(showCaptchaDiv,reCaptchaKey,'email',field);
		}
		else
		{
			service_captcha["email"] = 0;
		}
	}
	else
	{
		service_captcha["email"] = 0;
		myElementArray[tooltip.getConf('tip').tip] = 0;
		$(parentForm).removeAttr('state');
		submitBtn.removeAttr('disabled');		
		tooltip.getTrigger().val(ajaxResponse.address);
		tooltip.hide();
	}
	if(ajaxResponse.call_function != undefined && jQuery.trim(ajaxResponse.call_function) != '' )
	{
		functionstatus  = $.isFunction(window[ajaxResponse.call_function]);
		if(functionstatus)
		{
			var callbackfunction_args = []
			callbackfunction_args.status = ajaxResponse.status;
			callbackfunction_args.responsecode = ajaxResponse.responsecode;
			window[ajaxResponse.call_function](callbackfunction_args);
		}
	}
	formButtonCheckHandler(tooltip,submitBtn,parentForm);
	//field.removeAttr('disabled');
}

function phoneSuccessResponseHandler(ajaxResponse,tooltip,submitBtn,parentForm,field){
	var $ = getJQueryInstance();
	if(ajaxResponse.error){
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		tip.html(ajaxResponse.message);
		if(is_mobile == true){
			field.css({'border':'2px solid #F00'});
		}
		if(ajaxResponse.status == 'pending')
		{
			showRecaptcha(showCaptchaDiv,reCaptchaKey,'phone',field);
		}
		else
		{
			service_captcha["phone"] = 0;
		}
	}
	else
	{
		service_captcha["phone"] = 0;
		myElementArray[tooltip.getConf('tip').tip] = 0;
		submitBtn.removeAttr('disabled');
		$(parentForm).removeAttr('state');
		tooltip.hide();
	}
	if(ajaxResponse.call_function != undefined && jQuery.trim(ajaxResponse.call_function) != '' )
	{
		functionstatus  = $.isFunction(window[ajaxResponse.call_function]);
		if(functionstatus)
		{
			var callbackfunction_args = []
			callbackfunction_args.status = ajaxResponse.status;
			window[ajaxResponse.call_function](callbackfunction_args);
		}
	}
	formButtonCheckHandler(tooltip,submitBtn,parentForm);
}


function ipSuccessResponseHandler(ajaxResponse,tooltip,submitBtn,parentForm,field ){
	var $ = getJQueryInstance();
	if(ajaxResponse.error){
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		tip.html(ajaxResponse.message);
		if(is_mobile == true){
			field.css({'border':'2px solid #F00'});
		}
		if(ajaxResponse.status == 'pending')
		{
			showRecaptcha(showCaptchaDiv,reCaptchaKey,'ip',field);
		}
		else
		{
			service_captcha["ip"] = 0;
		}
	}
	else
	{
		service_captcha["ip"] = 0;
		myElementArray[tooltip.getConf('tip').tip] = 0;
		submitBtn.removeAttr('disabled');
		$(parentForm).removeAttr('state');
		tooltip.hide();
	}
	formButtonCheckHandler(tooltip,submitBtn,parentForm);
}

function nameSuccessResponseHandler(ajaxResponse,tooltip,submitBtn,fieldElements ){
	var $ = getJQueryInstance();
	if(ajaxResponse.error){
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.addClass(tooltip_error_class);
		tip.html(ajaxResponse.message);
		var firstNameElement = fieldElements.firstname;
		if(is_mobile == true){
			firstNameElement.css({'border':'2px solid #F00'});
		}
		if(ajaxResponse.status == 'pending')
		{
			showRecaptcha(showCaptchaDiv,reCaptchaKey,'name',firstNameElement);
		}
		else
		{
			service_captcha["name"] = 0;
		}
		
	}
	else
	{
		service_captcha["name"] = 0;
		myElementArray[tooltip.getConf('tip').tip] = 0;
		var firstNameElement = fieldElements.firstname;
		var lastNameElement = fieldElements.lastname;
		var parentForm = fieldElements.form;
		firstNameElement.val(ajaxResponse.first);
		lastNameElement.val(ajaxResponse.last);
		submitBtn.removeAttr('disabled');
		$(parentForm).removeAttr('state');
		tooltip.hide();
	}
	formButtonCheckHandler(tooltip,submitBtn,parentForm);
}

function addressSuccessResponseHandler(ajaxResponse,tooltip,submitBtn,fieldElements ){
	var $ = getJQueryInstance();
	if(ajaxResponse.error){
		tip = tooltip.getTip();
		tip.removeClass(tooltip_underprocess_class);
		tip.removeClass(tooltip_warning_class);
		tip.addClass(tooltip_error_class);
		tip.html(ajaxResponse.message);
		var streetElement = fieldElements.street;
		if(is_mobile == true)
		{
			streetElement.css({'border':'2px solid #F00'});
		}
		if(ajaxResponse.status == 'pending')
		{
			showRecaptcha(showCaptchaDiv,reCaptchaKey,'address',streetElement);
		}
		else
		{
			service_captcha["address"] = 0;
		}
	}
	else
	{
		myElementArray[tooltip.getConf('tip').tip] = 0;
		var streetElement = fieldElements.street;
		var zipElement = fieldElements.zip;
		var cityElement = fieldElements.city;
		var stateElement = fieldElements.state;
		var parentForm = fieldElements.form;
		service_captcha["address"] = 0;
		if(cityElement.length > 0) cityElement.val(ajaxResponse.city);
		if(stateElement.length > 0) stateElement.val(ajaxResponse.state);
		
		streetElement.val(ajaxResponse.street);
		zipElement.val(ajaxResponse.zip);
		
		submitBtn.removeAttr('disabled');
		$(parentForm).removeAttr('state');
		if(ajaxResponse.response_code != 9)
		{
			tooltip.hide();
		}
		else
		{
			tip = tooltip.getTip();
			tip.removeClass(tooltip_underprocess_class);
			tip.removeClass(tooltip_error_class);
			tip.addClass(tooltip_warning_class);
			tip.html(ajaxResponse.message);
		}
	}
	if(ajaxResponse.call_function != undefined && jQuery.trim(ajaxResponse.call_function) != '' )
	{
		functionstatus  = $.isFunction(window[ajaxResponse.call_function]);
		if(functionstatus)
		{
			var callbackfunction_args = []
			callbackfunction_args.status = ajaxResponse.status;
			window[ajaxResponse.call_function](callbackfunction_args);
		}
	}
	formButtonCheckHandler(tooltip,submitBtn,parentForm);
}

/************************************************************* Service Success Response Handler functions ******************************************/


/************************************************************* Service Response Handler functions ******************************************/

/************************************************************* Service Response Handler functions ******************************************/

function getPostBackData(form)
{
	var $ = getJQueryInstance();
	var returnString = '';
	fieldclass = 'xverify_postback';
	fieldElement = getInputElementsByAttributeFromSpecficForms('class',fieldclass,form)
	for (var i = 0; i < fieldElement.length; i++)
	{
		field = $(fieldElement[i]);
		name = field.attr('name');	
		value = field.attr('value');
		returnString = returnString + 'postback[' +  	name + ']=' + value + '&';
	}
	return returnString;
}
function getJQueryInstance(){
	if(jquerynoconflictinstance == true)
	{
		return jQuery.noConflict();
	}
	else
	{
		return $;
	}
}