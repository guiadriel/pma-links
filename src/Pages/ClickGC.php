<?php
namespace App\Pages;

use App\Bitrix24\Actions\MoveStage;
use App\Bitrix24\Contact;
use App\Bitrix24\Deal;

class ClickGC {
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
            $link_form_personalizado = $contato->getField("UF_CRM_1667760124");

            MoveStage::handleAction($this->crmId, "C5:UC_17CMN6");

            header("Location: {$link_form_personalizado}");
            exit;

        } catch ( \Exception $e ) {
            die( 'Não foi possível continuar <br/> entre em contato via WhatsApp <br/><br/> Motivo: ' .$e->getMessage() );
        }
    }
}
