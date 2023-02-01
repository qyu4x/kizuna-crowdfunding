<?php

namespace Hikaru\MVC\Crowdfunding\Controller;

use Hikaru\MVC\Crowdfunding\App\View;
use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Exception\ValidationException;
use Hikaru\MVC\Crowdfunding\Repository\DonationRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Repository\SessionsRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Repository\UserRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Service\DonationService;
use Hikaru\MVC\Crowdfunding\Service\DonationServiceImpl;
use Hikaru\MVC\Crowdfunding\Service\SessionService;
use Hikaru\MVC\Crowdfunding\Service\SessionServiceImpl;

class HomeController {

    private SessionService $sessionService;
    private DonationService $donationService;

    public function __construct()
    {
        $connection = Database::getConnection('production');
        $sessionRepository = new SessionsRepositoryImpl($connection);
        $userRepository = new UserRepositoryImpl($connection);

        $donationRepository = new DonationRepositoryImpl($connection);
        $this->donationService = new DonationServiceImpl($donationRepository);

        $this->sessionService = new SessionServiceImpl($sessionRepository, $userRepository);
    }

    public function index() : void {

        $currentUser = $this->sessionService->current();
        $allDonationList = $this->donationService->findAll();

        if ($currentUser != null ) {
            $findAllAllHistory = $this->donationService->findHistoryDonationById($currentUser->getIdUsername());
            $model = [
                'title' => 'Kizuna Home',
                'user' => [
                    'username' => $currentUser->getName(),
                    'idUsername' => $currentUser->getIdUsername(),
                ],
                'donation' => $allDonationList,
                'history' => $findAllAllHistory,
            ];


            View::renderLoginManagement('/MainView/main-dasboard', $model);
        } else {
            $model = [
                'title' => 'Kizuna Home',
            ];

            View::renderHome('/Home/index', $model);
        }

    }

    public function guest() {
        $allDonationList = $this->donationService->findAll();

        $currentUser = $this->sessionService->current();
        $allDonationList = $this->donationService->findAll();

        if ($currentUser == null ) {
            $findAllAllHistory = null;
            $model = [
                'title' => 'Kizuna Home',
                'user' => [
                    'username' => null,
                    'idUsername' => null,
                ],
                'donation' => $allDonationList,
                'history' => $findAllAllHistory,
            ];


            View::renderLoginManagement('/MainView/main-dasboard', $model);
        }
    }

    public function aboutKizuna() {
        $model = [

        ];
        View::renderLoginManagement('/About/about', $model);

    }

}
