--CREATE USER ALMOXARIFADO IDENTIFIED BY ALMOXARIFADO;
--GRANT DBA TO ALMOXARIFADO WITH ADMIN OPTION;

----------------------------------------------------------------------------------------------------------------------------------------------------------------

DROP TABLE CONTAGEM;
DROP TABLE MATERIAIS_INVENTARIADOS;
DROP TABLE INVENTARIO;
DROP TABLE MOVIMENTACAO;
DROP TABLE REQUISICAO_MATERIAL;
DROP TABLE REQUISICAO;
DROP TABLE ESTOQUE;
DROP TABLE MATERIAL;
DROP TABLE LOCAIS;
DROP TABLE UNIDADE_MEDIDA;
DROP TABLE TIPO_MATERIAL;
DROP TABLE USERS;
DROP SEQUENCE LOCAIS_COD_SEQ;
DROP SEQUENCE MATERIAL_COD_SEQ;
DROP SEQUENCE UNIDADES_COD_SEQ;
DROP SEQUENCE TIPOS_COD_SEQ;
DROP SEQUENCE USERS_ID_SEQ;
DROP SEQUENCE ESTOQUE_ID_SEQ;
DROP SEQUENCE MOVIMENTACAO_COD_SEQ;
DROP SEQUENCE REQUISICAO_COD_SEQ;
DROP SEQUENCE REQMATERIAL_ID_SEQ;
DROP SEQUENCE INVENTARIO_COD_SEQ;
DROP SEQUENCE MATINVENTARIADOS_ID_SEQ;
DROP SEQUENCE CONTAGEM_ID_SEQ;

----------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE LOCAIS (
COD_LOCAL NUMBER(5) PRIMARY KEY,
NOME_LOCAL VARCHAR(20)
);

CREATE SEQUENCE LOCAIS_COD_SEQ
MINVALUE 1
MAXVALUE 99999
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE OR REPLACE TRIGGER LOCAIS_COD_TRG 
            BEFORE INSERT ON LOCAIS
            FOR EACH ROW
                BEGIN
            IF :NEW.COD_LOCAL IS NULL THEN
                SELECT LOCAIS_COD_SEQ.NEXTVAL INTO :NEW.COD_LOCAL FROM DUAL;
            END IF;
            END;
/
ALTER TRIGGER LOCAIS_COD_TRG ENABLE;
            
INSERT INTO LOCAIS (NOME_LOCAL) VALUES ('A234');
INSERT INTO LOCAIS (NOME_LOCAL) VALUES ('A356');
INSERT INTO LOCAIS (NOME_LOCAL) VALUES ('A435');

----------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE UNIDADE_MEDIDA (
COD_UNID_MEDIDA NUMBER(5) PRIMARY KEY,
DESCRICAO_UNID_MEDIDA VARCHAR(20)
);

CREATE SEQUENCE UNIDADES_COD_SEQ
MINVALUE 1
MAXVALUE 99999
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE OR REPLACE TRIGGER UNIDADES_COD_TRG 
            BEFORE INSERT ON UNIDADE_MEDIDA
            FOR EACH ROW
                BEGIN
            IF :NEW.COD_UNID_MEDIDA IS NULL THEN
                SELECT UNIDADES_COD_SEQ.NEXTVAL INTO :NEW.COD_UNID_MEDIDA FROM DUAL;
            END IF;
            END;
/
ALTER TRIGGER UNIDADES_COD_TRG ENABLE;
          
INSERT INTO UNIDADE_MEDIDA (DESCRICAO_UNID_MEDIDA) VALUES ('p�s');
INSERT INTO UNIDADE_MEDIDA (DESCRICAO_UNID_MEDIDA) VALUES ('Kgs');
INSERT INTO UNIDADE_MEDIDA (DESCRICAO_UNID_MEDIDA) VALUES ('lts');
INSERT INTO UNIDADE_MEDIDA (DESCRICAO_UNID_MEDIDA) VALUES ('pacotes');

