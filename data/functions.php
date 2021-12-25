<?php

function getCategoryArbo($connexion,$id){
    $string = "";
    while($id){
        $req="SELECT name,parent from categories where categoryid = " . $id;
        $result = mysqli_query($connexion,$req);

        foreach($result as $ligne) $cat = $ligne;
        $id = $cat["parent"];

        $string = " > " . $cat["name"] . $string;
    }

    return substr($string,3);
}

?>