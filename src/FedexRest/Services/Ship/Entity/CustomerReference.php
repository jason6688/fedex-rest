<?php
namespace FedexRest\Services\Ship\Entity;

class CustomerReference
{
    public ?string $customerReferenceType;

    public ?string $value;


    public function setCustomerReferenceType(string $customerReferenceType): CustomerReference
    {
        $this->customerReferenceType = $customerReferenceType;
        return $this;
    }


    public function setValue(string $value): CustomerReference
    {
        $this->value = $value;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];
        if (!empty($this->customerReferenceType)) {
            $data['customerReferenceType'] = $this->customerReferenceType;
        }

        if (!empty($this->value)) {
            $data['value'] = $this->value;
        }

        return $data;
    }

}