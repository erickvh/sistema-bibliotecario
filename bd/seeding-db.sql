--roles
INSERT INTO roles(id,nombre,descripcion) VALUES(default,'Administrador','Administrador del sistema');
INSERT INTO roles(id,nombre,descripcion) VALUES(default,'Bibliotecario','Persona encargada de labores diarias en biblioteca');
INSERT INTO roles(id,nombre,descripcion) VALUES(default,'Prestamista','Persona con capacidad de solicitar libros');

-- creacion de admin y bibliotecarios
INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'admin','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','erick@dot.com','1994-11-1','Erick Ventura','M',1);

INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'bib1','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','vero@dot.com','1995-11-1','Veronica Reyes','F',2);


INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'bib2','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','crisk@dot.com','1995-11-1','Christian','M',2);

INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'bib3','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','paty@dot.com','1995-11-1','Paty Paty','F',2);

-- creacion de prestamistas
INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'user1','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','user@dot.com','1995-11-1','Axel Hernandez','M',3);

-- Biblioteca y bibliotecario ejemplo
INSERT INTO bibliotecas(id,nombre,ubicacion,telefono,clasificacion,logourl,nombrelogo,email)
VALUES (default,'Biblioteca el universitario','San Salvador','7812-1231','Publica','https://res.cloudinary.com/demo/image/upload/w_32,h_32,c_scale/turtles.jpg','logoBonito','esbib@ues.edu.sv');

INSERT INTO bibliotecas(id,nombre,ubicacion,telefono,clasificacion,logourl,nombrelogo,email)
VALUES (default,'Biblioteca el jocote','San Marcos','7412-1231','Privada','https://res.cloudinary.com/demo/image/upload/w_32,h_32,c_scale/balloons.jpg','logoFEO','esbib@priv.edu.sv');

INSERT INTO bibliotecas(id,nombre,ubicacion,telefono,clasificacion,logourl,nombrelogo,email)
VALUES (default,'Biblioteca el zapote','San Martin','7312-1231','Privada','https://res.cloudinary.com/demo/image/upload/w_32,h_32,c_scale/turtles.jpg','logoRegular','esbibib@priv.edu.sv');

INSERT INTO bibliotecarios(id,dui,telefono,idUser,idbiblioteca) VALUES (default,'01234567-1','7612-1231',2,1);
INSERT INTO bibliotecarios(id,dui,telefono,idUser,idbiblioteca) VALUES (default,'01222527-1','7612-1231',3,2);
INSERT INTO bibliotecarios(id,dui,telefono,idUser,idbiblioteca) VALUES (default,'13454567-2','7612-1231',4,3);
--LEER usuarios de prueba
-- admin => pasword = 123456
--  todos bib => password =123456

INSERT INTO departamentos(nombre) values ('Santa Ana');
    INSERT INTO municipios(nombre, idDepartamento) values ('Candelaria de la Frontera',1);
    INSERT INTO municipios(nombre, idDepartamento) values ('Chalchuapa',1);
    INSERT INTO municipios(nombre, idDepartamento) values ('Coatepeque',1);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Congo',1);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Porvenir',1);
    INSERT INTO municipios(nombre, idDepartamento) values ('Masahuat',1);
    INSERT INTO municipios(nombre, idDepartamento) values ('Metapán',1);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Antonio Pajonal',1);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Sebastián Salitrillo',1);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santa Ana',1);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santa Rosa Guachipilín',1);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santiago de la frontera',1);
    INSERT INTO municipios(nombre, idDepartamento) values ('Texistepeque',1);

