import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";
import { Dropdown } from "bootstrap";

const formulario = document.querySelector('form');
const tablaCitas = document.getElementById('tablaCitas');
const btnBuscar = document.getElementById('btnBuscar');
const btnVerDetalle = document.getElementById('btnVerDetalle');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('divTabla');

// btnModificar.disabled = true;
// btnVerDetalle.parentElement.style.display = 'none';


const guardar = async (evento) => {


    evento.preventDefault();
    if (!validarFormulario(formulario, ['cita_id','cita_fecha'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    body.delete('cita_id');
    const url = '/final_IS2_Franco/API/citas/guardar';
    const config = {
        method: 'POST',
        body
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        console.log(data);

        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success';
                // buscar();
                break;

            case 0:
                icon = 'error';
                console.log(detalle);
                break;

            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        });

    } catch (error) {
        console.log(error);
    }
};

const buscar = async () => {

    let cita_fecha = formulario.cita_fecha.value;
    const url = `/final_IS2_Franco/API/citas/buscar?cita_fecha=${cita_fecha}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data)

        tablaCitas.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();

        if (data.length > 0) {
            let contador = 1;
            data.forEach(cita => {
                // CREAMOS ELEMENTOS
                const tr = document.createElement('tr');
                const td1 = document.createElement('td');
                const td2 = document.createElement('td');
                const td3 = document.createElement('td');
              
              
                const td4 = document.createElement('td');
                const buttonModificar = document.createElement('button');
                const buttonEliminar = document.createElement('button');

                // CARACTERISTICAS A LOS ELEMENTOS
                buttonModificar.classList.add('btn', 'btn-warning');
                buttonEliminar.classList.add('btn', 'btn-danger');
                buttonModificar.textContent = 'Modificar';
                buttonEliminar.textContent = 'Eliminar';

                buttonModificar.addEventListener('click', () => colocarDatos(cita));
                buttonEliminar.addEventListener('click', () => eliminar(cita.cita_id));

                td1.innerText = contador;
                td2.innerText = cita.cita_fecha;

                // ESTRUCTURANDO DOM
                td3.appendChild(buttonModificar);
                td4.appendChild(buttonEliminar);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);

                fragment.appendChild(tr);

                contador++;
            });
        } else {
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.innerText = 'No existen registros';
            td.colSpan = 5;
            tr.appendChild(td);
            fragment.appendChild(tr);
        }

        tablaCitas.tBodies[0].appendChild(fragment);
    } catch (error) {
        console.log(error);
    }
};

const colocarDatos = (datos) => {


    formulario.cita_fecha.value = datos.cita_fecha;
    formulario.cita_id.value = datos.cita_id;
    formulario.cita_paciente.value= datos.cita_paciente;
    formulario.cita_medico.value= datos.cita_medico

    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = 'none';
    btnBuscar.disabled = true;
    btnBuscar.parentElement.style.display = 'none';
    // btnVerDetalle.disabled = false;
    btnVerDetalle.parentElement.style.display = '';
    divTabla.style.display = 'none';

};

const cancelarAccion = () => {
    btnGuardar.disabled = false;
    btnGuardar.parentElement.style.display = '';
    btnBuscar.disabled = false;
    btnBuscar.parentElement.style.display = '';
    // btnVerDetalle.disabled = true;
    btnVerDetalle.parentElement.style.display = '';
   
    divTabla.style.display = '';
};

const modificar = async () => {
    if (!validarFormulario(formulario)) {
        alert('Debe llenar todos los campos');
        return;
    }

    const body = new FormData(formulario);
    const url = '/final_IS2_Franco/API/citas/modificar';
    const config = {
        method: 'POST',
        body
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        console.log(data)


        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        switch (codigo) {
            case 1:
          
                icon = 'success';
                formulario.reset();
                buscar();
                cancelarAccion();
       
                break;

            case 0:
                icon = 'error';
                console.log(detalle);
                break;

            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        });

        buscar()

    } catch (error) {
        console.log(error);
    }
};

const eliminar = async (id) => {
    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('cita_id', id);
        const url = '/final_IS2_Franco/API/citas/eliminar';
        const config = {
            method: 'POST',
            body
        };
        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            console.log(data);
            const { codigo, mensaje, detalle } = data;

            let icon = 'info';
            switch (codigo) {
                case 1:
                    icon = 'success';
                    formulario.reset()
                    buscar();
                    break;

                case 0:
                    icon = 'error';
                    console.log(detalle);
                    break;

                default:
                    break;
            }

            Toast.fire({
                icon,
                text: mensaje
            });

            buscar()

        } catch (error) {
            console.log(error);
        }
    }
};

formulario.addEventListener('submit', guardar );
btnVerDetalle.addEventListener('click', modificar);
