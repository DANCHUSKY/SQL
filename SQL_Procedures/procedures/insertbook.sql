-- Este procedimiento almacenado inserta un nuevo libro en la tabla llibre.

-- Definición del procedimiento almacenado llamado 'insertbook' que toma varios parámetros de entrada.
CREATE PROCEDURE `insertbook`(IN `isbn` VARCHAR(255), IN `autor` VARCHAR(255), IN `titol` VARCHAR(255), IN `preu` DECIMAL(10,2))
BEGIN
    -- Inserta una nueva fila en la tabla 'llibre' con los valores proporcionados para ISBN, autor, título y precio.
    INSERT INTO llibre (isbn, autor, titol, preu)
    VALUES (isbn, autor, titol, preu);
END//
