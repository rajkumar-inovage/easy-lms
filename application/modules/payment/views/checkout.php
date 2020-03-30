<html>
  <head>
  <script>
    function submitPayuForm() {
    	setTimeout(function(){
    		var payuForm = document.forms.payuForm;
    		payuForm.submit();
    	}, 3000);
    }
  </script>
  </head>
  <body onload="submitPayuForm()" style="margin: 0;padding: 0;position: relative;height: 100vh;">
    <?php if($formError) { ?>
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } else{ ?>
    	<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);" width="64px" height="64px" viewBox="0 0 128 128" xml:space="preserve"><g><circle cx="16" cy="64" r="16" fill="#a5c339" fill-opacity="1"/><circle cx="16" cy="64" r="14.344" fill="#a5c339" fill-opacity="1" transform="rotate(45 64 64)"/><circle cx="16" cy="64" r="12.531" fill="#a5c339" fill-opacity="1" transform="rotate(90 64 64)"/><circle cx="16" cy="64" r="10.75" fill="#a5c339" fill-opacity="1" transform="rotate(135 64 64)"/><circle cx="16" cy="64" r="10.063" fill="#a5c339" fill-opacity="1" transform="rotate(180 64 64)"/><circle cx="16" cy="64" r="8.063" fill="#a5c339" fill-opacity="1" transform="rotate(225 64 64)"/><circle cx="16" cy="64" r="6.438" fill="#a5c339" fill-opacity="1" transform="rotate(270 64 64)"/><circle cx="16" cy="64" r="5.375" fill="#a5c339" fill-opacity="1" transform="rotate(315 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;315 64 64;270 64 64;225 64 64;180 64 64;135 64 64;90 64 64;45 64 64" calcMode="discrete" dur="720ms" repeatCount="indefinite"></animateTransform></g></svg>
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
		<input type="hidden" name="key" value="<?php echo PAYUMONEY_MERCHANT_KEY; ?>" />
		<input type="hidden" name="hash" value="<?php echo $posted['hash']; ?>"/>
		<input type="hidden" name="txnid" value="<?php echo $posted['txnid'] ?>" />
		<input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" />
        <input type="hidden" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname']))?'':$posted['firstname'];?>"/>
        <input type="hidden" name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" />
		<input type="hidden" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" />
		<input type="hidden" name="productinfo" value="<?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo']; ?>" />
		<input type="hidden" name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" />
        <input type="hidden" name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" />
        <input type="hidden" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" />
        <input type="hidden" name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" />
        <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
    </form>
  </body>
</html>