----------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE TIPO_MATERIAL (
COD_TIPO NUMBER(5) PRIMARY KEY,
NOME_TIPO VARCHAR(20)
);

CREATE SEQUENCE TIPOS_COD_SEQ
MINVALUE 1
MAXVALUE 99999
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE OR REPLACE TRIGGER TIPOS_COD_TRG 
            BEFORE INSERT ON TIPO_MATERIAL
            FOR EACH ROW
                BEGIN
            IF :NEW.COD_TIPO IS NULL THEN
                SELECT TIPOS_COD_SEQ.NEXTVAL INTO :NEW.COD_TIPO FROM DUAL;
            END IF;
            END;
/
ALTER TRIGGER TIPOS_COD_TRG ENABLE;
                     
INSERT INTO TIPO_MATERIAL (NOME_TIPO) VALUES ('Ferramentas');
INSERT INTO TIPO_MATERIAL (NOME_TIPO) VALUES ('EPI');
INSERT INTO TIPO_MATERIAL (NOME_TIPO) VALUES ('Lubrificantes');
INSERT INTO TIPO_MATERIAL (NOME_TIPO) VALUES ('Limpeza');
INSERT INTO TIPO_MATERIAL (NOME_TIPO) VALUES ('Escrit�rio');

----------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE USERS (
ID NUMBER(5) NOT NULL ENABLE, 
NAME VARCHAR2(255 BYTE) NOT NULL ENABLE, 
EMAIL VARCHAR2(255 BYTE) NOT NULL ENABLE, 
EMAIL_VERIFIED_AT TIMESTAMP (6), 
PASSWORD VARCHAR2(255 BYTE) NOT NULL ENABLE, 
REMEMBER_TOKEN VARCHAR2(100 BYTE), 
CREATED_AT TIMESTAMP (6), 
UPDATED_AT TIMESTAMP (6), 
PERMISSION NUMBER(1,0), 
CONSTRAINT "USERS_ID_PK" PRIMARY KEY ("ID"), 
CONSTRAINT "USERS_EMAIL_UK" UNIQUE ("EMAIL")
);

CREATE SEQUENCE USERS_ID_SEQ
MINVALUE 1
MAXVALUE 99999
INCREMENT BY 1
START WITH 1
NOORDER
NOCYCLE ;

CREATE OR REPLACE TRIGGER USERS_ID_TRG
BEFORE INSERT ON USERS
        FOR EACH ROW
            BEGIN
        IF :NEW.ID IS NULL THEN
            SELECT USERS_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
        END IF;
        END;
/
ALTER TRIGGER USERS_ID_TRG ENABLE;

