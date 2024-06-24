<?php include './views/components/navbar.php' ?>

<div class="table-wrapper">
	<table class="table table-bordered" id="usersTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>E-mail</th>
				<th>Phone Number</th>
				<th>City</th>
			</tr>
		</thead>
		<tbody id="usersTableBody" >
			<?php foreach($users as $user){?>
				<tr>
					<td><?=$user->getName()?></td>
					<td><?=$user->getEmail()?></td>
					<td><?=$user->getPhoneNumber()?></td>
					<td><?=$user->getCity()?></td>
				</tr>
			<?php }?>
		</tbody>
	</table>	
</div>

<div class="d-flex justify-content-end mb-2">
	<button type="button" class="btn btn-default addUserBtn"><div class="glyphicon glyphicon-plus"></div><div>Add User</div></button>
</div>


<form class="form-horizontal d-none" id="addUserForm" >
	<div class="form-group">
		<label class="col-lg-2 d-flex justify-content-start control-label" for="name">Name</label>
		<div class="col-lg-12">
		<input class="form-control" name="name" input="text" id="name"/>
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-2 d-flex justify-content-start control-label" for="email">E-mail</label>
		<div class="col-lg-12">
		<input class="form-control" name="email" input="text" id="email"/>
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-2 d-flex justify-content-start control-label" for="phone_number">Phone number</label>
		<div class="col-lg-12">
			<input class="form-control" name="phone_number" input="text" id="phone_number"/>
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-2 d-flex justify-content-start control-label" for="city">City</label>
		<div class="col-lg-12">
			<input class="form-control" name="city" input="text" id="city"/>
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-12 d-flex justify-content-end">
			<button class="btn btn-primary">Create new row</button>
		</div>
	</div>
</form>

<script>
	const errorMessage = (errorMessageText) =>{
		//del previous error message
		$('#formError').remove();
		const errorMessage = errorMessageText.join('<br>');
		//add error message to the top of the form
		$('#addUserForm').prepend('<div id="formError" class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + errorMessage  + '</div>');
	}
	const validateEmail = (email) => {
		const re = /\S+@\S+\.\S+/;
		return re.test(email);
	}
	const validateInputs = () => {
		let error = false;
		let errorMessageText = [];
		// Client Side Validation: User Experience
		// 1. name, city should be at least 3 chars long
		if($('#name').val().length < 3) {
			errorMessageText.push('Name should be at least 3 characters long.');

			error = true;
		}
		if($('#city').val().length < 3) {
			errorMessageText.push('City should be at least 3 characters long.');
			error = true;
		}
		// 2. email should be valid
		if(!validateEmail($('#email').val())) {
			errorMessageText.push('Invalid email address.');
			error = true;
		}
		// 3. phone_number should be valid (min 3 chars)
		if($('#phone_number').val().length < 3) {
			errorMessageText.push('Invalid phone number.');
			error = true;
		}
		return [error, errorMessageText];
	}


	$(document).ready(function() {
		//onclick of add user button, show the form
		$('.addUserBtn').on('click', function() {
			$('#addUserForm').toggle();
		});
		$('#addUserForm').on('submit', function(event) {
			event.preventDefault();
			
			const [error, errorMessageText] = validateInputs();
			if(error){
				errorMessage(errorMessageText);
				return;
			}

			$.ajax({
				type: 'POST',
				url: 'create.php',
				data: $(this).serialize(),
				success: function(response) {
					// Parse JSON res
					var responseObj = JSON.parse(response);
					// get user from response.user and append it to the table
					const user = responseObj.user;
					$('#usersTableBody').append('<tr><td>' + user.name + '</td><td>' + user.email + '</td><td>' + user.phone_number + '</td><td>' + user.city + '</td></tr>');
				},
				error: function(xhr, status, error) {
					// Handle errors
					alert('An error occurred: ' + error);
				}
			});
		});
	});
</script>