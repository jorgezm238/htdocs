const API_BASE_URL = "http://localhost/htdocs-1/Practica2Eva_Jorge/ArchivosPHP";

/**
 * Maneja todas las operaciones CRUD de "usuario" contra usuarios.php
 * @param {string} action - 'get' | 'create' | 'update' | 'delete'
 * @param {object} userData - { username, password, nombre, apellidos, fechaNacimiento, ... }
 */
export const handleUser = async (action, userData = {}) => {
  let method;
  let body = null;

  switch (action) {
    case 'get':
      method = 'GET';
      // GET no requiere body
      break;
    case 'create':
      method = 'POST';
      body = userData; // { username, password, nombre, apellidos, fechaNacimiento }
      break;
    case 'update':
      method = 'PUT';
      body = userData; // { username, [password], nombre, apellidos, fechaNacimiento }
      break;
    case 'delete':
      method = 'DELETE';
      body = { username: userData.username };
      break;
    default:
      throw new Error(`Acción no reconocida: ${action}`);
  }

  const response = await fetch(`${API_BASE_URL}/usuarios.php`, {
    method,
    headers: { 'Content-Type': 'application/json' },
    body: body ? JSON.stringify(body) : null
  });

  return response.json();
};

// Función para estadísticas (sigue en un archivo separado)
export const getStatistics = async (month) => {
  const response = await fetch(`${API_BASE_URL}/estadisticas.php?month=${month}`);
  return response.json();
};