INSERT INTO USERS (NAME, EMAIL, PASSWORD, PERMISSION) VALUES ('Coordenador Silva', 'coordenador@bosque.com', '$2y$10$UBcmg8habHcKlLi9BMRbx.0Vtx0OBhO65dPU9VBbuOX6Nb0NEAKl2', 1);
INSERT INTO USERS (NAME, EMAIL, PASSWORD, PERMISSION) VALUES ('Almoxarife Jason', 'almoxarife@bosque.com','$2y$10$UBcmg8habHcKlLi9BMRbx.0Vtx0OBhO65dPU9VBbuOX6Nb0NEAKl2', 2);
INSERT INTO USERS (NAME, EMAIL, PASSWORD, PERMISSION) VALUES ('Requi Donalds', 'requisitante@bosque.com', '$2y$10$UBcmg8habHcKlLi9BMRbx.0Vtx0OBhO65dPU9VBbuOX6Nb0NEAKl2', 3);
INSERT INTO USERS (NAME, EMAIL, PASSWORD, PERMISSION) VALUES ('Usu�rio Novo', 'novo@bosque.com', '$2y$10$UBcmg8habHcKlLi9BMRbx.0Vtx0OBhO65dPU9VBbuOX6Nb0NEAKl2', NULL);
INSERT INTO USERS (NAME, EMAIL, PASSWORD, PERMISSION) VALUES ('Geovane Oliveira', 'geovane@bosque.com', '$2y$10$UBcmg8habHcKlLi9BMRbx.0Vtx0OBhO65dPU9VBbuOX6Nb0NEAKl2', 1);
INSERT INTO USERS (NAME, EMAIL, PASSWORD, PERMISSION) VALUES ('Mariana Foga�a', 'mariana@bosque.com','$2y$10$UBcmg8habHcKlLi9BMRbx.0Vtx0OBhO65dPU9VBbuOX6Nb0NEAKl2', 2);
INSERT INTO USERS (NAME, EMAIL, PASSWORD, PERMISSION) VALUES ('Jean Depicoli', 'jean@bosque.com', '$2y$10$UBcmg8habHcKlLi9BMRbx.0Vtx0OBhO65dPU9VBbuOX6Nb0NEAKl2', 3);
INSERT INTO USERS (NAME, EMAIL, PASSWORD, PERMISSION) VALUES ('Gustavo Pereira', 'gustavo@bosque.com','$2y$10$UBcmg8habHcKlLi9BMRbx.0Vtx0OBhO65dPU9VBbuOX6Nb0NEAKl2', NULL);
INSERT INTO USERS (NAME, EMAIL, PASSWORD, PERMISSION) VALUES ('Leticia', 'leticia@bosque.com', '$2y$10$UBcmg8habHcKlLi9BMRbx.0Vtx0OBhO65dPU9VBbuOX6Nb0NEAKl2', NULL);

----------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE MATERIAL (
COD_MATERIAL NUMBER(5) PRIMARY KEY,
COD_TIPO NUMBER(5),
COD_UNID_MEDIDA NUMBER(5),
NOME_MATERIAL VARCHAR(50) UNIQUE,
CONS_DIA NUMBER(7,2),
LEAD_TIME NUMBER(7,2),
PERCENTUAL_SEG NUMBER(7,2),
MARGEM_SEG NUMBER(7,2),
CONSTRAINT FK_COD_TIPO    FOREIGN KEY (COD_TIPO)        REFERENCES TIPO_MATERIAL(COD_TIPO),
CONSTRAINT FK_COD_UNIDADE FOREIGN KEY (COD_UNID_MEDIDA) REFERENCES UNIDADE_MEDIDA(COD_UNID_MEDIDA)
);

CREATE SEQUENCE MATERIAL_COD_SEQ
MINVALUE 1
MAXVALUE 99999
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE OR REPLACE TRIGGER MATERIAL_COD_TRG 
            BEFORE INSERT ON MATERIAL
            FOR EACH ROW
                BEGIN
            IF :NEW.COD_MATERIAL IS NULL THEN
                SELECT MATERIAL_COD_SEQ.NEXTVAL INTO :NEW.COD_MATERIAL FROM DUAL;
            END IF;
            END;
/
ALTER TRIGGER MATERIAL_COD_TRG ENABLE;

INSERT INTO MATERIAL (COD_TIPO, COD_UNID_MEDIDA, NOME_MATERIAL, CONS_DIA, LEAD_TIME, PERCENTUAL_SEG, MARGEM_SEG) VALUES (2, 1, 'Camiseta Branca tam. GG', 2, 12, 10, 1);
INSERT INTO MATERIAL (COD_TIPO, COD_UNID_MEDIDA, NOME_MATERIAL, CONS_DIA, LEAD_TIME, PERCENTUAL_SEG, MARGEM_SEG) VALUES (1, 1, 'Ferramenta Torneamento ZYY', 2, 12, 10, 1);
INSERT INTO MATERIAL (COD_TIPO, COD_UNID_MEDIDA, NOME_MATERIAL, CONS_DIA, LEAD_TIME, PERCENTUAL_SEG, MARGEM_SEG) VALUES (3, 1, '�leo Mineral 50W20', 2, 12, 10, 1);

