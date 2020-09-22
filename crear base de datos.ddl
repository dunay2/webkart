-- Generado por Oracle SQL Developer Data Modeler 18.3.0.268.1156
--   en:        2020-09-21 10:34:16 BST
--   sitio:      Oracle Database 11g
--   tipo:      Oracle Database 11g



CREATE TABLE ti_desc_producto (
    id_producto         VARCHAR(20) NOT NULL,
    id_idioma           VARCHAR(2) NOT NULL,
    descripcion_corta   VARCHAR(200),
    descripcion_larga   VARCHAR(4000)
);

ALTER TABLE ti_desc_producto ADD CONSTRAINT tm_desc_producto_pk PRIMARY KEY ( id_idioma,
                                                                              id_producto );

CREATE TABLE ti_desc_tip_producto (
    id_tipo_producto   VARCHAR(20) NOT NULL,
    id_idioma          VARCHAR(2) NOT NULL,
    descripcion        VARCHAR(250) NOT NULL
);

ALTER TABLE ti_desc_tip_producto ADD CONSTRAINT desc_tip_producto_pk PRIMARY KEY ( id_tipo_producto,
                                                                                   id_idioma );

CREATE TABLE ti_estado_pedido (
    id_estado     VARCHAR(2) NOT NULL,
    id_idioma     VARCHAR(2) NOT NULL,
    descripcion   VARCHAR(50)
);

ALTER TABLE ti_estado_pedido ADD CONSTRAINT tm_desc_estado_pk PRIMARY KEY ( id_estado,
                                                                            id_idioma );

CREATE TABLE ti_modo_envio (
    id_envio      VARCHAR(2) NOT NULL,
    id_idioma     VARCHAR(2) NOT NULL,
    descripcion   VARCHAR(50)
);

ALTER TABLE ti_modo_envio ADD CONSTRAINT tm_desc_envio_pk PRIMARY KEY ( id_envio,
                                                                        id_idioma );

CREATE TABLE ti_modo_pago (
    id_pago      VARCHAR(4) NOT NULL,
    id_idioma    VARCHAR(2) NOT NULL,
    decripcion   VARCHAR(20)
);

ALTER TABLE ti_modo_pago ADD CONSTRAINT tm_desc_pago_pk PRIMARY KEY ( id_pago,
                                                                      id_idioma );

CREATE TABLE ti_tipo_cliente (
    id_tipo_cliente            VARCHAR(4) NOT NULL,
    id_idioma                  VARCHAR(2) NOT NULL,
    descripcion_tipo_cliente   VARCHAR(250)
);

CREATE UNIQUE INDEX desc_tip_cli__idx ON
    ti_tipo_cliente (
        id_idioma
    ASC );

CREATE UNIQUE INDEX desc_tip_cli__idxv1 ON
    ti_tipo_cliente (
        id_tipo_cliente
    ASC );

ALTER TABLE ti_tipo_cliente ADD CONSTRAINT desc_tip_cli_pk PRIMARY KEY ( id_tipo_cliente,
                                                                         id_idioma );

ALTER TABLE ti_tipo_cliente ADD CONSTRAINT desc_tip_cli_id_idioma_un UNIQUE ( id_tipo_cliente,
                                                                              id_idioma );

CREATE TABLE tm_cliente (
    id_cliente   VARCHAR(10) NOT NULL
);

ALTER TABLE tm_cliente ADD CONSTRAINT tm_cliente_pk PRIMARY KEY ( id_cliente );

CREATE TABLE tm_cliente_registrado (
    id_cliente                  VARCHAR(10) NOT NULL,
    nif                         VARCHAR(20) NOT NULL,
    nombre                      VARCHAR(50) NOT NULL,
    apellidos                   VARCHAR(50) NOT NULL,
    email                       VARCHAR(200) NOT NULL,
    password                    VARCHAR(30) NOT NULL,
    pregunta                    VARCHAR(100) NOT NULL,
    respuesta                   VARCHAR(100) NOT NULL,
    fecha_nacimiento            DATE,
    estado_civil                VARCHAR(10),
    fecha_primera_compra        DATE,
    fecha_ultima_compra         DATE,
    importe_acumulado_compras   decimal(10,2)
);

