<?php
namespace App\Bitrix24;

use GuzzleHttp\Client;

class Contact {
    public $contactId = null;
    public $result = null;

    public function __construct( $contactId ) {
        if( $contactId === null ) {
            throw new \Exception('Contact ID is required');
        }

        $this->contactId = $contactId;
        $this->client = new Client();

        $urlGetContact = "https://poiema.bitrix24.com.br/rest/1/qfpp57eeti411i1q/crm.contact.get.json?ID={$this->contactId}";
        $response = $this->client->request('GET', $urlGetContact);
        $json_response = json_decode($response->getBody()->getContents(), true);
        $this->result = $json_response['result'];
    }

    public function getAll() {
        return $this->result;
    }

    public function getField( $field = "UF_CRM_1667760124") {
        return $this->result[ $field ];
    }
}
