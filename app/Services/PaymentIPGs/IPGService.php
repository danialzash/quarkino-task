<?php

namespace App\Services\PaymentIPGs;

use Illuminate\Http\Request;

interface IPGService
{
    public function initialPayment();

    public function handleCallback(Request $request);

}
