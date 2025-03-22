import React, { useEffect, useState } from 'react';
import { handleUser } from '../api/api'; // Importa la función unificada

const ListaUsuarios = ({ alEditarUsuario }) => {
  const [usuariosRegistrados, setUsuariosRegistrados] = useState([]);

  useEffect(() => {
    cargarUsuarios();
  }, []);

  const cargarUsuarios = async () => {
    try {
      // Llamamos a handleUser con la acción 'get'
      const data = await handleUser('get');
      setUsuariosRegistrados(data);
    } catch (error) {
      console.error("Error al cargar usuarios:", error);
    }
  };

  const confirmarEliminacion = async (username) => {
    if (window.confirm(`¿Estás seguro de que quieres eliminar al usuario "${username}"?`)) {
      try {
        // Llamamos a handleUser con la acción 'delete'
        await handleUser('delete', { username });
        cargarUsuarios(); // Recargamos la lista
      } catch (error) {
        console.error("Error al eliminar usuario:", error);
      }
    }
  };

  return (
    <div>
      <h2>Listado de Usuarios</h2>
      <table border="1" cellPadding="8">
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Nombre Completo</th>
            <th>Fecha de Nacimiento</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {usuariosRegistrados.length > 0 ? (
            usuariosRegistrados.map(usuario => (
              <tr key={usuario.username}>
                <td>{usuario.username}</td>
                <td>{usuario.nombre} {usuario.apellidos}</td>
                <td>{usuario.fechaNacimiento}</td>
                <td>
                  <button onClick={() => alEditarUsuario(usuario)}>Editar</button>
                  <button onClick={() => confirmarEliminacion(usuario.username)}>Borrar</button>
                </td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="4">No hay usuarios registrados.</td>
            </tr>
          )}
        </tbody>
      </table>
    </div>
  );
};

export default ListaUsuarios;
