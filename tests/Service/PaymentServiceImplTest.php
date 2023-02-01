<?php

namespace Hikaru\MVC\Crowdfunding\Service;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Entity\Payment;
use Hikaru\MVC\Crowdfunding\Model\GetPaymentRequest;
use Hikaru\MVC\Crowdfunding\Repository\PaymentRepository;
use Hikaru\MVC\Crowdfunding\Repository\PaymentRepositoryImpl;
use PHPUnit\Framework\TestCase;

class PaymentServiceImplTest extends TestCase
{
    private PaymentRepository $paymentRepository;
    private PaymentService $paymentService;
    protected function setUp(): void
    {
        $connection = Database::getConnection('test');
        $this->paymentRepository = new PaymentRepositoryImpl($connection);
        $this->paymentService = new PaymentServiceImpl($this->paymentRepository);

    }

    function testSendMoneyTransferById() {
        $somePayment = new Payment(
            idDonations: 2,
            idUsers: 'rem',
            totalDonations: 10000,
            address: 'Shibuya',
            city: 'Tokyo',
            country: 'Japan',
            zipCode: '150-0001',
        );
        $paymentRequestTest = new GetPaymentRequest();
        $paymentRequestTest->paymentRequest = $somePayment;
        $response = $this->paymentService->sendMoneyTransferById($paymentRequestTest);

        self::assertEquals("rem", $response->paymentResponse->getIdUsers());


    }
}
