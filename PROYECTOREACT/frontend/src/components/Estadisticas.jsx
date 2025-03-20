import { useEffect, useState } from 'react';

export default function Estadisticas({ mes }) {
  const [stats, setStats] = useState({});

  useEffect(() => {
    fetch(`http://localhost:80/backend/estadisticas.php?mes=${mes}`)
      .then(r => r.json())
      .then(setStats);
  }, [mes]);

  return (
    <div>
      <h3>Estadísticas Insulina LENTA ({mes})</h3>
      <p>Media: {stats.media || 0}</p>
      <p>Mínima: {stats.minima || 0}</p>
      <p>Máxima: {stats.maxima || 0}</p>
    </div>
  );
}
