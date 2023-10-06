<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of FuncionarioDAO
 *
 * @author anderson
 */
class FuncionarioDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " MATRICULA AS \"matricFunc\" "
                    . " , CARACTER(NOME_FUNC) AS \"nomeFunc\" "
                    . " , FUNC_ID AS \"idFunc\" "
                    . " , OFICSECAO_ID AS \"idOficSecaoFunc\" "
                . " FROM "
                    . " USINAS.V_FUNC_APONT_INDUSTRIA "
                . " ORDER BY "
                        . " MATRICULA "
                . " ASC ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
