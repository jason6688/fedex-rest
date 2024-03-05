<?php

namespace FedexRest\Services\Ship\Entity;

class CustomsClearanceDetail
{
    public ?CommercialInvoice $commercialInvoice;
    public array $commodities = [];

    /**
     * @param CommercialInvoice $commercialInvoice
     * @return $this
     */
    public function setCommercialInvoice(CommercialInvoice $commercialInvoice): CustomsClearanceDetail
    {
        $this->commercialInvoice = $commercialInvoice;
        return $this;
    }

    /**
     * @param Commoditie ...$commodities
     * @return $this
     */
    public function setCommodities(Commodity ...$commodities): CustomsClearanceDetail
    {
        $this->commodities = $commodities;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];
        $commodities = [];
        if (!empty($this->commercialInvoice)) {
            $data['commercialInvoice'] = $this->commercialInvoice->prepare();
        }

        if (!empty($this->commodities)) {
            foreach ($this->commodities as $commodity) {
                $commodities[] = $commodity->prepare();
            }
            $data['commodities'] = $commodities;
        }
        return $data;
    }
}
