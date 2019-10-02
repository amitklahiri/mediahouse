<?php require_once APPROOT . '/views/inc/header.php'; ?>

<h1>Media</h1>

<?php if (!empty($_SESSION['flash_message'])) { ?>
<div class="alert <?php echo $_SESSION['flash_message_class']; ?> alert-dismissible fade show" role="alert">
	<?php echo $_SESSION['flash_message']; ?>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<?php } ?>

<div class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 pt-2">		
		<h4>Add New Asset</h4>
		<form action="<?php echo URLROOT; ?>/medias/add" method="post" enctype="multipart/form-data" autocomplete="off">			
			<div class="form-group">
				<input type="text" class="form-control <?php echo (!empty($data['url_err'])) ? 'is-invalid' : ''; ?>" name="url" placeholder="Youtube URL *" value="<?php echo !empty($data['url']) ? $data['url'] : ''; ?>">
				<span class="invalid-feedback"><?php echo $data['url_err']; ?></span>
			</div>
			<div class="form-group">
				<input type="text" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" name="title" placeholder="Media Title *" value="<?php echo !empty($data['title']) ? $data['title'] : ''; ?>">
				<span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
			</div>
			<input type="submit" name="submit" value="Add Media" class="btn btn-outline-success mt-2">
		</form>
	</div>
	<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 pt-2 border border-top-0 border-bottom-0 border-default">
		<?php if (count($data['medias']) == 0) { ?>
		<h4 class="text-danger">There is no record available</h4>
		<?php } ?>
		<?php foreach ($data['medias'] as $media) { ?>
		<div class="card">
			<div class="card-body">
				<div class="card-title text-primary"><?php echo $media->title; ?></div>
				<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $media->user_id) { ?>
					<a href="<?php echo URLROOT; ?>/medias/delete/<?php echo $media->id; ?>" class="btn btn-outline-danger btn-sm float-left">Remove</a>
				<?php } ?>
				<a href="<?php echo URLROOT; ?>/medias/index/<?php echo $media->id; ?>" class="btn btn-outline-info btn-sm float-right">Play</a>
			</div>
		</div>
		<hr class="border-default">
		<?php } ?>		
	</div>
	<?php 
		$media_now = !empty($data['media_single']->url) ? $data['media_single']->url : 'https://www.youtube.com/embed/zpOULjyy-n8';
		$media_now = str_replace('watch?v=', 'embed/', $media_now);
	?>
	<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 pt-2 mb-2">
		<div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="<?php echo $media_now; ?>" allowfullscreen></iframe>
		</div>
	</div>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