ALTER TABLE tm_cliente_registrado ADD CONSTRAINT tm_cliente_registrado_pk PRIMARY KEY ( id_cliente );

CREATE TABLE tm_desc_producto (
    id_producto        VARCHAR(20) NOT NULL,
    id_tipo_producto   VARCHAR(20) NOT NULL
);

ALTER TABLE tm_desc_producto ADD CONSTRAINT as_desc_prod_pk PRIMARY KEY ( id_tipo_producto,
                                                                          id_producto );

CREATE TABLE tm_descuento_tipo_cliente (
    id_tipo_cliente   VARCHAR(4) NOT NULL,
    dto               decimal(5,2)
);

ALTER TABLE tm_descuento_tipo_cliente ADD CONSTRAINT tm_tipo_cliente_pk PRIMARY KEY ( id_tipo_cliente );

CREATE TABLE tm_estado_pedido (
    id_estado   VARCHAR(2) NOT NULL
);

ALTER TABLE tm_estado_pedido ADD CONSTRAINT tm_estado_pedido_pk PRIMARY KEY ( id_estado );

CREATE TABLE tm_factura_envio (
    id_fact_env        VARCHAR(30) NOT NULL,
    nif                VARCHAR(20) NOT NULL,
    nombre             VARCHAR(50) NOT NULL,
    apellidos          VARCHAR(50) NOT NULL,
    direccion          VARCHAR(150) NOT NULL,
    poblacion          VARCHAR(150) NOT NULL,
    codigo_postal      VARCHAR(50) NOT NULL,
    pais               VARCHAR(50) NOT NULL,
    telefono           VARCHAR(20) NOT NULL,
    fax                VARCHAR(20) NOT NULL,
    email              VARCHAR(200) NOT NULL,
    nombreenv          VARCHAR(50),
    apellidoenv        VARCHAR(50),
    direccionenv       VARCHAR(400),
    codigo_postalenv   VARCHAR(20),
    poblacionenv       VARCHAR(50),
    id_paisenv         VARCHAR(3)
);

ALTER TABLE tm_factura_envio ADD CONSTRAINT tm_factura_envio_pk PRIMARY KEY ( id_fact_env );

CREATE TABLE tm_idioma (
    id_idioma     VARCHAR(2) NOT NULL,
    descripcion   VARCHAR(20)
);

ALTER TABLE tm_idioma ADD CONSTRAINT tm_idioma_pk PRIMARY KEY ( id_idioma );

CREATE TABLE tm_linea_pedido (
    id_linea                VARCHAR(2) NOT NULL,
    id_pedido               VARCHAR(10) NOT NULL,
    id_producto             VARCHAR(20) NOT NULL,
    unidades                INTEGER NOT NULL,
    precio_unitario_bruto   decimal(5,2) NOT NULL,
    dto                     decimal(5,2),
    precio_neto             decimal(5,2) NOT NULL,
    descripcion             VARCHAR(50)
);

ALTER TABLE tm_linea_pedido ADD CONSTRAINT tm_linea_pedido_pk PRIMARY KEY ( id_linea,
                                                                            id_pedido );

CREATE TABLE tm_modo_envio (
    id_envio   VARCHAR(2) NOT NULL
);

ALTER TABLE tm_modo_envio ADD CONSTRAINT tm_modo_envio_pk PRIMARY KEY ( id_envio );

CREATE TABLE tm_modo_pago (
    id_pago   VARCHAR(4) NOT NULL
);

ALTER TABLE tm_modo_pago ADD CONSTRAINT tm_modo_pago_pk PRIMARY KEY ( id_pago );

