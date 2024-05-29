<?php

class donnee {

    public function load(){
        global $mysql;
        
        $count = 0;
        $req_sel = "
        SELECT  `id_donnees`, 
                `id_bassin`, 
                `releve_temperature`,  
                `releve_ph`, 
                `releve_nitrate`, 
                `created_at` 
        FROM `Donnees`";


        $result = $mysql->query($req_sel);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $données_list[$count]['id_donnees'] = $row['id_donnees'];
            $données_list[$count]['id_bassin'] = $row['id_bassin'];
            $données_list[$count]['releve_temperature'] = $row['releve_temperature'];
            $données_list[$count]['releve_ph'] = $row['releve_ph'];
            $données_list[$count]['releve_nitrate'] = $row['releve_nitrate'];
            $données_list[$count]['created_at'] = $row['created_at'];
           
            $count++;
        } 

        return $données_list;
    } 

    public function getData($id, $date){
        global $mysql;
        
        $count = 0;
        $req_sel = "
        SELECT  `id_donnees`, 
                `id_bassin`, 
                `releve_temperature`,  
                `releve_ph`, 
                `releve_nitrate`, 
                DATE_FORMAT(`created_at`, '%d/%m/%Y %HH%i') as `date_fr`
        FROM `Donnees`
        WHERE `id_bassin` = ".$id."
        AND `created_at` LIKE '".$date."%'";

        $result = $mysql->query($req_sel);
        $donnees_list = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $donnees_list[$count]['id_donnees'] = $row['id_donnees'];
            $donnees_list[$count]['id_bassin'] = $row['id_bassin'];
            $donnees_list[$count]['releve_temperature'] = $row['releve_temperature'];
            $donnees_list[$count]['releve_ph'] = $row['releve_ph'];
            $donnees_list[$count]['releve_nitrate'] = $row['releve_nitrate'];
            $donnees_list[$count]['created_at'] = $row['date_fr'];
           
            $count++;
        } 
         
        return $donnees_list;
    } 

    public function getDataById($id){
        global $mysql;
        
        $count = 0;
        $req_sel = "
        SELECT  `id_donnees`, 
                `id_bassin`, 
                `releve_temperature`,  
                `releve_ph`, 
                `releve_nitrate`, 
                DATE_FORMAT(`created_at`, '%d/%m/%Y %HH%i') as `date_fr`
        FROM `Donnees`
        WHERE `id_bassin` = ".$id;

        $result = $mysql->query($req_sel);

        $donnees_list = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $donnees_list[$count]['id_donnees'] = $row['id_donnees'];
            $donnees_list[$count]['id_bassin'] = $row['id_bassin'];
            $donnees_list[$count]['releve_temperature'] = $row['releve_temperature'];
            $donnees_list[$count]['releve_ph'] = $row['releve_ph'];
            $donnees_list[$count]['releve_nitrate'] = $row['releve_nitrate'];
            $donnees_list[$count]['created_at'] = $row['date_fr'];
           
            $count++;
        } 

        return $donnees_list;
    } 
    

    public function getByIdForCsv($id){
        global $mysql;
        
        $count = 0;
        $req_sel = "
        SELECT  `releve_temperature`,  
                `releve_ph`, 
                `releve_nitrate`, 
                DATE_FORMAT(`created_at`, '%d/%m/%Y %HH%i') as `date_fr`
        FROM `Donnees`
        WHERE `id_bassin` = ".$id;

        $result = $mysql->query($req_sel);

        $donnees_list = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $donnees_list[$count]['created_at'] = $row['date_fr'];
            $donnees_list[$count]['releve_temperature'] = $row['releve_temperature'];
            $donnees_list[$count]['releve_ph'] = $row['releve_ph'];
            $donnees_list[$count]['releve_nitrate'] = $row['releve_nitrate'];
           
            $count++;
        } 

        return $donnees_list;
    } 
    
    public function getDataForCsv($id, $date){
        global $mysql;
        
        $count = 0;
        $req_sel = "
        SELECT  `releve_temperature`,  
                `releve_ph`, 
                `releve_nitrate`, 
                DATE_FORMAT(`created_at`, '%d/%m/%Y %HH%i') as `date_fr`
        FROM `Donnees`
        WHERE `id_bassin` = ".$id."
        AND `created_at` LIKE '".$date."%'";

        $result = $mysql->query($req_sel);
        $donnees_list = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $donnees_list[$count]['created_at'] = $row['date_fr'];
            $donnees_list[$count]['releve_temperature'] = $row['releve_temperature'];
            $donnees_list[$count]['releve_ph'] = $row['releve_ph'];
            $donnees_list[$count]['releve_nitrate'] = $row['releve_nitrate'];
           
            $count++;
        } 
    }  
}