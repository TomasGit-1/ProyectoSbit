drop database if exists SBIT;
create database SBIT;
use SBIT;

create table Usuarios(
    idUsuario int not null auto_increment,
	usuario varchar(30) not null,passwordd varchar(10),
 nivel int not null,
    constraint idUsuarioPK primary key(idUsuario));
    
create table Estados(
    idEstado int not null auto_increment,
	nombre varchar(30) not null,
    constraint idEstadoPK primary key(idEstado));
    
create table Personas(
    idPersona int not null auto_increment,
	idUsuario int not null,
    nombre varchar(22) not null,
    apPat varchar(15),
    apMat varchar(15),
    correo varchar(30),
    domicilio varchar(40) not null,
    idEstado int,
    edad int not null,
    edoCivil varchar(10) not null,
    fechaIngreso date not null,
    tipo int not null,
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
    EscProcedencia varchar(20) not null,
    servSocial boolean not null,
    statuss varchar(15) not null,
    constraint idAlumnoPK primary key(matricula),
    constraint idPersonaAlumnoFK foreign key(idPersona)
		references Personas(idPersona)
        on delete cascade);
        
create table CicloEsc(idCiclo int not null auto_increment,
	descripcion varchar(20) not null,
    constraint idCicloPK primary key(idCiclo));
    
create table Carrera(idCarrera int not null auto_increment,
	idCiclo int not null,
	descripcion varchar(50),
    nombre varchar(50) not null,
    clave int not null,
    constraint idCarreraPK primary key(idCarrera),
    constraint idCicloCarreraFK foreign key(idCiclo)
		references CicloEsc(idCiclo)
        on delete cascade);

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
	nombre varchar(15) not null,
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
    fecha date not null,
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
        
/*
insert into Usuarios
values(103266,'Ferzhop','qwerty123',1),
	(103267,'Tomy','qwerty123',1),
    (103268,'Paty','qwerty123',2),
    (103269,'Victor','qwerty123',1),
    (103270,'Cano','qwerty123',2),
    (103271,'Andy','qwerty123',1);
    
insert into Alumnos
values(103266,8,9,10),
	(103267,9,10,8),
    (103269,10,9,8),
    (103271,10,9,8);
    
SELECT * FROM Usuarios;
SELECT * FROM Alumnos;
*/