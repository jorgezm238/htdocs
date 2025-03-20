import React, { useEffect, useState } from 'react';
import { getStatistics } from '../api/api';
import { Line } from 'react-chartjs-2';
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement } from 'chart.js';

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement);

const Statistics = () => {
  const [stats, setStats] = useState(null);
  const [chartData, setChartData] = useState({});

  useEffect(() => {
    const fetchStats = async () => {
      try {
        const data = await getStatistics("2023-05"); 
        setStats(data);
        
        setChartData({
          labels: data.evolucion.map(item => item.dia),
          datasets: [
            {
              label: "Evolución LENTA",
              data: data.evolucion.map(item => item.valor),
              fill: false,
              borderColor: "#4CAF50",
              borderWidth: 5,
              pointBackgroundColor: "#4CAF50",
              pointRadius: 5
            }
          ]
        });
      } catch (error) {
        console.error("Error al cargar estadísticas:", error);
      }
    };
    fetchStats();
  }, []);

  if (!stats) return <div style={{ textAlign: "center", fontSize: "18px", color: "#666" }}>Cargando estadísticas...</div>;

  return (
    <div style={{ display: "flex", alignItems: "flex-start", gap: "20px", padding: "20px" }}>
      <div style={{ flex: 1, maxWidth: "300px" }}>
        <h2>Estadísticas del Indicador de insulina lenta</h2>
        <table style={{ width: "100%", borderCollapse: "collapse" }}>
          <tbody>
            <tr><td style={cellStyle}><strong>Valor medio:</strong></td><td style={cellStyle}>{stats.media}</td></tr>
            <tr><td style={cellStyle}><strong>Valor mínimo:</strong></td><td style={cellStyle}>{stats.min}</td></tr>
            <tr><td style={cellStyle}><strong>Valor máximo:</strong></td><td style={cellStyle}>{stats.max}</td></tr>
          </tbody>
        </table>
      </div>
      <div style={{ flex: 2, maxWidth: "600px" }}>
        <Line data={chartData} />
      </div>
    </div>
  );
};

const cellStyle = {
  padding: "8px",
  borderBottom: "1px solid #ddd"
};

export default Statistics;
