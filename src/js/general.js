
/*
$(document).ready(function() {
    $(".btnEliminar").click(function(event){
        event.preventDefault();
        var id = $(this).data("id");
        var boton = $(this);
        $.ajax({
            method: "POST",
            url: "/eliminarCarrito",
            data: {
                id: id
            }
        }).done(function(respuesta){
            boton.parent('td').parent('td').remove();
        });
    });

    
});
*/

(function () {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
  
          form.classList.add('was-validated')
        }, false)
      })
  })()
