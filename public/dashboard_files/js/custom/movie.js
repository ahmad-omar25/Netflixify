$(document).ready(function () {

    $('#movie_file_input').on('change', function () {

        $('#movie_upload_wrapper').css('display', 'none');

        $('#movie_properties').css('display', 'block');

        var url = $(this).data('url');

        var movie = this.files[0];

        var movieId = $(this).data('movie-id');

        var movieName = movie.name.split('.').slice(0, -1).join('.');

        $('#movie_name').val(movieName);

        var formData = new FormData();
        formData.append('movie_id', movieId);
        formData.append('name', movieName);
        formData.append('movie', movie);
        $.ajax({
            url: url,
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            success: function (movieBeforeProcessing) {
                var interval = setInterval(function () {
                    $.ajax({
                        url: `/dashboard/movies/${movieBeforeProcessing.id}`,
                        method: 'GET',
                        success: function (movieWhileProcessing) {
                            $('#movie_upload_status').html('Processing');
                            $('#movie_upload_progress').css('width', movieWhileProcessing.percent + '%');
                            $('#movie_upload_progress').html(movieWhileProcessing.percent + '%');
                            if (movieWhileProcessing.percent == 100) {
                                clearInterval(interval);
                                $('#movie_upload_status').html('Done Processing');
                                $('#movie_upload_progress').parent().css('display', 'none');
                                $('#movie_submit_btn').css('display', 'block');
                            }
                        }
                    });
                }, 3000)
            },
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round(evt.loaded / evt.total * 100) + "%";
                        $('#movie_upload_progress').css('width', percentComplete).html(percentComplete)
                    }
                }, false);
                return xhr;
            }
        })

    })// end of movie_file_input

});// end of document ready
