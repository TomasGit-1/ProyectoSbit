drop database if exists SBIT;
create database SBIT;
use SBIT;

create table Usuarios(idUsuario int not null auto_increment,
	usuario varchar(30) not null,
    passwordd varchar(20),                                    -- Cambiar tamaño de 10 a 20 (curp)
    nivel int not null,
    constraint idUsuarioPK primary key(idUsuario));
    
create table Estados(idEstado int not null auto_increment,
	nombre varchar(35) not null,                              -- Cambiar tamaño de 30 a 35
    constraint idEstadoPK primary key(idEstado));
    
create table Personas(idPersona int not null auto_increment,
	idUsuario int not null,
    nombre varchar(22) not null,
    apPat varchar(15),
    apMat varchar(15),
    correo varchar(30),
    domicilio varchar(70) not null,                          -- Cambiar tamaño de 40 a 70
    idEstado int,
    edad int not null,
    edoCivil varchar(10) not null,
    fechaIngreso date not null,
	curp varchar(30) not null,
    tipo varchar(1) not null,                                -- Cambiar de int a varchar(10) "sexo" 
    constraint idPersonaPK primary key(idPersona),
    constraint idUsuarioPersonaFK foreign key(idUsuario)
		references Usuarios(idUsuario)
        on delete cascade,
	constraint idEstadoPersonaFK foreign key(idEstado)
		references Estados(idEstado)
        on delete cascade);
        
create table Maestros(idMaestro int not null auto_increment,
	idPersona int not null,
	expLaboral varchar(100),
    tipo varchar(15) not null,
    categoria varchar(15) not null,
    numHoras int not null,
    constraint idMaestroPK primary key(idMaestro),
    constraint idPersonaMaestroFK foreign key(idPersona)
		references Personas(idPersona)
        on delete cascade);
        
create table Alumnos(matricula int not null auto_increment,
	idPersona int not null,
    EscProcedencia varchar(100) not null,                    -- Cambiar tamaño de 20 a 100
    servSocial boolean not null,
    statuss varchar(15) not null,
    solicitud varchar(30),                                 -- Agregar solicitud
    pagoServi varchar(30),                                 -- Agregar pagoServi
    ordenPago varchar(30),                                 -- Agregar ordenPago
    validacion1 boolean not null,                          -- Agregar validacion1
    validacion2 boolean not null,                          -- Agregar validacion2
    constraint idAlumnoPK primary key(matricula),
    constraint idPersonaAlumnoFK foreign key(idPersona)
		references Personas(idPersona)
        on delete cascade);
        
create table CicloEsc(idCiclo int not null auto_increment,
	descripcion varchar(30) not null,                         -- Cambiar tamaño de 20 a 30
    inicioCiclo date not null,                                -- Agregar inicioCiclo
    finCiclo date not null,                                   -- Agregar finCiclo
    constraint idCicloPK primary key(idCiclo));
    
create table Carrera(idCarrera int not null auto_increment,   -- Quitar idCiclo
	descripcion varchar(50),
    nombre varchar(50) not null,
    clave int not null,
    constraint idCarreraPK primary key(idCarrera));
-- constraint idCicloCarreraFK foreign key(idCiclo)references CicloEsc(idCiclo)on delete cascade);

create table Examenes(idExamen int not null auto_increment,
	idCarrera int not null,
	tipoExamen varchar(12) not null,
    constraint idExamenesPK primary key(idExamen),
    constraint idCarreraExamenFK foreign key(idCarrera)
		references Carrera(idCarrera)
        on delete cascade);
        
create table Materias(idMateria int not null auto_increment,
	idMaestro int not null,
	idExamen int not null,
	nombre varchar(45) not null,                             -- Cambiar tamaño de 15 a 45
    creditos int not null,
    constraint idMateriasPK primary key(idMateria),
    constraint idMaestroMateriaFK foreign key(idMaestro)
		references Maestros(idMaestro)
        on delete cascade,
	constraint idExamenMateriaFK foreign key(idExamen)
		references Examenes(idExamen)
        on delete cascade);
        
create table Calificaciones(idCiclo int not null,
	idExamen int not null,
    matricula int not null,
    idMateria int not null,
	calificacion float,
    fecha date,                                                    -- Quitar not null
    constraint idCicloCalificacionFK foreign key(idCiclo)
		references CicloEsc(idCiclo)
        on delete cascade,
	constraint idExamenCalificacionFK foreign key(idExamen)
		references Examenes(idExamen)
        on delete cascade,
	constraint idAlumnoCalificacionFK foreign key(matricula)
		references Alumnos(matricula)
        on delete cascade,
	constraint idMateriaCalificacionFK foreign key(idMateria)
		references Materias(idMateria)
        on delete cascade);
        
create table Egresados(idEgresado int not null,
    matricula int not null,
    actExtra int not null,
	servSocial varchar(20) not null,
    constraint idEgresadosPK primary key(idEgresado),
	constraint idAlumnoEgresadoFK foreign key(matricula)
		references Alumnos(matricula)
        on delete cascade);
        
create table ModTitulacion(idMTitulacion int not null,
    idEgresado int not null,
	modalidad varchar(20) not null,
    descripcion varchar(50) not null,
    constraint idModTitulacionPK primary key(idMTitulacion),
	constraint idEgresadoModTitulacionFK foreign key(idEgresado)
		references Egresados(idEgresado)
        on delete cascade);
        
