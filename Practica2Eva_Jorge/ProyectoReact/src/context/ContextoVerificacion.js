import React, { createContext } from 'react';

export const ContextoVerificacion = createContext();

export const ProveedorVerificacion = ({ children }) => {
  
  const patrones = {
    patronUsuario: /^[a-z][a-z0-9]{5,}$/,       // Inicia con letra minúscula y al menos 6 caracteres
    patronContrasena: /^(?=.*[A-Z])(?=.*\d).{8,}$/ // Al menos 8 caracteres, una mayúscula y un dígito
  };

  return (
    <ContextoVerificacion.Provider value={patrones}>
      {children}
    </ContextoVerificacion.Provider>
  );
};
