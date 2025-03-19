import React, { useState, useEffect } from 'react';

const Estadisticas = () => {
  const [estadisticas, setEstadisticas] = useState(null);

  useEffect(() => {
    fetchEstadisticas();
  }, []);

  const fetchEstadisticas = async () => {
    try {
      const response = await fetch('http://localhost/backend/estadisticas.php');
      if (response.ok) {
        const data = await response.json();
        setEstadisticas(data);
      } else {
        console.error('Error al obtener estadísticas');
      }
    } catch (error) {
      console.error('Error de conexión', error);
    }
  };

  if (!estadisticas) return <p>Cargando estadísticas...</p>;

  return (
    <div style={{ marginBottom: '20px' }}>
      <h2>Estadísticas de Insulina LENTA</h2>
      <ul>
        <li><strong>Valor Medio:</strong> {estadisticas.promedio}</li>
        <li><strong>Valor Mínimo:</strong> {estadisticas.minimo}</li>
        <li><strong>Valor Máximo:</strong> {estadisticas.maximo}</li>
      </ul>
    </div>
  );
};

export default Estadisticas;
