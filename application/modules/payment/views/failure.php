<html>
  <head>
  <script>
    function sendback() {
    	setTimeout(function(){
    		var transactionFailed = document.forms.transactionFailed;
    		transactionFailed.submit();
    	}, 3000);
    }
  </script>
  </head>
  <body onload="sendback()" style="margin: 0;padding: 0;position: relative;height: 100vh;">
    	<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);" width="64px" height="64px" viewBox="0 0 128 128" xml:space="preserve"><g><circle cx="16" cy="64" r="16" fill="#a5c339" fill-opacity="1"/><circle cx="16" cy="64" r="14.344" fill="#a5c339" fill-opacity="1" transform="rotate(45 64 64)"/><circle cx="16" cy="64" r="12.531" fill="#a5c339" fill-opacity="1" transform="rotate(90 64 64)"/><circle cx="16" cy="64" r="10.75" fill="#a5c339" fill-opacity="1" transform="rotate(135 64 64)"/><circle cx="16" cy="64" r="10.063" fill="#a5c339" fill-opacity="1" transform="rotate(180 64 64)"/><circle cx="16" cy="64" r="8.063" fill="#a5c339" fill-opacity="1" transform="rotate(225 64 64)"/><circle cx="16" cy="64" r="6.438" fill="#a5c339" fill-opacity="1" transform="rotate(270 64 64)"/><circle cx="16" cy="64" r="5.375" fill="#a5c339" fill-opacity="1" transform="rotate(315 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;315 64 64;270 64 64;225 64 64;180 64 64;135 64 64;90 64 64;45 64 64" calcMode="discrete" dur="720ms" repeatCount="indefinite"></animateTransform></g></svg>
    <form action="<?php echo $action; ?>" method="post" name="transactionFailed">
		<input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>" />
		<input type="hidden" name="status" value="<?php echo $status; ?>" />
		<input type="hidden" name="firstname" value="<?php echo $firstname; ?>" />
		<input type="hidden" name="email" value="<?php echo $email; ?>" />
		<input type="hidden" name="amount" value="<?php echo $amount; ?>" />
		<input type="hidden" name="phone" value="<?php echo $received['phone']; ?>" />
		<input type="hidden" name="txnid" value="<?php echo $received['payuMoneyId']; ?>" />
		<input type="hidden" name="addedon" value="<?php echo $received['addedon']; ?>" />
    </form>
  </body>
</html>