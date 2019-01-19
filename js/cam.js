// window.onload = function() {
    let width = 500,
        height = 0,
        filter = 'none',
        streaming = false;

     video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const photos = document.getElementById('photos');
    const photoBut = document.getElementById('photo-but');
    const clearBut = document.getElementById('clear-but');
    const FilterBut = document.getElementById('photo-fil');
     
    const fileToUpload = document.getElementById('fileToUpload');

    navigator.mediaDevices.getUserMedia({
        audio: false,
        video: {
            facingMode: "user"
        }        
    })
        .then(stream =>  {
            video.srcObject = stream;
            
            video.play();
        }) .catch(function(err) {
            console.log(`Error: ${err}`)
        });

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

        fileToUpload.addEventListener('click', function(ev) {
            // ev.preventDefault();
            alert('hello');
            uploadspot = document.getElementById('uploadspot');
            uploadspot.click();
            uploadspot.addEventListener('change', function(ev) {
                alert("yay")
                if (fileToUpload.files && fileToUpload.files[0]) {
                    var reader = new FileReader()
                    
                    reader.onload = function (e) {
                        document.getElementById('image').setAttribute('src', e.target.results);
                        document.getElementById('image').style.display = 'block';
                        document.getElementById('video').style.display = 'none';
                        video = document.getElementById('image');
                       
                    }
                    reader.readAsDataURL(fileToUpload.files[0]);
                }
            })

        })

        photoBut.addEventListener('click', function(ev) {
            takepicture();
            ev.preventDefault();
        }, false);

        //sets everything back to default
        
        clearBut.addEventListener('click', function(ev) {
            photos.innerHTML = '';
            filter = 'none';
            video.style.filter = filter;
            FilterBut.selectedIndex = 0;
        });
        FilterBut.addEventListener('change', function(ev) {
            filter = ev.target.value;
            video.style.filter = filter;
            ev.preventDefault();
        });

        function takepicture() {
            const context = canvas.getContext('2d');
            if (width && height) {
               canvas.width = width;
               canvas.height = height;
               context.drawImage(video, 0, 0, width, height);

               const data = canvas.toDataURL('image/png');
               
               const img = document.createElement('img');
               img.setAttribute('src', data);
               img.style.filter = filter;
               photos.appendChild(img);
            } else {
                clearphoto();
            }
        }
    // }