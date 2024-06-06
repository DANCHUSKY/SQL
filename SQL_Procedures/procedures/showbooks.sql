-- Este procedimiento almacenado muestra todos los libros presentes en la tabla llibre.

-- Definición del procedimiento almacenado llamado 'showbooks' que no toma ningún parámetro de entrada.
CREATE PROCEDURE `showbooks`()
BEGIN
    -- Selecciona todas las columnas de la tabla 'llibre' para mostrar todos los libros presentes en ella.
    SELECT * FROM llibre;
END//

