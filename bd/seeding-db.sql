--roles
INSERT INTO roles(id,nombre,descripcion) VALUES(default,'Administrador','Administrador del sistema');
INSERT INTO roles(id,nombre,descripcion) VALUES(default,'Bibliotecario','Persona encargada de labores diarias en biblioteca');
INSERT INTO roles(id,nombre,descripcion) VALUES(default,'Prestamista','Persona con capacidad de solicitar libros');

-- creacion de dos usuarios 
INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'admin','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','erick@dot.com','1994-11-1','Erick Ventura','M',1);

INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'bib1','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','vero@dot.com','1995-11-1','Veronica Reyes','F',2);


INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'bib2','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','crisk@dot.com','1995-11-1','Christian','M',2);

INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'bib3','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','paty@dot.com','1995-11-1','Paty Paty','F',2);

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
