<?php
namespace App\Pages;

use App\Bitrix24\Actions\MoveStage;
use App\Bitrix24\Contact;
use App\Bitrix24\Deal;

/**
 * Provido da pipeline Apelo (Click pós audio)
 */
class ClickApelo {
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

            // PIPELINE: APELO
            // STAGE: PÓS AUDIO DO PASTOR
            MoveStage::handleAction($this->crmId, "C1:UC_IDPMV0");

            header("Location: https://youtube.com/poiemeiros");
            exit;

        } catch ( \Exception $e ) {
            die( 'Não foi possível continuar <br/> entre em contato via WhatsApp <br/><br/> Motivo: ' .$e->getMessage() );
        }
    }
}
