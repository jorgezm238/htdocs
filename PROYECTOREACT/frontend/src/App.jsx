import UsuarioForm from './components/UsuarioForm';
import UsuariosList from './components/UsuariosList';
import Estadisticas from './components/Estadisticas';

export default function App() {
  return (
    <div>
      <h2>Control de Insulina</h2>
      <UsuarioForm recargar={() => window.location.reload()} />
      <UsuariosList />
      <Estadisticas mes={new Date().toISOString().slice(0, 7)} />
    </div>
  );
}
