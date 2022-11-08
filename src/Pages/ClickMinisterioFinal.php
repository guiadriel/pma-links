<?php
namespace App\Pages;

use App\Bitrix24\Actions\MoveStage;
use App\Bitrix24\Contact;
use App\Bitrix24\Deal;

class ClickMinisterioFinal {
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

            // PIPELINE: Ministérios
            // STAGE: FINALIZADO MINISTÉRIO
            MoveStage::handleAction($this->crmId, "C3:UC_KHYW1U");

            echo "O contato <strong>({$name})</strong> foi movido para a etapa de ministérios para [Contato de Ministérios Finalizados]. <br/> Agora você pode fechar esta janela.";
            exit;

        } catch ( \Exception $e ) {
            die( 'Não foi possível continuar <br/> entre em contato via WhatsApp <br/><br/> Motivo: ' .$e->getMessage() );
        }
    }
}