----------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE ESTOQUE (
ID NUMBER(5) PRIMARY KEY,
COD_MATERIAL NUMBER(5),
COD_LOCAL NUMBER(5),
LOTE VARCHAR(30),
QUANTIDADE NUMBER(7,2),
DATA_VALIDADE DATE,
CONSTRAINT FK_ESTOQUE_LOCAIS FOREIGN KEY (COD_LOCAL) REFERENCES LOCAIS(COD_LOCAL),
CONSTRAINT FK_ESTOQUE_MATERIAL FOREIGN KEY (COD_MATERIAL) REFERENCES MATERIAL(COD_MATERIAL),
CONSTRAINT UK_ESTOQUE UNIQUE (COD_MATERIAL, COD_LOCAL, LOTE)
);

CREATE SEQUENCE ESTOQUE_ID_SEQ
MINVALUE 1
MAXVALUE 99999
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE OR REPLACE TRIGGER ESTOQUE_ID_TRG 
            BEFORE INSERT ON ESTOQUE
            FOR EACH ROW
                BEGIN
            IF :NEW.ID IS NULL THEN
                SELECT ESTOQUE_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
            END IF;
            END;
/
ALTER TRIGGER ESTOQUE_ID_TRG ENABLE;

INSERT INTO ESTOQUE (COD_MATERIAL, COD_LOCAL, LOTE, QUANTIDADE, DATA_VALIDADE) VALUES (1, 1, '142495283', 15, '31/12/2019');
INSERT INTO ESTOQUE (COD_MATERIAL, COD_LOCAL, LOTE, QUANTIDADE, DATA_VALIDADE) VALUES (1, 2, '6587545', 09, '04/12/2019');
INSERT INTO ESTOQUE (COD_MATERIAL, COD_LOCAL, LOTE, QUANTIDADE, DATA_VALIDADE) VALUES (2, 2, '285675673', 42, '03/11/2019');
INSERT INTO ESTOQUE (COD_MATERIAL, COD_LOCAL, LOTE, QUANTIDADE, DATA_VALIDADE) VALUES (3, 3, '774950283', 23, '25/11/2019');

------------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE REQUISICAO (
COD_REQUISICAO NUMBER(5) PRIMARY KEY,
COD_USUARIO NUMBER(5),
DATA_REQ DATE,
DATA_ATEND DATE,
SITUACAO VARCHAR(12),
CONSTRAINT FK_REQUISICAO_USUARIO FOREIGN KEY (COD_USUARIO) REFERENCES USERS(ID)
);

CREATE SEQUENCE REQUISICAO_COD_SEQ
MINVALUE 1
MAXVALUE 99999
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE OR REPLACE TRIGGER REQUISICAO_COD_TRG 
            BEFORE INSERT ON REQUISICAO
            FOR EACH ROW
                BEGIN
            IF :NEW.COD_REQUISICAO IS NULL THEN
                SELECT REQUISICAO_COD_SEQ.NEXTVAL INTO :NEW.COD_REQUISICAO FROM DUAL;
            END IF;
            END;
/
ALTER TRIGGER REQUISICAO_COD_TRG ENABLE;

INSERT INTO REQUISICAO (COD_USUARIO, DATA_REQ, DATA_ATEND, SITUACAO) VALUES (1, '01/01/2019', '02/01/2019', 'Finalizada');
INSERT INTO REQUISICAO (COD_USUARIO, DATA_REQ, DATA_ATEND, SITUACAO) VALUES (2, '20/02/2019', '21/02/2019', 'Finalizada');
INSERT INTO REQUISICAO (COD_USUARIO, DATA_REQ, DATA_ATEND, SITUACAO) VALUES (1, '25/02/2019', '26/02/2019', 'Negada');
INSERT INTO REQUISICAO (COD_USUARIO, DATA_REQ, DATA_ATEND, SITUACAO) VALUES (1, '24/11/2019', null , 'Aberta');
INSERT INTO REQUISICAO (COD_USUARIO, DATA_REQ, DATA_ATEND, SITUACAO) VALUES (1, '24/11/2019', null , 'Aberta');

