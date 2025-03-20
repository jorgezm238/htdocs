import React, { useEffect, useState } from 'react';
import { Line } from 'react-chartjs-2';
import Chart from 'chart.js/auto';

const GraficoLenta = () => {
  const [historial, setHistorial] = useState([]);

  useEffect(() => {
    fetch('http://localhost/backend/historial.php')
      .then(res => res.json())
      .then(data => setHistorial(data))
      .catch(err => console.error(err));
  }, []);

  const data = {
    labels: historial.map(item => item.fecha),
    datasets: [
      {
        label: 'Evolución Insulina LENTA',
        data: historial.map(item => item.insulina_lenta),
        borderColor: 'blue',
        fill: false
      }
    ]
  };

  return (
    <div style={{ marginBottom: '20px' }}>
      <h2>Gráfico de Insulina LENTA</h2>
      <Line data={data} />
    </div>
  );
};

export default GraficoLenta;