create table Titulos(idTitulo int not null,
    idMTitulacion int not null,
    matricula int not null,
    fecha date not null,
	idAsesor int,
    mencion varchar(50) not null,
    constraint idTituloPK primary key(idTitulo),
	constraint idModTitulacionTituloFK foreign key(idMTitulacion)
		references ModTitulacion(idMTitulacion)
        on delete cascade,
	constraint idAlumnoTituloFK foreign key(matricula)
		references Alumnos(matricula)
        on delete cascade,
	constraint idMaestroTituloFK foreign key(idAsesor)
		references Maestros(idMaestro)
        on delete cascade);
        
create table Mensajes(idMsg int not null auto_increment,
	idMaestro int not null,
	matricula int not null,
    tipo int not null,   -- 1 para Tutor/ 2 para cualquier otro
    enviado varchar(2),  -- E o R para Enviado/Recibido
    msgTexto varchar(500),
    msgArchivo varchar(30),
    fecha date not null,
    constraint idMensajePK primary key(idMsg),
    constraint idAlumnoMensajeFK foreign key(matricula)
		references Alumnos(matricula)on delete cascade,
	constraint idMaestroMensajeFK foreign key(idMaestro)
		references Maestros(idMaestro)on delete cascade);
        
create table Tutorias(idTutorias int not null auto_increment,
	idMaestro int not null,
	matricula int not null,
    constraint idTutoriasPK primary key(idTutorias),
    constraint idAlumnoTutoriasFK foreign key(matricula)
		references Alumnos(matricula) on delete cascade,
	constraint idMaestroTutoriasFK foreign key(idMaestro)
		references Maestros(idMaestro) on delete cascade);

-- tablas de emma para regitros 

create table registroegresados(idregistro int not null auto_increment,
nombre varchar(30),
matricula int(7),
licenciatura varchar(30),
email varchar(30),
nacido int(5),
sexo varchar(3),
ocupacion varchar(70),
direccion varchar(70),
edad  int(3),
constraint idRegitroPK primary key(idregistro));

create table registrotitu(idtitu int not null auto_increment,
nombre varchar(30),
appat varchar(30),
apmat varchar(30),
curp varchar(30),
edad  int(5),
sexo varchar(5),
asesor varchar(30),
asesorexterno varchar(30),
tipotitu varchar(30),
fechatitu varchar(30),
constraint idTituPK primary key(idtitu));
-- Creacion de la tabla EstudioSocioeconomico
create table EstudioSocioeconomico(matricula int not null,
EstadoCivil varchar(15),
institucion varchar(10),
tiempo varchar(30),
estado varchar(50),
vivienda varchar(45),
habitantes varchar(30),
habitaciones varchar(30),
trabajas varchar(5),
trabajo_relacion varchar(5),
transporte varchar(35),
constraint idESCFK foreign key(matricula)
		references Alumnos(matricula) on delete cascade);
        
insert into Estados
values(1,'Aguascalientes'),
	(2,'Baja California'),
	(3,'Baja California Sur'),
	(4,'Campeche'),
	(5,'Coahuila'),
	(6,'Colima'),
	(7,'Chiapas'),
	(8,'Chihuahua'),
	(9,'Estado de Mexico'),
	(10,'Durango'),
	(11,'Guanajuato'),
	(12,'Guerrero'),
	(13,'Hidalgo'),
	(14,'Jalisco'),
	(15,'Mexico'),
	(16,'Michoacan'),
	(17,'Morelos'),
	(18,'Nayarit'),
	(19,'Nuevo Leon'),
	(20,'Oaxaca'),
	(21,'Puebla'),
	(22,'Queretaro'),
	(23,'Quintana Roo'),
	(24,'San Luis Potosi'),
	(25,'Sinaloa'),
	(26,'Sonora'),
	(27,'Tabasco'),
	(28,'Tamaulipas'),
	(29,'Tlaxcala'),
	(30,'Veracruz'),
	(31,'Yucatan'),
	(32,'Zacatecas');

insert into Usuarios -- idUsuario,usuario,passwordd,nivel
values
    (1,'LOPT980219HOCPRM07','LOPT980219HOCPRM07',1),
	(2,'RAGF950708HOCMMR00','RAGF950708HOCMMR00',3),
    (3,'JIMA980316MOCMRN09','JIMA980316MOCMRN09',3),
    (4,'CUPE950320HOCRRM06','CUPE950320HOCRRM06',3),
    (5,'EULV980627HOCFPC08','EULV980627HOCFPC08',3),
    (6,'ROMN961123MOCVRY05','ROMN961123MOCVRY05',3),
    (7,'CURP7','CURP7',2),
    (8,'CURP8','CURP8',2),
    (9,'CURP9','CURP9',2),
    (10,'CURP10','CURP10',2),
    (11,'CURP11','CURP11',2),
    (12,'CURP12','CURP12',2),
    (13,'CURP13','CURP13',2),
    (14,'CURP14','CURP14',2),
    (15,'CURP15','CURP15',2),
    (16,'CURP16','CURP16',2),
    (17,'CURP17','CURP17',2),
    (18,'CURP18','CURP18',2);
    
