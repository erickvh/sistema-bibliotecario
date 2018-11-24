--Creación de bibliotecas
INSERT INTO bibliotecas(id,nombre,ubicacion,telefono,clasificacion,logourl,nombrelogo,email)
VALUES (1,'Biblioteca 1','San Salvador','7812-1231','Publica','https://res.cloudinary.com/demo/image/upload/w_32,h_32,c_scale/turtles.jpg','logoBonito','esbib@ues.edu.sv');

--Creación de categorías
INSERT INTO categorias(id,nombre,descripcion,codigo,idBiblioteca)
VALUES (1,'Matemáticas','Esta categoría contiene libros/recursos sobre matemáticas.','MAT',1);

INSERT INTO categorias(id,nombre,descripcion,codigo,idBiblioteca)
VALUES (2,'Física','Esta categoría contiene libros/recursos sobre física','FIR',1);

INSERT INTO subcategorias(id,nombre,descripcion,codigo,idCategoria)
VALUES (1,'Cálculo integral','Esta subcategoría contiene libros/recursos sobre cálculo integral.','CAL',1);

INSERT INTO subcategorias(id,nombre,descripcion,codigo,idCategoria)
VALUES (2,'Ecuaciones diferenciales','Esta subcategoría contiene libros/recursos sobre ecuaciones diferenciales.','ECD',1);

INSERT INTO subcategorias(id,nombre,descripcion,codigo,idCategoria)
VALUES (3,'Física clásica','Esta subcategoría contiene libros/recursos sobre física clásica.','FIC',2);

INSERT INTO subcategorias(id,nombre,descripcion,codigo,idCategoria)
VALUES (4, 'Electromagnetismo','Esta subcategoría contiene libros/recursos sobre electromagnetismo.','ELM',2);

-- 'mes-día-año'
INSERT INTO autores(id,nombre,nacionalidad,fechaNacimiento,sexo,idBiblioteca)
VALUES (1,'David Halliday','Estados Unidos','3-3-1916','M',1);

INSERT INTO autores(id,nombre,nacionalidad,fechaNacimiento,sexo,idBiblioteca)
VALUES (2,'Robert Resnick','Estados Unidos','11-1-1923','M',1);

INSERT INTO autores(id,nombre,nacionalidad,fechaNacimiento,sexo,idBiblioteca)
VALUES (3,'Kenneth S. Krane','Estados Unidos','5-15-1944','M',1);

INSERT INTO autores(id,nombre,nacionalidad,fechaNacimiento,sexo,idBiblioteca)
VALUES (4,'Francis Sears','Estados Unidos','10-1-1898','M',1);

INSERT INTO autores(id,nombre,nacionalidad,fechaNacimiento,sexo,idBiblioteca)
VALUES (5,'Mark Zemansky','Estados Unidos','5-5-1900','M',1);

INSERT INTO autores(id,nombre,nacionalidad,fechaNacimiento,sexo,idBiblioteca)
VALUES (6,'Hugh D. Young','Estados Unidos','11-3-1930','M',1);

INSERT INTO autores(id,nombre,nacionalidad,sexo,idBiblioteca)
VALUES (7,'Edwin J. Purcell','Estados Unidos','M',1);

INSERT INTO autores(id,nombre,nacionalidad,sexo,idBiblioteca)
VALUES (8,'Dale Verberg','Estados Unidos','M',1);

INSERT INTO autores(id,nombre,nacionalidad,,sexo,idBiblioteca)
VALUES (9,'Steven E. Rigdon','Estados Unidos','M',1);

INSERT INTO autores(id,nombre,nacionalidad,fechaNacimiento,sexo,idBiblioteca)
VALUES (10,'Roland Larson','Estados Unidos','9-31-1941','M',1);

--Creación de materiales bibliográficos
INSERT INTO materialesBibliograficos(id,nombre,descripcion,esExterno,idBiblioteca,idSubcategoria)
VALUES(1,'Física','Libro de física clásica.',true,1,3);

INSERT INTO materialesBibliograficos(id,nombre,descripcion,esExterno,idBiblioteca,idSubcategoria)
VALUES(2,'Física Universitaria','Libro de física para universitarios.',true,1,3);

INSERT INTO materialesBibliograficos(id,nombre,descripcion,esExterno,idBiblioteca,idSubcategoria)
VALUES(3,'Cálculo con geometría analítica','Libro para aprender cálculo integral y diferencial.',true,1,1);

INSERT INTO materialesBibliograficos(id,nombre,descripcion,esExterno,idBiblioteca,idSubcategoria)
VALUES(4, 'Cálculo diferencial e integral','Libro para aprender cálculo integral y diferencial.',true,1,1);

INSERT INTO materialesBibliograficos(id,nombre,descripcion,esExterno,idBiblioteca,idSubcategoria)
VALUES (5,'Simpson','Programa en Scilab para resolver integrales por el método de Simpson',true,1,1);

--Creación de libros
INSERT INTO libros(id,volumen,editorial,isbn,idMaterial)
VALUES (1,'Vol. 1','Editorial continental','0-471-80458-4',1);

INSERT INTO libros(id,volumen,editorial,isbn,idMaterial)
VALUES (2, 'Vol. 1','Pearson educación','978-607-442-288-7',2);

INSERT INTO libros(id,volumen,editorial,isbn,idMaterial)
VALUES (3, 'Vol. 1','McGraw-Hill','970-10-5274-9',3);

INSERT INTO libros(id,volumen,editorial,isbn,idMaterial)
VALUES (4, 'Vol. 1','Pearson educación','978-970-26-0989-6',4);

--Relación autor-material
INSERT INTO materiales_autores(id,idMaterial) VALUES (1,1);
INSERT INTO materiales_autores(idAutor) VALUES (1),(2),(3);

INSERT INTO materiales_autores(id,idMaterial) VALUES (2,2);
INSERT INTO materiales_autores(idAutor) VALUES (4),(5),(6);

INSERT INTO materiales_autores(id,idMaterial) VALUES (3,3);
INSERT INTO materiales_autores(idAutor) VALUES (7),(8),(9);

INSERT INTO materiales_autores(id,idMaterial,idAutor) VALUES (4,4,10);

--Creando formatos
INSERT INTO formatos(id,tipoFormato,descripcion,idBiblioteca)
VALUES (1,'mp3','Archivo de audio en formato mp3.',1);

INSERT INTO formatos(id,tipoFormato,descripcion,idBiblioteca)
VALUES (2,'mp4','Archivo de video en formato mp4.',1);

INSERT INTO formatos(id,tipoFormato,descripcion,idBiblioteca)
VALUES (3,'pdf','Documento de lectura en formato pdf.',1);

INSERT INTO formatos(id,tipoFormato,descripcion,idBiblioteca)
VALUES (4,'docx','Documento Microsoft Word en formato docx.',1);

INSERT INTO formatos(id,tipoFormato,descripcion,idBiblioteca)
VALUES (5,'sce','Archivo que contiene código para resolver integrales para Scilab en formato sce.',1);

--Creando recursos
INSERT INTO recursos(id,idFormato,idMaterial) VALUES (1,3,1);
INSERT INTO recursos(id,idFormato,idMaterial) VALUES (2,3,2);
INSERT INTO recursos(id,idFormato,idMaterial) VALUES (3,3,3);
INSERT INTO recursos(id,idFormato,idMaterial) VALUES (4,3,4);
INSERT INTO recursos(id,idFormato,idMaterial) VALUES (5,5,5);
--Vaya, me sorprende que metiera exacto 40 items, los conté hasta que terminé. :v
