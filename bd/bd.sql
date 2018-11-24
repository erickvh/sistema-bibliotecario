DROP SCHEMA public CASCADE;
CREATE SCHEMA public;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO public;
COMMENT ON SCHEMA public IS 'Se borra esquema y se crea de nuevo';
--TABLAS MENOS DEPENDIENTES

CREATE TABLE roles(
    id smallserial,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT,

    CONSTRAINT pk_roles PRIMARY KEY (id)
);

CREATE TABLE bibliotecas(
    id smallserial,
    nombre VARCHAR(120) NOT NULL,
    ubicacion VARCHAR(300) NOT NULL,
    telefono VARCHAR(9) NOT NULL,
    clasificacion VARCHAR(120),
    habilitado boolean DEFAULT true,
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
    idBiblioteca SMALLINT NOT NULL,

    CONSTRAINT pk_categorias PRIMARY KEY (id),
    CONSTRAINT fk_categorias_biblioteca FOREIGN KEY (idBiblioteca)
    REFERENCES bibliotecas(id) ON UPDATE RESTRICT ON DELETE RESTRICT

);

CREATE TABLE formatos(
    id smallserial,
    tipoFormato VARCHAR(5) NOT NULL,
    descripcion TEXT,
    idBiblioteca SMALLINT NOT NULL,

    CONSTRAINT pk_formatos PRIMARY KEY (id),
    CONSTRAINT fk_formatos_bibliotecas FOREIGN KEY (idBiblioteca)
    REFERENCES bibliotecas(id) ON UPDATE RESTRICT ON DELETE RESTRICT

);

CREATE TABLE autores(
    id smallserial,
    nombre VARCHAR(120) NOT NULL,
    nacionalidad VARCHAR(50) NOT NULL,
    fechaNacimiento DATE DEFAULT NULL,
    sexo VARCHAR(1) NOT NULL,
    idBiblioteca SMALLINT NOT NULL,
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
    dui VARCHAR(10) NOT NULL,
    telefono VARCHAR(9),
    habilitado boolean DEFAULT true,
    idUser INTEGER,
    idBiblioteca SMALLINT NOT NULL,

    CONSTRAINT pk_bibliotecarios PRIMARY KEY (id),
    -- Solo un usuario puede ser 1 un o muchos bibliotecarios
    CONSTRAINT uniq_idUser UNIQUE (idUser),

    CONSTRAINT fk_bibliotecarios_users FOREIGN KEY (idUser)
    REFERENCES users(id) ON UPDATE RESTRICT ON DELETE RESTRICT,

    CONSTRAINT fk_bibliotecarios_bibliotecas FOREIGN KEY (idBiblioteca)
    REFERENCES bibliotecas(id) ON UPDATE RESTRICT ON DELETE RESTRICT

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
    idBiblioteca SMALLINT NOT NULL,
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
    unidadesPrestadas INTEGER DEFAULT 0,
    unidadesReservadas INTEGER DEFAULT 0,
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
    isbn VARCHAR(20),
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

-- TABLAS SEGUNDO SPRINT
CREATE TABLE departamentos(
    id serial,
    nombre VARCHAR(40),


    CONSTRAINT pk_departamentos PRIMARY KEY (id)
);

CREATE TABLE municipios(
    id serial,
    nombre VARCHAR(40),
    idDepartamento INTEGER,

    CONSTRAINT pk_municipios PRIMARY KEY (id),

    CONSTRAINT fk_municipios_departamentos FOREIGN KEY (idDepartamento)
    REFERENCES departamentos(id) ON UPDATE RESTRICT ON DELETE RESTRICT
);
CREATE TABLE prestamistas(
    id serial,
    lugarDeEstudio VARCHAR(60),
    trabaja boolean,
    estudia boolean,
    direccion VARCHAR(60), -- direccion fisica
    nombreDePadre VARCHAR(60),
    nombreDeMadre VARCHAR(60),
    telefono VARCHAR(9),
    activo boolean,

    idUser INTEGER,
    idMunicipio INTEGER,
    idBibilioteca INTEGER,

    CONSTRAINT pk_prestamistas PRIMARY KEY (id),

    CONSTRAINT fk_prestamistas_users FOREIGN KEY (idUser) REFERENCES
    users(id) ON UPDATE RESTRICT ON DELETE RESTRICT,

    CONSTRAINT fk_prestamistas_municipios FOREIGN KEY (idMunicipio) REFERENCES
    municipios(id) ON UPDATE RESTRICT ON DELETE RESTRICT,

    CONSTRAINT fk_prestamistas_bibliotecas FOREIGN KEY (idBibilioteca) REFERENCES
    bibliotecas(id) ON UPDATE RESTRICT ON DELETE RESTRICT
);

CREATE TABLE prestamos(
    id serial,
    fechaPrestamo DATE,
    fechaDevolucion DATE DEFAULT NULL,
    devuelto boolean,
    diasAtrasado INTEGER,
    idMaterial INTEGER,
    idPrestamista INTEGER,

    CONSTRAINT pk_prestamos PRIMARY KEY (id),

    CONSTRAINT fk_prestamos_prestamistas FOREIGN KEY (idPrestamista)
    REFERENCES prestamistas(id) ON UPDATE RESTRICT ON DELETE RESTRICT,

    CONSTRAINT fk_prestamos_materiales FOREIGN KEY (idMaterial)
    REFERENCES materialesBibliograficos(id) ON UPDATE RESTRICT ON DELETE RESTRICT


);

CREATE TABLE reservas(
    id serial,
    fechaReserva DATE,
    fechaSolicitud DATE,
    prestado boolean,
    cancelado boolean,
    idPrestamista INTEGER,
    idMaterial INTEGER,

    CONSTRAINT pk_reservas PRIMARY KEY (id),
    CONSTRAINT fk_reservas_prestamistas FOREIGN KEY (idPrestamista)
    REFERENCES prestamistas(id) ON UPDATE RESTRICT ON DELETE RESTRICT,

    CONSTRAINT fk_reservas_material FOREIGN KEY (idMaterial)
    REFERENCES materialesBibliograficos(id) ON UPDATE RESTRICT ON DELETE RESTRICT

);
