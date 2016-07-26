function draw(ev) {
  var ctx = document.getElementById('canvas').getContext('2d'),
      img = new Image(),
      f = document.getElementById("uploadimage").files[0],
      url = window.URL || window.webkitURL,
      src = url.createObjectURL(f);

  img.src = src;
  img.onload = function() {
      ctx.drawImage(img, 0, 0);
      url.revokeObjectURL(src);
  }
  var canvas = document.querySelector('#canvas');
  var photo = document.querySelector('#photo');
  var data = canvas.toDataURL('image/png');
  photo.setAttribute('src', data);
  saved_rect = ctx.getImageData(0, 0, 500, 500);
  moove(img);
}
document.getElementById("uploadimage").addEventListener("change", draw, false)

var moove = function(img){
    img.onload = function(){
        ctx.drawImage(img, 0,0);
    };

    var canvas=document.getElementById("canvas");
    var ctx=canvas.getContext("2d");
    var canvasOffset = document.getElementById('canvas').offset;
    // var offsetX=canvasOffset.left;
    var offsetX=document.getElementById('canvas').offsetLeft;
    var offsetY=document.getElementById('canvas').offsetTop;
    // var offsetY=canvasOffset.top;
    var canvasWidth=canvas.width;
    var canvasHeight=canvas.height;
    var isDragging=false;

    function handleMouseDown(e){
      canMouseX=parseInt(e.clientX-offsetX);
      canMouseY=parseInt(e.clientY-offsetY);
      // set the drag flag
      isDragging=true;
    }

    function handleMouseUp(e){
      canMouseX=parseInt(e.clientX-offsetX);
      canMouseY=parseInt(e.clientY-offsetY);
      // clear the drag flag
      isDragging=false;
    }

    function handleMouseOut(e){
      canMouseX=parseInt(e.clientX-offsetX);
      canMouseY=parseInt(e.clientY-offsetY);
      // user has left the canvas, so clear the drag flag
      //isDragging=false;
    }

    function handleMouseMove(e){
      var rect = canvas.getBoundingClientRect();
      canMouseX=parseInt(e.clientX-rect.left);
      canMouseY=parseInt(e.clientY-rect.top);
      // if the drag flag is set, clear the canvas and draw the image
      var height = img.clientHeight;
      var width = img.clientWidth;
      if(isDragging && !canDraw){
          ctx.clearRect(0,0,canvasWidth,canvasHeight);
          ctx.putImageData(saved_rect, 0, 0);
          ctx.drawImage(img,canMouseX - 40,canMouseY - 40);
          var photo = document.querySelector('#photo');
          var data = canvas.toDataURL('image/png');
          photo.setAttribute('src', data);
      }
    }

    canvas.addEventListener('mousedown', function(e) {
        handleMouseDown(e);
    }, false);

    canvas.addEventListener('mousemove', function(e) {
        handleMouseMove(e);
    }, false);

    canvas.addEventListener('mouseup', function(e) {
        handleMouseUp(e);
    }, false);

    canvas.addEventListener('mouseout', function(e) {
        handleMouseOut(e);
    }, false);


}