insert into Personas -- tipo????????
-- idPersona,idUsuario,nombre,apPat,apMat,correo,domicilio,idEstado,edad,edoCivil,fechaIngreso,curp,tipo
values
	(2,2,'FERNANDO MIGUEL','RAMOS','GOMEZ','framos-1m@hotmail.com','Iztaccihuatl #611-A Col.Volcanes',20,23,'Soltero','2016-08-21','RAGF950708HOCMMR00','H'),
    (1,1,'TOMAS','LOPEZ','PEREZ','Thomy-891@hotmail.com','Privada de Pedro crz, santiago etla SN',20,20,'Soltero','2016-08-21','LOPT980219HOCPRM07','H'),
    (3,3,'ANDREA','JIMENEZ','MARTINEZ','jima_98@hotmail.com','Circuito Santa Rosa #101 Col.Nezacubi',20,20,'Soltera','2016-08-21','JIMA980316MOCMRN09','M'),
    (4,4,'EMMANUEL','PERALTA','LOPEZ','peralta561@outlook.es','Col. Gomez Sandoval 5 Señores calle Venustiano Carranza #304',20,20,'Soltero','2016-08-21','CUPE950320HOCRRM06','H'),
    (5,5,'VICTOR EMANUEL','EUFRACIO','LOPEZ','eufracio3@hotmail.com','Segunda privada de Febrero #104 Col. 5 Señores',15,18,'Soltero','2016-08-21','EULV980627HOCFPC08','H'),
    (6,6,'NAYELI','MARTINEZ','NICOLAS','dinelirobles@hotmail.com','Josefa Ortiz de Dominguez #109',4,18,'Soltera','2016-08-21','ROMN961123MOCVRY05','M'),
    (7,7,'JOSE LUIS','CANO','PEREZ','JOSE_LUIS@hotmail.com','Colegio Militar #512 Col.Santa Lucia Del Camino',20,40,'Soltero','2014-07-01','CURP7','H'),
    (8,8,'ANA LAURA','JIMENEZ','ARTHUR','ANA_LAURA@hotmail.com','Colegio Militar #512 Col.Santa Lucia Del Camino',20,40,'Casado','2014-07-01','CURP8','H'),
    (9,9,'MARIA DEL PILAR','BERISTAIN','COLORADO','BeRIstaIN85@hotmail.com','Colegio Militar #512 Col.Santa Lucia Del Camino',20,40,'Casada','2014-07-01','CURP9','M'),
    (10,10,'NOE TRINIDAD','TAPIA','BONILLA','Noe_TRiniDAD346@hotmail.com','Colegio Militar #512 Col.Santa Lucia Del Camino',20,40,'Casado','2014-07-01','CURP10','H'),
    (11,11,'JORGE FERNANDO','AMBROS','ANTEMATE','AMbrOsvg34e@hotmail.com','Colegio Militar #512 Col.Santa Lucia Del Camino',20,40,'Casado','2014-07-01','CURP11','H'),
    (12,12,'FACUNDO SANTIAGO','CANSECO','RAMOS','CanSECOd457@hotmail.com','Colegio Militar #512 Col.Santa Lucia Del Camino',20,40,'Soltero','2014-07-01','CURP12','H'),
    (13,13,'OMAR AUGUSTO','HERNANDEZ','FLORES','hernflo0043@hotmail.com','Colegio Militar #512 Col.Santa Lucia Del Camino',20,40,'Casado','2014-07-01','CURP13','H'),
    (14,14,'PATRICIA','BATRES','MENDOZA','pabame25@hotmail.com','Colegio Militar #512 Col.Santa Lucia Del Camino',20,40,'Casada','2014-07-01','CURP14','M'),
    (15,15,'ERICK ISRAEL','GUERRA','HERNANDEZ','Erigu3rr4@hotmail.com','Colegio Militar #512 Col.Santa Lucia Del Camino',20,40,'Casado','2014-07-01','CURP15','H'),
    (16,16,'MARIA DE JESUS','ESTUDILLO','AYALA','marchuy@hotmail.com','Colegio Militar #512 Col.Santa Lucia Del Camino',20,40,'Casada','2014-07-01','CURP16','M'),
    (17,17,'MIRIAM','GARCIA','GARCIA','miri16dd94@hotmail.com','Colegio Militar #512 Col.Santa Lucia Del Camino',20,40,'Soltera','2014-07-01','CURP17','M'),
    (18,18,'JAIME','GUTIERREZ','GUTIERREZ','jam4gut8y4@hotmail.com','Colegio Militar #512 Col.Santa Lucia Del Camino',20,40,'Soltera','2014-07-01','CURP18','M');


insert into Alumnos(matricula,idPersona,EscProcedencia,servSocial,statuss,validacion1,validacion2)
-- matricula,idPersona,EscProcedencia,servSocial,statuss,solicitud,pagoServi,ordenPago,validacion1,validacion2
values(103266,2,'Centro de Bachillerato Tecnologico Industrial y de Servicios No.26.',FALSE,'REGULAR',TRUE,FALSE),
	(103267,3,'Colegio de Estudios Científicos y Tecnologicos del Estado de Oaxaca Plantel 05.',FALSE,'REGULAR',FALSE,FALSE),
    (103268,4,'Colegio de Bachilleres del Estado de Oaxaca No.08',FALSE,'REGULAR',TRUE,FALSE),
    (103269,5,'Intituto de Bachilleratos del Estado de Oaxaca No.03',FALSE,'REGULAR',FALSE,FALSE),
    (103270,6,'Centro de Bachillerato Tecnologico Agropecuario No.203',FALSE,'REGULAR',FALSE,FALSE);
    
select * from Alumnos;

insert into Maestros(idMaestro,idPersona,tipo,categoria,numHoras)
-- idMaestro,idPersona,expLaboral,tipo,categoria,numHoras
values(1,7,'ING.','Electronica',480),
	(2,8,'M.C.','Redes',480),
    (3,9,'M.C.','Programacion',480),
    (4,10,'M.C.','Matematicas',480),
    (5,11,'M.S.C.','Bases de datos',480),
    (6,12,'LIC.','Ingles',480),
    (7,13,'DR.','Matematicas',480),
    (8,14,'M.C.','Programacion',480),
    (9,15,'M.C.','Computacion',480),
    (10,16,'M.I.E.','Programacion',480),
    (11,17,'MTRA.','Inglés',480),
    (12,18,'DR.','Matematicas',480),
	(13,1,'M.C.','Programacion',400);
    
