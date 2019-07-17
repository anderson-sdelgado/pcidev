<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('./model/dao/ItemOSDAO.class.php');
/**
 * Description of ItemOSCTR
 *
 * @author anderson
 */
class ItemOSCTR {
    //put your code here
    
    public function dados($info) {

        $itemOSDAO = new ItemOSDAO();

        $dado = $info['dado'];

        $dadosItemOS = array("dados" => $itemOSDAO->dados($dado));
        $resItemOS = json_encode($dadosItemOS);
        
        return $resItemOS;
                
    }
    
}
