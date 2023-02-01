<?php

namespace Hikaru\MVC\Crowdfunding\Service;

use Hikaru\MVC\Crowdfunding\Model\GetPaymentRequest;
use Hikaru\MVC\Crowdfunding\Model\GetPaymentResponse;

interface PaymentService {

    function sendMoneyTransferById(GetPaymentRequest $getPaymentRequest):GetPaymentResponse;

}