INSERT INTO departamentos(nombre) values ('San Salvador');
    INSERT INTO municipios(nombre, idDepartamento) values ('Aguilares',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Apopa',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Ayutuxtepeque',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Cuscatancingo',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Delgado',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Paisnal',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Guazapa',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Ilopango',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Mejicanos',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Nejapa',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Panchimalco',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Rosario de Mora',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Marcos',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Martín',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Salvador',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santiago Texacuangos',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santo Tomás',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Soyapango',2);
    INSERT INTO municipios(nombre, idDepartamento) values ('Tonacatepeque',2);
INSERT INTO departamentos(nombre) values ('San Miguel');
    INSERT INTO municipios(nombre, idDepartamento) values ('Carolina',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('Chapeltique',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('Chirilagua',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('Chinameca',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('Ciudad Barrios',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('Comacarán',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Transito',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('Lolotique',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('Moncagua',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('Nueva Guadalupe',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('Nuevo Edén de San Juan',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('Quelepa',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Antonio',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Gerardo',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Jorge',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Luis de la Reina',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Miguel',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Rafael Oriente',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('Sesori',3);
    INSERT INTO municipios(nombre, idDepartamento) values ('Uluazapa',3);
    
INSERT INTO departamentos(nombre) values ('Sonsonate');
    INSERT INTO municipios(nombre, idDepartamento) values ('Armenia',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Acajutla',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Caluco',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Cuisnahuat',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Izalco',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Juayúa',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Nahuizalco',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Nahuilingo',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Salcoatitán',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Antonio del Monte',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Juián',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santa Catarina Masahuat',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santa Isabel Ishuatán',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santo Domingo de Guzmán',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Sonsonate',4);
    INSERT INTO municipios(nombre, idDepartamento) values ('Sonzacate',4);

INSERT INTO departamentos(nombre) values ('Cuscatlán');
    INSERT INTO municipios(nombre, idDepartamento) values ('Cojutepeque',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('Candelaria',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Carmen',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Rosario',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('Monte San Juan',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('Oratorio de Concepción',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Bartolomé Perulapía',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Cristóbal',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('San José Guayabal',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Pedro Perulapán',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Rafael Cedros',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Ramón',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santa Cruz Analquito',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santo Cruz Michapa',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('Suchitoto',5);
    INSERT INTO municipios(nombre, idDepartamento) values ('Tenancingo',5);

INSERT INTO departamentos(nombre) values ('San Vicente');
    INSERT INTO municipios(nombre, idDepartamento) values ('Apastepeque',6);
    INSERT INTO municipios(nombre, idDepartamento) values ('Guadalupe',6);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Cayetano Istepeque',6);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Esteban Istepeque',6);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Ildefonso',6);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Lorenzo',6);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Sebastian',6);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Vicente',6);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santa Clara',6);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santo Domingo',6);
    INSERT INTO municipios(nombre, idDepartamento) values ('Tecoluca',6);
    INSERT INTO municipios(nombre, idDepartamento) values ('Tepetitán',6);
    INSERT INTO municipios(nombre, idDepartamento) values ('Verapaz',6);



INSERT INTO departamentos(nombre) values ('Ahuachapán');
    INSERT INTO municipios(nombre, idDepartamento) values ('Ahuachapán',7);
    INSERT INTO municipios(nombre, idDepartamento) values ('Apaneca',7);
    INSERT INTO municipios(nombre, idDepartamento) values ('Atiquizaya',7);
    INSERT INTO municipios(nombre, idDepartamento) values ('Concepción de Ataco',7);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Refugio',7);
    INSERT INTO municipios(nombre, idDepartamento) values ('Guaymango',7);
    INSERT INTO municipios(nombre, idDepartamento) values ('Jujutla',7);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Francisco Menéndez',7);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Lorenzo',7);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Pedro Puxtla',7);
    INSERT INTO municipios(nombre, idDepartamento) values ('Tacuba',7);
    INSERT INTO municipios(nombre, idDepartamento) values ('Turín',7);

INSERT INTO departamentos(nombre) values ('La Union');
    INSERT INTO municipios(nombre, idDepartamento) values ('Anamorós',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('Bolivar',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('Concepción de Oriente',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('Conchagua',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Carmen',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Sauce',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('Intipucá',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('La Unión',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('Lislique',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('Meanguera del Golfo',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('Nueva Esparta',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('Pasaquina',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('Polorós',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Alejo',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('San José',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santa Rosa de Lima',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('Yayantique',8);
    INSERT INTO municipios(nombre, idDepartamento) values ('Yucuaiquin',8);


INSERT INTO departamentos(nombre) values ('La Libertad');
    INSERT INTO municipios(nombre, idDepartamento) values ('Antiguo Cuscatlán',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Chiltiupán',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Ciudad Arce',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Colón',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Comasagua',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Huizúcar',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Jayaque',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Jicalapa',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('La Libertad',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santa Tecla',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Nuevo Cuscatlán',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Juan Opico',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Quezaltepeque',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Sacacoyo',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('San José Villanueva',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Matías',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Pablo Tacachico',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Talnique',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Tamanique',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Teotepeque',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Tepecoyo',9);
    INSERT INTO municipios(nombre, idDepartamento) values ('Zaragoza',9);


INSERT INTO departamentos(nombre) values ('Chalatenango');
    INSERT INTO municipios(nombre, idDepartamento) values ('Agua Caliente',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Arcatao',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Azacualpa',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Chalatenango',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Citalá',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Comalapa',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Concepción Quezaltepeque',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Dulce Nombre de María',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Carrizal',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Paraíso',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('La Laguna',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('La Palma',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('La Reina',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Las Vueltas',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Nombre de Jesús',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Nueva Concepción',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Nueva TrinidDepartamentoad',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Ojos de Agua',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Potoníco',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Antonio de la Cruz',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Antonio Los Ranchos',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Fernando',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Francisco Lempa',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Francisco Morazán',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Ignacio',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('San IsidDepartamentoro Labrador',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('San José Cancasque',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('San José Las Flores',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Luis del Carmen',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Miguel de Mercedes',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Rafael',10); 
    INSERT INTO municipios(nombre, idDepartamento) values ('Santa Rita',10);
    INSERT INTO municipios(nombre, idDepartamento) values ('Tejutla',10);
     
INSERT INTO departamentos(nombre) values ('La Paz');
    INSERT INTO municipios(nombre, idDepartamento) values ('Zacatecoluca',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('Cuyultitán',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Rosario',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('Jerusalén',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('Mercedes La Ceiba',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('Olocuilta',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('Paríso de Osorio',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Antonio Masahuat',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Emigdio',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Francisco Chinameca',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Pedro Masahuat',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Juan Nonualco',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Juan Talpa',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Juan Tepezontes',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Luis La Herradura',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Luis Talpa',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Miguel Tepezontes',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Pedro Nonualco',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Rafael Obrajuelo',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santa María Ostuma',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santiago Nonualco',11);
    INSERT INTO municipios(nombre, idDepartamento) values ('Tapalhuaca',11);

INSERT INTO departamentos(nombre) values ('Cabañas');
    INSERT INTO municipios(nombre, idDepartamento) values ('Cinquera',12);
    INSERT INTO municipios(nombre, idDepartamento) values ('Dolores',12);
    INSERT INTO municipios(nombre, idDepartamento) values ('Guacotecti',12);
    INSERT INTO municipios(nombre, idDepartamento) values ('Ilobasco',12);
    INSERT INTO municipios(nombre, idDepartamento) values ('Jutiapa',12);
    INSERT INTO municipios(nombre, idDepartamento) values ('San IsidDepartamentoro',12);
    INSERT INTO municipios(nombre, idDepartamento) values ('Sensuntepeque',12);
    INSERT INTO municipios(nombre, idDepartamento) values ('Tejutepeque',12);
    INSERT INTO municipios(nombre, idDepartamento) values ('Victoria',12);

INSERT INTO departamentos(nombre) values ('Morazan');
    INSERT INTO municipios(nombre, idDepartamento) values ('Arambala',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Cacaopera',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Chilanga',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Corinto',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Delicias de Concepción',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Divisadero',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Rosario',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Gualococti',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Guatajiagua',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Jocoateca',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Jocoro',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Jocoaitique',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Lolotiquillo',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Meanguera',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Osicala',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Perquin',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Carlos',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Fernando',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Francisco Gotera',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Isidro',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Simón',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Sensembra',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Sociedad',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Torola',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Yamabal',13);
    INSERT INTO municipios(nombre, idDepartamento) values ('Yoloaiquin',13);  

INSERT INTO departamentos(nombre) values ('Usulután');
    INSERT INTO municipios(nombre, idDepartamento) values ('Alegría',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Berlin',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('California',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Concepción Batres',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('El Triunfo',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Ereguayquin',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Estanzuelas',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Jiquilisco',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Jucuapa',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Jucuarán',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Mercedes Umaña',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Nueva Granada',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Ozatlán',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Puerto El Triunfo',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Agustin',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Buenaventura',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Dionisio',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('San Francisco Javier',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santa Elena',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santa María',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Santiago de María',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Tecapán',14);
    INSERT INTO municipios(nombre, idDepartamento) values ('Usulután',14);
   

   --Rellenado de prestamista

INSERT INTO prestamistas(lugarDeEstudio,trabaja,estudia,direccion,nombreDePadre,nombreDeMadre,telefono,activo,idUser,idMunicipio,idBibilioteca)
VALUES ('UES', false, true,'Loma grande','Axel Hernandez','Maria Hernandez','7213-1234',true,5,1,1);
