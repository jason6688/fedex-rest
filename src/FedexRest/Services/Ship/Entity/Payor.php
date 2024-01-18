<?php
namespace FedexRest\Services\Ship\Entity;

class Payor
{
    public ?ResponsibleParty $responsibleParty;

    /**
     * @param ResponsibleParty $responsibleParty
     * @return $this
     */
    public function setResponsibleParty(ResponsibleParty $responsibleParty): Payor
    {
        $this->responsibleParty = $responsibleParty;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];
        if (!empty($this->responsibleParty)) {
            $data['responsibleParty'] = $this->responsibleParty->prepare();
        }

        return $data;
    }

}