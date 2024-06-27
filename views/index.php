
<!-- Total amount of users -->
<p class="text-secondary" style="text-align: right;" id="totalUsers"></p>



<table class="table table-striped table-hover table-bordered usersTable">
	<thead>
		<tr>
			<th>Name</th>
			<th>E-mail</th>
			<th>Phone Number</th>
			<th>City</th>
		</tr>
	</thead>
	<tbody class="usersTableBody" >
		<?php foreach($users as $user){?>
			<tr>
				<td><?=$user->getName()?></td>
				<td><?=$user->getEmail()?></td>
				<td><?=$user->getPhoneNumber()?></td>
				<td class="td-city"><?=$user->getCity()?></td>
			</tr>
		<?php }?>
	</tbody>
</table>	


<div class="d-flex justify-content-end mb-2">
	<a href="#addUserForm" class="text-decoration-none"><button type="button" class="btn btn-sm btn-outline-primary bg-opacity-10 addUserBtn d-flex gap-1"><div>Create new row</div></button></a>
</div>


<form class="form-horizontal border p-2 rounded" id="addUserForm" style="display: none;" >
	<div class="input-group mb-2">
		<label class="col-lg-12 d-flex justify-content-start form-label" for="name">Name</label>
		<div class="col-lg-12">
			<input class="form-control" name="name" input="text" id="name" placeholder="Name"/>
			<small class="text-body-secondary">Minimum of 3 characters</small>
		</div>
	</div>

	<div class="input-group mb-2">
		<label class="col-lg-12 d-flex justify-content-start form-label" for="email">E-mail</label>
		<div class="col-lg-12">
			<input class="form-control" name="email" input="text" id="email" placeholder="E-mail"/>
			<small class="text-body-secondary">Example: example@mail.com </small>
		</div>
	</div>

	<div class="input-group mb-2">
		<label class="col-lg-12 d-flex justify-content-start form-label" for="phone_number">Phone number</label>
		<div class="col-lg-12">
			<input class="form-control" name="phone_number" input="text" id="phone_number" placeholder="Phone number"/>
			<small class="text-body-secondary">Minimum of 3 digits</small>
		</div>
	</div>

	<div class="input-group mb-2">
		<label class="col-lg-12 d-flex justify-content-start form-label" for="city">City</label>
		<div class="col-lg-12">
			<input class="form-control" name="city" input="text" id="city" placeholder="City"/>
			<small class="text-body-secondary">Minimum of 3 characters</small>
		</div>
	</div>
	<div class="col-lg-12 d-flex justify-content-end">
		<button class="btn btn-sm btn-outline-primary d-flex gap-1"><i class="bi bi-person-add"></i><div>Add User</div></button>
	</div>
</form>


<script>

	const errorMessage = (errorMessageText) =>{
		//del previous error message
		$('#formError').remove();
		const errorMessage = errorMessageText.join('<br>');
		//add error message to the top of the form
		$('#addUserForm').prepend('<div id="formError" class="alert alert-danger alert-dismissable position-relative">' + '<p class="m-0 w-100">' + errorMessage + '</p>'  + '<button type="button" class="btn-close position-absolute" style="top: 5px; right: 5px;" data-bs-dismiss="alert" aria-label="Close"></button>' + '</div>');
	}
	const deleteErrorMessage = () => {
		$('#formError').remove();
	}
	// Client Side Validation: User Experience and minimal server requests
	const validateInputs = () => {
		const validateEmail = (email) => {
			const re = /\S+@\S+\.\S+/;
			return re.test(email);
		}
		let errorMessageText = [];

		// func to check if a string contains only digits (aka phone number validation)
		const containsOnlyDigits = (str) => /^\d+$/.test(str);

		const name = $('#name').val().trim();
		if (name.length < 3) {
			errorMessageText.push('Name should be at least 3 characters long.');
		}
		const email = $('#email').val().trim();
		if (!validateEmail(email)) {
			errorMessageText.push('Invalid email address.');
		}
		const phone_number = $('#phone_number').val().trim();
		if (phone_number.length < 3 || !containsOnlyDigits(phone_number)) {
			errorMessageText.push('Invalid phone number, it should be at least 3 characters long and contain only digits.');
		}
		const city = $('#city').val().trim();
		if (city.length < 3) {
			errorMessageText.push('City should be at least 3 characters long.');
		}
		return errorMessageText;
	}
	const createUser = (userData) => {
		const errorMessageText = validateInputs();
		if(errorMessageText.length > 0){
			errorMessage(errorMessageText);
			return;
		}

		$.ajax({
			type: 'POST',
			url: 'create.php',
			data: userData.serialize(),
			success: function(response) {
				var responseObj = JSON.parse(response);
				if (!responseObj.success) {
					errorMessage([responseObj.error]);
					return;
				}
				deleteErrorMessage();
				const user = responseObj.user;
				$('.usersTableBody').append('<tr><td>' + user.name + '</td><td>' + user.email + '</td><td>' + user.phone_number + '</td><td>' + user.city + '</td></tr>');
			},
			error: function(xhr, status, error) {
				// Handle errors
				errorMessage(['An error occurred: ' + error])
			}
		});
	}
	// Display total users
	function displayTotalUsers() {
		//display NR of all visible rows
		const totalUsers = $('.usersTableBody tr:visible').length;
		$('#totalUsers').text('Results: ' + totalUsers);
	}

	$(document).ready(function() {
		displayTotalUsers();
		//onclick of any city, search for users from that city
		$('.usersTableBody .td-city').click(function() {
			const city = $(this).text();
			$('#searchByCityValue').val(city);
			$('#searchByCity').submit();
		});
		//onclick of add user button, show the form
		$('.addUserBtn').on('click', function() {
			$('#addUserForm').toggle();
		});
		$('#addUserForm').on('submit', function(event) {
			event.preventDefault();
			const userData = $(this);
			createUser(userData);
		});
		//Navbar&Search related code
		$('#searchByCity').submit(function(e) {
			e.preventDefault();
			const searchValue = $('#searchByCityValue').val().toLowerCase();
			searchUsers(searchValue);
		});
		function searchUsers(searchValue) {
			// hide all rows initially
			$('.usersTableBody tr').hide();

			// check if any rows contain the search value
			let foundResults = false;
			$('.usersTableBody tr').each(function() {
				const city = $(this).find('td').eq(3).text().toLowerCase();
				if (city.includes(searchValue)) {
					$(this).show();
					foundResults = true; // set flag if a match is found
				}
			});
			displayTotalUsers();

			// Create and display "Nothing found" message if no rows match
			if (!foundResults) {
				const noResultsDiv = $('<div id="noResults">Nothing found</div>');
				$('.usersTableBody').append(noResultsDiv);
			} else {
				// remove "Nothing found" message if results are found
				$('#noResults').remove();
			}
		}
	});
	
</script>