import React, { createContext } from 'react';

const ValidacionesContext = createContext({
  usuarioRegex: /^[a-z][a-z0-9]{5,}$/,
  contraseñaRegex: /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/,
  validarEdad: (fecha) => {
    const hoy = new Date();
    const nacimiento = new Date(fecha);
    let edad = hoy.getFullYear() - nacimiento.getFullYear();
    const mes = hoy.getMonth() - nacimiento.getMonth();
    if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
      edad--;
    }
    return edad >= 18;
  }
});

export const ValidacionesProvider = ({ children }) => {
  return (
    <ValidacionesContext.Provider value={{
      usuarioRegex: /^[a-z][a-z0-9]{5,}$/,
      contraseñaRegex: /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/,
      validarEdad: (fecha) => {
        const hoy = new Date();
        const nacimiento = new Date(fecha);
        let edad = hoy.getFullYear() - nacimiento.getFullYear();
        const mes = hoy.getMonth() - nacimiento.getMonth();
        if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
          edad--;
        }
        return edad >= 18;
      }
    }}>
      {children}
    </ValidacionesContext.Provider>
  );
};

export default ValidacionesContext;
