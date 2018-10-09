--TABLAS MENOS DEPENDIENTES 

CREATE TABLE roles(
    id smallserial,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT,
    
    CONSTRAINT pk_roles PRIMARY KEY (id)
);
CREATE TABLE permisos(
    id smallserial,
    tipo VARCHAR(50) NOT NULL,
    descripcion TEXT,

    CONSTRAINT pk_permisos PRIMARY KEY (id)

);

CREATE TABLE bibliotecas(
    id smallserial,
    nombre VARCHAR(120) NOT NULL,
    ubicacion VARCHAR(300) NOT NULL,
    telefono VARCHAR(9) NOT NULL,
    clasificacion VARCHAR(120),
    logoUrl VARCHAR(254),
    nombreLogo VARCHAR(50),
    email VARCHAR(254) UNIQUE,
    
    CONSTRAINT pk_bibliotecas PRIMARY KEY (id)
);

CREATE TABLE categorias(
    id smallserial,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT,
    codigo VARCHAR(8) UNIQUE,

    CONSTRAINT pk_categorias PRIMARY KEY (id)
    
);

CREATE TABLE formatos(
    id smallserial,
    tipoFormato VARCHAR(50) NOT NULL,
    descripcion TEXT,
   
    CONSTRAINT pk_formatos PRIMARY KEY (id)
   
);

CREATE TABLE autores(
    id smallserial,
    nombre VARCHAR(120) NOT NULL,
    nacionalidad VARCHAR(50) NOT NULL,
    fechaNacimiento DATE,
    sexo VARCHAR(1) NOT NULL,
    idBiblioteca SMALLINT,
    CONSTRAINT pk_autores PRIMARY KEY (id),
    CONSTRAINT fk_autores_bibliotecas FOREIGN KEY (idBiblioteca)
    REFERENCES bibliotecas(id) ON UPDATE RESTRICT ON DELETE RESTRICT
);
-- con dependencias
CREATE TABLE users(
    id serial,
    username VARCHAR(40) NOT NULL,
    password VARCHAR(120) NOT NULL,
    email VARCHAR(254) UNIQUE,
    fechaNacimiento DATE NOT NULL,
    nombre VARCHAR(120) NOT NULL,
    sexo VARCHAR(1) NOT NULL,
    idRol INTEGER NOT NULL,
    CONSTRAINT pk_users PRIMARY KEY (id),
    CONSTRAINT fk_users_roles FOREIGN KEY (idRol) 
    REFERENCES roles(id) ON UPDATE RESTRICT ON DELETE RESTRICT
);


CREATE TABLE bibliotecarios(
    id serial,
    dui VARCHAR(9) NOT NULL,
    telefono VARCHAR(9),
    idUser INTEGER,
    idBiblioteca INTEGER NOT NULL,

    CONSTRAINT pk_bibliotecarios PRIMARY KEY (id),
    -- Solo un usuario puede ser 1 un o muchos bibliotecarios
    CONSTRAINT uniq_idUser UNIQUE (idUser),
    
    CONSTRAINT fk_bibliotecarios_users FOREIGN KEY (idUser)  
    REFERENCES users(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
    
    CONSTRAINT fk_bibliotecarios_bibliotecas FOREIGN KEY (idBiblioteca)
    REFERENCES bibliotecas(id) ON UPDATE RESTRICT ON DELETE RESTRICT
      
);

CREATE TABLE roles_permisos(
    id SERIAL,
    idRol INTEGER NOT NULL,
    idPermiso INTEGER NOT NULL,

    CONSTRAINT pk_roles_permisos PRIMARY KEY (id),
    
    CONSTRAINT fk_roles_permisos_roles FOREIGN KEY (idRol)
    REFERENCES roles(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
    
    CONSTRAINT fk_roles_permisos_permisos FOREIGN KEY (idPermiso)
    REFERENCES permisos(id) ON UPDATE RESTRICT ON DELETE RESTRICT

    );




CREATE TABLE subcategorias(
    id smallserial,
    nombre VARCHAR(50) NOT NULL,

    descripcion TEXT,
    codigo VARCHAR(8) UNIQUE,
    
    idCategoria INTEGER,

    CONSTRAINT pk_subcategorias PRIMARY KEY (id),

    CONSTRAINT fk_subcategorias_categorias FOREIGN KEY (idCategoria)
    REFERENCES categorias(id) ON UPDATE RESTRICT ON DELETE RESTRICT
   
);



CREATE TABLE materialesBibliograficos( 
    id serial,
    nombre VARCHAR(120) NOT NULL,
    descripcion TEXT,
    imagenUrl VARCHAR(254),
    nombreImagen VARCHAR(50),
    fechaPublicacion DATE,
    esExterno BOOLEAN NOT NULL,
    idBiblioteca INTEGER NOT NULL,
    idSubcategoria INTEGER,

    CONSTRAINT pk_materiales PRIMARY KEY (id),
    CONSTRAINT fk_materiales_subcategoria FOREIGN KEY (idSubcategoria) 
    REFERENCES subcategorias(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
    CONSTRAINT fk_materiales_bibliotecas FOREIGN KEY (idBiblioteca)
    REFERENCES bibliotecas(id) ON UPDATE RESTRICT ON DELETE RESTRICT
);


CREATE TABLE unidades(
    id serial,
    unidadesExistentes INTEGER NOT NULL,
    idMaterial INTEGER,

    CONSTRAINT pk_unidades PRIMARY KEY (id),
    CONSTRAINT uniq_idMaterial UNIQUE (idMaterial),
    CONSTRAINT fk_unidades_materiales FOREIGN KEY (idMaterial)
    REFERENCES materialesBibliograficos(id) ON UPDATE RESTRICT ON DELETE RESTRICT
   
);

CREATE TABLE recursos(
    id serial,
    idFormato INTEGER NOT NULL,
    idMaterial INTEGER  UNIQUE,

    CONSTRAINT pk_recursos PRIMARY KEY (id),
    
    CONSTRAINT fk_recursos_formatos FOREIGN KEY (idFormato)
    REFERENCES formatos(id) ON UPDATE RESTRICT ON DELETE RESTRICT,

    CONSTRAINT fk_recursos_materiales FOREIGN KEY (idMaterial)
    REFERENCES materialesBibliograficos(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
    

    CONSTRAINT uniqIdMaterial UNIQUE (idMaterial)
);

CREATE TABLE libros(
    id serial,
    volumen VARCHAR(20),
    editorial VARCHAR(120),
    sinopsis TEXT,
    idMaterial INTEGER UNIQUE,
   
    CONSTRAINT pk_libros PRIMARY KEY (id),
    
    CONSTRAINT uniqIdMateriales UNIQUE (idMaterial),
    
    CONSTRAINT fk_libros_materiales FOREIGN KEY (idMaterial)
    REFERENCES materialesBibliograficos(id) ON UPDATE RESTRICT ON DELETE RESTRICT

);


CREATE TABLE materiales_autores(
    id serial,
    idMaterial INTEGER NOT NULL,
    idAutor INTEGER NOT NULL,

    CONSTRAINT pk_materiales_autores PRIMARY KEY (id),
    CONSTRAINT fk_materiales_autores_materiales FOREIGN KEY (idMaterial)
    REFERENCES materialesBibliograficos(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
    
    CONSTRAINT fk_materiales_autores_autores FOREIGN KEY (idAutor)
    REFERENCES autores(id) ON UPDATE RESTRICT ON DELETE RESTRICT
);

