create schema db_asm;

create table tbl_user (
user_id int primary key auto_increment,
username varchar(255),
userpassword varchar(255),
fullname varchar(255),
email varchar(255)
);

drop schema db_asm;