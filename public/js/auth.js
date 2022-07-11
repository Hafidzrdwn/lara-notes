$(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

  function showErrorValidator(msg) {
                $('#alert-zone').html(
                    `
                    <div class="alert alert-danger alert-dismissible fade show alert-error d-none" role="alert">
                        <ul></ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `
                );
                $('.alert-error').removeClass('d-none');
                $('.alert-error ul').html('');

                if(msg.type == "list") {
                    $.each(msg.error, function(key, value) {
                        $(`#${key}`).addClass('is-invalid');
                        $('.alert-error ul').append(`<li>${value}</li>`);
                    });
                } else {
                    $('.alert-error ul').replaceWith(msg.error);
                }

            }

            $('.btn-submit-auth').click(function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let formData = form.serializeArray();
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    beforeSend: function() {
                        $('.btn-submit-auth').hide();
                        $('.btn-loading').removeClass('d-none');
                    },
                    complete: function() {
                        $('.btn-submit-auth').show();
                        $('.btn-loading').addClass('d-none');
                    },
                    success: function(data) {
                        formData.map(dt => {
                            $(`#${dt.name}`).removeClass('is-invalid');
                        });
                        if (data.error) {
                            showErrorValidator(data);
                        }else {
                            document.location.href = data.redirect
                        }
                    },
                    error: function(err) {
                        alert(`${err.status} ${err.statusText}`)
                    }
                });
            });
        });