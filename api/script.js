/*jshint esversion: 6 */
$(document).ready(function(){

  var API_KEY="AIzaSyDk6FkvemVSTdLY0a9puKQGk5TTiTevEZ8";
  var video="";
  $("#form").submit(function(event){
    event.preventDefault() ; //prevent auto completition of form
    //alert("form is submitted")



    var search=$("#search").val();
    videoSearch(API_KEY,search,15);
  });

function videoSearch(API_KEY,search,max_results){
  $("#videos").empty();
$.get("https://www.googleapis.com/youtube/v3/search?key="+API_KEY+"&type=video&part=snippet&maxResults="+max_results+"&q="+search,function(data){
      console.log(data);

      data.items.forEach(item=>{
        video= `<iframe src="http://www.youtube.com/embed/${item.id.videoId}" width="420" height="315" frameborder="0" allowfullscreen></iframe>
        <br>
        <h3>${item.snippet.title}</h3>
        <br>
        `
          $("#videos").append(video)
      });

    })
}


})