CREATE TABLE tm_pedido (
    id_pedido                  VARCHAR(10) NOT NULL,
    id_cliente                 VARCHAR(10) NOT NULL,
    id_fact_env                VARCHAR(10) NOT NULL,
    total_pedido               decimal(10,2) NOT NULL,
    fecha_pedido               DATE NOT NULL,
    hora_inicio_compra         TIMESTAMP NOT NULL,
    hora_fin_compra            TIMESTAMP NULL DEFAULT NULL,,
    direc_ip_compra            VARCHAR(15) NOT NULL,
    num_transaccion            VARCHAR(50),
    fecha_transaccion          DATE,
    id_resultado_transaccion   VARCHAR(10),
    fecha_entrega              DATE,
    hora_entrega               TIMESTAMP NULL DEFAULT NULL,,
    id_pago                    VARCHAR(10) NOT NULL,
    id_estado                  VARCHAR(10) NOT NULL,
    id_envio                   VARCHAR(10) NOT NULL
);

ALTER TABLE tm_pedido ADD CONSTRAINT tm_pedido_pk PRIMARY KEY ( id_pedido );

CREATE TABLE tm_producto (
    id_producto            VARCHAR(20) NOT NULL,
    precio_actual          decimal(10,2) NOT NULL,
    es_oferta              VARCHAR(1),
    precio_oferta          decimal(10,2),
    reserva_inicial        DATE,
    reserva_actual         DATE,
    reserva_notificacion   DATE,
    stock                  numeric NOT NULL,
    imagen                 BLOB
);

ALTER TABLE tm_producto ADD CONSTRAINT tm_producto_pk PRIMARY KEY ( id_producto );

CREATE TABLE tm_tipo_cliente (
    id_cliente        VARCHAR(10) NOT NULL,
    id_tipo_cliente   VARCHAR(4) NOT NULL
);

ALTER TABLE tm_tipo_cliente ADD CONSTRAINT as_tipo_cliente_pk PRIMARY KEY ( id_cliente,
                                                                            id_tipo_cliente );

CREATE TABLE tm_tipo_producto (
    id_tipo_producto   VARCHAR(20) NOT NULL,
    dto                decimal(5,2) NOT NULL
);


ALTER TABLE tm_tipo_producto ADD CONSTRAINT tipo_producto_pk PRIMARY KEY ( id_tipo_producto );



ALTER TABLE tm_desc_producto
    ADD CONSTRAINT  FOREIGN KEY ( id_producto )
        REFERENCES tm_producto ( id_producto );


ALTER TABLE tm_tipo_cliente
    ADD CONSTRAINT  FOREIGN KEY ( id_cliente )
        REFERENCES tm_cliente_registrado ( id_cliente );

ALTER TABLE ti_tipo_cliente
    ADD CONSTRAINT  FOREIGN KEY ( id_idioma )
        REFERENCES tm_idioma ( id_idioma );


ALTER TABLE ti_tipo_cliente
    ADD CONSTRAINT  FOREIGN KEY ( id_tipo_cliente )
        REFERENCES tm_descuento_tipo_cliente ( id_tipo_cliente );


ALTER TABLE tm_cliente_registrado
    ADD CONSTRAINT  FOREIGN KEY ( id_cliente )
        REFERENCES tm_cliente ( id_cliente );

ALTER TABLE ti_modo_envio
    ADD CONSTRAINT  FOREIGN KEY ( id_idioma )
        REFERENCES tm_idioma ( id_idioma );

ALTER TABLE ti_modo_envio
    ADD CONSTRAINT tm_desc_envio_tm_modo_envio_fk FOREIGN KEY ( id_envio )
        REFERENCES tm_modo_envio ( id_envio );


ALTER TABLE ti_estado_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_estado )
        REFERENCES tm_estado_pedido ( id_estado );

ALTER TABLE ti_estado_pedido
    ADD CONSTRAINT tm_desc_estado_tm_idioma_fk FOREIGN KEY ( id_idioma )
        REFERENCES tm_idioma ( id_idioma );