insert into CicloEsc -- idCiclo,descripcion
values(1,'ciclo 2016-2016','2016-02-18','2016-07-05'),
	(2,'ciclo 2016-2017','2016-08-21','2017-02-12'),
	(3,'ciclo 2017-2017','2017-02-18','2017-07-05'),
    (4,'ciclo 2017-2018','2017-08-21','2018-01-12'),
    (5,'ciclo 2018-2018','2018-02-18','2018-07-05'),
	(6,'ciclo 2018-2019','2018-08-21','2019-01-12');
    
/*
insert into Carrera  idCarrera,idCiclo,descripcion,nombre,clave
values(1,2,'Escuela de Ciencias, computacion','Licenciatura en computacion',13),
	(2,2,'Escuela de Ciencias, SBIT','Licenciatura en biologia',13),
    (3,5,'Escuela de Ciencias, SBIT','Licenciatura en Ingenieria e Inovacion Tecnologica',13),
	(4,2,'Escuela de Ciencias, computacion','Licenciatura en computacion',13),
    (5,2,'Escuela de Ciencias, computacion','Licenciatura en computacion',13),
    (6,2,'Escuela de Ciencias, computacion','Licenciatura en computacion',13),
    (7,2,'Escuela de Ciencias, computacion','Licenciatura en computacion',13);
*/

insert into Carrera -- idCarrera,descripcion,nombre,clave
values(1,'Escuela de Ciencias, Computacion','Licenciatura en computacion',13),
	(2,'Escuela de Ciencias, SBIT','Licenciatura en biologia',13),
    (3,'Escuela de Ciencias, SBIT','Licenciatura en Ingenieria e Inovacion Tecnologica',13);

insert into Examenes -- idExamen,idCarrera,tipoExamen
values(1,1,'Ordinario'),
	(2,1,'Extra'),
    (3,1,'Titulo 1'),
    (4,1,'Titulo 2');
        
insert into Materias -- idMateria,idMaestro,idExamen,nombre,creditos
values(1,4,2,'MATEMATICAS I',10),
    (2,3,2,'INTRODUCCION A LA COMPUTACION',8),
    (3,5,2,'ESTRUCTURAS DISCRETAS',10),
    (4,2,2,'COMUNICACION ORAL Y ESCRITA',7),
    (5,1,2,'CIRCUITOS ELECTRICOS Y ELECTRONICOS',10),
    (6,4,2,'MATEMATICAS II',10),
    (7,6,2,'INGLES BASICO',7),
    (8,3,2,'FUNDAMENTOS DE PROGRAMACION',11),
    (9,1,2,'ELECTRONICA DIGITAL',10),
    (10,2,2,'DESARROLLO SUSTENTABLE',7),
    (11,12,2,'ALGEBRA LINEAL',10),
    (12,8,2,'PROGRAMACION I',11),
    (13,7,2,'MATEMATICAS DISCRETAS',10),
    (14,4,2,'MATEMATICAS III',10),
    (15,6,2,'INGLES ELEMENTAL',7),
    (16,5,2,'FUNDAMENTOS DE BASES DE DATOS',10),
    (17,3,2,'ESTRUCTURA DE DATOS',10),
    (18,8,2,'SISTEMAS OPERATIVOS',9),
    (19,8,2,'PROGRAMACION II',11),
    (20,7,2,'PROBABILIDAD Y ESTADISTICA',10),
    (21,6,2,'INGLES PREINTERMEDIO',7),
    (22,3,2,'BASES DE DATOS',10),
    (23,9,2,'ARQUITECTURA DE COMPUTADORAS',9),
    (24,2,2,'REDES DE COMPUTADORAS',10),
    (25,8,2,'PROGRAMACION WEB',11),
    (26,11,2,'INGLES INTERMEDIO',7),
    (27,1,2,'DERECHOS HUMANOS Y ETICA PROFESIONAL',7),
    (28,10,2,'ANALISIS DE ALGORITMOS',10),
    (29,10,2,'TEORIA DE AUTOMATAS Y LENGUAJES FORMALES',10),
    (30,8,2,'INGENIERIA DE SOFTWARE',10),
    (31,2,2,'SISTEMAS DISTRIBUIDOS',10),
    (32,1,2,'METODOLOGIA DE LA INVESTIGACION',10),
    (33,11,2,'INGLES AVANZADO',10),
    (34,10,2,'PROCESAMIENTO DE IMAGENES',10),
    (35,10,2,'INTELIGENCIA ARTIFICIAL',10),
    (36,5,2,'BASES DE DATOS DISTRIBUIDAS',10),
    (37,10,2,'GRAFICACION',10),
    (38,8,2,'COMPILADORES',10),
    (39,8,2,'SEGURIDAD INFORMATICA',10),
    (40,1,2,'OPTATIVA I',10),
    (41,1,2,'OPTATIVA II',10),
    (42,1,2,'OPTATIVA II',10),
    (43,1,2,'OPTATIVA IV',10);
    
