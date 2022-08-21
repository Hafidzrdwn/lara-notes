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
                if (msg.type == "list") { 
                    $.each(msg.error, function(key, value) {
                        $(`#${key}`).addClass('border border-danger');
                        $('.alert-error ul').append(`<li>${value}</li>`);
                    });
                } else {
                    $('.alert-error ul').replaceWith(msg.error);
                }

                $.each(msg.error, function(key, value) {
                    $(`#${key}`).val('');
                });
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
                        $('.btn-submit-auth').addClass('disabled')
                        $('.btn-submit-auth').html('<i class="fas fa-spinner fa-spin"></i> Loading...')
                    },
                    success: function (data) {
                        formData.map(dt => {
                            $(`#${dt.name}`).removeClass('border border-danger');
                        });
                        $('.btn-submit-auth').removeClass('disabled')
                        if ($('.btn-submit-auth').hasClass('login')) {
                            $('.btn-submit-auth').html('Login');
                        } else {
                            $('.btn-submit-auth').html('Register');
                        }
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
    
    $('.icon-eye').click(function (e) { 
        $(this).toggleClass('fa-eye fa-eye-slash');
        $(`#${$(this).data('tag')}`).attr('type', ($(this).hasClass('fa-eye')) ? 'password' : 'text');
    })
});