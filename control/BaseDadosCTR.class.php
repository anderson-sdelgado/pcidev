<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../control/AtualAplicCTR.class.php');
require_once('../model/AtualAplicDAO.class.php');
require_once('../model/ComponenteDAO.class.php');
require_once('../model/FuncionarioDAO.class.php');
require_once('../model/ItemOSDAO.class.php');
require_once('../model/OSDAO.class.php');
require_once('../model/PlantaDAO.class.php');
require_once('../model/ServicoDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    
    public function dadosComponente($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $componenteDAO = new ComponenteDAO();

            $dados = array("dados"=>$componenteDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }

    }
    
     public function dadosFunc($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){
            
            $funcionarioDAO = new FuncionarioDAO();

            $dados = array("dados"=>$funcionarioDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
       
        }

    }
    
    public function dadosItemOS($info) {

        $itemOSDAO = new ItemOSDAO();
        $atualAplicDAO = new AtualAplicDAO();

        $jsonObj = json_decode($info['dado']);
        $dados = $jsonObj->dados;

        foreach ($dados as $d) {
            $idOS = $d->idOS;
            $token = $d->token;
        }

        $v = $atualAplicDAO->verToken($token);
        
        if ($v > 0) {

            $dadosItemOS = array("dados" => $itemOSDAO->dados($idOS));
            $resItemOS = json_encode($dadosItemOS);

            return $resItemOS;
        
        }

    }
    
    public function dadosOS($info) {

        $osDAO = new OSDAO();
        $atualAplicDAO = new AtualAplicDAO();

        $jsonObj = json_decode($info['dado']);
        $dados = $jsonObj->dados;

        foreach ($dados as $d) {
            $idOficSecao = $d->idOficSecao;
            $token = $d->token;
        }

        $v = $atualAplicDAO->verToken($token);
        
        if ($v > 0) {

            $dadosOS = array("dados" => $osDAO->dados($idOficSecao));
            $resOS = json_encode($dadosOS);

            return $resOS;
        
        }
                 
    }
    
    public function dadosPlanta($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){
            
            $plantaDAO = new PlantaDAO();

            $dados = array("dados"=>$plantaDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosServico($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){
            
            $servicoDAO = new ServicoDAO();

            $dados = array("dados"=>$servicoDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
}
