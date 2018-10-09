--roles
INSERT INTO roles(id,nombre,descripcion) VALUES(default,'Administrador','Administrador del sistema');
INSERT INTO roles(id,nombre,descripcion) VALUES(default,'Bibliotecario','Persona encargada de labores diarias en biblioteca');
INSERT INTO roles(id,nombre,descripcion) VALUES(default,'Prestamista','Persona con capacidad de solicitar libros');

-- creacion de dos usuarios 
INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'admin','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','erick@dot.com',now(),'Erick Ventura','M',1);

INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'bib1','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','vero@dot.com',now(),'Veronica Reyes','F',2);


INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'bib2','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','crisk@dot.com',now(),'Christian','M',2);

INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'bib3','$2a$08$zEAVp2Ei086gZXWwqNri2eY0WbBY0YWrz.Sn2TFkvHJKxs53kaRIK','paty@dot.com',now(),'Paty Paty','F',2);

-- Biblioteca y bibliotecario ejemplo
INSERT INTO bibliotecas(id,nombre,ubicacion,telefono,clasificacion,logourl,nombrelogo,email)
VALUES (default,'Biblioteca el universitario','San Salvador','7812-1231','Publica','https://dinaryok','logoBonito','esbib@ues.edu.sv');

INSERT INTO bibliotecas(id,nombre,ubicacion,telefono,clasificacion,logourl,nombrelogo,email)
VALUES (default,'Biblioteca el jocote','San Marcos','7412-1231','Privada','https://diasok','logoFEO','esbib@priv.edu.sv');

INSERT INTO bibliotecas(id,nombre,ubicacion,telefono,clasificacion,logourl,nombrelogo,email)
VALUES (default,'Biblioteca el zapote','San Martin','7312-1231','Privada','https://diasoask','logoRegular','esbibib@priv.edu.sv');

INSERT INTO bibliotecarios(id,dui,telefono,idUser,idbiblioteca) VALUES (default,'01212-123','7612-1231',2,1);
INSERT INTO bibliotecarios(id,dui,telefono,idUser,idbiblioteca) VALUES (default,'01212-123','7612-1231',3,2);
INSERT INTO bibliotecarios(id,dui,telefono,idUser,idbiblioteca) VALUES (default,'01212-123','7612-1231',4,3);
--LEER usuarios de prueba
-- admin => pasword = 123456
--  todos bib => password =123456