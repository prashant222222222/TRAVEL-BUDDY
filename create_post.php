<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin_functions.php'); ?>
<?php  include('post_functions.php'); ?>
<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
<!-- Get all topics -->

<?php $topics = getAllTopics();	?>
	<title>Create Post</title>
</head>
<body>
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->


		<!-- Middle form - to create and edit  -->
		<div class="action create-post-div">
			<h1 class="page-title">ADD BLOG</h1>
			<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'create_post.php'; ?>" >
				<!-- validation errors for the form -->


				<!-- if editing post, the id is required to identify that post -->
				<?php if ($isEditingPost === true): ?>
					<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
				<?php endif ?>

				<input type="text" name="title" value="<?php echo $title; ?>" placeholder="Title">
				<label style="float: left; margin: 5px auto 5px;">Featured image</label>
				<input type="file" name="featured_image" >
				<textarea name="body" id="body" cols="30" rows="10"><?php echo $body; ?></textarea>




				<!-- Only admin users can view publish input field -


				<!-- if editing post, display the update button instead of create button -->

					<button type="submit" class="btn" name="create_post">Save Post</button>


			</form>
		</div>
		<!-- // Middle form - to create and edit -->
	</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>
<script>	CKEDITOR.replace('body');
</script>



</html>
