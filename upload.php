<?php
include('config.php');
error_reporting(1);
$con=mysqli_connect("localhost", "root", "", "complete-blog-php");
extract($_POST);

$user=$_SESSION['user']['username'];
$place=$_POST['state'];
$target_dir = "test_upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if($upd)
{
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg")
{
    echo "File Format Not Suppoted";
}

else
{

$video_path=$_FILES['fileToUpload']['name'];

mysqli_query($con,"insert into video(user,video_name,place) values('$user','$video_path','$place')");

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);
echo '<h4>Uploaded Sucessfully !!</h4>';
 // echo '<script type="text/JavaScript">
 //     alert("Uploaded Successfully !!!")

// header("Location: video.php");
// exit();

}
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
<link href='https://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700' rel='stylesheet' type='text/css'>
<style media="screen">
  @import "compass/css3";

/* ===================== FILE INPUT ===================== */
.file-area {
  width: 100%;
  position: relative;

  input[type=file] {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0;
    cursor: pointer;
  }

  .file-dummy {
    width: 100%;
    padding: 30px;
    background: rgba(255,255,255,0.2);
    border: 2px dashed rgba(255,255,255,0.2);
    text-align: center;
    transition: background 0.3s ease-in-out;

    .success {
      display: none;
    }
  }

  &:hover .file-dummy {
    background: rgba(255,255,255,0.1);
  }

  input[type=file]:focus + .file-dummy {
    outline: 2px solid rgba(255,255,255,0.5);
    outline: -webkit-focus-ring-color auto 5px;
  }

  input[type=file]:valid + .file-dummy {
    border-color: rgba(0,255,0,0.4);
    background-color: rgba(0,255,0,0.3);

    .success {
      display: inline-block;
    }
    .default {
      display: none;
    }
  }
}
/* ===================== BASIC STYLING ===================== */

* {
  box-sizing: border-box;
  font-family: 'Lato', sans-serif;
}

html,
body {
  margin: 0;
  padding: 0;
  font-weight: 300;
  height: 100%;
  background: #053777;
  color: #fff;
  font-size: 16px;
  overflow: hidden;
  background: -moz-linear-gradient(top, #053777 0%, #00659b 100%);
  /* FF3.6+ */

  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #053777), color-stop(100%, #00659b));
  /* Chrome,Safari4+ */

  background: -webkit-linear-gradient(top, #053777 0%, #00659b 100%);
  /* Chrome10+,Safari5.1+ */

  background: -o-linear-gradient(top, #053777 0%, #00659b 100%);
  /* Opera 11.10+ */

  background: -ms-linear-gradient(top, #053777 0%, #00659b 100%);
  /* IE10+ */

  background: linear-gradient(to bottom, #053777 0%, #00659b 100%);
  /* W3C */

}

h1 {
  text-align: center;
  margin: 50px auto;
  font-weight: 100;
}

label {
  font-weight: 500;
  display: block;
  margin: 4px 0;
  text-transform: uppercase;
  font-size: 13px;
  overflow: hidden;

  span {
    float: right;
    text-transform: none;
    font-weight: 200;
    line-height: 1em;
    font-style: italic;
    opacity: 0.8;
  }
}

.form-controll {
  display: block;
  padding: 8px 16px;
  width: 100%;
  font-size: 16px;
  background-color: rgba(255,255,255,0.2);
  border: 1px solid rgba(255,255,255,0.3);
  color: #fff;
  font-weight: 200;

  &:focus {
    outline: 2px solid rgba(255,255,255,0.5);
    outline: -webkit-focus-ring-color auto 5px;
  }
}

#upload {
  padding: 8px 30px;
  background: rgba(255,255,255,0.8);
  color: #053777;
  text-transform: uppercase;
  font-weight: 600;
  font-size: 11px;
  border: 0;
  text-shadow: 0 1px 2px #fff;
  cursor: pointer;
}

.form-group {
  max-width: 500px;
  margin: auto;
  margin-bottom: 30px;
}

.back-to-article {
  color: #fff;
  text-transform: uppercase;
  font-size: 12px;
  position: absolute;
  right: 20px;
  top: 20px;
  text-decoration: none;
  display: inline-block;
  background: rgba(0,0,0,0.6);
  padding: 10px 18px;
  transition: all 0.3s ease-in-out;
  opacity: 0.6;

  &:hover {
    opacity: 1;
    background: rgba(0,0,0,0.8);
  }
}
select{
  display: block;
  padding: 8px 16px;
  width: 100%;
  font-size: 16px;
  background-color: rgba(255,255,255,0.2);
  border: 1px solid rgba(255,255,255,0.3);
  color: black;
  font-weight: 200;


}
</style>


</head>
<body>
  <form action="upload.php" method="post" enctype="multipart/form-data">
  <h1><strong>Upload your VLOG</strong></h1>
  <div class="form-group">
    <label for="state"><span>Choose the state of your VLOG</span></label>
    <select name="state" id="state" placeholder="state">
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Puducherry">Puducherry</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Odisha">Odisha</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Telangana">Telangana</option>
<option value="Tripura">Tripura</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="Uttarakhand">Uttarakhand</option>
<option value="West Bengal">West Bengal</option>
</select><br>
  </div>
  <div class="form-group file-area">
        <label for="images">Choose videos</label>
    <input type="file" name="fileToUpload" />
    <div class="file-dummy">
    </div>
  </div>

  <div class="form-group">
  <input type="submit" value="Uplaod Video" name="upd" id="upload">
  </div>

</form>



<a href="video.php" class="back-to-article" target="_blank">back to Video</a>
</body>
</html>
