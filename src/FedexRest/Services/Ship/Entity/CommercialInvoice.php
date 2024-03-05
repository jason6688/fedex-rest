<?php
namespace FedexRest\Services\Ship\Entity;

class CommercialInvoice
{
    public array $customerReferences = [];


    /**
     * @param CustomerReference ...$customerReferences
     * @return $this
     */
    public function setCustomerReferences(CustomerReference ...$customerReferences): CommercialInvoice
    {
        $this->customerReferences = $customerReferences;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];
        $customerReferences = [];
        if (!empty($this->customerReferences)) {
            foreach ($this->customerReferences as $customerReference) {
                $customerReferences[] = $customerReference->prepare();
            }

            $data = [
                'customerReferences' => $customerReferences
            ];
        }

        return $data;
    }

}