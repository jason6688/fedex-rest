<?php
namespace FedexRest\Services\Ship\Entity;

class ResponsibleParty
{
    protected int $thirdAccountNumber;

    /**
     * @param int $thirdAccountNumber
     * @return $this
     */
    public function setThirdAccountNumber(int $thirdAccountNumber): ResponsibleParty
    {
        $this->thirdAccountNumber = $thirdAccountNumber;
        return $this;
    }

    public function prepare(): array
    {
        $data = [
            'accountNumber' => [
                'value' => $this->thirdAccountNumber,
            ],
        ];

        return $data;
    }

}