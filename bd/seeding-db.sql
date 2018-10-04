--roles
INSERT INTO roles(id,nombre,descripcion) VALUES(default,'Administrador','Administrador del sistema');
INSERT INTO roles(id,nombre,descripcion) VALUES(default,'Bibliotecario','Persona encargada de labores diarias en biblioteca');
INSERT INTO roles(id,nombre,descripcion) VALUES(default,'Prestamista','Persona con capacidad de solicitar libros');

-- creacion de dos usuarios 
INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'admin','admin','erick@dot.com',now(),'Erick Ventura','M',1);

INSERT INTO users(id,username,password, email, fechanacimiento, nombre, sexo,idRol)
VALUES(default,'bib','bib','vero@dot.com',now(),'Veronica Reyes','F',2);


-- Biblioteca y bibliotecario ejemplo
INSERT INTO bibliotecas(id,nombre,ubicacion,telefono,clasificacion,logourl,nombrelogo,email)
VALUES (default,'Biblioteca el universitario','San Salvador','7812-1231','Publica','https://dinaryok','logoBonito','esbib@ues.edu.sv');
INSERT INTO bibliotecarios(id,dui,telefono,idUser,idbiblioteca) VALUES (default,'01212-123','7612-1231',2,1);