import React, { useState } from 'react';
import './App.css';  // <-- Importación del archivo de estilos

import { ProveedorVerificacion } from './context/ContextoVerificacion';
import ListaUsuarios from './components/ListaUsuarios';
import FormularioUsuario from './components/FormularioUsuario';
import IndicadorInsulina from './components/IndicadorInsulina';

function App() {
  const [userToEdit, setUserToEdit] = useState(null);
  const [refresh, setRefresh] = useState(false);

  const handleEdit = (user) => {
    setUserToEdit(user);
  };

  const handleFormSubmit = () => {
    setUserToEdit(null);
    setRefresh(!refresh);
  };

  return (
    <div className="App">
      <header className="App-header">
        <ProveedorVerificacion>

          <h1>Control de Insulina React</h1>

          {/* Formulario para crear o editar usuarios */}
          <FormularioUsuario userToEdit={userToEdit} onFormSubmit={handleFormSubmit} />

          {/* Lista de usuarios (key para forzar recarga cuando cambie "refresh") */}
          <ListaUsuarios key={refresh} onEdit={handleEdit} />

          {/* Componente de estadísticas */}
          <IndicadorInsulina />

        </ProveedorVerificacion>
      </header>
    </div>
  );
}

export default App;
