<script>
	const loaderSelector = document.getElementById('loader');
	const formSelector = document.getElementById('login-form');
	const errorDiv = document.getElementById('error');
	
	formSelector.addEventListener ('submit', e => {
		e.preventDefault ();
		var idbSupported = false;
		var db;
		const dbName = 'itsc';
		const dbVersion = 1;
		const formURL = formSelector.getAttribute ('action');
		var formData = new FormData(formSelector);
		loaderSelector.style.display = 'block';		
		toastr.info ('Please wait...');
		fetch (formURL, {
			method : 'POST',
			body: formData,
		}).then (function (response) {
			return response.json ();
		}).then(function(result) {
			toastr.clear ();
			if (result.status == true) {
				if (typeof(Storage) !== "undefined") {
				   localStorage.clear ();
				   localStorage.setItem('is_logged_in', result.is_logged_in );
				   localStorage.setItem('member_id', result.member_id );
				   localStorage.setItem('is_admin', result.is_admin );
				   localStorage.setItem('user_token', result.user_token );
				   localStorage.setItem('user_name', result.user_name );
				   localStorage.setItem('role_id', result.member_id );
				   localStorage.setItem('role_lvl', result.role_lvl );
				   localStorage.setItem('dashboard', result.dashboard );
				   localStorage.setItem('slug', result.slug );				    
				}
				else {
				  // Too bad, no localStorage for us
				}
				toastr.success (result.message);
				document.location = result.redirect;
			} else {
				toastr.error (result.error);
			}
			loaderSelector.style.display = 'none';
		});
	});
	

	
	// Function to add role-based user menu to IndexedDB
	function addUserMenu(db, data) { 
		var request = db.transaction(['userMenu'], 'readwrite').objectStore('userMenu'); 
		for (let i=0; i < data.length; i++) {
			request.add({
				menu_id: data[i].menu_id,
				role_id: data[i].group_id,
				menu_id: data[i].menu_id, 
				order: data[i].menu_order,
				controller_path: data[i].controller_path,
				controller_nm: data[i].controller_nm,
				action_nm: data[i].action_nm,
				icon_img: data[i].icon_img 
			});
		}
		request.onsuccess = function (event) {
		};
		request.onerror = function (event) {
			console.log('Unable to create user-menu.');
		}		
	}
	// Function to add user session data to IndexedDB
	function addUserData(db, data) { 
		var request = db.transaction(['userSession'], 'readwrite')
			.objectStore('userSession')
			.add({
				member_id: data.member_id, 
				token: data.token, 
				role_id: data.role_id,
				is_admin: data.is_admin,
				is_logged_in: data.is_logged_in,
				name: data.user_name,
				status: data.status,
				role_lvl: data.role_lvl,
				dashboard: data.dashboard,
			});
		request.onsuccess = function (event) {
		};
		request.onerror = function (event) {
			console.log('Unable to write IndexedDB session ');
		}
	}	
</script>