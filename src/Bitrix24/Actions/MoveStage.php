<?php
namespace App\Bitrix24\Actions;

class MoveStage {
    public $crmId = null;
    public $stageId = null;
    public $result = null;

    public static function handleAction( $crmId, $stageId ) {
        if( $crmId === null ) {
            throw new \Exception('CRM ID is required');
        }

        if( $stageId === null ) {
            throw new \Exception('Stage ID is required');
        }

        $client = new \GuzzleHttp\Client();

        $urlRestToBitrixAction = "https://poiema.bitrix24.com.br/rest/1/vvl1hicqckkjoj42/crm.deal.update.json?ID={$crmId}&STAGE_ID={$stageId}";
        $response = $client->request('GET', $urlRestToBitrixAction);
        $json_response = json_decode($response->getBody()->getContents(), true);
        $result = $json_response['result'];
        return $result;
    }
}
