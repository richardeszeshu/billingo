<?php

namespace RichardEszes\Billingo\Models;

class Partner extends AbstractModel
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $address;

    /**
     * @var array
     */
    protected $emails;

    /**
     * @var string
     */
    protected $taxcode;

    /**
     * @var string
     */
    protected $iban;

    /**
     * @var string
     */
    protected $swift;

    /**
     * @var string
     */
    protected $account_number;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $general_ledger_number;

    /**
     * @var string
     */
    protected $tax_type;

    /**
     * @var array
     */
    protected $custom_billing_settings;

    /**
     * @var string
     */
    protected $group_member_tax_number;

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
     * Set name of partner.
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
     * Set address of partner.
     * 
     * @param array $address
     * @return self
     * @throws Exception
     */
    protected function setAddress(array $address): self
    {
        if (!in_array($address['country_code'], config('billingo.countryCodes'))) {
            throw new \Exception("Invalid country code");
        }

        $this->address = [
            'country_code' => $address['country_code'],
            'post_code' => $address['post_code'],
            'city' => $address['city'],
            'address' => $address['address']
        ];

        return $this;
    }

    /**
     * Set address of partner.
     * 
     * @param string $countryCode
     * @param string $postCode
     * @param string $city
     * @param string $address
     * @return self
     * @throws Exception
     */
    public function setAddressFields(string $countryCode, string $postCode, string $city, string $address): self
    {
        if (!in_array($countryCode, config('billingo.countryCodes'))) {
            throw new \Exception("Invalid country code");
        }

        $this->address = [
            'country_code' => $countryCode,
            'post_code' => $postCode,
            'city' => $city,
            'address' => $address
        ];

        return $this;
    }

    /**
     * Set email address of partner.
     * 
     * @param array $emails
     * @return self
     */
    protected function setEmails(array $emails): self
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * Assign an email address to partner.
     * 
     * @param string $email
     * @return self
     * @throws Exception
     */
    public function assignEmail(string $email): self
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid e-mail address");
        }
        
        $this->emails[] = $email;

        return $this;
    }

    /**
     * Assign email addresses to partner.
     * 
     * @param array $emails
     * @return self
     * @throws Exception
     */
    public function assignEmails(array $emails): self
    {
        foreach ($emails as $email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception("Invalid e-mail address");
            }
        }

        $this->emails= array_merge($this->emails, $emails);

        return $this;
    }

    /**
     * Remove email address of partner if exists.
     * 
     * @param string $email
     * @return self
     */
    public function detachEmail(string $email): self
    {
        foreach ($this->emails as $index => $row) {
            if ($row == $email) {
                unset($this->emails[$index]);
            }
        }

        return $this;
    }

    /**
     * Set tax code of partner.
     * 
     * @param string $taxCode
     * @return self
     */
    public function setTaxcode(string $taxCode): self
    {
        $this->taxcode = $taxCode;

        return $this;
    }

    /**
     * Set iban of partner.
     * 
     * @param string $iban
     * @return self
     */
    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * Set swift of partner.
     * 
     * @param string $swift
     * @return self
     */
    public function setSwift(string $swift): self
    {
        $this->swift = $swift;

        return $this;
    }

    /**
     * Set account number of partner.
     * 
     * @param string $number
     * @return self
     */
    public function setAccountNumber(string $number): self
    {
        $this->account_number = $number;

        return $this;
    }

    /**
     * Set phone of partner.
     * 
     * @param string $phone
     * @return self
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Set general ledger number of partner.
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
     * Set tax type of partner.
     * 
     * @param string $taxType
     * @return self
     * @throws Exception
     */
    public function setTaxType(string $taxType): self
    {
        if ($taxType !== "" && !in_array($taxType, config('billingo.taxTypes'))) {
            throw new \Exception("Invalid tax type");
        }

        $this->tax_type = $taxType;

        return $this;
    }

    /**
     * Set custom billing settings of partner.
     * 
     * @param array $settings
     * @return self
     */
    protected function setCustomBillingSettings(array $settings): self
    {
        $this->custom_billing_settings = $settings;

        return $this;
    }

    /**
     * Set payment method of partner.
     * 
     * @param string $method
     * @return self
     * @throws Exception
     */
    public function setPaymentMethod(string $method): self
    {
        if (!in_array($method, config('billingo.paymentMethods'))) {
            throw new \Exception("Invalid payment method");
        }

        $this->custom_billing_settings['payment_method'] = $method;

        return $this;
    }

    /**
     * Set document form of partner. It can be 'electronic' or 'paper'.
     * 
     * @param string $form
     * @return self
     * @throws Exception
     */
    public function setDocumentForm(string $form): self
    {
        if (!in_array($form, ['electronic', 'paper'])) {
            throw new \Exception("Invalid document form");
        }

        $this->custom_billing_settings['document_form'] = $form;

        return $this;
    }

    /**
     * Set due days of partner.
     * 
     * @param int $days
     * @return self
     */
    public function setDueDays(int $days): self
    {
        $this->custom_billing_settings['due_days'] = $days;

        return $this;
    }

    /**
     * Set document currency of partner.
     * 
     * @param string $currency
     * @return self
     * @throws Exception
     */
    public function setDocumentCurrency(string $currency): self
    {
        if (!in_array($currency, config('billingo.currencies'))) {
            throw new \Exception("Invalid currency");
        }

        $this->custom_billing_settings['document_currency'] = $currency;

        return $this;
    }

    /**
     * Set phone of partner.
     * 
     * @param string $phone
     * @return self
     */
    public function setTemplateLanguageCode(string $code): self
    {
        if (!in_array($code, config('billingo.languages'))) {
            throw new \Exception("Invalid language");
        }

        $this->custom_billing_settings['template_language_code'] = $code;

        return $this;
    }

    /**
     * Set discount of partner. Type can by "percent" only.
     * 
     * @param string $type
     * @param int $value
     * @return self
     * @throws Exception
     */
    public function setDiscount(string $type, int $value): self
    {
        if ($type !== "percent") {
            throw new \Exception("Invalid discount type");
        }

        $this->custom_billing_settings['discount'] = [
            'type' => $type,
            'value' => $value
        ];

        return $this;
    }

    /**
     * Set group member tax number of partner.
     * 
     * @param string $taxNumber
     * @return self
     */
    public function setGroupMemberTaxNumber(string $taxNumber): self 
    {
        $this->group_member_tax_number = $taxNumber;

        return $this;
    }
}