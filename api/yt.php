<!DOCTYPE html>
<?php $place=""; ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>video_search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style media="screen">
body{

}
  #videos{
    margin: auto;
  }
  #videos1{
    margin: auto;
  }
  h1,h2{
    text-align: center;
  }

  .button {
        background-color: #1c87c9;
        border: none;
        color: white;
        padding: 20px 34px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 4px 2px;
        cursor: pointer;
        margin-left: 70%;
      }

</style>
  </head>
  <body>

<a href="upload.php" class="button">Upload your videos</a>
<div class="container">
  <br>
  <h1>TRAVELTUBE</h1>
  <br>
<form id="form" method="post" action="video.php" onsubmit="return fun()">
  <div class="form-group">
        <select name="state" id="state" class="form-control">
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
    </select>
  <div class="form-group">
  <input type="submit" name="submit" value="Submit">
  </div>
</form>



<?php
if(isset($_POST["submit"])&& $_SERVER["REQUEST_METHOD"]=="POST")
{
$con=mysqli_connect("localhost", "root", "", "complete-blog-php");
$place=$_POST['state'];
echo "<h1>Vlogs of $place</h1>" ;
echo("<h2>Videos Uploaded By users</h2>");
$query=mysqli_query($con,"select * from video WHERE Place='$place'");

  while($all_video=mysqli_fetch_array($query))
  {
?>

<div class="row">
<div class="col-md-12">
  <div id="videos1" class="col-md-6">
    <video width="420" height="315" frameborder="0" controls allowfullscreen>
   <source src="test_upload/<?php echo $all_video['video_name']; ?>" type="video/mp4">
    <br>  <h3><?php echo $all_video['video_name'] ?></h3><br>
   </video>
  </div>


</div>
</div>


<?php } } ?>


<h2>Videos from Youtube</h2>
<div class="row">
<div class="col-md-12">
  <div id="videos" class="col-md-6">

  </div>
</div>
</div>


</div>
  </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  fun();
});
function fun(){
  var API_KEY="AIzaSyClIzmA2Gg3P5kovLo-Mf4OH6NJpWBacvM";
  var video="";

  var search="<?php echo  $place ;?>";
  console.log(search);
  search=search+" blog";
  console.log(search);


var max_results=10;

  $("#videos").empty();
$.get("https://www.googleapis.com/youtube/v3/search?key="+API_KEY+"&type=video&part=snippet&maxResults="+max_results+"&q="+search,function(data){
      console.log(data);

      data.items.forEach(item=>{
        video= `<iframe src="http://www.youtube.com/embed/${item.id.videoId}" width="420" height="315" frameborder="0" allowfullscreen></iframe>
        <br>
        <h3>${item.snippet.title}</h3>
        <br>
        `
          $("#videos").append(video);
      });
  })

};

</script>

</html>