----------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE REQUISICAO_MATERIAL (
ID NUMBER(5) PRIMARY KEY,
COD_REQUISICAO NUMBER(5),
COD_MATERIAL NUMBER(5),
QUANTIDADE_REQ NUMBER(7,2),
CONSTRAINT FK_REQMATERIAL_REQUISICAO FOREIGN KEY (COD_REQUISICAO) REFERENCES REQUISICAO(COD_REQUISICAO),
CONSTRAINT FK_REQMATERIAL_MATERIAL FOREIGN KEY (COD_MATERIAL) REFERENCES MATERIAL(COD_MATERIAL),
CONSTRAINT UK_REQMATERIAL UNIQUE (COD_REQUISICAO, COD_MATERIAL)
);

CREATE SEQUENCE REQMATERIAL_ID_SEQ
MINVALUE 1
MAXVALUE 99999
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE OR REPLACE TRIGGER REQMATERIAL_COD_TRG 
            BEFORE INSERT ON REQUISICAO_MATERIAL
            FOR EACH ROW
                BEGIN
            IF :NEW.ID IS NULL THEN
                SELECT REQMATERIAL_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
            END IF;
            END;
/
ALTER TRIGGER REQMATERIAL_COD_TRG ENABLE;

INSERT INTO REQUISICAO_MATERIAL (COD_REQUISICAO, COD_MATERIAL, QUANTIDADE_REQ) VALUES (1, 1, 5);
INSERT INTO REQUISICAO_MATERIAL (COD_REQUISICAO, COD_MATERIAL, QUANTIDADE_REQ) VALUES (2, 1, 1);
INSERT INTO REQUISICAO_MATERIAL (COD_REQUISICAO, COD_MATERIAL, QUANTIDADE_REQ) VALUES (2, 2, 1);
INSERT INTO REQUISICAO_MATERIAL (COD_REQUISICAO, COD_MATERIAL, QUANTIDADE_REQ) VALUES (3, 1, 1);
INSERT INTO REQUISICAO_MATERIAL (COD_REQUISICAO, COD_MATERIAL, QUANTIDADE_REQ) VALUES (4, 1, 1);
INSERT INTO REQUISICAO_MATERIAL (COD_REQUISICAO, COD_MATERIAL, QUANTIDADE_REQ) VALUES (5, 1, 7);
INSERT INTO REQUISICAO_MATERIAL (COD_REQUISICAO, COD_MATERIAL, QUANTIDADE_REQ) VALUES (5, 3, 12);

----------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE MOVIMENTACAO (
COD_MOVIMENTACAO NUMBER(5) PRIMARY KEY,
ESTOQUE_ID NUMBER(5),
DATA_MOV TIMESTAMP (6),
COD_USUARIO NUMBER(5),
COD_REQUISICAO NUMBER(5),
QTDE_MOVIMENTADA NUMBER(7,2),
TIPO_MOVIMENTACAO VARCHAR(12),
CONSTRAINT FK_MOVIMENTACAO_ESTOQUE FOREIGN KEY (ESTOQUE_ID) REFERENCES ESTOQUE(ID),
CONSTRAINT FK_MOVIMENTACAO_USER FOREIGN KEY (COD_USUARIO) REFERENCES USERS(ID),
CONSTRAINT FK_MOVIMENTACAO_REQUISICAO FOREIGN KEY (COD_REQUISICAO) REFERENCES REQUISICAO(COD_REQUISICAO),
CONSTRAINT UK_MOVIMENTACAO UNIQUE (ESTOQUE_ID, DATA_MOV)
);

