import React, { useState, useEffect } from 'react';

const UsuariosTabla = () => {
  const [usuarios, setUsuarios] = useState([]);

  useEffect(() => {
    fetchUsuarios();
  }, []);

  const fetchUsuarios = async () => {
    try {
      const response = await fetch('http://localhost/backend/usuarios.php');
      if (response.ok) {
        const data = await response.json();
        setUsuarios(data);
      } else {
        console.error('Error al obtener usuarios');
      }
    } catch (error) {
      console.error('Error de conexión', error);
    }
  };

  const eliminarUsuario = async (usuario) => {
    try {
      const response = await fetch(`http://localhost/backend/usuarios.php?usuario=${usuario}`, {
        method: 'DELETE'
      });
      if (response.ok) {
        alert('Usuario eliminado');
        setUsuarios(usuarios.filter((u) => u.usuario !== usuario));
      } else {
        alert('Error al eliminar usuario');
      }
    } catch (error) {
      console.error('Error de conexión', error);
    }
  };

  return (
    <div style={{ marginBottom: '20px' }}>
      <h2>Lista de Usuarios</h2>
      <table border="1" cellPadding="5">
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Fecha Nacimiento</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {usuarios.map((u) => (
            <tr key={u.usuario}>
              <td>{u.usuario}</td>
              <td>{u.nombre}</td>
              <td>{u.apellidos}</td>
              <td>{u.fecha_nacimiento}</td>
              <td>
                <button onClick={() => eliminarUsuario(u.usuario)}>Eliminar</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default UsuariosTabla;
