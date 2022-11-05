<?php

namespace RichardEszes\Billingo\Models;

use RichardEszes\Billingo\Constants\Country;
use RichardEszes\Billingo\Constants\Currency;
use RichardEszes\Billingo\Constants\Language;
use RichardEszes\Billingo\Constants\PaymentMethod;
use RichardEszes\Billingo\Constants\TaxType;

class Partner implements ModelInterface
{
    protected $id;

    protected $name;

    protected $address;

    protected $emails;

    protected $taxcode;

    protected $iban;

    protected $swift;

    protected $account_number;

    protected $phone;

    protected $general_ledger_number;

    protected $tax_type;

    protected $custom_billing_settings;

    protected $group_member_tax_number;

    public function __get($name): mixed
    {
        return $this->$name;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setAddress(string $countryCode, string $postCode, string $city, string $address): self
    {
        if (!in_array($countryCode, Country::VALUES)) {
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

    public function assignEmail(string $email): self
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid e-mail address");
        }
        
        $this->emails[] = $email;

        return $this;
    }

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

    public function detachEmail(string $email): self
    {
        foreach ($this->emails as $index => $row) {
            if ($row == $email) {
                unset($this->emails[$index]);
            }
        }

        return $this;
    }

    public function setTaxCode(string $taxCode): self
    {
        $this->taxcode = $taxCode;

        return $this;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function setSwift(string $swift): self
    {
        $this->swift = $swift;

        return $this;
    }

    public function setAccountNumber(string $number): self
    {
        $this->account_number = $number;

        return $this;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function setGeneralLedgerNumber(string $number): self
    {
        $this->general_ledger_number = $number;

        return $this;
    }

    public function setTaxType(string $taxType): self
    {
        if (!in_array($taxType, TaxType::VALUES)) {
            throw new \Exception("Invalid tax type");
        }

        $this->tax_type = $taxType;

        return $this;
    }

    public function setPaymentMethod(string $method): self
    {
        if (!in_array($method, PaymentMethod::VALUES)) {
            throw new \Exception("Invalid payment method");
        }

        $this->custom_billing_settings['payment_method'] = $method;

        return $this;
    }

    public function setDocumentForm(string $form): self
    {
        if (!in_array($form, ['electronic', 'paper'])) {
            throw new \Exception("Invalid document form");
        }

        $this->custom_billing_settings['document_form'] = $form;

        return $this;
    }

    public function setDueDays(int $days): self
    {
        $this->custom_billing_settings['due_days'] = $days;

        return $this;
    }

    public function setDocumentCurrency(string $currency): self
    {
        if (!in_array($currency, Currency::VALUES)) {
            throw new \Exception("Invalid currency");
        }

        $this->custom_billing_settings['document_currency'] = $currency;

        return $this;
    }

    public function setTemplateLanguageCode(string $code): self
    {
        if (!in_array($code, Language::VALUES)) {
            throw new \Exception("Invalid language");
        }

        $this->custom_billing_settings['template_language_code'] = $code;

        return $this;
    }

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

    public function setGroupMemberTaxNumber(string $taxNumber): self 
    {
        $this->group_member_tax_number = $taxNumber;

        return $this;
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->name) {
            $result['name'] = $this->name;
        }
        if ($this->address) {
            $result['address'] = $this->address;
        }
        if ($this->emails) {
            $result['emails'] = $this->emails;
        }
        if ($this->taxcode) {
            $result['taxcode'] = $this->taxcode;
        }
        if ($this->iban) {
            $result['iban'] = $this->iban;
        }
        if ($this->swift) {
            $result['swift'] = $this->swift;
        }
        if ($this->account_number) {
            $result['account_number'] = $this->account_number;
        }
        if ($this->phone) {
            $result['phone'] = $this->phone;
        }
        if ($this->general_ledger_number) {
            $result['general_ledger_number'] = $this->general_ledger_number;
        }
        if ($this->tax_type) {
            $result['tax_type'] = $this->tax_type;
        }
        if ($this->custom_billing_settings) {
            $result['custom_billing_settings'] = $this->custom_billing_settings;
        }
        if ($this->group_member_tax_number) {
            $result['group_member_tax_number'] = $this->group_member_tax_number;
        }
    
        return $result;
    }

    public function loadFromResponse($response): self
    {
        if ($response->id) {
            $this->setId($response->id);
        }
        if ($response->name) {
            $this->setName($response->name);
        }
        if ($response->country_code) {
            $this->setAddress(
                $response->address->country_code, 
                $response->address->post_coded, 
                $response->address->city, 
                $response->address->address
            );
        }
        if ($response->emails) {
            $this->assignEmails($response->emails);
        }
        if ($response->taxcode) {
            $this->setTaxCode($response->taxcode);
        }
        if ($response->iban) {
            $this->setIban($response->iban);
        }
        if ($response->swift) {
            $this->setSwift($response->swift);
        }
        if ($response->account_number) {
            $this->setAccountNumber($response->account_number);
        }
        if ($response->phone) {
            $this->setPhone($response->phone);
        }
        if ($response->general_ledger_number) {
            $this->setGeneralLedgerNumber($response->general_ledger_number);
        }
        if ($response->tax_type) {
            $this->setTaxType($response->tax_type);
        }
        if ($response->custom_billing_settings->payment_method) {
            $this->setPaymentMethod($response->custom_billing_settings->payment_method);
        }
        if ($response->custom_billing_settings->document_form) {
            $this->setDocumentForm($response->custom_billing_settings->document_form);
        }
        if ($response->custom_billing_settings->due_days) {
            $this->setDueDays($response->custom_billing_settings->due_days);
        }
        if ($response->custom_billing_settings->document_currency) {
            $this->setDocumentCurrency($response->custom_billing_settings->document_currency);
        }
        if ($response->custom_billing_settings->template_language_code) {
            $this->setTemplateLanguageCode($response->custom_billing_settings->template_language_code);
        }
        if ($response->custom_billing_settings->discount->type) {
            $this->setDiscount(
                $response->custom_billing_settings->discount->type, 
                $response->custom_billing_settings->discount->value
            );
        }
        if ($response->group_member_tax_number) {
            $this->setGroupMemberTaxNumber($response->group_member_tax_number);
        }

        return $this;
    }
}