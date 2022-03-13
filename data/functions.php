<?php
    
    if(!function_exists("getCategoryArbo")){
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
    }

    if(!function_exists("getUser")){
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
    }

    if(!function_exists("getPost")){
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
    }

    if(!function_exists("getCategory")){
        function getCategory($connexion,$id){
            $req="SELECT * from categories where categoryid = ?";

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
    }
    
    if(!function_exists("getCategoryChilds")){
        function getCategoryChilds($connexion,$id){
            $ids = array();
            $cats = getCatList($connexion);

            $state = false;
            $prof = null;
            foreach($cats as $cat){
                if($state && $cat[2]==$prof) return $ids;
                if($state) array_push($ids,$cat[0]);
                else if($cat[0] == $id){
                    $state = true;
                    array_push($ids,$cat[0]);
                    $prof = $cat[2];
                }
            }

            return $ids;
        }
    }

    if(!function_exists("getCatList")){
        function getCatList($connexion){
            $req = "SELECT categoryid,name,parent FROM categories";
            $result = mysqli_query($connexion, $req) or die('erreur');

            $result = mysqli_fetch_all($result);

            return getCatListRec($result,NULL,0);
        }
    }

    if(!function_exists("getCatListRec")){
        function getCatListRec($result,$parent,$profondeur){
            $cats = array();
            foreach($result as $ligne){
                if($ligne[2]==$parent){
                    array_push($cats,array($ligne[0],$ligne[1],$profondeur));

                    $sons = getCatListRec($result,$ligne[0],$profondeur+1);
                    foreach($sons as $value){
                        array_push($cats,$value);
                    }
                }
            }
            return $cats;
        }
    }

    if(!function_exists("printProfile")){
        function printProfile($connexion, $id){
            $req="SELECT * from users where userid = ?";

            $stmt = mysqli_prepare($connexion, $req);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            mysqli_stmt_close($stmt);
            if($result){
                $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
            }else{
                return "<div class='user-info'>Utilisateur inconnu</div>";
            }
            $str = "<div class='user-info'>";
            if($result["profilepic"]){
                $str .= "<img src='data:image/jpeg;base64,".base64_encode($result["profilepic"])."'class='user-info-image' alt='profile picture'/>";
            }else{
                $str .= "<img src='data/img/noprofile.jpg' alt='profile picture missing' class='user-info-image' />";
            }
            return $str."&#160;<a href='account.php?user=".$result["userid"]."' class='link'>".$result["username"]."</a>"
                        ."<span>&#160-&#160;".$result["points"]
                        ." points</span></div>";
        }
    }
?>