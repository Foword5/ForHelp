<?php

    function getCategoryArbo($connexion,$id){
        $string = "";
        for($i=0;$i<5 && ($id != NULL);$i++){
            $req="SELECT name,parent from categories where categoryid = " . $id;
            $result = mysqli_query($connexion,$req);

            foreach($result as $ligne) $cat = $ligne;
            $id = $cat["parent"];

            $string = " > " . $cat["name"] . $string;
        }

        return substr($string,3);
    }

?>