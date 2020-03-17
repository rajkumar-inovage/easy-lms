<script>
$("#check-all").click(function(){
    $('.check').not(this).prop('checked', this.checked);
});
</script>

<script>
$(document).ready (function () {
	$('#search-status').on ('change', function () {
		var status = $(this).val ();
		var url = '<?php echo site_url ('coaching/users/batch_users/'.$coaching_id.'/'. $batch_id.'/'.$add_users);?>/'+status+'/<?php 
		echo $role_id; ?>';
		$(location).attr('href', url);
	});

	$('#search-role').on ('change', function () {
		var role_id = $(this).val ();
		var url = '<?php echo site_url ('coaching/users/batch_users/'.$coaching_id.'/'. $batch_id.'/'.$add_users);?>/<?php 
		echo $status; ?>/'+role_id;
		$(location).attr('href', url);
	});
});
</script>

<script>
	
	const loaderSelector = document.getElementById('loader');
	const formSelector = document.getElementById('search-form');
	const formURL = formSelector.getAttribute ('action');
	const outputSelector = document.getElementById ('users-list');
	
	formSelector.addEventListener ('submit', e => {
		e.preventDefault ();
		var formData = new FormData(formSelector);
		loaderSelector.style.display = 'block';
		
		fetch (formURL, {
			method : 'POST',
			body: formData,
		}).then (function (response) {
			return response.json();
		}).then(function(result) {
			if (result.status == true) {
				loaderSelector.style.display = 'none';
				var obj =  result.data;
				var i = 1;
				var output = '<table class="table">';
					output += '<thead>';
						output += '<tr>';
							output += '<th width="5%">';
								output += '<input id="checkAll" type="checkbox" >';
							output += '</th>';
							output += '<th>Name</th>';
							output += '<th>Email</th>';
							output += '<th>Role</th>';
							output += '<th>Status</th>';
							output += '<th>Actions</th>';
						output += '</tr>';
					output += '</thead>';
					output += '<tbody>';
					for (var item in obj) {
						output += '<tr>';
							output += '<td>';
								output += '<input type="checkbox" value="'+obj[item].member_id+'" class="checks">';
							output += '</td>';
							output += '<td>';
								var name = obj[item].first_name+' '+obj[item].last_name;
								output += '<a href="<?php echo site_url('coaching/users/create'); ?>/'+obj[item].coaching_id+'/'+obj[item].role_id+'/'+obj[item].member_id+'">'+name+'</a><br>';
								output += obj[item].adm_no;
							output += '</td>';
							output += '<td>';
								output += obj[item].email;
							output += '</td>';
							output += '<td>';
								if(obj[item].role_id == 1){
									output += '<span>Super Admin</span>';
								}
								if(obj[item].role_id == 2){
									output += '<span>Admin</span>';
								}
								if(obj[item].role_id == 3){
									output += '<span>Teacher</span>';
								}
								if(obj[item].role_id == 4){
									output += '<span>Student</span>';
								}
								if(obj[item].role_id == 5){
									output += '<span>Coaching Admin</span>';
								}
							output += '</td>';
							output += '<td>';
								if (obj[item].status == 1) {
									output += '<span class="font-weight-bold">Enabled</span>';
								} else {
									output += '<span class="font-weight-bold">Disabled</span>';
								}
							output += '</td>';
							output += '<td>';
								output += '<a href="<?php echo site_url('coaching/users/create'); ?>/'+obj[item].coaching_id+'/'+obj[item].role_id+'/'+obj[item].member_id+'"><i class="fa fa-trash"></i></a>';
							output += '</td>';
						output += '</tr>';
						i++;
					}
					output += '<tbody>';
				output += '</table>';
				/*
				/*
				*/
				outputSelector.innerHTML = output;
			}
		});
	});

</script>