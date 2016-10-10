drop database lost_and_found;
create database if not exists `lost_and_found`
    CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

use `lost_and_found`;
-- permissoes
create table permission (
    perm_cd int(4) unique,
    perm_nm varchar(100) unique,
    perm_ds varchar(250)
);

insert into permission
    values (0,'admin', 'Admin tem acesso completo'),
           (10,'comum', 'tem acesso a areas comuns');

select * from permission;

drop table if exists user;

-- user
create table user(
    user_cd int(4) auto_increment,
    user_nm varchar(12) unique not null,
    user_ps varchar(100) not null,
    user_perm_cd int(4) not null,
    user_email varchar(100) unique not null,
    user_fnm varchar(100),
    constraint pk_user primary key(user_cd),
    constraint fk_perm foreign key(user_perm_cd) references permission(perm_cd)
);

insert into user
    values (null,'admin', MD5('qwe123'), 0,'leandrogamedesigner@gmail.com','Leandro Soares');
select * from user;

drop table if exists object_status;
create table object_status(
	obst_cd int(1)NOT NULL,
    obst_ds varchar(100)NOT NULL,
    constraint pk_obst primary key(obst_cd)
);
insert into object_status values(1,'perdido');
insert into object_status values(2,'achado');
insert into object_status values(3,'encontrado');
insert into object_status values(4,'entregue');

drop table if exists object;
create table object(
	 obje_cd int(4) auto_increment
    ,obje_nm varchar(45)
    ,obje_ds varchar(255)
    ,obje_img longblob
    ,obje_obst_cd int(1)
    ,obje_email varchar(255)
    ,constraint pk_obje_cd primary key(obje_cd)
    ,constraint fk_obje_obst_cd foreign key(obje_obst_cd) references object_status(obst_cd)
    
);

-- select * from object;
-- 
-- Select * from object 
-- 		 where obje_cd 
--          in(Select object.obje_cd, upper(Concat(object.obje_nm,object.obje_ds, object_status.obst_ds))as concat
--     from object,object_status 
--     where object.obje_obst_cd=object_status.obst_cd);
-- 
-- Select Concat(obje_nm, "", obje_ds) from object;
-- 
-- 
-- Select *
--     from (select * 
-- 			from object,object_status
-- 			where object.obje_obst_cd=object_status.obst_cd) as obj
--     where Concat(obj.obje_nm, "", obj.obje_ds,"",obj.obst_ds) like "%perdido%";
--     
-- -- Select * from object where Concat(obje_nm, "", obje_ds,"" like "%'.$seachQuery.'%"';
--     
-- select * 
--     from object,object_status
--     where object.obje_obst_cd=object_status.obst_cd;

select * from object order by obje_obst_cd;
update object set obje_obst_cd=2 where obje_cd=3;