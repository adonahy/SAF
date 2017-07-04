<?php
    $da = date("d/m/Y");

    function user_exists($username){
        //$username = sanitize($username);
        return (mysql_result(mysql_query("SELECT COUNT(`user`) FROM `users` WHERE `user` = '$username'"), 0) == 1) ? true : false;
    }

    function output_errors($errors){
        return '<ul><il>' . implode ('</il><li>', $errors) . '</il></ul>';
    }

    function register_user($u, $p, $d){
        $query=mysql_query("INSERT INTO `users` (`user`, `pass`, `date`) VALUES ('$u', '$p', '$d')");
    }

    function eliminar_user($usuario){
        $query=mysql_query("DELETE FROM `users` WHERE `users`.`user` = '$usuario'");
    }

    function insert_logs($f, $u, $d, $t, $u_e){
        $query=mysql_query("INSERT INTO `logs` (`id`, `fecha`, `usuario`, `descripcion`, `tabla`) VALUES (NULL, '$f', '$u', '$d \"$u_e\"', '$t')");
    }
    
    function insert_rol(){
        
    }

    function new_id(){
        $query=mysql_query("SELECT `id` FROM `planillas` ORDER BY id DESC");
        $r    =mysql_fetch_array($query);
        
        $id   =$r['id'];
        $newid=$id + 1;
        
        return $newid;
    }


        
        $query=mysql_query("SELECT `nombre` FROM `nombre_programa`");
        $rq =   mysql_fetch_array($query);
        
        $nombre_p =   $rq['nombre'];
        
        
        
    

?>