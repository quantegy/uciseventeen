jQuery(function ($) {
    var $uploadButton = $('#jumbotron-upload-button');
    var $removeButton = $('#jumbotron-remove-button');
    var $fileFrame;

    $uploadButton.on('click', function(event) {
        event.preventDefault();

        if($fileFrame) {
            $fileFrame.open();

            return;
        }

        $fileFrame = wp.media({
            title: 'Select or upload image',
            button: {text: 'Use this image'},
            multiple: false
        });

        $fileFrame.on('select', function() {
            var attachment = $fileFrame.state().get('selection').first().toJSON();

            $('.jumbotron-preview').html('<img class="jumbotron-image" src="' + attachment.url + '" style="max-width: 100%;">');

            $('#jumbotron-media-id').val(attachment.id);

            $('#jumbotron-upload-button').css('display', 'none');
            $('#jumbotron-remove-button').css('display', 'block');
            $('#save-crop-button').css('display', 'block');
        });

        $fileFrame.open();
    });

    $removeButton.on('click', function(event) {
        event.preventDefault();

        $('.jumbotron-preview').html('');

        $('#jumbotron-media-id').val('');

        $('#jumbotron-upload-button').css('display', 'block');
        $('#jumbotron-remove-button').css('display', 'none');
        $('#save-crop-button').css('display', 'none');
    });

    $('.jumbotron-image').cropper({
        aspectRatio: 16/5,
        ready: function() {

        }
    });
});