insert into Calificaciones -- idCiclo,idExamen,matricula,idMateria,calificacion,fecha
values(2,1,103266,1,9,'2017-01-10'),
	(2,1,103266,2,9,'2017-01-19'),
    (2,1,103266,3,5,'2017-01-12'),
    (2,1,103266,4,9,'2017-01-16'),
    (2,1,103266,5,10,'2017-01-18'),
	(3,1,103266,6,8,'2017-06-20'),
    (3,1,103266,7,10,'2017-06-26'),
    (3,1,103266,8,10,'2017-06-19'),
    (3,1,103266,9,10,'2017-06-19'),
    (3,1,103266,10,9,'2017-06-28'),
    (3,1,103266,11,10,'2017-06-21'),
    (4,1,103266,12,10,'2018-01-12'),
    (4,1,103266,13,8,'2018-01-10'),
    (4,1,103266,14,9,'2018-01-15'),
    (4,1,103266,15,10,'2018-01-08'),
    (4,1,103266,16,8,'2018-01-11'),
    (4,1,103266,17,10,'2018-01-11'),
    (5,1,103266,18,10,'2018-06-22'),
    (5,1,103266,19,10,'2018-06-20'),
    (5,1,103266,20,9,'2018-06-19'),
    (5,1,103266,21,10,'2018-06-26'),
    (5,1,103266,22,9,'2018-06-21'),
    (5,1,103266,23,9,'2018-06-25'),
    
    (2,1,103267,1,10,'2017-01-10'),
	(2,1,103267,2,9,'2017-01-19'),
    (2,1,103267,3,10,'2017-01-12'),
    (2,1,103267,4,9,'2017-01-16'),
    (2,1,103267,5,8,'2017-01-18'),
	(3,1,103267,6,9,'2017-06-20'),
    (3,1,103267,7,9,'2017-06-26'),
    (3,1,103267,8,10,'2017-06-19'),
    (3,1,103267,9,10,'2017-06-19'),
    (3,1,103267,10,10,'2017-06-28'),
    (3,1,103267,11,9,'2017-06-21'),
    (4,1,103267,12,9,'2018-01-12'),
    (4,1,103267,13,9,'2018-01-10'),
    (4,1,103267,14,10,'2018-01-15'),
    (4,1,103267,15,8,'2018-01-08'),
    (4,1,103267,16,10,'2018-01-11'),
    (4,1,103267,17,9,'2018-01-11'),
    
    (3,1,103268,1,0,'0000-00-00'),
    (3,1,103268,2,0,'0000-00-00'),
    (3,1,103268,3,0,'0000-00-00'),
    (3,1,103268,4,0,'0000-00-00'),
    (3,1,103268,5,0,'0000-00-00'),
    
	(2,1,103269,1,7,'2017-01-10'),
	(2,1,103269,2,8,'2017-01-19'),
    (2,1,103269,3,7,'2017-01-12'),
    (2,1,103269,4,6,'2017-01-16'),
    (2,1,103269,5,8,'2017-01-18'),
	(3,1,103269,6,8,'2017-06-20'),
    (3,1,103269,7,8,'2017-06-26'),
    (3,1,103269,9,9,'2017-06-19'),
    (3,1,103269,10,9,'2017-06-28'),
    (3,1,103269,11,5,'2017-06-21'),
    (4,1,103269,8,9,'2018-01-12'),
    (4,1,103269,12,10,'2018-01-11'),
    (4,1,103269,13,8,'2018-01-11'),
    (4,1,103269,14,10,'2018-01-08'),
    (4,1,103269,15,9,'2018-01-11'),
    (4,1,103269,16,8,'2018-01-10'),
    (4,1,103269,17,8,'2018-01-12'),
    
    (3,1,103270,1,8,'2017-06-20'),
    (3,1,103270,2,10,'2017-06-26'),
    (3,1,103270,3,7,'2017-06-19'),
    (3,1,103270,4,10,'2017-06-19'),
    (3,1,103270,5,9,'2017-06-28');
    
    
insert into Mensajes(idMaestro,matricula,tipo,enviado,msgTexto,fecha) -- idMsg,idMaestro,matricula,tipo,enviado,msgTexto,msgArchivo,fecha
	values(1,103266,2,'E1','Se le invita a la platica de becas manutencion y tranporte.','2018-11-24'),
    (2,103266,2,'E1','Revision de tareas el dia 30 de Noviembre del 2018 para concluir con la materia.','2018-11-24'),
    (1,103266,2,'E1','Tutoria','2018-11-24'),
    (4,103266,2,'R2','Motivo regularizacion del curso matematicas III debido a la perdida de clases (Motivo de bloqueos) ','2018-11-24');
insert into Mensajes(idMaestro,matricula,tipo,enviado,msgTexto,msgArchivo,fecha)
    values(6,103266,2,'R1','Tarea prezzi.(Ramos Gomez Fernando Miguel)','BLUES (Ramos Gomez Fernando Miguel).pptx','2018-11-24'),
    (8,103266,2,'E2','Tarea Char Codes.(Ramos Gomez Fernando Miguel)','Char Codes (Key Codes).pdf','2018-11-24');
    
insert into Tutorias(idMaestro,matricula) -- idTutorias,idMaestro,matricula
	values(1,103266),
    (2,103267),
    (1,103268),
    (4,103269),
    (6,103270);
    
INSERT INTO egresados (idEgresado,matricula,actExtra, servSocial) 
VALUES 
(1, 103270, 80, 'false'), 
(2, 103267, 53, 'true'), 
(3, 103268, 32, 'true'), 
(4, 103269, 0, 'true');


INSERT INTO modtitulacion (idMTitulacion, idEgresado, modalidad, descripcion) 
VALUES (5, 2, 'tesis', ' no cambies te quiero att:administrador'), (2, 3, 'tesina', 'tu puedes campeon');



INSERT INTO titulos (idTitulo, idMTitulacion, matricula,fecha,idAsesor,mencion)
 VALUES (1,2, 103269, '2018-11-07', NULL, 'null'), 
