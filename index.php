<?php

//require_once("utils.php");
require_once("autoload.php");

// Instancia a classe de conexao com banco de dados
try {
    $sql = new Sql();
    $sql->setDebug(true);
    $sql->setDebugRows(true);
} catch (Exception $e) {
    showExceptionAndAbort($e);
}

$fisrtid = 0;
$lastid = 0;

// <<< Executa SELECT's >>>
// Exemplo de SELECT para buscar todos os registros de uma tabela
try {
    $results = $sql->select("SELECT * FROM employee ORDER BY id", array());
} catch (Exception $e) {
    showExceptionAndAbort($e);
}

// <<< Executa um INSERT >>>
// Exemplo que cria um registro com base na ultima identificacao encontradas
try {
    $results = $sql->select("SELECT max(id) AS lastid FROM employee", array());
    if (isset($results) && count($results) > 0 && isset($results[0]['lastid']))
        $lastid = (int)$results[0]['lastid'];
    $lastid++;
    $params = array(":ID" => $lastid, ":NOME" => "employee_" . $lastid, ":CARGO" => "cargo_" . $lastid);
    $sql->query("INSERT INTO employee (id, name, cargo) VALUES (:ID, :NOME, :CARGO)", $params);
} catch (Exception $e) {
    showExceptionAndAbort($e);
}

// <<< Executa um DELETE >>>
// Executa um comando SQL remover o registro mais novo na tabela
try {
    $results = $sql->select("SELECT min(id) AS minid FROM employee", array());
    if (isset($results) && count($results) > 0 && isset($results[0]['minid'])) {
        $minid = (int)$results[0]['minid'];
        $params = array(":ID" => $minid);
        $sql->query("DELETE FROM employee WHERE id = :ID", $params);
    }
} catch (Exception $e) {
    showExceptionAndAbort($e);
}

// <<< Executa um UPDATE >>>
// Executa um comando SQL remover o registro mais novo na tabela
try {
    $idrand = rand($minid, $lastid);
    $params = array(":ID" => $idrand, ":CARGO" => "Cargo Aleatorio: " . $idrand);
    $sql->query("UPDATE employee SET cargo=:CARGO WHERE id=:ID", $params);
} catch (Exception $e) {
    showExceptionAndAbort($e);
}

?>