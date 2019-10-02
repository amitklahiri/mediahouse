<?php require_once APPROOT . '/views/inc/header.php'; ?>

<?php if (!empty($_SESSION['flash_message'])) { ?>
<div class="alert <?php echo $_SESSION['flash_message_class']; ?> alert-dismissible fade show" role="alert">
	<?php echo $_SESSION['flash_message']; ?>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<?php } ?>

<div class="row justify-content-center mt-4 mb-2">
	<div class="col-md-5">
		<div class="card bg-light">
			<div class="card-body">
				<h2 class="card-title">Create Account</h2>
				<form action="<?php echo URLROOT; ?>/users/register" method="post" enctype="multipart/form-data" autocomplete="off">
					<div class="form-group">
						<label for="name">Name <sup>*</sup></label>
						<input type="text" name="name" id="" class="form-control <?php echo !empty($data['name_err']) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($data['name']) ? $data['name'] : ''; ?>">
						<div class="invalid-feedback"><?php echo $data['name_err']; ?></div>
					</div>
					<div class="form-group">
						<label for="email">Email <sup>*</sup></label>
						<input type="email" name="email" id="" class="form-control <?php echo !empty($data['email_err']) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($data['email']) ? $data['email'] : ''; ?>">
						<div class="invalid-feedback"><?php echo $data['email_err']; ?></div>
					</div>
					<div class="form-group">
						<label for="password">Password <sup>*</sup></label>
						<input type="password" name="password" id="" class="form-control <?php echo !empty($data['password_err']) ? 'is-invalid' : ''; ?>">
						<div class="invalid-feedback"><?php echo $data['password_err']; ?></div>
					</div>
					<div class="form-group">
						<label for="confirm_password">Confirm Password <sup>*</sup></label>
						<input type="password" name="confirm_password" id="" class="form-control <?php echo !empty($data['confirm_password_err']) ? 'is-invalid' : ''; ?>">
						<div class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></div>
					</div>
					<div class="form-group">
						<label for="picture">Profile Picture <sup>*</sup></label>
						<input type="file" name="picture" id="" class="form-control <?php echo !empty($data['picture_err']) ? 'is-invalid' : ''; ?>">
						<div class="invalid-feedback"><?php echo $data['picture_err']; ?></div>
					</div>
					<div class="row">
						<div class="col">
							<input type="submit" value="Register" class="btn btn-success btn-block">
						</div>
						<div class="col">
							<a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? Login</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