(2, 2, 103268, '2018-11-01', NULL, 'a la mejor investigacion'),
(3, 2, 103267, '2018-11-04', NULL, 'a la mejor tesis');

SELECT idMaestro FROM Tutorias WHERE matricula = 103266;

CREATE OR REPLACE VIEW Plan_Alumno AS
	SELECT us.usuario,pe.nombre,pe.apPat,pe.apMat,pe.fechaIngreso,al.matricula,
    al.servSocial,al.statuss,ce.idCiclo,ce.descripcion,ca.calificacion,ca.fecha,
    ex.tipoExamen,car.idCarrera,car.nombre nombreLic,ma.nombre nombreMat,ma.creditos,inicioCiclo,finCiclo,-- Agregar inicioCiclo y Agregar finCiclo
	(SELECT p.nombre FROM
	Personas p INNER JOIN Maestros m ON p.idPersona = m.idPersona
	WHERE m.idMaestro = mtr.idMaestro) nombreMtr,
	(SELECT p.apPat FROM
	Personas p INNER JOIN Maestros m ON p.idPersona = m.idPersona
	WHERE m.idMaestro = mtr.idMaestro) apPatMtr,
	(SELECT p.apMat FROM
	Personas p INNER JOIN Maestros m ON p.idPersona = m.idPersona
	WHERE m.idMaestro = mtr.idMaestro) apMatMtr,
    (SELECT m.idMaestro FROM                                                                             -- Agregar idMtr
	Personas p INNER JOIN Maestros m ON p.idPersona = m.idPersona
	WHERE m.idMaestro = mtr.idMaestro) idMtr
		FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
		INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
		INNER JOIN Calificaciones ca ON al.matricula = ca.matricula
		INNER JOIN Examenes ex ON ca.idExamen = ex.idExamen
		INNER JOIN Carrera car ON ex.idCarrera = car.idCarrera
		INNER JOIN CicloEsc ce ON ca.idCiclo = ce.idCiclo
		INNER JOIN Materias ma ON ma.idMateria = ca.idMateria
		INNER JOIN Maestros mtr ON ma.idMaestro = mtr.idMaestro;
		-- WHERE us.usuario = 'RAGF950708HOCMMR00';

SELECT * FROM Plan_Alumno WHERE usuario = 'RAGF950708HOCMMR00';

SELECT * FROM Plan_Alumno WHERE usuario = 'CURP4';

SELECT max(idCiclo) maximo FROM Plan_Alumno WHERE usuario = 'CURP4';

CREATE OR REPLACE VIEW Calif_Alumno AS
	SELECT ce.idCiclo,ce.descripcion,ma.nombre nombreMat,ca.calificacion,ca.fecha,ex.tipoExamen,us.usuario
		FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
		INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
		INNER JOIN Calificaciones ca ON al.matricula = ca.matricula
		INNER JOIN Examenes ex ON ca.idExamen = ex.idExamen
		INNER JOIN Carrera car ON ex.idCarrera = car.idCarrera
		INNER JOIN CicloEsc ce ON ca.idCiclo = ce.idCiclo
		INNER JOIN Materias ma ON ma.idMateria = ca.idMateria
		INNER JOIN Maestros mtr ON ma.idMaestro = mtr.idMaestro;
        
SELECT * FROM Calif_Alumno WHERE usuario = 'RAGF950708HOCMMR00';

CREATE OR REPLACE VIEW Materias_Alumno AS
SELECT ca.idCarrera,ca.nombre nombreLic,ma.idMateria,ma.nombre nombreMat,ma.creditos 
	FROM Carrera ca INNER JOIN Examenes ex ON ca.idCarrera = ex.idCarrera
	INNER JOIN Materias ma ON ex.idExamen = ma.idExamen;

SELECT * FROM Materias_Alumno WHERE idCarrera = 1;        

CREATE OR REPLACE VIEW Aprobada_Alumno AS
	SELECT us.usuario,ma.idMateria,ma.nombre nombreMat,ca.calificacion,ma.creditos   -- agregar ma.creditos
		FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
		INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
		INNER JOIN Calificaciones ca ON al.matricula = ca.matricula
		INNER JOIN Examenes ex ON ca.idExamen = ex.idExamen
		INNER JOIN Carrera car ON ex.idCarrera = car.idCarrera
		INNER JOIN CicloEsc ce ON ca.idCiclo = ce.idCiclo
		INNER JOIN Materias ma ON ma.idMateria = ca.idMateria
		INNER JOIN Maestros mtr ON ma.idMaestro = mtr.idMaestro
        WHERE ca.calificacion >= 6 ;

SELECT * FROM Aprobada_Alumno WHERE usuario = 'RAGF950708HOCMMR00' AND idMateria = 4;

SELECT * FROM Aprobada_Alumno WHERE usuario = 'CURP4' AND idMateria = 1;

SELECT m.idMaestro,p.nombre,p.apPat,p.apMat 
FROM Usuarios u INNER JOIN Personas p ON u.idUsuario = p.idUsuario
		INNER JOIN Maestros m ON p.idPersona = m.idPersona
        WHERE u.nivel=1;

