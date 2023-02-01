<?php

namespace Hikaru\MVC\Crowdfunding\Service;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Entity\Payment;
use Hikaru\MVC\Crowdfunding\Exception\ValidationException;
use Hikaru\MVC\Crowdfunding\Model\GetPaymentRequest;
use Hikaru\MVC\Crowdfunding\Model\GetPaymentResponse;
use Hikaru\MVC\Crowdfunding\Repository\PaymentRepository;
use Hikaru\MVC\Crowdfunding\Validation\ValidatePaymentRequest;

class PaymentServiceImpl implements PaymentService {

    var PaymentRepository $paymentRepository;
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    function sendMoneyTransferById(GetPaymentRequest $getPaymentRequest): GetPaymentResponse
    {
        ValidatePaymentRequest::validatePaymentRequest($getPaymentRequest);
        try {


            Database::startTransaction();
            // conversion
            $paymentRequest = new Payment(
                idDonations: $getPaymentRequest->paymentRequest->getIdDonations(),
                idUsers: $getPaymentRequest->paymentRequest->getIdUsers(),
                totalDonations: $getPaymentRequest->paymentRequest->getTotalDonations(),
                address: $getPaymentRequest->paymentRequest->getAddress(),
                city: $getPaymentRequest->paymentRequest->getCity(),
                country: $getPaymentRequest->paymentRequest->getCountry(),
                zipCode: $getPaymentRequest->paymentRequest->getZipCode(),
            );

            $sendMoneyById = $this->paymentRepository->sendMoneyById($paymentRequest);
            $findDonationById = $this->paymentRepository->findDonationById($sendMoneyById->getIdDonations());
            $this->paymentRepository->updateMoneyById($findDonationById, $sendMoneyById);

            Database::commitTransaction();

            $cuurentPaymentResponse = new GetPaymentResponse();
            $cuurentPaymentResponse->paymentResponse = $sendMoneyById;
            return $cuurentPaymentResponse;

        }catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw new ValidationException("Error " . $exception->getMessage());
        }

    }
}
