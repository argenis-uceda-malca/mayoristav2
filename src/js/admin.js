//const { on } = require("gulp");

document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    AddProducto();
    ActualizarProducto();
    verificarLogin();
    editarTabla();
    ObtenerProductoPorId();
    ActualizarProductoModal();
    EstadoModal();
    ActualizarColaboradorModal();
    ActualizarColaborador();
    ActualizarCategoriaModal();
    ActualizarCategoria();
    AddCategoria();
    ActualizarMarcaModal();
    AddMarca();
    ActualizarMarca();
    //nuevoMostrarDatosUserModal();
    AddColaborador();
    UpdateStado();
    getUsuario();
    //report();
}

function verificarLogin() {
    $('#login').on('submit', function (e) {

        e.preventDefault();
        var datos = $(this).serializeArray();
        //alert("hola");
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: "/login",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.resultado == 'exito') {
                    swal.fire(
                        {
                            icon: 'success',
                            title: 'Login Exitoso',
                            text: 'Bienvenido ' + resultado.usuario,
                            showConfirmButton: false,
                        }
                    )
                    setTimeout(function () {
                        window.location.href = '/admin';
                    }, 600);
                }
                if (resultado.resultado == 'error') {
                    swal.fire(
                        'Error',
                        'Password Incorrecto o Usuario No existente',
                        'error'
                    )
                }
            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });
    });
}

function editarTabla() {
    $('#registro').DataTable({
        dom: "Bfrti",
        buttons: {
            dom: {
                button: {
                    className: "btn"
                }
            },
            buttons: [
                {
                    extend: "excel",              // Extend the excel button
                    text: "Generar Excel",
                    className: "btn btn-outline-success ",
                    excelStyles: {                // Add an excelStyles definition
                        template: "blue_medium",  // Apply the 'blue_medium' template
                    },
                },
            ],
        },
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': false,
        'pageLength': 1000,

        'language': {
            info: "Mostrando del _START_ al _END_ de _TOTAL_ resultados",
            emptyaTable: "No hay registros",
            infoEmpty: "0 Registros",
            search: "Buscar",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            lengthMenu: "Mostrar _MENU_ registros",
            paginate: {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },

        }

    });
}

function ObtenerProductoPorId() {
    $('.btnModal').on('click', function () {
        var ventaId = $(this).data("id");
        //console.log(ventaId);
        $.ajax({
            method: "POST",
            url: "/getInfo",
            data: {
                ventaId: ventaId
            },
            success: function (data) {
                var jsonOriginal = data;

                const json = JSON.parse(jsonOriginal);

                $(".del").remove();

                var table_header = $('#MyModaltable_header').find('.table tbody');

                json.ventas.forEach(function (comprador) {
                    table_header.append('<tr class="del"><td class="text-center">' + comprador.nombres + '</td><td class="text-center">' + comprador.apellidos + '</td><td class="text-center">' + comprador.telefono + '</td><td class="text-center">S/. ' + comprador.total + '</td></tr>');
                });

                var table = $('#MyModaltable').find('.table tbody');

                json.detalle.forEach(function (rol) {
                    console.log(rol.ventaId);
                    table.append('<tr class="del"><td class="text-center">' + rol.nombre + '</td><td class="text-center">' + rol.categoria + '</td><td class="text-center">' + rol.cantidad + '</td><td class="text-center">S/. ' + rol.precio + '</td><td class="text-center">S/. ' + rol.total + '</td></tr>');
                });

            }
        });
    });

}

function ActualizarProducto() {

    $('#editarProducto').on('submit', function (e) {
        e.preventDefault();
        //alert("hola");
        //var datos = $(this).serializeArray();
        var datos = new FormData(this);

        $.ajax({
            type: 'POST',
            data: datos,
            url: "/editarProducto",
            dataType: 'json',
            /* When Ajax*/
            contentType: false,
            //para enviar imagenes processdata debe ser false
            processData: false,
            async: true,
            // no cachear la página al request
            cache: false,
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.resultado == 'exito') {
                    swal.fire(
                        'Exito',
                        'Actualizado correctamente ',
                        'success'
                    )
                    setTimeout(function () {
                        window.location.href = '/viewProducto';
                    }, 600);

                }
                if (resultado.resultado == 'error') {
                    swal.fire(
                        'Error',
                        'Error al Actualizar',
                        'error'
                    )
                }
            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });
    });
}

function AddProducto() {
    $('#addProducto').on('submit', function (e) {
        e.preventDefault();
        //alert("hola");
        //var datos = $(this).serializeArray();
        var datos = new FormData(this);
        console.log(datos);

        $.ajax({
            type: 'POST',
            data: datos,
            url: "/addProducto",
            dataType: 'json',
            /* When Ajax*/
            contentType: false,
            //para enviar imagenes processdata debe ser false
            processData: false,
            async: true,
            // no cachear la página al request
            cache: false,
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.resultado == 'exito') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 900,
                        //timerProgressBar: true,
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Registrado Corectamente'
                    })
                    setTimeout(function () {
                        window.location.href = '/viewProducto';
                    }, 900);

                }
                if (resultado.resultado == 'error') {
                    swal.fire(
                        'Error',
                        'Error al agregar',
                        'error'
                    )
                }
            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });
    });
}

