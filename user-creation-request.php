<?php
	$u = new utils();
	$s_name = $u->stalker('fullname');
	$s_email = $u->stalker('email');
	$s_phone = $u->stalker('phone');
?>

<div id="content">

<script type="text/javascript" src="<?=TEMPLATE_URL_BASE?>/lib/zebra-datepicker.1.6.7/public/javascript/zebra_datepicker.js"></script>
<link rel="stylesheet" href="<?=TEMPLATE_URL_BASE?>/lib/zebra-datepicker.1.6.7/public/css/zebra_datepicker.css" type="text/css">
<script type="text/javascript">
$(document).ready(function() {
  $('#Start-Date').Zebra_DatePicker({
		format: 'Y-m-d',
		direction:0,
		readonly_element: false,
		show_icon: false
		});
    $('#End-Date').Zebra_DatePicker({
		format: 'Y-m-d',
		direction:0,
		readonly_element: false,
		show_icon: false
		});
});
$(document).ready(function() {
	$('#Colleague-Access-1, #Email-Account-0').attr('checked', true);
	$('#security-class-cg').hide();
	$("input[name='Colleague-Access']").click(function() {
		if($('#Colleague-Access-0').is(":checked"))
		{
			$("#security-class-cg").show();
		}
		else
		{
			$("#security-class-cg").hide();
		}
	});

});
</script>

<h1>New User Account • Service Requests • ITS</h1>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/departments/its/_include/nav.php');?>

<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/_include/form-validator.php');
$fv = new FormValidator(); //create Form Validator Object

  if ($fv->isPosted()){ 
	$fv->validateRequired("First-Name", "First Name is required.");
	$fv->validateRequired("Last-Name", "Last Name is required.");
	$fv->validateRequired("Camosun-ID", "Camosun ID is required.");
	$fv->validateRequired("Division", "Division is required.");	
	$fv->validateRequired("Department", "Department is required.");
	$fv->validateRequired("Manager-Supervisor", "Manager/Supervisor is required.");
	$fv->validateRequired("Start-Date", "Start Date is required.");
		if(!isset($s_email) || !isset($s_name)){
		$fv->validateRequired("Requestor-Name", "Your name is required.");
		$fv->validateRequired("Email-Address", "Your email address is required.");
		}
	//$fv->validateRequired("End-Date", "End Date is required.");
	//$fv->validateRequired("Email-Account", "Email Account is required.");
	//$fv->validateRequired("Shared-Mailboxes", "Shared Mailboxes is required.");
	//$fv->validateRequired("Shared-Drives", "Shared Drives is required.");
	//$fv->validateRequired("Colleague-Access", "Colleague Access is required.");
	//$fv->validateRequired("Security-Class", "Security Class is required.");
	//$fv->validateRequired("Mirror-Access-to-User", "Mirror Access to User is required.");
	//$fv->validateRequired("Other-Notes", "Other Notes is required.");
	//$fv->validateRecaptcha("recaptcha_response_field", "recaptcha_challenge_field", "reCAPTCHA is incorrect."); 
	//$fv->validateNocaptcha("g-recaptcha-response", "reCAPTCHA is incorrect."); 
  }
