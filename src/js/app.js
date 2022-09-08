let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

const venta = {
    id: '',
    total: '',
    fecha: '',
}
document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    //mostrarSeccion(); // Muestra y oculta las secciones
    //tabs(); // Cambia la sección cuando se presionen los tabs
    //botonesPaginador(); // Agrega o quita los botones del paginador
    //paginaSiguiente(); 
    //paginaAnterior();
    eliminarCarrito();
    cambiarCantidad();
    Verificarcheckbox();
    VerificarcheckboxDelivery();
    confirmarCheckup();

    //consultarAPI(); // Consulta la API en el backend de PHP

    //idCliente();
    //nombreCliente(); // Añade el nombre del cliente al objeto de cita
    //seleccionarFecha(); // Añade la fecha de la cita en el objeto
    //seleccionarHora(); // Añade la hora de la cita en el objeto

    //mostrarResumen(); // Muestra el resumen de la cita
    //VerificarCantidad();
}

function mostrarSeccion() {

    // Ocultar la sección que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    // Seleccionar la sección con el paso...
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if (tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    // Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs() {

    // Agrega y cambia la variable de paso según el tab seleccionado
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            e.preventDefault();

            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();

            botonesPaginador();
        });
    });
}

function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if (paso === 1) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 3) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');

        mostrarResumen();
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function () {

        if (paso <= pasoInicial) return;
        paso--;

        botonesPaginador();
    })
}
function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function () {

        if (paso >= pasoFinal) return;
        paso++;

        botonesPaginador();
    })
}

function eliminarCarrito() {
    $('.btnEliminar').on('click', function () {
        var id = $(this).data("id");
        var precio = $(this).data("precio");
        var cantidad = $(this).data("cantidad");
        var oldValue = $(this).parent().parent().find('input').val();
        var total = precio * oldValue;
        var boton = $('#btnEliminar' + id);

        console.log(oldValue);

        actualizarTotal(total, 0);
        $.ajax({
            method: "POST",
            url: "/eliminarCarrito",
            data: {
                id: id
            }
        }).done(function (respuesta) {
            boton.parent('td').parent('tr').remove();
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 900,
                //timerProgressBar: true,
            })

            Toast.fire({
                //icon: 'success',
                title: 'Eliminado'
            })
        });
    });
}

function cambiarCantidad() {
    $('.txtCantidad').keyup(function () {
        var cantidad = $(this).val();
        var precio = $(this).data('precio');
        var id = $(this).data('id');

        if (cantidad == "") {
            $(this).val(parseFloat(0));
            cantidad = 0;
            //console.log($(this).val(parseFloat(0)));
        }

        incrementar(cantidad, precio, id, 3);


    });
    $('.qtybtn').click(function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        var estado;
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
            estado = false;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                estado = false;
                var newVal = parseFloat(oldValue) - 1;
                if (oldValue == 1) {
                    //$button.css('pointer-events', 'none');
                    //$button.css('cursor', 'not-allowed');
                    //$button.off("click");
                }
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);

        var precio = $(this).parent('div').find('input').data('precio');
        var id = $(this).parent('div').find('input').data('id');
        var cantidad = $(this).parent('div').find('input').val();

        //console.log(precio);
        //console.log(newVal);

        if ($button.hasClass('inc')) {
            incrementar(cantidad, precio, id, 1);
        } else {
            if (estado == false) {
                if (cantidad == 0) {
                    estado = true;
                }
                incrementar(cantidad, precio, id, 2);
            }
        }
    });
}

function incrementar(cantidad, precio, id, operacion) {

    var inicio = $(".cant" + id).text();
    var mul = parseFloat(cantidad) * parseFloat(precio);
    $(".cant" + id).text(mul.toFixed(2));

    if (operacion == 3) {
        var resultado = parseInt(mul) - parseInt(inicio);
        /* console.log(mul);
         console.log(inicio);
         console.log(resultado);*/
        actualizarTotal(resultado, operacion);
    } else {
        if (cantidad >= 0) {
            actualizarTotal(precio, operacion);
        }
    }
    $.ajax({
        method: "POST",
        url: "/actualizarCarrito",
        data: {
            id: id,
            cantidad: cantidad
        }
    }).done(function (respuesta) {

    });
}

function actualizarTotal(mul, operacion) {

    /*const total2 = document.getElementById("totalCarrito");
    var monto = $(total2).data("total");*/
    var total = parseFloat($("#totalCarrito").text());
    if (operacion == 0) {
        console.log(total);
        console.log(mul);
        var totalNuevo = total - mul;
    } else if (operacion == 1) {
        var totalNuevo = mul + total;
        console.log("suma");
    } else if (operacion == 2) {
        var totalNuevo = total - mul;
        console.log("resta");
    } else {
        var totalNuevo = total + mul;
    }
    $("#totalCarrito").text(totalNuevo.toFixed(2));
    $(".totalCarrito").text(totalNuevo.toFixed(2));

}

