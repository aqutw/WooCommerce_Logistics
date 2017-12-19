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

    $checkout = [];
    $checkout['billing_first_name'] = filter_var($_POST['checkoutData']['billing_first_name'], FILTER_SANITIZE_STRING);
    $checkout['billing_last_name'] = filter_var($_POST['checkoutData']['billing_last_name'], FILTER_SANITIZE_STRING);
    $checkout['billing_company'] = filter_var($_POST['checkoutData']['billing_company'], FILTER_SANITIZE_STRING);
    $checkout['billing_phone'] = preg_match('/^09\d{8}$/', $_POST['checkoutData']['billing_phone']) ? $_POST['checkoutData']['billing_phone'] : '';
    $checkout['billing_email'] = filter_var($_POST['checkoutData']['billing_email'], FILTER_VALIDATE_EMAIL) ? $_POST['checkoutData']['billing_email'] : '';
    $checkout['shipping_first_name'] = filter_var($_POST['checkoutData']['shipping_first_name'], FILTER_SANITIZE_STRING);
    $checkout['shipping_last_name'] = filter_var($_POST['checkoutData']['shipping_last_name'], FILTER_SANITIZE_STRING);
    $checkout['shipping_company'] = filter_var($_POST['checkoutData']['shipping_company'], FILTER_SANITIZE_STRING);

    if (!empty($_POST['ecpayShippingType']) && in_array($_POST['ecpayShippingType'], $ecpayShippingType)) {
        $_SESSION['ecpayShippingType'] = htmlspecialchars($_POST['ecpayShippingType'], ENT_QUOTES, 'UTF-8');
        foreach ($checkout as $key => $value) {
            $_SESSION[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    }