<?php
// Admin user variables
$admin_id = 0;
$isEditingUser = false;
$username = "";
$role = "";
$email = "";

// Topics variables
$topic_id = 0;
$isEditingTopic = false;
$topic_name = "";

// general variables
$errors = [];

/* - - - - - - - - - -
-  Admin users actions
- - - - - - - - - - -*/

function createTopic($request_values){
	global $conn, $errors, $topic_name;
	$topic_name = esc($request_values['topic_name']);
	// create slug: if topic is "Life Advice", return "life-advice" as slug
	$topic_slug = makeSlug($topic_name);
	// validate form
	if (empty($topic_name)) {
		array_push($errors, "Topic name required");
	}
	// Ensure that no topic is saved twice.
	$topic_check_query = "SELECT * FROM topics WHERE slug='$topic_slug' LIMIT 1";
	$result = mysqli_query($conn, $topic_check_query);
	if (mysqli_num_rows($result) > 0) { // if topic exists
		array_push($errors, "Topic already exists");
	}
	// register topic if there are no errors in the form
	if (count($errors) == 0) {
		$query = "INSERT INTO topics (name, slug)
				  VALUES('$topic_name', '$topic_slug')";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Topic created successfully";
		header('location: topics.php');
		exit(0);
	}
}



function esc($value){

	global $conn;
	// remove empty space sorrounding string
	$val = trim($value);
	$val = mysqli_real_escape_string($conn, $value);
	return $val;
}
// Receives a string like 'Some Sample String'
// and returns 'some-sample-string'
function makeSlug($string){
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}
?>