ALTER TABLE ti_modo_pago
    ADD CONSTRAINT tm_desc_pago_tm_idioma_fk FOREIGN KEY ( id_idioma )
        REFERENCES tm_idioma ( id_idioma );

ALTER TABLE ti_modo_pago
    ADD CONSTRAINT tm_desc_pago_tm_modo_pago_fk FOREIGN KEY ( id_pago )
        REFERENCES tm_modo_pago ( id_pago );

ALTER TABLE ti_desc_producto
    ADD CONSTRAINT tm_desc_producto_tm_idioma_fk FOREIGN KEY ( id_idioma )
        REFERENCES tm_idioma ( id_idioma );


ALTER TABLE ti_desc_producto
    ADD CONSTRAINT  FOREIGN KEY ( id_producto )
        REFERENCES tm_producto ( id_producto );


ALTER TABLE tm_desc_producto
    ADD CONSTRAINT  FOREIGN KEY ( id_tipo_producto )
        REFERENCES tm_tipo_producto ( id_tipo_producto );


ALTER TABLE ti_desc_tip_producto
    ADD CONSTRAINT  FOREIGN KEY ( id_idioma )
        REFERENCES tm_idioma ( id_idioma );


ALTER TABLE ti_desc_tip_producto
    ADD CONSTRAINT  FOREIGN KEY ( id_tipo_producto )
        REFERENCES tm_tipo_producto ( id_tipo_producto );

ALTER TABLE tm_linea_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_pedido )
        REFERENCES tm_pedido ( id_pedido );

ALTER TABLE tm_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_cliente )
        REFERENCES tm_cliente ( id_cliente );

ALTER TABLE tm_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_estado )
        REFERENCES tm_estado_pedido ( id_estado );

ALTER TABLE tm_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_fact_env )
        REFERENCES tm_factura_envio ( id_fact_env );

ALTER TABLE tm_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_envio )
        REFERENCES tm_modo_envio ( id_envio );

ALTER TABLE tm_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_pago )
        REFERENCES tm_modo_pago ( id_pago );


ALTER TABLE tm_tipo_cliente
    ADD CONSTRAINT  FOREIGN KEY ( id_tipo_cliente )
        REFERENCES tm_descuento_tipo_cliente ( id_tipo_cliente );


ALTER TABLE tm_desc_producto
    ADD CONSTRAINT  FOREIGN KEY ( id_producto )
        REFERENCES tm_producto ( id_producto );


ALTER TABLE tm_tipo_cliente
    ADD CONSTRAINT  FOREIGN KEY ( id_cliente )
        REFERENCES tm_cliente_registrado ( id_cliente );

ALTER TABLE ti_tipo_cliente
    ADD CONSTRAINT  FOREIGN KEY ( id_idioma )
        REFERENCES tm_idioma ( id_idioma );


ALTER TABLE ti_tipo_cliente
    ADD CONSTRAINT  FOREIGN KEY ( id_tipo_cliente )
        REFERENCES tm_descuento_tipo_cliente ( id_tipo_cliente );
 
ALTER TABLE tm_cliente_registrado
    ADD CONSTRAINT  FOREIGN KEY ( id_cliente )
        REFERENCES tm_cliente ( id_cliente );

ALTER TABLE ti_modo_envio
    ADD CONSTRAINT  FOREIGN KEY ( id_idioma )
        REFERENCES tm_idioma ( id_idioma );

ALTER TABLE ti_modo_envio
    ADD CONSTRAINT  FOREIGN KEY ( id_envio )
        REFERENCES tm_modo_envio ( id_envio );

ALTER TABLE ti_estado_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_estado )
        REFERENCES tm_estado_pedido ( id_estado );

ALTER TABLE ti_estado_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_idioma )
        REFERENCES tm_idioma ( id_idioma );

