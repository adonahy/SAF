<?php 
    session_start();
    require 'connection.php';
    //$da = date("m/d/Y");
    error_reporting(0);

    if(empty($_POST['username'])===false && empty($_POST['password'])===false){
        $u          =   $_POST['username'];
        $p          =   $_POST['password'];
        
        $query  =   mysql_query("SELECT COUNT(`user`) FROM `users` WHERE `user` = '$u' AND `pass` = '$p'");
        $r      =   mysql_fetch_array($query);
        $C      =   $r['COUNT(`user`)'];
        
        if($C > 0){
            //echo "$C";
            $_SESSION["u"] = "$u";
            $_SESSION["c"] = "$p";
            $security   =   'go';
        }else{
            $security   =   'stop';
        }
    }else{
        $u  =   $_SESSION['u'];
        $p  =   $_SESSION['c'];
        
            $query  =   mysql_query("SELECT COUNT(`user`) FROM `users` WHERE `user` = '$u' AND `pass` = '$p'");
            $r      =   mysql_fetch_array($query);
            $C      =   $r['COUNT(`user`)'];
        
        if($C > 0){
            $_SESSION["u"] = "$u";
            $_SESSION["c"] = "$p";
            $security   =   'go';
        }else{
            $security   =   'stop';
        }
        
    }
?>