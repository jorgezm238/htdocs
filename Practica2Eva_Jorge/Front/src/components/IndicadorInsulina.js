import React from 'react';
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  BarElement,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js';
import { Bar } from 'react-chartjs-2';

// Registramos los componentes en ChartJS
ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
);

function GraficoCombinado() {
  const data = {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo','Junio',  'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    datasets: [
      {
        type: 'bar',
        label: 'Frecuencia',
        data: [35, 40, 30, 32, 28],       // Datos para las barras
        backgroundColor: 'rgba(61, 82, 94, 0.6)', // Color de relleno
      },
      {
        type: 'line',
        label: 'Tendencia',
        data: [25, 35, 32, 31, 30],       // Datos para la línea
        borderColor: 'rgb(240, 66, 66)',
        borderWidth: 5,
        fill: false,
        tension: 0.1
      }
    ]
  };

  // Opciones del gráfico
  const options = {
    responsive: true,
    maintainAspectRatio: false, // Permite que el gráfico ocupe el alto/width del contenedor
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Frecuencia'
        }
      },
      x: {
        title: {
          display: true,
          text: 'Meses'
        }
      }
    },
    plugins: {
      legend: {
        position: 'top'
      },
      title: {
        display: true,
        text: 'Gráfico de Barras + Línea'
      }
    }
  };

  return (
    <div
      style={{
        width: '900px',   // Ancho fijo
        height: '500px',  // Alto fijo
        margin: '0 auto', // Centrar en pantalla
        backgroundColor: '#282c34',
        padding: '10px'
      }}
    >
      <Bar data={data} options={options} />
    </div>
  );
}

export default GraficoCombinado;
