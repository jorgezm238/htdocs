import React from 'react';
import UsuarioForm from './components/UsuarioForm';
import UsuariosTabla from './components/UsuariosTabla';
import Estadisticas from './components/Estadisticas';
import { ValidacionesProvider } from './context/ValidacionesContext';

function App() {
  return (
    <ValidacionesProvider>
      <div style={{ margin: '20px' }}>
        <h1>Gestión de Insulina</h1>
        <UsuarioForm />
        <UsuariosTabla />
        <Estadisticas />
        {/* <GraficoLenta />  // Opcional si deseas usar Chart.js */}
      </div>
    </ValidacionesProvider>
  );
}

export default App;
