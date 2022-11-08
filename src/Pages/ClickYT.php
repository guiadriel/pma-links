<?php
namespace App\Pages;

use App\Bitrix24\Actions\MoveStage;
use App\Bitrix24\Contact;
use App\Bitrix24\Deal;

class ClickYT {
    public $crmId = null;
    public $result = null;

    public function __construct( $crmId ) {
        if( $crmId === null ) {
            throw new \Exception('CRM ID is required');
        }

        $this->crmId = $crmId;
    }

    public function execute() {
        try {

            $deal = new Deal( $this->crmId );
            $contato = new Contact( $deal->getContactId() );
            $name = $contato->getField("NAME");

            // PIPELINE: WELCOME
            // STAGE: Click Youtube
            MoveStage::handleAction($this->crmId, "C5:UC_OCPI80");

            header("Location: https://youtube.com/poiemeiros");
            exit;

        } catch ( \Exception $e ) {
            die( 'Não foi possível continuar <br/> entre em contato via WhatsApp <br/><br/> Motivo: ' .$e->getMessage() );
        }
    }
}
