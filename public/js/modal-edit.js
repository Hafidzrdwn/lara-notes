$(document).ready(function () { 

  $('.btnEdit').on('click', function() {

      const ws = $(this).data('ws')

      $.ajax({
        url: `/spaces/${ws}/projects?id=${$(this).data('prj-id')}`
        , type: 'GET'
        , dataType: 'json'
        , success: function(data) {
          console.log(data)
          $('#modalEdit').find('input[name="title"]').val(data.title)
          $('#modalEdit').find('select[name="category"] > option').each(
            function() {
              if ($(this).val() == data.category_id) {
                $(this).prop('selected', true)
              }
            })
          $('#modalEdit').find('input[name="security"]').prop('checked', data
            .security)
          $('#modalEdit').find('form').attr('action'
            , `/spaces/${ws}/projects/${data.slug}?page=${$('.btnEdit').data('page')}`
          )
        }
        , error: function(error) {
          console.log(error)
        }
      })
    })

})