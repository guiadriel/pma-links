<?php
ini_set("display_errors", 1);
require_once "./vendor/autoload.php";

use App\Pages\ClickGC;

// Tipos de páginas
$pages = [
    "gc" => App\Pages\ClickGC::class,
    "gc_final" => App\Pages\ClickGCFinal::class,
    "mn" => App\Pages\ClickMinisterio::class,
    "mn_final" => App\Pages\ClickMinisterioFinal::class,
    "yt" => App\Pages\ClickYT::class,
    "parar" => null,
    "live" => null,
    "sair" => null
];

// Verifica se a página existe
$page = filter_input(INPUT_GET, 'page');
if( $page == null || !array_key_exists($page, $pages) ) {
  die('Página não encontrada. <br/> Não foi possível continuar, entre em contato via WhatsApp');
}

// Verifica se o ID está correto
$crmId = filter_input(INPUT_GET, 'i', FILTER_VALIDATE_INT);
if( $crmId === false ) {
  die('ID não encontrado. <br/> Não foi possível continuar, entre em contato via WhatsApp');
}

try {

    $selectedPage = new $pages[$page]($crmId);
    $selectedPage->execute();

} catch ( \Exception $e ) {
    die('Erro. <br/> Não foi possível continuar, entre em contato via WhatsApp. Motivo' . $e->getMessage() );
}
