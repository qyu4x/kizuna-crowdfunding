<?php

namespace Hikaru\MVC\Crowdfunding\Repository;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Entity\Donation;
use Hikaru\MVC\Crowdfunding\Entity\Payment;
use Hikaru\MVC\Crowdfunding\Entity\User;
use PHPUnit\Framework\TestCase;

class PaymentRepositoryImplTest extends TestCase
{
    private PaymentRepository $paymentRepository;
    protected function setUp(): void
    {
        $connection = Database::getConnection('test');
        $this->paymentRepository = new PaymentRepositoryImpl($connection);

    }

    function testSendMoneyById() {
        $payment = new Payment(
            idDonations: 2,
            idUsers: 'rem',
            totalDonations: 2000,
            address: 'Shibuya',
            city: 'Tokyo',
            country: 'Japan',
            zipCode: '150-0001',
        );
        $resultPayment = $this->paymentRepository->sendMoneyById($payment);
        self::assertEquals(2000, $resultPayment->getTotalDonations());
    }

    function testFindDonationById() {
        $resultDonationDetails = $this->paymentRepository->findDonationById(3);
        self::assertEquals(3, $resultDonationDetails->getId());
    }

    function testUpdateMoneyById() {

        $resultDonationDetails = $this->paymentRepository->findDonationById(3);

        $payment = new Payment(
            idDonations: 3,
            idUsers: 'rem',
            totalDonations: 12000,
            address: 'Shibuya',
            city: 'Tokyo',
            country: 'Japan',
            zipCode: '150-0001',
        );

        $resultPayment = $this->paymentRepository->sendMoneyById($payment);

        $resultAfterUpdate = $this->paymentRepository->updateMoneyById($resultDonationDetails, $resultPayment);

        self::assertEquals(12000, $resultAfterUpdate->getMoneyCollected());

    }

}
