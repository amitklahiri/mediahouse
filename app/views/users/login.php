<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="row justify-content-center mt-4 mb-2">
	<div class="col-md-5">
		<div class="card bg-light">
			<div class="card-body">
				<h2 class="card-title">Login</h2>
				<form action="<?php echo URLROOT; ?>/users/login" method="post" enctype="multipart/form-data" autocomplete="off">
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
					<div class="row">
						<div class="col">
							<input type="submit" value="Login" class="btn btn-success btn-block">
						</div>
						<div class="col">
							<a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light btn-block">No account? Register</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
