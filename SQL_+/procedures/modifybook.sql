-- Este procedimiento almacenado modifica los datos de un libro en la base de datos llibre basado en su ISBN.

-- Definición del procedimiento almacenado llamado 'modifybook' que toma varios parámetros de entrada.
CREATE PROCEDURE modifybook(
    IN isbn_value VARCHAR(20),   -- Parámetro de entrada para el ISBN del libro a modificar.
    IN autor_value VARCHAR(255), -- Parámetro de entrada para el nuevo autor del libro.
    IN titol_value VARCHAR(255), -- Parámetro de entrada para el nuevo título del libro.
    IN preu_value DECIMAL(10,2) -- Parámetro de entrada para el nuevo precio del libro.
)
BEGIN
    -- Actualiza la tabla 'llibre' estableciendo el nuevo autor, título y precio según los valores proporcionados,
    -- donde el ISBN coincide con el valor proporcionado.
    UPDATE llibre
    SET autor = autor_value, titol = titol_value, preu = preu_value
    WHERE isbn = isbn_value;
END //