function Verificarcheckbox() {
    $('#acc-or').click(function () {
        var miCheckbox = $(this);

        if (miCheckbox.prop('checked')) {
            $(this).prop('value', '1');
        } else {
            $(this).prop('value', '0');
        }
    });
}

function VerificarcheckboxDelivery() {
    var total = parseFloat($("#granTotal").val());
    //alert(total);
    //$('#payment').prop('value', '0');

    $('#payment').click(function () {
        var miCheckbox = $(this);
        //alert("asd");

        if (total < 60) {
            $("#payment").prop("checked", false);
            $(this).prop('value', '0');
        } else {
            if (miCheckbox.prop('checked')) {
                $(this).prop('value', '1');
                //alert("valor 1");
            } else {
                $(this).prop('value', '12');
                //alert("valor 0");
            }
        }


        /*if (miCheckbox.prop('checked')) {
            $(this).prop('value', '1');
        } else {
            $(this).prop('value', '0');
        }*/
    });
}

function confirmarCheckup() {
    $('#crearVenta').on('submit', function (e) {
        e.preventDefault();
        //alert("hola");
        var datos = $(this).serializeArray();
        console.log(datos);
        $.ajax({
            type: 'POST',
            data: datos,
            url: "/crearVenta",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var resultado = data;
                if (resultado.resultado == 'contraentrega') {
                    swal.fire(
                        'Registro Exitoso',
                        'Hemos recibido su pedido, estaremos llamandolo en los próximos minutos',
                        'success'
                    )
                    setTimeout(function () {
                        window.location.href = '/';
                    }, 5000);

                }
                if (resultado.resultado == 'resumen') {
                    window.location.href = '/resumen?id=' + resultado.id;
                }
                if (resultado.resultado == 'resumen2') {
                    window.location.href = '/resumen2?id=' + resultado.id;
                    //console.log(resultado.busqueda);
                }

                if (resultado.resultado == 'vacio') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        //timerProgressBar: true,
                    })

                    Toast.fire({
                        icon: 'warning',
                        title: 'Complete todos los campos'
                    })
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

async function consultarAPI() {
    try {
        const url = 'http://localhost:3000/api/servicios';
        //const url = 'http://localhost:9000/api/';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        //mostrarServicios(servicios);
        mostrarProductos(servicios);

    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach(servicio => {
        const { id, nombre, precio } = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id; // data-id-servicio = id
        servicioDiv.onclick = function () {
            seleccionarServicio(servicio);
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);

    });
}

function mostrarProductos(servicios) {
    servicios.forEach(producto => {
        const { id, nombre, precio } = producto;

        const nombreProducto = document.createElement('H6');

        const tabpane = document.createElement('DIV');
        const conw31 = document.createElement('DIV');
        const colmd3 = document.createElement('DIV');
        const colm = document.createElement('DIV');
        const a = document.createElement('a');
        const img = document.createElement('img');
        const offer = document.createElement('DIV');
        const p_ofter = document.createElement('P');
        const span_ofter = document.createElement('span');
        const mid1 = document.createElement('DIV');
        const women = document.createElement('DIV');
        const mid2 = document.createElement('DIV');
        const p = document.createElement('P');
        const block = document.createElement('DIV')
        const starbox = document.createElement('DIV');
        const clearfix = document.createElement('clearfix');
        const add = document.createElement('DIV');
        const button = document.createElement('button');


        button.setAttribute("data-id", id);
        button.setAttribute("data-name", "Moong");
        button.setAttribute("data-summary", "summary 1");
        button.setAttribute("data-price", "1.50");
        button.setAttribute("data-quantity", "1");
        button.setAttribute("data-image", "img/of.png");
        button.setAttribute("onclick", "window.location.href='/cart'");

        a.setAttribute("href", "#");
        a.setAttribute("data-toggle", "modal");
        a.setAttribute("data-target", "#myModal1");

        img.setAttribute("alt", "")
        img.setAttribute("src", "/build/img/of.png")

        nombreProducto.textContent = nombre + ' ID: ' + id;
        p.textContent = 'S/.' + precio;
        button.textContent = 'Agregar Producto'
        span_ofter.textContent = 'Oferta';

        tabpane.classList.add('tab-pane', 'active', 'text-style')
        conw31.classList.add('con-w3l');
        colmd3.classList.add('col-md-3', 'm-wthree');
        colm.classList.add('col-m');
        a.classList.add('offer-img');
        img.classList.add('img-responsive');
        offer.classList.add('offer');
        mid1.classList.add('mid-1');
        women.classList.add('women');
        mid2.classList.add('mid-2');
        block.classList.add('block');
        starbox.classList.add('starbox', 'small', 'ghosting');
        clearfix.classList.add('clearfix');
        add.classList.add('add');
        button.classList.add('btn', 'btn-danger', 'my-cart-btn', 'my-cart-b');

        tabpane.appendChild(conw31);
        conw31.appendChild(colmd3);
        colmd3.appendChild(colm);

        colm.appendChild(a);
        a.appendChild(img);
        a.appendChild(offer);
        offer.appendChild(p_ofter);
        p_ofter.appendChild(span_ofter);
        colm.appendChild(mid1);
        mid1.appendChild(women);
        women.appendChild(nombreProducto);

        colm.appendChild(mid2);
        mid2.appendChild(p);
        mid2.appendChild(block);
        block.appendChild(starbox);
        mid2.appendChild(clearfix);

        colm.appendChild(add);
        add.appendChild(button);

        document.querySelector('#tabProdcutos').appendChild(tabpane);

    });
}

function seleccionarServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita;

    // Identificar el elemento al que se le da click
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    // Comprobar si un servicio ya fue agregado 
    if (servicios.some(agregado => agregado.id === id)) {
        // Eliminarlo
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove('seleccionado');
    } else {
        // Agregarlo
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add('seleccionado');
    }
    // console.log(cita);
}

function idCliente() {
    cita.id = document.querySelector('#id').value;
}
function nombreCliente() {
    cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function (e) {

        const dia = new Date(e.target.value).getUTCDay();

        if ([6, 0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Fines de semana no permitidos', 'error', '.formulario');
        } else {
            cita.fecha = e.target.value;
        }

    });
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function (e) {


        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        if (hora < 10 || hora > 18) {
            e.target.value = '';
            mostrarAlerta('Hora No Válida', 'error', '.formulario');
        } else {
            cita.hora = e.target.value;

            // console.log(cita);
        }
    })
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {

    // Previene que se generen más de 1 alerta
    const alertaPrevia = document.querySelector('.alerta');
    if (alertaPrevia) {
        alertaPrevia.remove();
    }

    // Scripting para crear la alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if (desaparece) {
        // Eliminar la alerta
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }

}


function mostrarResumen() {
    const resumen = document.querySelector('.contenido-resumen');

    // Limpiar el Contenido de Resumen
    while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    if (Object.values(cita).includes('') || cita.servicios.length === 0) {
        mostrarAlerta('Faltan datos de Servicios, Fecha u Hora', 'error', '.contenido-resumen', false);

        return;
    }

    // Formatear el div de resumen
    const { nombre, fecha, hora, servicios } = cita;



    // Heading para Servicios en Resumen
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de Servicios';
    resumen.appendChild(headingServicios);

    // Iterando y mostrando los servicios
    servicios.forEach(servicio => {
        const { id, precio, nombre } = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    });

    // Heading para Cita en Resumen
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita';
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    // Formatear la fecha en español
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia));

    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
    const fechaFormateada = fechaUTC.toLocaleDateString('es-MX', opciones);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

    // Boton para Crear una cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    resumen.appendChild(botonReservar);
}

async function reservarCita() {

    const { nombre, fecha, hora, servicios, id } = cita;

    const idServicios = servicios.map(servicio => servicio.id);
    // console.log(idServicios);

    const datos = new FormData();

    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuarioId', id);
    datos.append('servicios', idServicios);

    // console.log([...datos]);

    try {
        // Petición hacia la api
        const url = 'http://localhost:3000/api/citas'
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        console.log(resultado);

        if (resultado.resultado) {
            Swal.fire({
                icon: 'success',
                title: 'Cita Creada',
                text: 'Tu cita fue creada correctamente',
                button: 'OK'
            }).then(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            })
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al guardar la cita'
        })
    }


    // console.log([...datos]);

}

function VerificarCantidad() {
    var total_col = 0;

    //Recorro todos los tr ubicados en el tbody
    $('#ejemplo').find('tr').each(function (i, el) {

        //Voy incrementando las variables segun la fila ( .eq(0) representa la fila 1 )     
        total_col += parseFloat($(this).find('td').eq(4).text());

    });
    //Muestro el resultado en el th correspondiente a la columna

    console.log(total_col);


}