?>           
<?php 
if ( !($fv->isPosted()) || $fv->errorExists() ){ //OPENING of SUBMIT CLICKED but VALIDATION or OTHER ERROR OCCURED
//server side error display in list
	if ($fv->errorExists()){
		$errors = $fv->getErrorList();
		echo ('<div class="row"><div class="span6"><div class="alert alert-danger"><h3>Form submission contains the following errors...</h3><ul class="phpFormError">');
		foreach ($errors as $e){
			echo ('<li>'.$e['message'].'</li>');
		}   
	echo ('</ul></div></div></div>');
	}
?>
<div class="alert alert-block alert-info">
	<h4>Instructions</h4>
	<p>A summary page will be displayed after you submit this form. Please save a copy of the summary for your records. You will also receive a copy of this form via email at <strong><?=$s_email?></strong>. If you
		have not received this email within <strong>30 minutes</strong> of submitting the form, please email a copy of the summary page to the ITS Service Desk at <a href="mailto:itsservicedesk@camosun.bc.ca">itsservicedesk@camosun.bc.ca</a>.</p>
</div>
<form class="form-horizontal bootstrap" id="User-Create" method="post" action="<?=$_SERVER['PHP_SELF']?>">
<fieldset>

<!-- Form Name -->
<legend>Employee Information</legend>
<p>* = Required</p>

<!-- Text input-->
	<div class="control-group">
	<label class="control-label">First Name<sup>*</sup></label>
	<div class="controls">
    <input id="First-Name" name="First-Name" type="text" class="span4" value="<?php  $fv->repopulateText('First-Name'); ?>">
	</div>
</div>

<!-- Text input-->
	<div class="control-group">
	<label class="control-label">Last Name<sup>*</sup></label>
	<div class="controls">
    <input id="Last-Name" name="Last-Name" type="text" class="span4" value="<?php  $fv->repopulateText('Last-Name'); ?>">
	</div>
</div>

<!-- Text input-->
	<div class="control-group">
	<label class="control-label">Camosun ID<sup>*</sup></label>
	<div class="controls">
	<input id="Camosun-ID" name="Camosun-ID" type="text" class="input-small" value="<?php  $fv->repopulateText('Camosun-ID'); ?>" placeholder="C0123456" maxlength="8">
	</div>
</div>

<!-- Text input-->
	<div class="control-group">
	<label class="control-label">Division<sup>*</sup></label>
	<div class="controls">
    <input id="Division" name="Division" type="text" class="span6" value="<?php  $fv->repopulateText('Division'); ?>">
	</div>
</div>

<!-- Text input-->
	<div class="control-group">
	<label class="control-label">Department<sup>*</sup></label>
	<div class="controls">
    <input id="Department" name="Department" type="text" class="span6" value="<?php  $fv->repopulateText('Department'); ?>">
	</div>
</div>

	
<!-- Text input-->
	<div class="control-group">
	<label class="control-label">Manager/Supervisor<sup>*</sup></label>
	<div class="controls">
    <input id="Manager-Supervisor" name="Manager-Supervisor" type="text" class="span4" value="<?php  $fv->repopulateText('Manager-Supervisor'); ?>">
	</div>
</div>

<!-- Text input-->
	<div class="control-group">
	<label class="control-label">Start Date<sup>*</sup></label>
	<div class="controls">
    <input id="Start-Date" name="Start-Date" type="text" class="input-small" placeholder="YYYY-MM-DD" value="<?php  $fv->repopulateText('Start-Date'); ?>">
	</div>
</div>

<!-- Text input-->
	<div class="control-group">
	<label class="control-label">End Date</label>
	<div class="controls">
    <input id="End-Date" name="End-Date" type="text" class="input-small" placeholder="YYYY-MM-DD" value="<?php $fv->repopulateText('End-Date'); ?>">
	</div>
</div>
</fieldset>

<fieldset>

<legend>Account Settings</legend>

<!-- Multiple Radios -->
	<div class="control-group">
	<label class="control-label">Email Account</label>
	<div class="controls">
    <label class="radio" for="Email-Account-0">
	<input type="radio" name="Email-Account" id="Email-Account-0" value="Yes" <?php $fv->repopulateCheckbox('Email-Account', 'Yes'); ?>>
	Yes
    </label>
    <label class="radio" for="Email-Account-1">
	<input type="radio" name="Email-Account" id="Email-Account-1" value="No" <?php $fv->repopulateCheckbox('Email-Account', 'No'); ?>>
	No
    </label>
	</div>
</div>

<!-- Textarea -->
	<div class="control-group">
	<label class="control-label">Shared Mailboxes</label>
	<div class="controls">
    <textarea id="Shared-Mailboxes" name="Shared-Mailboxes" class="span4" rows="6"><?php  $fv->repopulateText('Shared-Mailboxes'); ?></textarea>
	<div class="help-block"><p class="muted">List shared mailboxes one per line.</p></div>
	</div>

</div>

<!-- Textarea -->
	<div class="control-group">
	<label class="control-label">Shared Drives</label>
	<div class="controls">
    <textarea id="Shared-Drives" name="Shared-Drives" class="span4" rows="6"><?php  $fv->repopulateText('Shared-Drives'); ?></textarea>
	<div class="help-block"><p class="muted">List shared drives one per line.</p></div>
	</div>
</div>
	
<!-- Multiple Radios -->
	<div class="control-group">
	<label class="control-label">Colleague Access</label>
	<div class="controls">
    <label class="radio" for="Colleague-Access-0">
	<input type="radio" name="Colleague-Access" id="Colleague-Access-0" value="Yes" <?php $fv->repopulateCheckbox('Colleague-Access', 'Yes'); ?>>
	Yes
    </label>
    <label class="radio" for="Colleague-Access-1">
	<input type="radio" name="Colleague-Access" id="Colleague-Access-1" value="No" <?php $fv->repopulateCheckbox('Colleague-Access', 'No'); ?>>
	No
    </label>
	</div>
</div>
	
<!-- Text input-->
	<div class="control-group" id="security-class-cg">
	<label class="control-label">Security Class</label>
	<div class="controls">
    <input id="Security-Class" name="Security-Class" type="text" class="span4" value="<?php $fv->repopulateText('Security-Class'); ?>">
	<p class="help-block"><span class="label label-warning">Help</span> <span class="muted">Enter a Colleague security class. If unknown, enter the Camosun ID of a user to mirror Colleague access from.</span></p>
	</div>
</div>

<!-- Textarea -->
	<div class="control-group">
	<label class="control-label">Other Notes</label>
	<div class="controls">
    <textarea id="Other-Notes" name="Other-Notes" class="span6" rows="6"><?php $fv->repopulateText('Other-Notes'); ?></textarea>
	</div>
</div>

<fieldset id="contact_info" class="">
	<legend>Contact Info</legend>
	<p>The following contact information will be sent along with this request.</p>

<!-- custom php code -->
<?php if(isset($s_email)){ ?>
	<dl class="dl-horizontal">
		<dt>Submitted by:</dt>
		<dd><?=(isset($s_name)) ? $s_name : 'Unknown'?></dd>
		<dt>Email:</dt>
		<dd><?=(isset($s_email)) ? $s_email : 'Unknown'?></dd>
		<dt>Phone:</dt>
		<dd><?=(isset($s_phone)) ? $s_phone : 'Unknown'?></dd>
	</dl>
	<input type="hidden" name="Submitter-Name"  value="<?=(isset($s_name)) ? $s_name : 'Unknown'?>" id="Submitter-Name">
	<input type="hidden" name="Submitter-Email" value="<?=(isset($s_email)) ? $s_email : 'Unknown'?>" id="Submitter-Email">
	<input type="hidden" name="Submitter-Phone" value="<?=(isset($s_phone)) ? $s_phone : 'Unknown'?>" id="Submitter-Phone">

<?php } else {
	
?>
	<div class="control-group">
	<label class="control-label">Name<sup>*</sup></label>
	<div class="controls">
	<input id="Requestor-Name" name="Requestor-Name" type="text" class="span4" value="<?php  $fv->repopulateText('Requestor-Name'); ?>" >
	</div>
</div>

	<!-- Text input-->
	<div class="control-group">
	<label class="control-label">Email Address<sup>*</sup></label>
	<div class="controls">
	<input id="Email-Address" name="Email-Address" type="text" class="span4" value="<?php  $fv->repopulateText('Email-Address'); ?>">
	</div>
</div>

<?php }
	
?>
</fieldset>

	
</fieldset>
<div class="form-actions">
    <input id="Submit" name="sendit" type="submit" class="btn" value="Submit">
</div>

<?php 
} //CLOSING of SUBMIT CLICKED but VALIDATION or OTHER ERRORS OCCURED 
//BEGIN actual processing of form and inputs
else {
	//error_reporting(1);
require_once($_SERVER['DOCUMENT_ROOT'].'/_include/class.form_compiler.php');
$data = new FormCompiler();
$newArray = $data->flattenPost($_POST);
$hide = array("sendit");
$data->setHidden($hide);
$HTMLbody = $data->createHTMLTable($newArray, "29%" ); //
$HTMLbody = $data->addHeaders(array(0 => "User Details", 'Email Account'=>'User Settings', 'Requestor Name' => 'Requestor Information'), $HTMLbody);
$HTMLbody = str_replace("_full<", "<", $HTMLbody); //raw manipulation to fix arrays

//Variable Array => "First-Name", "Last-Name", "Camosun-ID", "Department", "Manager-Supervisor", "Start-Date", "End-Date", "Email-Account", "Email-Account", "Shared-Mailboxes", "Shared-Drives", "Colleague-Access", "Colleague-Access", "Security-Class", "Mirror-Access-to-User", "sendit", "Other-Notes"

//require_once($_SERVER['DOCUMENT_ROOT'].'/_include/mailer/class.phpmailer.php');
	$mailer = new phpmailer();
	//$mailer->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/images/logos/logo_camosun_150x77.png', 'logo', 'logo_camosun_150x77.png'); 
   	$mailer->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/_images/camosun-logo-white.png', 'logowhite', 'logowhite_camosun_179x70.png');
    //Style the HTML email being sent

	$subjecttype= "User Creation Request: ".$fv->getValue('First-Name')." ".$fv->getValue('Last-Name')." ".$fv->getValue('Camosun-ID'); //Subject of Email sent
    $fullEmail = $data->getHead("User Creation Request Form").$HTMLbody.$data->getFoot();  //Combine the Header + Table + Footer

	$mailer->AddAddress("itsservicedesk@camosun.bc.ca", "ITS Service Desk");
	#$mailer->AddAddress("bancesm@camosun.bc.ca", "ITS Service Desk");

	if(isset($e))
	{
		$mailer->AddCC($e);
	}


	$mailer->From=		"do_not_reply@camosun.bc.ca";
	$mailer->FromName=	"Do Not Reply";
	$mailer->Subject=	$subjecttype;
	$mailer->Body=		$fullEmail;
	$mailer->WordWrap=	78;
	$mailer->IsSMTP(); // telling  the class to use SMTP
	$mailer->Host=      "192.168.77.97"; //SMTP server 
	$mailer->ContentType= "text/html";
//var_dump($mailer); die();
	if(!$mailer->Send())
	{
		print "<p>There was a problem submitting your request. The error was:<br/><code>".$mailer->ErrorInfo."</code></p>";
		print "<p>Please send an email directly to <a href=\"mailto:itsservicedesk@camosun.bc.ca\">itsservicedesk@camosun.bc.ca</a> with the error as the body of the message.</p>";
	}
	else 
	{
		$confirmation = '<div class="alert alert-block alert-info"><h4>Success</h4><p>Your new user account request for '.$fv->getValue('First-Name').' '.$fv->getValue('Last-Name').' was sent.</p></div>';
		print $confirmation;
        print $HTMLbody;
	}
	
}
?>

</div>