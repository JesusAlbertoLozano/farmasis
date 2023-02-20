$(document).ready(function(){
  $.ajax({
    type: 'POST',
    url: 'php/cargar_listas.php'
  })
  .done(function(listas_rep){
    $('#local').html(listas_rep)
  })
  .fail(function(){
    alert('Hubo un errror al cargar las locales')
  })

  $('#local').on('change', function(){
    var id = $('#local').val()
    $.ajax({
      type: 'POST',
      url: 'php/cargar_videos.php',
      data: {'id': id}
    })
    .done(function(listas_rep){
      $('#vendedor').html(listas_rep)
    })
    .fail(function(){
      alert('Hubo un errror al cargar los vendedores')
    })
  })

  $('#enviar').on('click', function(){
    var resultado = 'Lista de locales: ' + $('#local option:selected').text() +
    ' vendeor elegido: ' + $('#vendedor option:selected').text()

    $('#resultado1').html(resultado)
  })

})