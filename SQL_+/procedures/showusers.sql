-- Este procedimiento almacenado muestra todos los usuarios presentes en la tabla client.

-- Definición del procedimiento almacenado llamado 'showusers' que no toma ningún parámetro de entrada.
CREATE PROCEDURE `showusers`()
BEGIN
    -- Selecciona todas las columnas de la tabla 'client' para mostrar todos los usuarios presentes en ella.
    SELECT * FROM client;
END//

