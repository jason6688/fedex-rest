<?php

namespace FedexRest\Entity;

use FedexRest\Services\Ship\Entity\CustomerReference;

class Item
{
    public string $itemDescription = '';
    public ?Weight $weight;
    public ?Dimensions $dimensions;
    public array $customerReferences = [];

    /**
     * @param string $itemDescription
     * @return Item
     */
    public function setItemDescription(string $itemDescription): Item
    {
        $this->itemDescription = $itemDescription;
        return $this;
    }

    /**
     * @param Weight|null $weight
     * @return $this
     */
    public function setWeight(?Weight $weight): Item
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @param Dimensions|null $dimensions
     * @return $this
     */
    public function setDimensions(?Dimensions $dimensions): Item
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    /**
     * @param CustomerReference ...$customerReferences
     * @return $this
     */
    public function setCustomerReferences(CustomerReference ...$customerReferences): Item
    {
        $this->customerReferences = $customerReferences;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];

        if (!empty($this->itemDescription)) {
            $data['itemDescription'] = $this->itemDescription;
        }

        if (!empty($this->weight)) {
            $data['weight'] = $this->weight->prepare();
        }

        if (!empty($this->dimensions)) {
            $data['dimensions'] = $this->dimensions->prepare();
        }

        $customerReferences = [];
        if (!empty($this->customerReferences)) {
            foreach ($this->customerReferences as $customerReference) {
                $customerReferences[] = $customerReference->prepare();
            }

            $data['customerReferences'] = $customerReferences;
        }

        return $data;
    }


}
