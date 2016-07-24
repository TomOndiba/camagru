function getImageUrl(frame, username){
    var img = document.getElementById("photo").src
    if (img != "http://localhost:8080/camagru/assets/images/grue.jpg"){
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
          reloadMiniGallery();
        }}
    }
}

function reloadMiniGallery(){
    var vars = 'mini_gallery=true';
    ajax = new XMLHttpRequest();
    ajax.open( 'POST', 'layouts/mini-gallery.php', true );
    ajax.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
    ajax.send(vars);
    ajax.onreadystatechange = function() {
    if (ajax.readyState == 4 && ajax.status == 200) {
      document.getElementById("the-mini-gallery").innerHTML = ajax.responseText;}}
}

function addLike(img_uid, user_id){
    var vars = 'img_uid='+img_uid+"&user_id="+user_id;
    ajax = new XMLHttpRequest();
    ajax.open( 'POST', 'update_likes.php', true );
    ajax.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
    ajax.send( vars );
    ajax.onreadystatechange = function() {
    if (ajax.readyState == 4 && ajax.status == 200) {
      document.getElementById("likes").innerHTML = ajax.responseText;
    }}
}    

function destroyImg(img_uid, user_id){
    var vars = 'img_uid='+img_uid+"&user_id="+user_id;
    ajax = new XMLHttpRequest();
    ajax.open( 'POST', 'destroy_img.php', true );
    ajax.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
    ajax.send( vars );
    ajax.onreadystatechange = function() {
    if (ajax.readyState == 4 && ajax.status == 200) {
      document.getElementById("destroyImg").innerHTML = ajax.responseText;
    }}    
}