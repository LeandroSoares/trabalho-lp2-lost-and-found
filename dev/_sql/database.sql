-- se quiser do zero de novo: drop
-- drop database episodia_lms;
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
    values (null,'admin', MD5('qwe123'), 0);
select * from user;

-- profile
-- create table user_profile(
-- 	uspr_user_cd int(4) not null,
--     uspr_email varchar(100) unique not null,
--     uspr_fnm varchar(45),
--     uspr_lnm varchar(45),
--     uspr_phone varchar(45),
--     uspr_starttime timestamp default current_timestamp,
--     constraint fk_uspr foreign key(uspr_user_cd) references user (user_cd)
-- );

-- insert into user_profile (uspr_user_cd,uspr_email,uspr_fnm,uspr_lnm,uspr_phone)
--              values (1, 'leandrogamdesigner@gmail.com', 'Leandro','Silva Soares', '11957746243');

select *
	from user, user_profile, permission
    where user.user_cd=user_profile.uspr_user_cd
    and user.user_perm_cd=permission.perm_cd;

create table objeto_status(
	obst_cd int(1)NOT NULL,
    obst_ds varchar(100)NOT NULL,
    constraint pk_obst primary key(obst_cd)
);
insert into objeto_status values(0,'perdido'),(1,'encontrado');

create table objeto(
	obje_cd int(4) NOT NULL,
    obje_nm varchar(255) NOT NULL,
    obje_ds varchar(255)NOT NULL,
	obje_obst_cd int(1)NOT NULL,
    obje_img longblob,
    constraint pk_obje primary key(obst_cd),
    constraint fk_status foreign key(obje_obst_cd) references objeto_status(obst_cd)
    
);