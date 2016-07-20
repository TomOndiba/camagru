function getImageUrl(frame, username){
    var base64 = document.getElementById("canvas").toDataURL();
    var vars = 'frame='+frame+"&imgurl="+base64+"&username="+username;
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