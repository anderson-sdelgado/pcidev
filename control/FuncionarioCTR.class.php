<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/FuncionarioDAO.class.php');
/**
 * Description of FuncionarioCTR
 *
 * @author anderson
 */
class FuncionarioCTR {
    //put your code here
    
    public function dados() {
        
        $funcionarioDAO = new FuncionarioDAO();
       
        $dados = array("dados"=>$funcionarioDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
}
