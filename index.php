<?php
ini_set("display_errors", 1);
require_once "./vendor/autoload.php";

use App\Pages\ClickGC;

// Tipos de páginas
$pages = [
    "gc" => ClickGC::class,
    "yt" => null,
    "mn" => null,
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

}






// if( $page === "gc") {
//     $client = new \GuzzleHttp\Client();
//     // Resgatar código do contato
//     $urlGetContact = "https://poiema.bitrix24.com.br/rest/1/vvl1hicqckkjoj42/crm.deal.get.json?ID={$crmId}";
//     $response = $client->request('GET', $urlGetContact);
//     $json_response = json_decode($response->getBody()->getContents(), true);
//     $contactId = $json_response['result']['CONTACT_ID'];

//     // Recuperar informação do link personalizado
//     $urlGetContact = "https://poiema.bitrix24.com.br/rest/1/qfpp57eeti411i1q/crm.contact.get.json?ID={$contactId}";
//     $response = $client->request('GET', $urlGetContact);
//     $json_response = json_decode($response->getBody()->getContents(), true);
//     $link_form_personalizado = $json_response['result']['UF_CRM_1667760124'];

//     // Atualizar etapa para CLICOU:GC
//     $stageId = "C5:UC_KOZHZL"; // Pipeline Welcome: Stage  CLICOU:GC
//     $urlBitrix24 = "https://poiema.bitrix24.com.br/rest/1/3riiuenuve947m3z/crm.deal.update.json?ID={$crmId}&FIELDS[STAGE_ID]={$stageId}";
//     $response = $client->request('GET', $urlBitrix24);
//     if( $response === false || $response->getStatusCode() != 200 ) {
//         die('Não foi possível continuar, entre em contato via WhatsApp');
//     }

//     // Redirecionar para o formulário de GC (Personalizado)
//     header("Location: {$link_form_personalizado}");
//     exit;
// }
