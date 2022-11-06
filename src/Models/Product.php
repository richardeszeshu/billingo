<?php

declare(strict_types=1);

namespace RichardEszes\Billingo\Models;

class Product extends AbstractModel
{
    protected $id;

    protected $name;

    protected $currency;

    protected $vat;

    protected $net_unit_price;

    protected $unit;

    protected $general_ledger_number;

    protected $general_ledger_taxcode;

    protected $entitlement;

    /**
     * Set Billingo ID.
     * 
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set name of the product.
     * 
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set document currency of partner.
     * 
     * @param string $currency
     * @return self
     * @throws Exception
     */
    public function setCurrency(string $currency): self
    {
        if (!in_array($currency, config('billingo.currencies'))) {
            throw new \Exception("Invalid currency");
        }

        $this->currency = $currency;

        return $this;
    }

    /**
     * Set vat of partner.
     * 
     * @param string $vat
     * @return self
     * @throws Exception
     */
    public function setVat(string $vat): self
    {
        if (!in_array($vat, config('billingo.vatKeys'))) {
            throw new \Exception("Invalid vat key");
        }

        $this->vat = $vat;

        return $this;
    }

    /**
     * Set net unit price of the product.
     * 
     * @param float $price
     * @return self
     */
    public function setNetUnitPrice(float $price): self
    {
        $this->net_unit_price = $price;

        return $this;
    }

    /**
     * Set unit of the product.
     * 
     * @param string $unit
     * @return self
     */
    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Set general ledger number of the product.
     * 
     * @param string $number
     * @return self
     */
    public function setGeneralLedgerNumber(string $number): self
    {
        $this->general_ledger_number = $number;

        return $this;
    }

    /**
     * Set general ledger taxcode of the product.
     * 
     * @param string $code
     * @return self
     */
    public function setGeneralLedgerTaxcode(string $code): self
    {
        $this->general_ledger_taxcode = $code;

        return $this;
    }

    /**
     * Set entitlement of partner.
     * 
     * @param string $entitlement
     * @return self
     * @throws Exception
     */
    public function setEntitlement(string $entitlement): self
    {
        if (!in_array($entitlement, config('billingo.entitlements'))) {
            throw new \Exception("Invalid entitlement");
        }

        $this->entitlement = $entitlement;

        return $this;
    }
}