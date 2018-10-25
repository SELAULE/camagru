/* const video = document.getElementById('video');

function cam() {
    navigator.mediaDevices.getUserMedia({
        audio: false,
        video: { width: 1280, height: 720 }
    }).then(stream => {
        video.srcObject = stream;
    }).catch(console.error)
}

window.addEventListener('load', cam, false);
/*  */
//window.onload(function() {
    let width = 500,
        height = 0,
        filter = 'none',
        streaming = false;

    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const photos = document.getElementById('photos');
    const photoBut = document.getElementById('photo-but');
    /*const clearBut = document.getElementById('clear-but');
    const FilteBut = document.getElementById('Filter-but'); */

    navigator.mediaDevices.getUserMedia({
        audio: false,
        video: {
          /*   width: {ideal: 1280},
            height: {ideal: 720} */
            facingMode: "user"
        }        
    })
        .then(stream =>  {
            video.srcObject = stream;
            
            video.play();
        }) .catch(console.log(`Error: ${err}`));

        //startup() {
            video.addEventListener('canplay', function(ev){
            if (!streaming) {
                height = video.videoHeight / (video.videoHeight/width);

                video.setAttribute('width', width);
                video.setAttribute('width', height);
                canvas.setAttribute('width', width);
                canvas.setAttribute('width', height);
                streaming = true;
            }
        }, false);

        photoBut.addEventListener('click', function(ev) {
            takepicture();
            ev.preventDefault();
        }, false);

        clearphoto();

        function clearphoto() {
            var context = canvas.getContext('2d');
            context.fillStyle = "#AAA"; //light grey colour
            context.fillRect(0, 0, canvas.width, canvas.height);

            var data = canvas.toDataURL('image/png');
            photos.setAttribute('src', data);
        }

        function takepicture() {
            var context = canvas.getContext('2');
            if (width && height) {
               canvas.width = width;
               canvas.height = height;
               context.drawImage(video, 0, 0, width, height);

               var data = canvas.toDataURL('image/png');
               photos.setAttribute('src', data);
            } else {
                clearphoto();
            }
        }
    //}
//})