function ActualizarProductoModal() {
    $('.editbtn').on('click', function (e) {
        $tr = $(this).closest("tr");
        var datos = $tr.children("td").map(function () {
            return $(this).text();
        });

        $cat = $(this).data("idcategoria");
        //console.log(datos);
        //console.log(datos[3]);
        $('#id').val(datos[0]);
        $('#nombre').val(datos[1]);
        $('#precio').val(datos[2]);
        $('#idcategoria').text(datos[3]);
        $('#idcategoria').val($cat);
        $('#stock').val(datos[5]);

    });
}

function ActualizarCategoriaModal() {
    $('.editbtnCategoria').on('click', function (e) {
        $tr = $(this).closest("tr");
        var datos = $tr.children("td").map(function () {
            return $(this).text();
        });
        //console.log(datos);
        $('#id').val(datos[0]);
        //$('#idcategoria').text(datos[1]);
        $('#nombre').val(datos[1]);
        $('#descripcion').val(datos[2]);
    });
}

function ActualizarCategoria() {
    $('#editarCategoria').on('submit', function (e) {
        e.preventDefault();
        //alert("hola");
        var datos = $(this).serializeArray();

        $.ajax({
            type: 'POST',
            data: datos,
            url: "/addEditarCategoria",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.resultado == 'exito') {
                    swal.fire(
                        'Exito',
                        'Actualizado correctamente ',
                        'success'
                    )
                    setTimeout(function () {
                        window.location.href = '/viewCategorias';
                    }, 600);

                }
                if (resultado.resultado == 'error') {
                    swal.fire(
                        'Error',
                        'Error al Actualizar',
                        'error'
                    )
                }
            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });
    });
}

function AddCategoria() {
    $('#addcategoria').on('submit', function (e) {
        e.preventDefault();
        //alert("hola");
        var datos = $(this).serializeArray();
        console.log(datos);
        $.ajax({
            type: 'POST',
            data: datos,
            url: "/addEditarCategoria",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.resultado == 'exito') {
                    swal.fire(
                        'Registro Exitoso',
                        '',
                        'success'
                    )
                    setTimeout(function () {
                        window.location.href = '/viewCategorias';
                    }, 900);

                }
                if (resultado.resultado == 'alerta') {
                    swal.fire(
                        'Advertencia!!!',
                        'Ya existe un usuario con ese correo',
                        'warning'
                    )
                }
                if (resultado.resultado == 'error') {
                    swal.fire(
                        'Error',
                        'Error al agregar',
                        'error'
                    )
                }
            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });
    });
}

function ActualizarColaborador() {

    $('#editarColaborador').on('submit', function (e) {
        e.preventDefault();
        //alert("hola");
        var datos = $(this).serializeArray();

        $.ajax({
            type: 'POST',
            data: datos,
            url: "/addEditarColaborador",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.resultado == 'exito') {
                    swal.fire(
                        'Exito',
                        'Actualizado correctamente ',
                        'success'
                    ),
                        setTimeout(function () {
                            window.location.href = '/viewColaborador';
                        }, 600);

                }
                if (resultado.resultado == 'error') {
                    swal.fire(
                        'Error',
                        'Error al Actualizar',
                        'error'
                    )
                }
            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });
    });
}

function ActualizarMarcaModal() {
    $('.editbtnMarca').on('click', function (e) {
        $tr = $(this).closest("tr");
        var datos = $tr.children("td").map(function () {
            return $(this).text();
        });
        //console.log(datos);
        $('#id').val(datos[0]);
        //$('#idMarca').text(datos[1]);
        $('#nombre').val(datos[1]);
        $('#descripcion').val(datos[2]);
    });
}

function ActualizarMarca() {
    $('#editarMarca').on('submit', function (e) {
        e.preventDefault();
        //alert("hola");
        var datos = $(this).serializeArray();

        $.ajax({
            type: 'POST',
            data: datos,
            url: "/addEditarMarca",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.resultado == 'exito') {
                    swal.fire(
                        'Exito',
                        'Actualizado correctamente ',
                        'success'
                    )
                    setTimeout(function () {
                        window.location.href = '/viewMarcas';
                    }, 600);

                }
                if (resultado.resultado == 'error') {
                    swal.fire(
                        'Error',
                        'Error al Actualizar',
                        'error'
                    )
                }
            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });
    });
}

