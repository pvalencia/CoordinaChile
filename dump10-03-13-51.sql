INSERT INTO areas VALUES(1,'salud',NULL,NULL,NULL);
INSERT INTO areas VALUES(2,'vivienda',NULL,NULL,NULL);
INSERT INTO areas VALUES(3,'humanitaria',NULL,NULL,NULL);

INSERT INTO tipo_recursos VALUES(1,'Enviados Operativo medicina ','Cantidad de Voluntarios  enviados para Operativo Medico ',1,NULL,NULL);
INSERT INTO tipo_recursos VALUES(2,'Enviados Operativo Sicosocial ','Cantidad de Voluntarios  enviados para Operativo Sicosocial ',1,NULL,NULL);
INSERT INTO tipo_recursos VALUES(3,'Enviados Operativo Higiene Ambiental y Educación ','Cantidad de Voluntarios  enviados para Higiene Ambiental y Educación ',1,NULL,NULL);
INSERT INTO tipo_recursos VALUES(4,'constructor',NULL,2,NULL,NULL);
INSERT INTO tipo_recursos VALUES(5,'destructor',NULL,2,NULL,NULL);
INSERT INTO tipo_recursos VALUES(6,'Reparadores ','Cantidad de Personas reparando estructuras y viviendas que no poseen daño estrctural ',2,NULL,NULL);
INSERT INTO tipo_recursos VALUES(7,'Constructores ','Cantidad de Personas Construyendo Viviendas ',2,NULL,NULL);
INSERT INTO tipo_recursos VALUES(8,'Voluntarios Humanitaria ','Voluntarios Enviados para ayuda Humanitaria ',3,NULL,NULL);
INSERT INTO tipo_recursos VALUES(9,'Agua ','Litros de Agua ',3,NULL,NULL);
INSERT INTO tipo_recursos VALUES(10,'Alimentos ','Kilos de alimentos ',3,NULL,NULL);
INSERT INTO tipo_recursos VALUES(11,'Abrigo ','Kilos de frasadas , ropa de cama y sacos de dormir ',3,NULL,NULL);
INSERT INTO tipo_recursos VALUES(12,'Ropa ','Kilos de ropa ',3,NULL,NULL);
INSERT INTO tipo_recursos VALUES(13,'Colchonetas ','Cantidad de Colchonetas y aislantes de piso ',3,NULL,NULL);
INSERT INTO tipo_recursos VALUES(14,'Aseo Personal ','Kilos de Jabon, shampoo, pasta de dientes, etc. ',3,NULL,NULL);
INSERT INTO tipo_recursos VALUES(15,'Aseo General ','Kilos de Cloro, virutillas, detergentes, etc. ',3,NULL,NULL);
INSERT INTO tipo_recursos VALUES(16,'Combustible ','Kilos de Carbón, Bencina, Parafina, etc ',3,NULL,NULL);
INSERT INTO tipo_recursos VALUES(17,'Carpas ','Cantidad de Carpas ',3,NULL,NULL);
INSERT INTO tipo_recursos VALUES(18,'Viviendas de Emergencia ','Cantidad de  Viviendas, tales como mediaguas, etc. ',3,NULL,NULL);
INSERT INTO tipo_recursos VALUES(19,'Buses ','Cantidad de Transportes Masivo de Pasajeros ',4,NULL,NULL);
INSERT INTO tipo_recursos VALUES(20,'Camiones ','Cantidad de Vehiculos de Carga Mayor ',4,NULL,NULL);
INSERT INTO tipo_recursos VALUES(21,'Retroexcavadoras ','Cantidad de Maquinaria Pesada ',4,NULL,NULL);
CREATE TABLE 'operativos' (
	'id' integer primary key,
	'fecha_llegada' date DEFAULT NULL,
	'duracion' integer DEFAULT NULL,
	'localidad_id' integer(11) NOT NULL,
	'organizacion_id' integer(11) NOT NULL,
	'created' datetime DEFAULT NULL,
	'modified' datetime DEFAULT NULL);
INSERT INTO operativos VALUES(1,'2010-03-08',NULL,1,1,'2010-03-08 18:40:14','2010-03-08 18:40:14');
CREATE TABLE 'recursos' (
	'id' integer primary key,
	'cantidad' integer(11) DEFAULT '0',
	'caracteristica' text DEFAULT NULL,
	'tipo_recurso_id' integer(11) DEFAULT NULL,
	'operativo_id' integer(11) DEFAULT NULL,
	'created' datetime DEFAULT NULL,
	'modified' datetime DEFAULT NULL);
