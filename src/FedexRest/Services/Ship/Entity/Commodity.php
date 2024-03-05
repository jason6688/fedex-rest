<?php
namespace FedexRest\Services\Ship\Entity;

class Commodity
{
    public string $description;
    
    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): Commodity
    {
        $this->description = $description;

        return $this;
    }


    public function prepare(): array
    {
        $data = [];
        if (!empty($this->description)) {
            $data['description'] = $this->description;
        }

        return $data;
    }

}