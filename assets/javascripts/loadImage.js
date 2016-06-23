function draw(ev) {
    console.log(ev);
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
}

document.getElementById("uploadimage").addEventListener("change", draw, false)