<?php
namespace FedexRest\Services\Ship;

use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Exceptions\MissingTrackingNumberException;
use FedexRest\Services\AbstractRequest;

class CancelShipment extends AbstractRequest
{
    protected int $accountNumber;
    protected string $trackingNumber;
    protected bool $emailShipment = FALSE;
    protected string $senderCountryCode;
    protected string $deletionControl;

    /**
     * {@inheritDoc}
     */
    public function setApiEndpoint() {
        return '/ship/v1/shipments/cancel';
    }


    /**
     * @param  int  $accountNumber
     * @return $this
     */
    public function setAccountNumber(int $accountNumber): CancelShipment {
        $this->accountNumber = $accountNumber;
        return $this;
    }


    /**
     * @param int $trackingNumber
     * @return $this
     */
    public function setTrackingNumber(int $trackingNumber): CancelShipment {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }


    public function setEmailShipment(bool $emailShipment): CancelShipment {
        $this->emailShipment = $emailShipment;
        return $this;
    }


    public function setSenderCountryCode(string $senderCountryCode): CancelShipment {
        $this->senderCountryCode = $senderCountryCode;
        return $this;
    }


    public function setDeletionControl(string $deletionControl): CancelShipment {
        $this->deletionControl = $deletionControl;
        return $this;
    }


    /**
     * @return array
     */
    public function prepare(): array {
        $data = [
            'accountNumber' => [
                'value' => $this->accountNumber,
            ],
            'trackingNumber' => $this->trackingNumber
        ];

        if (!empty($this->emailShipment)) {
            $data['emailShipment'] = $this->emailShipment;
        }
        if (!empty($this->senderCountryCode)) {
            $data['senderCountryCode'] = $this->senderCountryCode;
        }
        if (!empty($this->deletionControl)) {
            $data['deletionControl'] = $this->deletionControl;
        }

        return $data;
    }


    /**
     * @return mixed|string|void
     * @throws MissingAccountNumberException
     * @throws MissingTrackingNumberException
     * @throws \FedexRest\Exceptions\MissingAccessTokenException
     */
    public function request() {
        parent::request();
        if (empty($this->accountNumber)) {
            throw new MissingAccountNumberException('The account number is required');
        }
        if (empty($this->trackingNumber)) {
            throw new MissingTrackingNumberException('The tracking number is required');
        }

        try {
            $query = $this->http_client->put($this->getApiUri($this->api_endpoint), [
                'json' => $this->prepare(),
                'http_errors' => FALSE,
            ]);
            return ($this->raw === true) ? $query : json_decode($query->getBody()->getContents());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}