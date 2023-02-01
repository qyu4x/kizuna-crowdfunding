<?php

namespace Hikaru\MVC\Crowdfunding\Validation;

use Hikaru\MVC\Crowdfunding\Entity\Payment;
use Hikaru\MVC\Crowdfunding\Exception\ValidationException;
use Hikaru\MVC\Crowdfunding\Model\GetPaymentRequest;

class ValidatePaymentRequest {
    public static function validatePaymentRequest(GetPaymentRequest $paymentRequest) {
        $totalDonation = $paymentRequest->paymentRequest->getTotalDonations();
        $address = $paymentRequest->paymentRequest->getAddress();
        $city = $paymentRequest->paymentRequest->getCity();
        $country = $paymentRequest->paymentRequest->getCountry();
        $zipCode = $paymentRequest->paymentRequest->getZipCode();

        if ($totalDonation < 1000 || $totalDonation == 0|| $totalDonation == "") {
            throw new ValidationException("Opps sorry, the amount of money can't be less than Rp. 1000");
        }
        if ($totalDonation == null || $address == null || $city == null || $country == null || $zipCode == null
        || $totalDonation == "" || $address == "" || $city == "" || $country == "" || $zipCode == "") {
            throw new ValidationException("Opps, all data must be filled in, cannot be empty");
        }
    }


}