CREATE SEQUENCE MOVIMENTACAO_COD_SEQ
MINVALUE 1
MAXVALUE 99999
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE OR REPLACE TRIGGER MOVIMENTACAO_COD_TRG 
            BEFORE INSERT ON MOVIMENTACAO
            FOR EACH ROW
                BEGIN
            IF :NEW.COD_MOVIMENTACAO IS NULL THEN
                SELECT MOVIMENTACAO_COD_SEQ.NEXTVAL INTO :NEW.COD_MOVIMENTACAO FROM DUAL;
            END IF;
            END;
/
ALTER TRIGGER MOVIMENTACAO_COD_TRG ENABLE;

INSERT INTO MOVIMENTACAO (ESTOQUE_ID, DATA_MOV, COD_USUARIO, COD_REQUISICAO, QTDE_MOVIMENTADA, TIPO_MOVIMENTACAO) VALUES (1, LOCALTIMESTAMP, 1, NULL, 13, 'Aquisi��o');
INSERT INTO MOVIMENTACAO (ESTOQUE_ID, DATA_MOV, COD_USUARIO, COD_REQUISICAO, QTDE_MOVIMENTADA, TIPO_MOVIMENTACAO) VALUES (1, LOCALTIMESTAMP, 2, NULL, -2, 'Ajuste');
INSERT INTO MOVIMENTACAO (ESTOQUE_ID, DATA_MOV, COD_USUARIO, COD_REQUISICAO, QTDE_MOVIMENTADA, TIPO_MOVIMENTACAO) VALUES (1, LOCALTIMESTAMP, 1, 1, -3, 'Requisi��o');

INSERT INTO MOVIMENTACAO (ESTOQUE_ID, DATA_MOV, COD_USUARIO, COD_REQUISICAO, QTDE_MOVIMENTADA, TIPO_MOVIMENTACAO) VALUES (2, LOCALTIMESTAMP, 1, NULL, 44, 'Aquisi��o');
INSERT INTO MOVIMENTACAO (ESTOQUE_ID, DATA_MOV, COD_USUARIO, COD_REQUISICAO, QTDE_MOVIMENTADA, TIPO_MOVIMENTACAO) VALUES (2, LOCALTIMESTAMP, 2, NULL, -2, 'Ajuste');
INSERT INTO MOVIMENTACAO (ESTOQUE_ID, DATA_MOV, COD_USUARIO, COD_REQUISICAO, QTDE_MOVIMENTADA, TIPO_MOVIMENTACAO) VALUES (2, LOCALTIMESTAMP, 2, 1, -1, 'Requisi��o');

INSERT INTO MOVIMENTACAO (ESTOQUE_ID, DATA_MOV, COD_USUARIO, COD_REQUISICAO, QTDE_MOVIMENTADA, TIPO_MOVIMENTACAO) VALUES (3, LOCALTIMESTAMP, 1, NULL, 25, 'Aquisi��o');
INSERT INTO MOVIMENTACAO (ESTOQUE_ID, DATA_MOV, COD_USUARIO, COD_REQUISICAO, QTDE_MOVIMENTADA, TIPO_MOVIMENTACAO) VALUES (3, LOCALTIMESTAMP, 2, NULL, -2, 'Ajuste');
INSERT INTO MOVIMENTACAO (ESTOQUE_ID, DATA_MOV, COD_USUARIO, COD_REQUISICAO, QTDE_MOVIMENTADA, TIPO_MOVIMENTACAO) VALUES (3, LOCALTIMESTAMP, 2, NULL, -3, 'Ajuste');
INSERT INTO MOVIMENTACAO (ESTOQUE_ID, DATA_MOV, COD_USUARIO, COD_REQUISICAO, QTDE_MOVIMENTADA, TIPO_MOVIMENTACAO) VALUES (3, LOCALTIMESTAMP, 2, NULL, -5, 'Ajuste');

