import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.querySelector('form');
const tablaEspecialidades = document.getElementById('tablaEspecialidades');
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
    if (!validarFormulario(formulario, ['espec_id'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    body.delete('espec_id');
    const url = '/final_IS2_Franco/API/especialidades/guardar';
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
    let espec_nombre = formulario.espec_nombre.value;
    const url = `/final_IS2_Franco/API/especialidades/buscar?espec_nombre=${espec_nombre}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        tablaEspecialidades.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        
        if (data.length > 0) {
            let contador = 1;
            data.forEach(especialidad => {
                // CREAMOS ELEMENTOS
                const tr = document.createElement('tr');
                const td1 = document.createElement('td');
                const td2 = document.createElement('td');
                const td3 = document.createElement('td'); // Agregado según el código que proporcionaste
                const td4 = document.createElement('td');
                const td5 = document.createElement('td');
                const buttonModificar = document.createElement('button');
                const buttonEliminar = document.createElement('button');

                // CARACTERISTICAS A LOS ELEMENTOS
                buttonModificar.classList.add('btn', 'btn-warning');
                buttonEliminar.classList.add('btn', 'btn-danger');
                buttonModificar.textContent = 'Modificar';
                buttonEliminar.textContent = 'Eliminar';

                buttonModificar.addEventListener('click', () => colocarDatos(especialidad));
                buttonEliminar.addEventListener('click', () => eliminar(especialidad.espec_id));

                td1.innerText = contador;
                td2.innerText = especialidad.espec_nombre;
                
                // ESTRUCTURANDO DOM
                td4.appendChild(buttonModificar);
                td5.appendChild(buttonEliminar);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3); // Agregado según el código que proporcionaste
                tr.appendChild(td4);
                tr.appendChild(td5);

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

        tablaEspecialidades.tBodies[0].appendChild(fragment);
    } catch (error) {
        console.log(error);
    }
};

const colocarDatos = (datos) => {
    formulario.espec_nombre.value = datos.espec_nombre;
    formulario.espec_id.value = datos.espec_id;

    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = '';
    btnBuscar.disabled = true;
    btnBuscar.parentElement.style.display = 'none';
    btnModificar.disabled = false;
    btnModificar.parentElement.style.display = '';
    btnCancelar.disabled = false;
    btnCancelar.parentElement.style.display = '';
    divTabla.style.display = 'none';

    // modalEjemploBS.show();
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
    const url = '/final_IS2_Franco/API/especialidades/modificar';
    const config = {
        method: 'POST',
        body
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success';
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

    } catch (error) {
        console.log(error);
    }
};

const eliminar = async (id) => {
    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('espec_id', id);
        const url = '/final_IS2_Franco/API/especialidades/eliminar';
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
    }
};

buscar();
formulario.addEventListener('submit', guardar );
btnBuscar.addEventListener('click', buscar);
btnCancelar.addEventListener('click', cancelarAccion);
btnModificar.addEventListener('click', modificar);
