<?php

    session_start();

    $ecpayShippingType = [
        'FAMI',
        'FAMI_Collection',
        'UNIMART' ,
        'UNIMART_Collection',
        'HILIFE',
        'HILIFE_Collection',
    ];

    $billing = [];
    $billing['first_name'] = filter_var($_POST['billingData']['first_name'], FILTER_SANITIZE_STRING);
    $billing['last_name'] = filter_var($_POST['billingData']['last_name'], FILTER_SANITIZE_STRING);
    $billing['company'] = filter_var($_POST['billingData']['company'], FILTER_SANITIZE_STRING);
    $billing['phone'] = preg_match('/^09\d{8}$/', $_POST['billingData']['phone']) ? $_POST['billingData']['phone'] : '';
    $billing['email'] = filter_var($_POST['billingData']['email'], FILTER_VALIDATE_EMAIL) ? $_POST['billingData']['email'] : '';

    if (!empty($_POST['ecpayShippingType']) && in_array($_POST['ecpayShippingType'], $ecpayShippingType)) {
        $_SESSION['ecpayShippingType'] = htmlspecialchars($_POST['ecpayShippingType'], ENT_QUOTES, 'UTF-8');
        foreach ($billing as $key => $value) {
            $_SESSION['billing_' . $key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    }