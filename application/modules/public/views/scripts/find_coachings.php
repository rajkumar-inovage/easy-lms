<?php
	$this->load->view ('public/scripts/validate');
?>
<script type="text/javascript">
	var submitFormSelector = document.getElementById ('find-coaching');
	if (submitFormSelector) {	
		submitFormSelector.addEventListener ('submit', e => {
			e.preventDefault ();
			const formURL = submitFormSelector.getAttribute ('action');
			var formData = new FormData(submitFormSelector);
			toastr.info ('Please wait...');
			fetch (formURL, { 
				method : 'POST',
				body: formData,
			}).then (function (response) {
				return response.json ();
			}).then(function(data) {
				toastr.clear ();
				if (data.status == true) {
					document.getElementById ('message-div').innerHTML = '<div class="alert alert-success">'+data.message+'</div>';
					var obj = data.result;
					var output = '';
					output += '<div class="list-group list-group-flush">';
					for (var item in obj) {
						var coaching_id = obj[item].id;
						var logo_path = obj[item].logo;
						output += '<a class="list-group-item" href="<?php echo site_url ('login/login/index/?sub='); ?>'+obj[item].coaching_url+'">';
							output += '<span class="float-left"><img src="'+logo_path+'" height="30"></span>';
							output += obj[item].coaching_name;
						output += '</a>';
					}
					output += '</div>';

					document.getElementById ('result-div').innerHTML = output;

				} else {
					toastr.error (data.error);
				}
			});
		});
	}
</script>
