import React, { useState, useEffect } from 'react';
import { handleUser } from '../api/api';

const FormularioUsuario = ({ userToEdit, onFormSubmit }) => {
  const [datosUsuario, setDatosUsuario] = useState({
    username: '',
    password: '',
    nombre: '',
    apellidos: '',
    fechaNacimiento: ''
  });

  useEffect(() => {
    if (userToEdit) {
      // Cargamos datos para editar
      setDatosUsuario({
        username: userToEdit.username,
        password: '',
        nombre: userToEdit.nombre,
        apellidos: userToEdit.apellidos,
        fechaNacimiento: userToEdit.fechaNacimiento
      });
    } else {
      // Formulario vacío para crear
      setDatosUsuario({
        username: '',
        password: '',
        nombre: '',
        apellidos: '',
        fechaNacimiento: ''
      });
    }
  }, [userToEdit]);

  const manejarCambio = (e) => {
    const { name, value } = e.target;
    setDatosUsuario(prev => ({ ...prev, [name]: value }));
  };

  const enviarFormulario = async (e) => {
    e.preventDefault();
    try {
      if (userToEdit) {
        // Actualizar usuario
        await handleUser('update', datosUsuario);
        alert("Usuario actualizado correctamente.");
      } else {
        // Crear usuario
        await handleUser('create', datosUsuario);
        alert("Usuario creado correctamente.");
      }
      onFormSubmit();
    } catch (error) {
      console.error("Error al enviar el formulario:", error);
    }
  };

  return (
    <div>
      <h2>{userToEdit ? "Editar Usuario" : "Nuevo Usuario"}</h2>
      <form onSubmit={enviarFormulario}>
        {!userToEdit && (
          <>
            <label>Nombre de Usuario:</label>
            <input
              type="text"
              name="username"
              value={datosUsuario.username}
              onChange={manejarCambio}
              required
            />
          </>
        )}
        <label>Contraseña:</label>
        <input
          type="password"
          name="password"
          value={datosUsuario.password}
          onChange={manejarCambio}
          placeholder={userToEdit ? "Dejar en blanco para no cambiar" : ""}
        />
        <label>Nombre:</label>
        <input
          type="text"
          name="nombre"
          value={datosUsuario.nombre}
          onChange={manejarCambio}
          required
        />
        <label>Apellidos:</label>
        <input
          type="text"
          name="apellidos"
          value={datosUsuario.apellidos}
          onChange={manejarCambio}
          required
        />
        <label>Fecha de Nacimiento:</label>
        <input
          type="date"
          name="fechaNacimiento"
          value={datosUsuario.fechaNacimiento}
          onChange={manejarCambio}
          required
        />
        <button type="submit">
          {userToEdit ? "Actualizar" : "Registrar"}
        </button>
      </form>
    </div>
  );
};

export default FormularioUsuario;
