<?php

namespace Hikaru\MVC\Crowdfunding\Repository;

use Hikaru\MVC\Crowdfunding\Entity\Donation;
use Hikaru\MVC\Crowdfunding\Entity\Payment;
use Hikaru\MVC\Crowdfunding\Entity\User;

interface PaymentRepository {

    function sendMoneyById(Payment $payment):Payment;
    function updateMoneyById(Donation $idDonation, Payment $payment):Donation;
    function findDonationById(int $id):?Donation;

}