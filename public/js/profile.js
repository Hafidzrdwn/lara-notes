$(document).ready(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    const modal = $('#cropProfilePhoto');
    const image = $('#sample_image');
    let cropper;

    $('#profile_image').on('change', function(event) {
      const reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]);
      reader.onload = function(e) {
        image.attr('src', e.target.result);
        modal.modal('show');
      };
    });

    modal.on('shown.bs.modal', function() {
      cropper = new Cropper(image[0], {
        aspectRatio: 1
        , viewMode: 3
        , preview: '.preview'
      });
    }).on('hidden.bs.modal', function() {
      cropper.destroy();
      cropper = null;
    });

    $('#save').click(function() {
      canvas = cropper.getCroppedCanvas({
        width: 600
        , height: 600
      });

      canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        const reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function(e) {
          let data = e.target.result;

          $.ajax({
            url: "/user/profile/image"
            , method: 'PUT'
            , data: {
              image: data
            }
            , beforeSend: function() {
              $('#save').addClass('disabled');
              $('#save').html('<i class="fas fa-spinner fa-spin"></i> Saving...');
            }
            , success: function(res) {
              $('#save').text('Save changes');
              $('#save').removeClass('disabled');
              modal.modal('hide');
              location.reload();
            }
          });
        };
      });
    });
  
  const social_cb = $('#social');

  function changeStateCb(state) {
    if ($(state).is(':checked')) {
      $('.social-label').text('Enabled');
      $('.row-social').removeClass('d-none');
    } else {
      $('.social-label').text('Disabled');
      $('.row-social').addClass('d-none');
    }
  }

  changeStateCb(social_cb);

  $(social_cb).on('change', function () {
    changeStateCb(social_cb);
  })

});
