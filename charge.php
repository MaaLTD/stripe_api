<?php
require_once __DIR__ . '/devel.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/lib/Database.php';
require_once __DIR__ . '/models/Customer.php';
require_once __DIR__ . '/models/Transaction.php';

//use Model\Customer;
//use Model\Transaction;

\Stripe\Stripe::setApiKey('sk_test_lY82vttSpTrsINOp620fymYj00D9nQiHGv');

// Sanitize POST Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

// get form values
$first_name = $POST['first_name'];
$last_name  = $POST['last_name'];
$email      = $POST['email'];
$token      = $POST['stripeToken'];

// Create customer in Stripe
$customer = \Stripe\Customer::create([
    'email'     => $email,
    'source'    => $token
]);

// Charge customer
$charge = \Stripe\Charge::create([
    'amount'        => 5000,
    'currency'      => 'usd',
    'description'   => 'Intro to Stripe API course',
    'customer'      => $customer->id
]);

// Instantiate customer
$data = [
    'id' => $charge->customer,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email
];
$customer = new Customer();
$customer->addCustomer($data);

// Instantiate transaction
$data = [
    'tid'         => $charge->id,
    'customer_id' => $charge->customer,
    'product'     => $charge->description,
    'amount'      => $charge->amount,
    'currency'    => $charge->currency,
    'status'      => $charge->status
];
$transaction = new Transaction();
$transaction->addTransaction($data);

// Redirect to success
$success = 'success.php?tid='.$charge->id.'&product='.$charge->description;
header('Location: ' . $success);