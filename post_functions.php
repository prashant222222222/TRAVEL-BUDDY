<?php
// Post variables
$post_id = 0;
$isEditingPost = false;
$published = 0;
$title = "";
$post_slug = "";
$body = "";
$featured_image = "";
$featured_video = "";
$post_topic = "";

/* - - - - - - - - - -
-  Post functions
- - - - - - - - - - -*/
// get all posts from DB
function getAllPosts()
{
	global $conn;

	// Admin can view all posts
	// Author can only view their posts
if ($_SESSION['user']!='') {
		$user_id = $_SESSION['user']['id'];
		$sql = "SELECT * FROM posts WHERE user_id=$user_id";
	}
	$result = mysqli_query($conn, $sql);
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
		$post['author'] = getPostAuthorById($post['user_id']);
		array_push($final_posts, $post);
	}
	return $final_posts;
}
// get the author/username of a post
function getPostAuthorById($user_id)
{
	global $conn;
	$sql = "SELECT username FROM users WHERE id=$user_id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		// return username
		return mysqli_fetch_assoc($result)['username'];
	} else {
		return null;
	}
}



if (isset($_POST['create_post'])) { createPost($_POST); }


/* - - - - - - - - - -
-  Post functions
- - - - - - - - - - -*/
function createPost($request_values)
	{
		echo"Please fill all the details correctly";

		global $conn, $errors, $title, $featured_image,$featured_video, $topic_id, $body, $published,$place;

//echo "dsfhjdfskhdsfkjfhdsjk";
//	array_push($errors, "Failed to upload video. Please check file settings for your server");





		$title = esc($request_values['title']);

		$body = htmlentities(esc($request_values['body']));
		if (isset($request_values['topic_id'])) {
			$topic_id = esc($request_values['topic_id']);
		}

			$published = 1;
			$topic_id=1;
		// create slug: if title is "The Storm Is Over", return "the-storm-is-over" as slug
		$post_slug = makeSlug($title);
		// validate form
		if (empty($title)) { array_push($errors, "Post title is required"); }
		if (empty($body)) { array_push($errors, "Post body is required"); }
		if (empty($topic_id)) { array_push($errors, "Post topic is required"); }
		// Get image name
	  	$featured_image = $_FILES['featured_image']['name'];
	  	if (empty($featured_image)) { array_push($errors, "Featured image is required"); }
	  	// image file directory
	  	$target = "static/images/" . basename($featured_image);
	  	if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
	  		array_push($errors, "Failed to upload image. Please check file settings for your server");
	  	}

		$post_check_query = "SELECT * FROM posts WHERE slug='$post_slug' LIMIT 1";
		$result = mysqli_query($conn, $post_check_query);

		if (mysqli_num_rows($result) > 0) { // if post exists
			array_push($errors, "A post already exists with that title.");
		}
		// create post if there are no errors in the form
		if (count($errors) == 0) {
			$query = "INSERT INTO posts (user_id, title, slug, image, body, published, created_at, updated_at) VALUES(1, '$title', '$post_slug', '$featured_image', '$body', $published, now(), now())";
			if(mysqli_query($conn, $query)){ // if post created successfully
				$inserted_post_id = mysqli_insert_id($conn);
				// create relationship between post and topic
				$sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($inserted_post_id, $topic_id)";
				mysqli_query($conn, $sql);
		echo $errors;
				$_SESSION['message'] = "Post created successfully";
				header('location: index.php');
				exit(0);
			}
		}
	}





?>
