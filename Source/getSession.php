<?php
require_once('lib/Common.php');
session_start();

if ( ! is_array($_POST)) {
    return;
}

$serviceList = array('ecpayShippingType', 'checkoutInput');
$checkoutInput = array();
foreach ($_POST as $key => $value) {
    if (in_array($key, $serviceList)) {
        $checkoutInput[$key] = $value;
    }
}

$LogisticsField = 'ECPay_' . key($checkoutInput);
$LogisticsObj = new $LogisticsField;
$LogisticsObj->setInput($checkoutInput);
$LogisticsObj->validate();
$LogisticsObj->store();

class ECPayShippingCheckout
{
    public $ecpayInput = array();
    public $ecpayCheckout = array();

    function setInput($post)
    {
        $this->ecpayInput = $post;
    }

    function store()
    {
        foreach ($this->ecpayCheckout as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

}

class ECPay_ecpayShippingType extends ECPayShippingCheckout
{
    function validate()
    {
        $checkoutInput = $this->ecpayInput['ecpayShippingType'];
        $checkout = array();
        $ecpayShippingType = array(
            'FAMI',
            'FAMI_Collection',
            'UNIMART' ,
            'UNIMART_Collection',
            'HILIFE',
            'HILIFE_Collection'
        );
        if (in_array($checkoutInput, $ecpayShippingType)) {
            $checkout['ecpayShippingType'] = $checkoutInput;
        }

        foreach ($checkout as $key => $value) {
            $checkout[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        $this->ecpayCheckout = $checkout;
    }
}

class ECPay_checkoutInput extends ECPayShippingCheckout
{
    function validate()
    {
        $checkoutInput = $this->ecpayInput['checkoutInput'];
        $checkout = array();
        $validateInput = [
            'billing_first_name',
            'billing_last_name',
            'billing_company',
            'shipping_first_name',
            'shipping_last_name',
            'shipping_company',
            'shipping_to_different_address',
            'order_comments'
        ];
        $validateEmail = ['billing_email'];
        $validatePhone = ['billing_phone'];
        foreach ($checkoutInput as $key => $value) {
            if (in_array($key, $validatePhone)) {
                $result = preg_match('/^09\d{8}$/', $checkoutInput[$key]);
                if ($result === 0) {
                    $checkout[$key] = 'Must be a mobile';
                } else {
                    $checkout[$key] = $checkoutInput[$key];
                }
            } else {
                $checkout[$key] = $checkoutInput[$key];
            }
        }

        foreach ($checkout as $key => $value) {
            $checkout[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        $this->ecpayCheckout = $checkout;
    }
}