-- Este procedimiento almacenado elimina un libro de la base de datos llibre basado en su ISBN.

-- Definición del procedimiento almacenado llamado 'deletebook' que toma un parámetro de entrada 'isbn_value' de tipo VARCHAR(20).
CREATE PROCEDURE `deletebook`(IN `isbn_value` VARCHAR(20))
BEGIN
    -- Elimina la entrada de la tabla 'llibre' donde el ISBN coincide con el valor proporcionado.
    DELETE FROM llibre WHERE isbn = isbn_value;
END//

