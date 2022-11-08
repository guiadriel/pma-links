<?php
namespace App\Bitrix24;

use GuzzleHttp\Client;

class Deal {
    public $crmId = null;
    public $result = null;

    public function __construct( $crmId ) {
        if( $crmId === null ) {
            throw new \Exception('CRM ID is required');
        }

        $this->crmId = $crmId;
        $this->client = new Client();

        $urlGetDeal = "https://poiema.bitrix24.com.br/rest/1/vvl1hicqckkjoj42/crm.deal.get.json?ID={$this->crmId}";
        $response = $this->client->request('GET', $urlGetDeal);
        $json_response = json_decode($response->getBody()->getContents(), true);
        $this->result = $json_response['result'];
    }

    public function getContactId() {
        return $this->result['CONTACT_ID'];
    }
}