CREATE OR REPLACE VIEW Reprobada_Alumno AS
	SELECT us.usuario,ma.idMateria,ma.nombre nombreMat,ca.calificacion,ma.creditos   -- agregar ma.creditos
		FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
		INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
		INNER JOIN Calificaciones ca ON al.matricula = ca.matricula
		INNER JOIN Examenes ex ON ca.idExamen = ex.idExamen
		INNER JOIN Carrera car ON ex.idCarrera = car.idCarrera
		INNER JOIN CicloEsc ce ON ca.idCiclo = ce.idCiclo
		INNER JOIN Materias ma ON ma.idMateria = ca.idMateria
		INNER JOIN Maestros mtr ON ma.idMaestro = mtr.idMaestro
        WHERE ca.calificacion <= 5 AND ca.calificacion > 0;

SELECT * FROM Reprobada_Alumno WHERE usuario = 'RAGF950708HOCMMR00' AND idMateria = 3;

CREATE OR REPLACE VIEW Horario_Alumno AS
	SELECT mat.creditos,mat.idMateria,mat.nombre nombreMat,per.nombre nombrePro,per.apPat,per.apMat
		FROM Materias mat INNER JOIN Maestros mae 
		ON mat.idMaestro = mae.idMaestro INNER JOIN Personas per 
		ON mae.idPersona = per.idPersona;
        
SELECT * FROM Horario_Alumno WHERE nombreMat = 'ESTRUCTURAS DISCRETAS';

SELECT al.matricula,pe.fechaIngreso,pe.nombre nombreA,pe.apPat,pe.apMat,
pe.correo,es.nombre nombreE,pe.domicilio,pe.edad,pe.edoCivil,pe.tipo
FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
	INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
    INNER JOIN Estados es ON pe.idEstado = es.idEstado
	WHERE us.usuario = 'RAGF950708HOCMMR00';

CREATE OR REPLACE VIEW Mensaje_Alumno AS
	SELECT per.nombre,per.apPat,per.apMat,per.correo,msg.idMsg,msg.msgTexto,
	msg.msgArchivo,msg.tipo,msg.fecha,msg.idMaestro,msg.matricula,msg.enviado
	FROM Mensajes msg 
		INNER JOIN Maestros mtr ON msg.idMaestro = mtr.idMaestro
		INNER JOIN Personas per ON mtr.idPersona = per.idPersona;
       
SELECT * FROM Mensaje_Alumno WHERE matricula = 103266;

SELECT * FROM Maestros m INNER JOIN Personas p ON m.idPersona = p.idPersona;

SELECT DISTINCT idCiclo FROM Calificaciones WHERE matricula = 103266;

-- idMsg,idMaestro,matricula,tipo,enviado,msgTexto,msgArchivo,fecha
/*
SELECT CURDATE();
INSERT INTO Mensajes(idMaestro,matricula,tipo,enviado,msgTexto,msgArchivo,fecha) 
			values(4,103266,1,'E','Prueba  mensajes','prueba',(SELECT CURDATE()));
*/

CREATE OR REPLACE VIEW Boleta_Alumno AS
	SELECT pe.nombre,pe.apPat,pe.apMat,al.matricula,us.usuario,car.nombre nombreLic,ce.idCiclo,ce.descripcion,
    ma.creditos,ma.idMateria,ma.nombre nombreMat,ca.calificacion,ca.fecha,ex.tipoExamen,pe.fechaIngreso,
		(SELECT count(ca.calificacion)
		FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
		INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
		INNER JOIN Calificaciones ca ON al.matricula = ca.matricula
		INNER JOIN Examenes ex ON ca.idExamen = ex.idExamen
		INNER JOIN Carrera car ON ex.idCarrera = car.idCarrera
		INNER JOIN CicloEsc ce ON ca.idCiclo = ce.idCiclo
		INNER JOIN Materias ma ON ma.idMateria = ca.idMateria
		INNER JOIN Maestros mtr ON ma.idMaestro = mtr.idMaestro) numMaterias
			FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
			INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
			INNER JOIN Calificaciones ca ON al.matricula = ca.matricula
			INNER JOIN Examenes ex ON ca.idExamen = ex.idExamen
			INNER JOIN Carrera car ON ex.idCarrera = car.idCarrera
			INNER JOIN CicloEsc ce ON ca.idCiclo = ce.idCiclo
			INNER JOIN Materias ma ON ma.idMateria = ca.idMateria
			INNER JOIN Maestros mtr ON ma.idMaestro = mtr.idMaestro;
        
SELECT * FROM Boleta_Alumno WHERE usuario = 'RAGF950708HOCMMR00' AND idCiclo = 3;

CREATE OR REPLACE VIEW minCiclo_Alumno AS
	SELECT min(ce.idCiclo) minimo,us.usuario
		FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
		INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
		INNER JOIN Calificaciones ca ON al.matricula = ca.matricula
		INNER JOIN Examenes ex ON ca.idExamen = ex.idExamen
		INNER JOIN Carrera car ON ex.idCarrera = car.idCarrera
		INNER JOIN CicloEsc ce ON ca.idCiclo = ce.idCiclo
		INNER JOIN Materias ma ON ma.idMateria = ca.idMateria
		INNER JOIN Maestros mtr ON ma.idMaestro = mtr.idMaestro;
        
SELECT * FROM minCiclo_Alumno WHERE usuario = 'RAGF950708HOCMMR00';

