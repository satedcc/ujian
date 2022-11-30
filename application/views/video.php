<html>

<head>
    <script src="https://www.webrtc-experiment.com/RecordRTC.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <style>
        video {
            max-width: 100%;
            border: 5px solid yellow;
            border-radius: 9px;
        }

        h1 {
            color: yellow;
        }

        .video-record {
            /* display: none; */
        }
    </style>
</head>

<body>
    <h1 id="header">RecordRTC Upload to PHP</h1>
    <video class="video-record" id="your-video-id" controls autoplay playsinline></video>

    <script type="text/javascript">
        // capture camera and/or microphone
        navigator.mediaDevices.getUserMedia({
            video: true,
            audio: true
        }).then(function(camera) {

            // preview camera during recording
            document.getElementById('your-video-id').muted = false;
            document.getElementById('your-video-id').srcObject = camera;

            // recording configuration/hints/parameters
            var recordingHints = {
                type: 'video'
            };

            // initiating the recorder
            var recorder = RecordRTC(camera, recordingHints);

            // starting recording here

            setInterval(() => {
                recorder.startRecording();

                // auto stop recording after 5 seconds
                var milliSeconds = 5 * 1000;
                setTimeout(function() {
                    // stop recording
                    recorder.stopRecording(function() {

                        // get recorded blob
                        var blob = recorder.getBlob();

                        // generating a random file name
                        var fileName = getFileName('webm');

                        // we need to upload "File" --- not "Blob"
                        var fileObject = new File([blob], fileName, {
                            type: 'video/webm'
                        });

                        var formData = new FormData();

                        // recorded data
                        formData.append('video-blob', fileObject);

                        // file name
                        formData.append('video-filename', fileObject.name);


                        var upload_url = '<?= base_url('soal/uploadVideo/') ?>';
                        // var upload_url = 'RecordRTC-to-PHP/save.php';

                        var upload_directory = upload_url;
                        // var upload_directory = 'RecordRTC-to-PHP/uploads/';

                        // upload using jQuery
                        $.ajax({
                            url: upload_url, // replace with your own server URL
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: 'POST',
                            success: function(response) {
                                $("body").html(response)
                            }
                        });



                    });

                }, milliSeconds);
            }, 5 * 60 * 1000);
        });

        // this function is used to generate random file name
        function getFileName(fileExtension) {
            var d = new Date();
            var year = d.getUTCFullYear();
            var month = d.getUTCMonth();
            var date = d.getUTCDate();
            return 'RecordRTC-' + year + month + date + '-' + getRandomString() + '.' + fileExtension;
        }

        function getRandomString() {
            if (window.crypto && window.crypto.getRandomValues && navigator.userAgent.indexOf('Safari') === -1) {
                var a = window.crypto.getRandomValues(new Uint32Array(3)),
                    token = '';
                for (var i = 0, l = a.length; i < l; i++) {
                    token += a[i].toString(36);
                }
                return token;
            } else {
                return (Math.random() * new Date().getTime()).toString(36).replace(/\./g, '');
            }
        }
    </script>


    <footer style="margin-top: 20px;"><small id="send-message"></small></footer>
    <script src="https://www.webrtc-experiment.com/common.js"></script>

</body>

</html>