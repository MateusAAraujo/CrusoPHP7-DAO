CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuarios_insert`(
pdeslogin varchar(64),
pdessenha varchar(256)
)
BEGIN

	insert into tb_usuarios(deslogin, dessenha) values(pdeslogin, pdessenha);
    
    select * from tb_usuarios where idusuario = last_insert_id();

END