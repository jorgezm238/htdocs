import React, { useState, useContext } from 'react';
import ValidacionesContext from '../context/ValidacionesContext';

const UsuarioForm = () => {
  const [usuario, setUsuario] = useState('');
  const [contraseña, setContraseña] = useState('');
  const [nombre, setNombre] = useState('');
  const [apellidos, setApellidos] = useState('');
  const [fechaNacimiento, setFechaNacimiento] = useState('');

  const { usuarioRegex, contraseñaRegex, validarEdad } = useContext(ValidacionesContext);

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (!usuarioRegex.test(usuario)) {
      alert('Usuario inválido: Debe empezar por letra y tener al menos 6 caracteres (solo letras y números).');
      return;
    }
    if (!contraseñaRegex.test(contraseña)) {
      alert('Contraseña inválida: Debe tener al menos 8 caracteres, una mayúscula y un número.');
      return;
    }
    if (!validarEdad(fechaNacimiento)) {
      alert('El usuario debe ser mayor de 18 años.');
      return;
    }
    if (!nombre || !apellidos) {
      alert('El nombre y apellidos son obligatorios.');
      return;
    }

    try {
      const response = await fetch('http://localhost/backend/usuarios.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          usuario,
          contraseña,
          nombre,
          apellidos,
          fecha_nacimiento: fechaNacimiento
        })
      });

      if (response.ok) {
        alert('Usuario creado correctamente.');
        setUsuario('');
        setContraseña('');
        setNombre('');
        setApellidos('');
        setFechaNacimiento('');
      } else {
        alert('Error al crear el usuario.');
      }
    } catch (error) {
      console.error(error);
      alert('Error de conexión.');
    }
  };

  return (
    <div style={{ marginBottom: '20px' }}>
      <h2>Crear Usuario</h2>
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          placeholder="Usuario"
          value={usuario}
          onChange={(e) => setUsuario(e.target.value)}
          required
        /><br />
        <input
          type="password"
          placeholder="Contraseña"
          value={contraseña}
          onChange={(e) => setContraseña(e.target.value)}
          required
        /><br />
        <input
          type="text"
          placeholder="Nombre"
          value={nombre}
          onChange={(e) => setNombre(e.target.value)}
          required
        /><br />
        <input
          type="text"
          placeholder="Apellidos"
          value={apellidos}
          onChange={(e) => setApellidos(e.target.value)}
          required
        /><br />
        <label>Fecha de Nacimiento: </label>
        <input
          type="date"
          value={fechaNacimiento}
          onChange={(e) => setFechaNacimiento(e.target.value)}
          required
        /><br />
        <button type="submit">Registrar</button>
      </form>
    </div>
  );
};

export default UsuarioForm;
