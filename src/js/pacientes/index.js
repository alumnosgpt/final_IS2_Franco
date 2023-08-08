import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";
import { Dropdown } from "bootstrap";

const formulario = document.querySelector('form');
const tablaPacientes = document.getElementById('tablaPacientes');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('divTabla');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

const guardar = async (evento) => {


    evento.preventDefault();
    if (!validarFormulario(formulario, ['paciente_id'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    body.delete('paciente_id');
    const url = '/final_IS2_Franco/API/pacientes/guardar';
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

    } catch (error) {
        console.log(error);
    }
};

const buscar = async () => {

    let paciente_nombre = formulario.paciente_nombre.value;
    const url = `/final_IS2_Franco/API/pacientes/buscar?paciente_nombre=${paciente_nombre}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data)

        tablaPacientes.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();

        if (data.length > 0) {
            let contador = 1;
            data.forEach(paciente => {
                // CREAMOS ELEMENTOS
                const tr = document.createElement('tr');
                const td1 = document.createElement('td');
                const td2 = document.createElement('td');
                const td3 = document.createElement('td');
                const td4 = document.createElement('td');
                const td5 = document.createElement('td');
                const td6 = document.createElement('td');
              
              
            
                const buttonModificar = document.createElement('button');
                const buttonEliminar = document.createElement('button');

                // CARACTERISTICAS A LOS ELEMENTOS
                buttonModificar.classList.add('btn', 'btn-warning');
                buttonEliminar.classList.add('btn', 'btn-danger');
                buttonModificar.textContent = 'Modificar';
                buttonEliminar.textContent = 'Eliminar';

                buttonModificar.addEventListener('click', () => colocarDatos(paciente));
                buttonEliminar.addEventListener('click', () => eliminar(paciente.paciente_id));

                td1.innerText = contador;
                td2.innerText = paciente.paciente_nombre;
                td3.innerText = paciente.paciente_dpi;
                td4.innerText = paciente.paciente_telefono;



                // ESTRUCTURANDO DOM
                td5.appendChild(buttonModificar);
                td6.appendChild(buttonEliminar);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td6);


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

        tablaPacientes.tBodies[0].appendChild(fragment);
    } catch (error) {
        console.log(error);
    }
};

const colocarDatos = (datos) => {


    formulario.paciente_nombre.value = datos.paciente_nombre;
    formulario.paciente_id.value = datos.paciente_id;
    formulario.paciente_dpi.value= datos.paciente_dpi;
    formulario.paciente_telefono.value= datos.paciente_telefono

    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = 'none';
    btnBuscar.disabled = true;
    btnBuscar.parentElement.style.display = 'none';
    btnModificar.disabled = false;
    btnModificar.parentElement.style.display = '';
    btnCancelar.disabled = false;
    btnCancelar.parentElement.style.display = '';
    divTabla.style.display = 'none';

};

const cancelarAccion = () => {
    btnGuardar.disabled = false;
    btnGuardar.parentElement.style.display = '';
    btnBuscar.disabled = false;
    btnBuscar.parentElement.style.display = '';
    btnModificar.disabled = true;
    btnModificar.parentElement.style.display = 'none';
    btnCancelar.disabled = true;
    btnCancelar.parentElement.style.display = 'none';
    divTabla.style.display = '';
};

const modificar = async () => {
    if (!validarFormulario(formulario)) {
        alert('Debe llenar todos los campos');
        return;
    }

    const body = new FormData(formulario);
    const url = '/final_IS2_Franco/API/pacientes/modificar';
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
        body.append('paciente_id', id);
        const url = '/final_IS2_Franco/API/pacientes/eliminar';
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

buscar();
formulario.addEventListener('submit', guardar );
btnBuscar.addEventListener('click', buscar);
btnCancelar.addEventListener('click', cancelarAccion);
btnModificar.addEventListener('click', modificar);
