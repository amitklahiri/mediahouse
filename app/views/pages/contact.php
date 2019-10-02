<?php require_once APPROOT . '/views/inc/header.php'; ?>

<h1>Contact</h1>

<?php if (!empty($_SESSION['flash_message'])) { ?>
<div class="alert <?php echo $_SESSION['flash_message_class']; ?> alert-dismissible fade show" role="alert">
	<?php echo $_SESSION['flash_message']; ?>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<?php } ?>

<div class="row mt-4 mb-2">
	<div class="col-md-6">
		<div class="card border-0">
			<form action="<?php echo URLROOT; ?>/pages/contact" method="post" enctype="multipart/form-data" autocomplete="off">
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
					<label for="subject">Subject <sup>*</sup></label>
					<input type="subject" name="subject" id="" class="form-control <?php echo !empty($data['subject_err']) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($data['subject']) ? $data['subject'] : ''; ?>">
					<div class="invalid-feedback"><?php echo $data['subject_err']; ?></div>
				</div>
				<div class="form-group">
					<label for="message">Message <sup>*</sup></label>
					<textarea name="message" id="" class="form-control <?php echo !empty($data['message_err']) ? 'is-invalid' : ''; ?>" rows="3"></textarea>
					<div class="invalid-feedback"><?php echo $data['message_err']; ?></div>
				</div>
				<div class="row">
					<div class="col">
						<input type="submit" value="Send" class="btn btn-success">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