function AddMarca() {
    $('#addMarca').on('submit', function (e) {
        e.preventDefault();
        //alert("hola");
        var datos = $(this).serializeArray();
        console.log(datos);
        $.ajax({
            type: 'POST',
            data: datos,
            url: "/addEditarMarca",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.resultado == 'exito') {
                    swal.fire(
                        'Registro Exitoso',
                        '',
                        'success'
                    )
                    setTimeout(function () {
                        window.location.href = '/viewMarcas';
                    }, 900);

                }
                if (resultado.resultado == 'alerta') {
                    swal.fire(
                        'Advertencia!!!',
                        'No se puede registrar',
                        'warning'
                    )
                }
                if (resultado.resultado == 'error') {
                    swal.fire(
                        'Error',
                        'Error al agregar',
                        'error'
                    )
                }
            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });
    });
}

function AddColaborador() {
    $('#addColaborador').on('submit', function (e) {
        e.preventDefault();
        //alert("hola");
        var datos = $(this).serializeArray();
        console.log(datos);
        $.ajax({
            type: 'POST',
            data: datos,
            url: "/crear-usuario",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.resultado == 'exito') {
                    swal.fire(
                        'Registro Exitoso',
                        'Bienvenido',
                        'success'
                    )
                    setTimeout(function () {
                        window.location.href = '/viewColaborador';
                    }, 900);

                }
                if (resultado.resultado == 'alerta') {
                    swal.fire(
                        'Advertencia!!!',
                        'Ya existe un usuario con ese correo',
                        'warning'
                    )
                }
                if (resultado.resultado == 'error') {
                    swal.fire(
                        'Error',
                        'Error al agregar',
                        'error'
                    )
                }
            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });
    });
}

function ActualizarColaboradorModal() {
    $('.editColaboradorbtn').on('click', function (e) {
        $tr = $(this).closest("tr");
        var datos = $tr.children("td").map(function () {
            return $(this).text();
        });

        //console.log($cat);
        console.log(datos);
        $('#id').val(datos[0]);
        $('#nombre').val(datos[1]);
        $('#apellido').val(datos[2]);
        $('#email').val(datos[3]);
        $('#telefono').val(datos[4]);


    });
}

function nuevoMostrarDatosUserModal() {
    $('.editColaboradorbtn').on('click', function (e) {
        e.preventDefault();
        $tr = $(this).closest("tr");
        var datos = $tr.children("td").map(function () {
            return $(this).text();
        });
        $email = datos[3];
        console.log($email);
        $.ajax({
            type: 'POST',
            data: $email,
            url: "/getInfoUser",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var resultado = data;

            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });
    });
}

function getUsuario() {
    $('#editarCuenta').on('submit', function (e) {
        e.preventDefault();
        //alert("hola");
        var datos = $(this).serializeArray();
        console.log(datos);
        $.ajax({
            type: 'POST',
            data: datos,
            url: "/cuenta",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.resultado == 'exito') {
                    swal.fire(
                        'Registro Exitoso',
                        'Actualizado Correctamente',
                        'success'
                    )
                    setTimeout(function () {
                        window.location.href = '/viewProducto';
                    }, 900);

                }
                if (resultado.resultado == 'alerta') {
                    swal.fire(
                        'Error!!!',
                        'La contraseña actual no es correcta',
                        'warning'
                    )
                }
                if (resultado.resultado == 'error') {
                    swal.fire(
                        'Error',
                        'Error al agregar',
                        'error'
                    )
                }
            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });

    });
}

function report() {
    $('#report').on('submit', function (e) {
        e.preventDefault();
        //alert("hola");
        var datos = $(this).serializeArray();
        console.log(datos);
        $.ajax({
            type: 'POST',
            data: datos,
            url: "/report",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var resultado = data;
            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });
    });
}

function EstadoModal() {
    $('.btnModalEstado').on('click', function (e) {

        $id = $(this).data('id')
        //console.log($cat);
        console.log($id);
        $('#id').val($id);

    });
}

function UpdateStado() {
    $('#updateEstado').on('submit', function (e) {
        e.preventDefault();
        //alert("hola");
        var datos = $(this).serializeArray();
        console.log(datos);
        $.ajax({
            type: 'POST',
            data: datos,
            url: "/updateEstado",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.resultado == 'exito') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 900,
                        //timerProgressBar: true,
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Estado actualizado'
                    })
                    setTimeout(function () {
                        window.location.href = '/admin';
                    }, 900);

                }
                if (resultado.resultado == 'alerta') {
                    swal.fire(
                        'Advertencia!!!',
                        'Ya existe un usuario con ese correo',
                        'warning'
                    )
                }
                if (resultado.resultado == 'error') {
                    swal.fire(
                        'Error',
                        'Error al agregar',
                        'error'
                    )
                }
            },
            error: function (e) {
                swal.fire(
                    'UPS!!!',
                    'Lo sentimos hubo un error inesperado',
                    'error'
                )
            }
        });
    });
}

function ValidateInput(array) {

    for (i in array) {
        if (array[i].value == "") {
            $('#nombre').addClass('is-invalid');

        } else {
            console.log('nombre lleno');
        }
    }


}
