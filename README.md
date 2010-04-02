# Coordina Chile

Coordinación de organizaciones de voluntarios para la ayuda para el terremoto.

## Versión inestable de coordinachile.cl

### Cambios para el unstable

*  De routeo se pasa a index.


*  Creado un mini-hack para lograr separar operativos en SQLite y en MySQL con la misma sentencia SQL:
Se deben crear dos funciones en MySQL, para ello ejecutar este script:
-------------------
DELIMITER //
CREATE FUNCTION strftime(format varchar(2), ss varchar(3)) RETURNS INT(11)
BEGIN
    RETURN TO_DAYS(NOW());
END
//
CREATE FUNCTION julianday(fecha DATE) RETURNS INT(11)
BEGIN
    RETURN TO_DAYS(fecha);
END
-------------------
