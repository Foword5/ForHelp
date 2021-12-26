<?php

    function getCategoryArbo($connexion,$id){
        $string = "";
        for($i=0;$i<10 && $id;$i++){
            $req="SELECT name,parent from categories where categoryid = ?";

            $stmt = mysqli_prepare($connexion, $req);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            foreach($result as $ligne) $cat = $ligne;
            $id = $cat["parent"];

            $string = " > " . $cat["name"] . $string;

            mysqli_stmt_close($stmt);
        }

        return substr($string,3);
    }

    function getUser($connexion,$id){
        $req="SELECT * from users where userid = ?";

        $stmt = mysqli_prepare($connexion, $req);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        if(mysqli_num_rows($result)>=1){
            foreach($result as $ligne) $return = $ligne;
        }else{
            $return = NULL;
        }
        return $return;
    }

    function getPost($connexion,$id){
        $req="SELECT * from posts where postid = ?";

        $stmt = mysqli_prepare($connexion, $req);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        if(mysqli_num_rows($result)>=1){
            foreach($result as $ligne) $return = $ligne;
        }else{
            $return = NULL;
        }
        return $return;
    }
?>