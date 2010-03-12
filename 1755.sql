
DROP TABLE "areas";
DROP TABLE "tipo_recursos";
DROP TABLE "operativos";
DROP TABLE "recursos";
DROP TABLE "comunas";
DROP TABLE "localidades";
DROP TABLE "tipo_organizaciones";
DROP TABLE "organizaciones";
DROP TABLE "catastros";


CREATE TABLE "areas" (
	"id" integer primary key,
	"nombre" varchar(255) DEFAULT NULL,
	"descripcion" text DEFAULT NULL,
	"created" datetime DEFAULT NULL,
	"modified" datetime DEFAULT NULL);
	

CREATE TABLE "tipo_recursos" (
	"id" integer primary key,
	"nombre" varchar(100) NOT NULL,
	"descripcion" text DEFAULT NULL,
	"codigo" varchar(5) NOT NULL,
	"area_id" integer(11) NOT NULL,
	"created" datetime DEFAULT NULL,
	"modified" datetime DEFAULT NULL);
	

CREATE TABLE "operativos" (
	"id" integer primary key,
	"fecha_llegada" date DEFAULT NULL,
	"duracion" integer DEFAULT NULL,
	"localidad_id" integer(11) NOT NULL,
	"organizacion_id" integer(11) NOT NULL,
	"created" datetime DEFAULT NULL,
	"modified" datetime DEFAULT NULL);
	

CREATE TABLE "recursos" (
	"id" integer primary key,
	"cantidad" integer(11) DEFAULT '0',
	"caracteristica" text DEFAULT NULL,
	"tipo_recurso_id" integer(11) DEFAULT NULL,
	"operativo_id" integer(11) DEFAULT NULL,
	"created" datetime DEFAULT NULL,
	"modified" datetime DEFAULT NULL);
	

CREATE TABLE "comunas" (
	"id" integer primary key,
	"nombre" varchar(255) DEFAULT NULL,
	"lat" float DEFAULT NULL,
	"lon" float DEFAULT NULL,
	"created" datetime DEFAULT NULL,
	"modified" datetime DEFAULT NULL);
	

CREATE TABLE "localidades" (
	"id" integer primary key,
	"comuna_id" integer(11) NOT NULL,
	"nombre" varchar(100) NOT NULL,
	"lat" float DEFAULT NULL,
	"lon" float DEFAULT NULL,
	"created" datetime DEFAULT NULL,
	"modified" datetime DEFAULT NULL);
	

CREATE TABLE "tipo_organizaciones" (
	"id" integer primary key,
	"nombre" varchar(255) DEFAULT NULL,
	"created" datetime DEFAULT NULL,
	"modified" datetime DEFAULT NULL);
	

CREATE TABLE "organizaciones" (
	"id" integer primary key,
	"nombre" varchar(255) NOT NULL,
	"tipo_organizacion_id" integer(11) NOT NULL,
	"telefono" varchar(100) DEFAULT NULL,
	"email" varchar(255) DEFAULT NULL,
	"web" varchar(255) DEFAULT NULL,
	"nombre_contacto" varchar(255) DEFAULT NULL,
	"apellido_contacto" varchar(255) DEFAULT NULL,
	"telefono_contacto" varchar(255) DEFAULT NULL,
	"areas_trabajo" text DEFAULT NULL,
	"created" datetime DEFAULT NULL,
	"modified" datetime DEFAULT NULL);
	

CREATE TABLE "catastros" (
	"id" integer primary key,
	"localidad_id" integer(11) DEFAULT NULL,
	"organizacion_id" integer(11) DEFAULT NULL,
	"localidad" varchar(255) DEFAULT NULL,
	"nombre_contacto" varchar(255) DEFAULT NULL,
	"telefono_contacto" varchar(100) DEFAULT NULL,
	"fecha" datetime DEFAULT NULL,
	"caracterizacion" text DEFAULT NULL,
	"danos_graves_fisicos" integer(11) DEFAULT NULL,
	"danos_graves_psicologicos" integer(11) DEFAULT NULL,
	"personas_con_discapacidad" integer(11) DEFAULT NULL,
	"enfermedades_cronicas" integer(11) DEFAULT NULL,
	"embarazadas" integer(11) DEFAULT NULL,
	"menores" integer(11) DEFAULT NULL,
	"casas_destruidas" integer(11) DEFAULT NULL,
	"casas_remocion_escombros" integer(11) DEFAULT NULL,
	"casas_evaluacion_estructural" integer(11) DEFAULT NULL,
	"sistema_excretas" integer(11) DEFAULT NULL,
	"agua" integer(11) DEFAULT NULL,
	"ropa" integer(11) DEFAULT NULL,
	"abrigo" integer(11) DEFAULT NULL,
	"colchoneta" integer(11) DEFAULT NULL,
	"aseo_personal" integer(11) DEFAULT NULL,
	"aseo_general" integer(11) DEFAULT NULL,
	"combustible" integer(11) DEFAULT NULL,
	"created" datetime DEFAULT NULL,
	"modified" datetime DEFAULT NULL);
	