ALTER TABLE ti_modo_pago
    ADD CONSTRAINT  FOREIGN KEY ( id_idioma )
        REFERENCES tm_idioma ( id_idioma );

ALTER TABLE ti_modo_pago
    ADD CONSTRAINT  FOREIGN KEY ( id_pago )
        REFERENCES tm_modo_pago ( id_pago );

ALTER TABLE ti_desc_producto
    ADD CONSTRAINT  FOREIGN KEY ( id_idioma )
        REFERENCES tm_idioma ( id_idioma );


ALTER TABLE ti_desc_producto
    ADD CONSTRAINT  FOREIGN KEY ( id_producto )
        REFERENCES tm_producto ( id_producto );


ALTER TABLE tm_desc_producto
    ADD CONSTRAINT  FOREIGN KEY ( id_tipo_producto )
        REFERENCES tm_tipo_producto ( id_tipo_producto );


ALTER TABLE ti_desc_tip_producto
    ADD CONSTRAINT  FOREIGN KEY ( id_idioma )
        REFERENCES tm_idioma ( id_idioma );


ALTER TABLE ti_desc_tip_producto
    ADD CONSTRAINT  FOREIGN KEY ( id_tipo_producto )
        REFERENCES tm_tipo_producto ( id_tipo_producto );

ALTER TABLE tm_linea_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_pedido )
        REFERENCES tm_pedido ( id_pedido );

ALTER TABLE tm_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_cliente )
        REFERENCES tm_cliente ( id_cliente );

ALTER TABLE tm_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_estado )
        REFERENCES tm_estado_pedido ( id_estado );

ALTER TABLE tm_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_fact_env )
        REFERENCES tm_factura_envio ( id_fact_env );

ALTER TABLE tm_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_envio )
        REFERENCES tm_modo_envio ( id_envio );

ALTER TABLE tm_pedido
    ADD CONSTRAINT  FOREIGN KEY ( id_pago )
        REFERENCES tm_modo_pago ( id_pago );


ALTER TABLE tm_tipo_cliente
    ADD CONSTRAINT  FOREIGN KEY ( id_tipo_cliente )
        REFERENCES tm_descuento_tipo_cliente ( id_tipo_cliente );

ALTER TABLE `tm_tipo_producto` CHANGE `imagen` `imagen` BLOB ;

-- Informe de Resumen de Oracle SQL Developer Data Modeler: 
-- 
-- CREATE TABLE                            20
-- CREATE INDEX                             2
-- ALTER TABLE                             67
-- CREATE VIEW                              0
-- ALTER VIEW                               0
-- CREATE PACKAGE                           0
-- CREATE PACKAGE BODY                      0
-- CREATE PROCEDURE                         0
-- CREATE FUNCTION                          0
-- CREATE TRIGGER                           0
-- ALTER TRIGGER                            0
-- CREATE COLLECTION TYPE                   0
-- CREATE STRUCTURED TYPE                   0
-- CREATE STRUCTURED TYPE BODY              0
-- CREATE CLUSTER                           0
-- CREATE CONTEXT                           0
-- CREATE DATABASE                          0
-- CREATE DIMENSION                         0
-- CREATE DIRECTORY                         0
-- CREATE DISK GROUP                        0
-- CREATE ROLE                              0
-- CREATE ROLLBACK SEGMENT                  0
-- CREATE SEQUENCE                          0
-- CREATE MATERIALIZED VIEW                 0
-- CREATE MATERIALIZED VIEW LOG             0
-- CREATE SYNONYM                           0
-- CREATE TABLESPACE                        0
-- CREATE USER                              0
-- 
-- DROP TABLESPACE                          0
-- DROP DATABASE                            0
-- 
-- REDACTION POLICY                         0
-- 
-- ORDS DROP SCHEMA                         0
-- ORDS ENABLE SCHEMA                       0
-- ORDS ENABLE OBJECT                       0
-- 
-- ERRORS                                   0
-- WARNINGS                                 0
