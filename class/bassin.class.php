<?php

class bassin {

    public function load(){
        global $mysql;
        
        $count = 0;
        $req_sel = "
        SELECT  `id_bassin`, 
                `Nom_bassin`, 
                `valeur_min_temp`, 
                `valeur_max_temp`, 
                `valeur_min_ph`, 
                `valeur_max_ph`, 
                `valeur_min_nitrate`, 
                `valeur_max_nitrate` 
        FROM `Bassins`";

        $result = $mysql->query($req_sel);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $bassins_list[$count]['id_bassin'] = $row['id_bassin'];
            $bassins_list[$count]['Nom_bassin'] = $row['Nom_bassin'];
            $bassins_list[$count]['valeur_min_temp'] = $row['valeur_min_temp'];
            $bassins_list[$count]['valeur_max_temp'] = $row['valeur_max_temp'];
            $bassins_list[$count]['valeur_min_ph'] = $row['valeur_min_ph'];
            $bassins_list[$count]['valeur_max_ph'] = $row['valeur_max_ph'];
            $bassins_list[$count]['valeur_min_nitrate'] = $row['valeur_min_nitrate'];
            $bassins_list[$count]['valeur_max_nitrate'] = $row['valeur_max_nitrate'];
            $count++;
        } 

        return $bassins_list;
    } 

    public function getById($id){
        global $mysql;
        
        $req_sel = "
        SELECT  `Nom_bassin`, 
                `valeur_min_temp`, 
                `valeur_max_temp`, 
                `valeur_min_ph`, 
                `valeur_max_ph`, 
                `valeur_min_nitrate`, 
                `valeur_max_nitrate`      
        FROM `Bassins`
        WHERE `id_bassin` =" .$id;

        $result = $mysql->query($req_sel);

        $row = $result->fetch(PDO::FETCH_ASSOC);

        $bassin['Nom_bassin'] = $row['Nom_bassin'];
        $bassin['valeur_min_temp'] = $row['valeur_min_temp'];
        $bassin['valeur_max_temp'] = $row['valeur_max_temp'];
        $bassin['valeur_min_ph'] = $row['valeur_min_ph'];
        $bassin['valeur_max_ph'] = $row['valeur_max_ph'];
        $bassin['valeur_min_nitrate'] = $row['valeur_min_nitrate'];
        $bassin['valeur_max_nitrate'] = $row['valeur_max_nitrate'];

        return $bassin;
    } 

    
}
