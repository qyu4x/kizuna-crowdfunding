<?php

namespace Hikaru\MVC\Crowdfunding\Controller;

use Hikaru\MVC\Crowdfunding\Entity\Payment;
use Hikaru\MVC\Crowdfunding\Entity\User;
use Hikaru\MVC\Crowdfunding\Exception\ValidationException;
use Hikaru\MVC\Crowdfunding\Repository\PaymentRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Repository\SessionsRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Repository\UserRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Service;
use Hikaru\MVC\Crowdfunding\App\View;
use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Model\GetPaymentRequest;
use Hikaru\MVC\Crowdfunding\Service\SessionService;
use Hikaru\MVC\Crowdfunding\Service\SessionServiceImpl;
use Hikaru\MVC\Crowdfunding\Service\UserService;
use Hikaru\MVC\Crowdfunding\Service\UserServiceImpl;
use Hikaru\MVC\Crowdfunding\Service\PaymentServiceImpl;
use Hikaru\MVC\Crowdfunding\Service\PaymentService;

class PaymentController {

    // setup
    private PaymentService $paymentService;
    private SessionService $sessionService;

    //private UserService $userService;

    public function __construct()
    {
        $connection = Database::getConnection('production');
        $paymentRepository = new PaymentRepositoryImpl($connection);
        $this->paymentService = new PaymentServiceImpl($paymentRepository);

        // $connection = Database::getConnection('production');
        $userRepository = new UserRepositoryImpl($connection);
        $sesionRepository = new SessionsRepositoryImpl($connection);

        //$this->userService = new UserServiceImpl($userRepository);
        $this->sessionService = new SessionServiceImpl($sesionRepository, $userRepository);
    }

    function requestPayment() {

        $model = [
          'title' => 'something',
        ];
        View::renderPayment('/Payment/payment', $model);
    }

    function postPayment(int $idDonation) {
        $paymentRequestController = new GetPaymentRequest();
        $currentUser = $this->sessionService->current();

        //echo  $idDonation;
        try {

            // bug in validation layer service, soo here i make manual validation...
            $amountMoney = $_POST['amount_money'];
            $address = $_POST['address'];
            $city =  $_POST['city'];
            $country =  $_POST['state'];
            $zipCode = $_POST['zip_code'];
            if ($amountMoney == "" || $amountMoney <= 1000 || $address == "" || $city == "" || $country == "" || $zipCode == "") {
                //echo  $idDonation;
                throw new ValidationException("Opps, all data must be filled in, cannot be empty");

            } else {
                $payment = new Payment(
                    idDonations: $idDonation,
                    idUsers: $currentUser->getIdUsername(),
                    totalDonations: $_POST['amount_money'],
                    address: $_POST['address'],
                    city: $_POST['city'],
                    country: $_POST['state'],
                    zipCode: $_POST['zip_code']
                );

                $paymentRequestController->paymentRequest = $payment;
                $paymentResponseController = $this->paymentService->sendMoneyTransferById($paymentRequestController);
                if ($paymentResponseController != null) {
                    $model = [
                        'time' => date("h:i:sa"),
                        'date' => date("Y-m-d"),
                        'username' => $currentUser->getName(),
                        'amount' => $_POST['amount_money'],
                    ];

                    View::renderStatusPayment('/Status/status-payment',$model);
                }
            }


            // $paymentRequestController->paymentRequest = $payment;
        }catch (ValidationException $exception) {

            $model = [
                'title' => 'Kizuna Payment',
                'error' => $exception->getMessage(),
            ];

            //echo $model['error'];
            View::renderStatusPayment('/Payment/payment',$model);
        }

    }

}
