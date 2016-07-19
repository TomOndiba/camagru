// function getImageUrl(frame){
//   // Create our XMLHttpRequest object
//   var hr = new XMLHttpRequest();
//   // Create some variables we need to send to our PHP file
//   var url = "imagesrc.php";
//   // var imgurl = document.getElementById("photo").src;
//   var canvasFinal = document.getElementById("canvas");
//   // var imgurl = canvasFinal.toDataURL('image/png');
//   var imgurl = canvasFinal.toDataURL();
//   var vars = "imgurl="+imgurl+'&frame='+frame;
//   hr.open("POST", url, true);
//   // hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   // Access the onreadystatechange event for the XMLHttpRequest object
//   hr.onreadystatechange = function() {
//       console.log(hr);

//       if(hr.readyState == 4 && hr.status == 200) {
//           var return_data = hr.responseText;
//           document.getElementById("imgsrc").innerHTML = return_data;
//       }
//   }
//   // Send the data to PHP now... and wait for response to update the status div
//   hr.send(vars); // Actually execute the request
//   document.getElementById("imgsrc").innerHTML = "processing...";
//   window.scrollTo(0, 0);
// }

function getImageUrl(frame){
    var base64 = document.getElementById("photo").src;
    var vars = 'frame='+frame+"&imgurl="+base64;
    ajax = new XMLHttpRequest();
    ajax.open( 'POST', 'imagesrc.php', true );
    ajax.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
    ajax.send( vars );
    window.scrollTo(0, 0);
    ajax.onreadystatechange = function() {
    if (ajax.readyState == 4 && ajax.status == 200) {
      document.getElementById("imgsrc").innerHTML = ajax.responseText;
    }}

}

var canvasFinal = document.getElementById('canvas');