---------------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE INVENTARIO (
COD_INVENTARIO NUMBER(5) PRIMARY KEY,
COD_RESP NUMBER(5),
DATA_INICIO TIMESTAMP,
DATA_FIM TIMESTAMP,
CONSTRAINT FK_INVENTARIO_USERS FOREIGN KEY (COD_RESP) REFERENCES USERS(ID)
);

CREATE SEQUENCE INVENTARIO_COD_SEQ
MINVALUE 1
MAXVALUE 99999
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE OR REPLACE TRIGGER INVENTARIO_COD_TRG 
            BEFORE INSERT ON INVENTARIO
            FOR EACH ROW
                BEGIN
            IF :NEW.COD_INVENTARIO IS NULL THEN
                SELECT INVENTARIO_COD_SEQ.NEXTVAL INTO :NEW.COD_INVENTARIO FROM DUAL;
            END IF;
            END;
/
ALTER TRIGGER INVENTARIO_COD_TRG ENABLE;

----------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE MATERIAIS_INVENTARIADOS (
ID NUMBER(5) PRIMARY KEY,
COD_INVENTARIO NUMBER(5), 
ID_ESTOQUE NUMBER(5),
QTDE_ESTOQUE_SISTEMA NUMBER(7,2),
QTDE_ESTOQUE_REAL NUMBER(7,2),
CONSTRAINT FK_MATINVENTARIADOS_ESTOQUE FOREIGN KEY (ID_ESTOQUE) REFERENCES ESTOQUE(ID),
CONSTRAINT FK_MATINVENTARIADOS_INVENTARIO FOREIGN KEY (COD_INVENTARIO) REFERENCES INVENTARIO(COD_INVENTARIO),
CONSTRAINT UK_MATINVENTARIASOS UNIQUE (COD_INVENTARIO, ID_ESTOQUE)
);

CREATE SEQUENCE MATINVENTARIADOS_ID_SEQ
MINVALUE 1
MAXVALUE 99999
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE OR REPLACE TRIGGER MATINVENTARIADOS_ID_TRG 
            BEFORE INSERT ON MATERIAIS_INVENTARIADOS
            FOR EACH ROW
                BEGIN
            IF :NEW.ID IS NULL THEN
                SELECT MATINVENTARIADOS_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
            END IF;
            END;
/
ALTER TRIGGER MATINVENTARIADOS_ID_TRG ENABLE;

----------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE CONTAGEM (
ID NUMBER(5) PRIMARY KEY,
ID_MATINVENTARIADOS NUMBER(5),
ID_CONTADOR NUMBER(5),
QTDE_CONTADA NUMBER(7,2),
CONSTRAINT FK_CONTAGEM_MATINVENTARIADOS FOREIGN KEY (ID_MATINVENTARIADOS) REFERENCES MATERIAIS_INVENTARIADOS(ID),
CONSTRAINT FK_CONTAGEM_USER FOREIGN KEY (ID_CONTADOR) REFERENCES USERS(ID),
CONSTRAINT UK_CONTAGEM UNIQUE (ID_MATINVENTARIADOS, ID_CONTADOR)
);

CREATE SEQUENCE CONTAGEM_ID_SEQ
MINVALUE 1
MAXVALUE 99999
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

CREATE OR REPLACE TRIGGER CONTAGEM_ID_TRG 
            BEFORE INSERT ON CONTAGEM
            FOR EACH ROW
                BEGIN
            IF :NEW.ID IS NULL THEN
                SELECT CONTAGEM_ID_SEQ.NEXTVAL INTO :NEW.ID FROM DUAL;
            END IF;
            END;
/
ALTER TRIGGER CONTAGEM_ID_TRG ENABLE;

----------------------------------------------------------------------------------------------------------------------------------------------------------------