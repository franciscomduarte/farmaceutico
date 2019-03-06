<?php

spl_autoload_register(function ($class) {
    include '../../classes/'.$class .'.php';
});

include_once '../../config.php';
include_once '../../util/functions.php';

$objChecklist = new Checklist();
$cl = $objChecklist->listarAtivos();

    foreach ($cl as $checklist) {
        $mensagem = "Bundle . $checklist->sigla . não preenchido para o(s) paciente(s):";
        $internacoes = $checklist->internacoes;
        foreach ($internacoes as $internacao) {
            $objChecklist = new Checklist();
            $bundles = $objChecklist->listarAtivasPorInternacao($internacao->id);
            foreach ($bundles as $bundle) {
                if ($checklist->id == $bundle->id) {
                    $mensagem .= $internacao->paciente->nome . " ";
                }
            }
        }
        $telegram = new Telegram();
        $telegram->enviaAlerta($mensagem);
        
    }
?>