INSERT INTO recursos VALUES(1,20,'maracos',2,1,'2010-03-08 18:40:14','2010-03-08 18:40:14');
INSERT INTO recursos VALUES(2,10,'machitos',5,1,'2010-03-08 18:40:14','2010-03-08 18:40:14');
CREATE TABLE 'comunas' (
	'id' integer primary key,
	'nombre' varchar(255) DEFAULT NULL,
	'lat' float DEFAULT NULL,
	'lon' float DEFAULT NULL,
	'created' datetime DEFAULT NULL,
	'modified' datetime DEFAULT NULL);
INSERT INTO comunas VALUES(1,'concepcion',NULL,NULL,NULL,NULL);
INSERT INTO comunas VALUES(2,'constitucion',NULL,NULL,NULL,NULL);
CREATE TABLE 'localidades' (
	'id' integer primary key,
	'comuna_id' integer(11) NOT NULL,
	'nombre' varchar(100) NOT NULL,
	'lat' float DEFAULT NULL,
	'lon' float DEFAULT NULL,
	'created' datetime DEFAULT NULL,
	'modified' datetime DEFAULT NULL);
INSERT INTO localidades VALUES(1,1,'concepcion',NULL,NULL,NULL,NULL);
INSERT INTO localidades VALUES(2,2,'constitucion',NULL,NULL,NULL,NULL);
CREATE TABLE 'tipo_organizaciones' (
	'id' integer primary key,
	'nombre' varchar(255) DEFAULT NULL,
	'created' datetime DEFAULT NULL,
	'modified' datetime DEFAULT NULL);
CREATE TABLE 'organizaciones' (
	'id' integer primary key,
	'nombre' varchar(255) NOT NULL,
	'tipo_organizacion_id' integer(11) NOT NULL,
	'telefono' varchar(100) DEFAULT NULL,
	'email' varchar(255) DEFAULT NULL,
	'web' varchar(255) DEFAULT NULL,
	'nombre_contacto' varchar(255) DEFAULT NULL,
	'apellido_contacto' varchar(255) DEFAULT NULL,
	'telefono_contacto' varchar(255) DEFAULT NULL,
	'areas_trabajo' text DEFAULT NULL,
	'created' datetime DEFAULT NULL,
	'modified' datetime DEFAULT NULL);
INSERT INTO organizaciones VALUES(1,'fech',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO organizaciones VALUES(2,'feuc',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
CREATE TABLE 'catastros' (
	'id' integer primary key,
	'localidad_id' integer(11) DEFAULT NULL,
	'organizacion_id' integer(11) DEFAULT NULL,
	'localidad' varchar(255) DEFAULT NULL,
	'nombre_contacto' varchar(255) DEFAULT NULL,
	'telefono_contacto' varchar(100) DEFAULT NULL,
	'fecha' datetime DEFAULT NULL,
	'caracterizacion' text DEFAULT NULL,
	'danos_graves_fisicos' integer(11) DEFAULT NULL,
	'danos_graves_psicologicos' integer(11) DEFAULT NULL,
	'personas_con_discapacidad' integer(11) DEFAULT NULL,
	'enfermedades_cronicas' integer(11) DEFAULT NULL,
	'embarazadas' integer(11) DEFAULT NULL,
	'menores' integer(11) DEFAULT NULL,
	'casas_destruidas' integer(11) DEFAULT NULL,
	'casas_remocion_escombros' integer(11) DEFAULT NULL,
	'casas_evaluacion_estructural' integer(11) DEFAULT NULL,
	'sistema_excretas' integer(11) DEFAULT NULL,
	'agua' integer(11) DEFAULT NULL,
	'ropa' integer(11) DEFAULT NULL,
	'abrigo' integer(11) DEFAULT NULL,
	'colchoneta' integer(11) DEFAULT NULL,
	'aseo_personal' integer(11) DEFAULT NULL,
	'aseo_general' integer(11) DEFAULT NULL,
	'combustible' integer(11) DEFAULT NULL,
	'created' datetime DEFAULT NULL,
	'modified' datetime DEFAULT NULL);
