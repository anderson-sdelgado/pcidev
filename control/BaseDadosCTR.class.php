<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/ComponenteDAO.class.php');
require_once('../model/dao/FuncionarioDAO.class.php');
require_once('../model/dao/ItemOSDAO.class.php');
require_once('../model/dao/OSDAO.class.php');
require_once('../model/dao/PlantaDAO.class.php');
require_once('../model/dao/ServicoDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    
    private $base = 2;
    
    public function dadosComponente($versao) {
        
        $versao = str_replace("_", ".", $versao);
       
        if($versao >= 2.00){
            
            $componenteDAO = new ComponenteDAO();
        
            $dados = array("dados"=>$componenteDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
     public function dadosFunc($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 2.00){
            
            $funcionarioDAO = new FuncionarioDAO();
       
            $dados = array("dados"=>$funcionarioDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosItemOS($info, $versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 2.00){
            
            $itemOSDAO = new ItemOSDAO();

            $dado = $info['dado'];

            $dadosItemOS = array("dados" => $itemOSDAO->dados($dado, $this->base));
            $resItemOS = json_encode($dadosItemOS);

            return $resItemOS;
        
        }
            
    }
    
    public function dadosOS($info, $versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 2.00){

            $osDAO = new OSDAO();

            $dado = $info['dado'];

            $dadosOS = array("dados" => $osDAO->dados($dado, $this->base));
            $resOS = json_encode($dadosOS);

            return $resOS;
        
        }
                
    }
    
    public function dadosPlanta($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 2.00){
        
            $plantaDAO = new PlantaDAO();

            $dados = array("dados"=>$plantaDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosServico($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 2.00){
        
            $servicoDAO = new ServicoDAO();

            $dados = array("dados"=>$servicoDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
}