/*
SELECT * FROM Alumnos;

SELECT p.nombre,p.apPat,p.apMat,p.tipo,a.matricula 
	FROM Usuarios u INNER JOIN Personas p ON u.idUsuario=p.idUsuario 
    INNER JOIN Alumnos a ON p.idPersona=a.idPersona WHERE u.usuario = 'RAGF950708HOCMMR00';
    
CREATE OR REPLACE VIEW Rango_Ciclo AS
	SELECT ce.idCiclo,ce.descripcion,us.usuario -- ,ce.finCiclo,pe.fechaIngreso,min(ce.idCiclo) minimo,max(ce.idCiclo) maximo
		FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
		INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
		INNER JOIN Calificaciones ca ON al.matricula = ca.matricula
		INNER JOIN CicloEsc ce ON ca.idCiclo = ce.idCiclo
        WHERE ce.finCiclo > pe.fechaIngreso;
        
SELECT * FROM Rango_Ciclo WHERE usuario = 'RAGF950708HOCMMR00';

SELECT count(ca.calificacion) numMaterias
	FROM Usuarios us INNER JOIN Personas pe ON us.idUsuario = pe.idUsuario
	INNER JOIN Alumnos al ON pe.idPersona = al.idPersona
	INNER JOIN Calificaciones ca ON al.matricula = ca.matricula
	INNER JOIN Examenes ex ON ca.idExamen = ex.idExamen
	INNER JOIN Carrera car ON ex.idCarrera = car.idCarrera
	INNER JOIN CicloEsc ce ON ca.idCiclo = ce.idCiclo
	INNER JOIN Materias ma ON ma.idMateria = ca.idMateria
	INNER JOIN Maestros mtr ON ma.idMaestro = mtr.idMaestro
	WHERE us.usuario = 'RAGF950708HOCMMR00' AND ce.idCiclo=2;
*/

-- Vista Para Mostrar el numero de alumnos
create or replace view Num_Tut as select u.usuario,p.nombre,p.apPat,p.apMat, count(t.matricula) as n 
         from usuarios u
         inner join personas p on u.idUsuario=p.idUsuario
         inner join maestros m on p.idPersona=m.idPersona
         inner join tutorias t on m.idMaestro=t.idMaestro
         group by t.idMaestro;
       
-- vista para ver los alumnos reprobados

create or replace view Num_Rep as select t.idMaestro,p.nombre, p.apPat, p.apMat,a.matricula,count(c.calificacion) as Mat_Rep
from tutorias t inner join alumnos a on t.matricula=a.matricula
inner join personas p on p.idPersona=a.idPersona
inner join usuarios u on u.idUsuario=p.idUsuario
inner join calificaciones c on c.matricula=a.matricula
where c.calificacion<=5 and c.calificacion>0 group by a.matricula ;

-- Vista para ver los alumnos aprobados

create or replace view Num_Apr as select t.idMaestro,p.nombre, p.apPat, p.apMat,a.matricula,count(c.calificacion) as Mat_Apr
from tutorias t inner join alumnos a on t.matricula=a.matricula
inner join personas p on p.idPersona=a.idPersona
inner join usuarios u on u.idUsuario=p.idUsuario
inner join calificaciones c on c.matricula=a.matricula
where c.calificacion>5 group by a.matricula ;

-- Victa para el Ciclo y Matricula

create or replace view Cal_Ciclo as select a.matricula,ce.descripcion,mat.nombre,c.calificacion from materias mat
inner join calificaciones c on mat.idMateria=c.idMateria
inner join alumnos a on c.matricula=a.matricula
inner join cicloesc ce on ce.idCiclo=c.idCiclo
where c.calificacion>0;

-- Vista para mostrar informacion del maestro y alumno

-- Vista de Alumno
CREATE OR REPLACE VIEW infoAlumno AS SELECT pe.idUsuario,alu.matricula,pe.nombre,pe.apPat,pe.apMat,pe.correo,pe.domicilio,pe.idEstado,pe.edad,pe.edoCivil,pe.curp,pe.tipo,alu.EscProcedencia,alu.servsocial,alu.Statuss
FROM Personas pe inner join alumnos alu  on pe.idPersona=alu.idPersona ; 
-- Vista de Maestro
CREATE OR REPLACE VIEW infoMaestro AS SELECT ma.idMaestro,pe.idPersona,pe.idUsuario,pe.nombre,pe.apPat,pe.apMat,pe.correo,pe.domicilio,pe.curp,ma.tipo,ma.categoria,ma.numHoras,ma.expLaboral
FROM Personas pe inner join Maestros ma  on pe.idPersona=ma.idPersona and pe.idUsuario!=1 ;

-- Vamos a mostrar a todos los maestros
-- vamos a mostrar los mensaje spara el administrador
create or replace view admin as select us.idUsuario,pe.idPersona,ma.idmaestro,us.usuario,us.passwordd,pe.nombre,pe.apPat,pe.apMat from usuarios us inner join personas pe on us.idUsuario=pe.idUsuario inner join maestros ma on pe.idPersona=ma.idmaestro  where us.nivel=1;

select * from Usuarios;
select * from Estados;
select * from Personas;
select * from Maestros;
select * from alumnos;
select * from infoAlumno;-- Vista
select * from infoMaestro;-- Vista
select * from admin;
-- select * from horarioInicial;
select * from CicloEsc;
select * from Carrera;
select * from Examenes;
select * from Materias;
select * from Calificaciones;
select * from Egresados;
select * from ModTitulacion;
select * from Titulos;
select * from tutorias;
select * from mensajes;
/*

select * from infoAlumno where correo='framos-1m@hotmail.com'

INSERT INTO Calificaciones (idciclo,idExamen,matricula,idMateria,Calificacion) VALUES 
                      (1,1,2147483647,1,0),
                      (1,1,2147483647,2,0),
                      (1,1,2147483647,3,0),
                      (1,1,2147483647,4,0),
                      (1,1,2147483647,5,0);
*/
select * from  CicloEsc where descripcion='ciclo 2016-2016';




--  Delete from Usuarios where idusuario=2; -- Debemos agregar el on delete a utorias

