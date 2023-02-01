<?php


namespace Hikaru\MVC\Crowdfunding\Controller;


use Hikaru\MVC\Crowdfunding\App\View;
use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Exception\ValidationException;
use Hikaru\MVC\Crowdfunding\Model\GetDonationRequest;
use Hikaru\MVC\Crowdfunding\Model\GetDonationResponse;
use Hikaru\MVC\Crowdfunding\Repository\DonationRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Repository\SessionsRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Repository\UserRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Service\DonationService;
use Hikaru\MVC\Crowdfunding\Service\DonationServiceImpl;
use Hikaru\MVC\Crowdfunding\Service\SessionService;
use Hikaru\MVC\Crowdfunding\Service\SessionServiceImpl;
use Hikaru\MVC\Crowdfunding\Service\UserServiceImpl;
use http\Env\Response;

class DonationController {
    // set up
    private DonationService $donationService;
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection('production');
        $donationRepository = new DonationRepositoryImpl($connection);
        $this->donationService = new DonationServiceImpl($donationRepository);

        // user
        $userRepository = new UserRepositoryImpl($connection);
        $sesiionRepository = new SessionsRepositoryImpl($connection);
        $this->userService = new UserServiceImpl($userRepository);
        $this->sessionService = new SessionServiceImpl($sesiionRepository, $userRepository);
    }

    public function detailsDonation(int $donationId) : void
    {
        $request = new GetDonationRequest(id:
            $donationId
        );
        try {
            $resultSpesificDonation = $this->donationService->findById($request);
            $dataCurrentUser = $this->sessionService->current();

            if ($resultSpesificDonation != null && $dataCurrentUser != null) {
                $model = [
                    'title' => 'Details ' . $resultSpesificDonation->donation->getTitle(),
                    'result' => [
                        'id' => $resultSpesificDonation->donation->getId() ,
                        'title' => $resultSpesificDonation->donation->getTitle(),
                        'description' => $resultSpesificDonation->donation->getDescription(),
                        'imageUrl' => $resultSpesificDonation->donation->getImageUrl(),
                        'moneyNeeded' => $resultSpesificDonation->donation->getMoneyNeeded(),
                        'moneyCollected' => $resultSpesificDonation->donation->getMoneyCollected(),
                        'restOfTheDay' => $resultSpesificDonation->donation->getRestOfTheDay(),
                        'organizer' => $resultSpesificDonation->donation->getOrganizer(),
                    ],
                    'user' => [
                        'name'  => $dataCurrentUser->getName(),
                    ]
                ];

                View::renderDonationDetails('/Donations/donation-details', $model);
            } else {
                $model = [
                    'title' => 'Details ' . $resultSpesificDonation->donation->getTitle(),
                    'result' => [
                        'id' => $resultSpesificDonation->donation->getId() ,
                        'title' => $resultSpesificDonation->donation->getTitle(),
                        'description' => $resultSpesificDonation->donation->getDescription(),
                        'imageUrl' => $resultSpesificDonation->donation->getImageUrl(),
                        'moneyNeeded' => $resultSpesificDonation->donation->getMoneyNeeded(),
                        'moneyCollected' => $resultSpesificDonation->donation->getMoneyCollected(),
                        'restOfTheDay' => $resultSpesificDonation->donation->getRestOfTheDay(),
                        'organizer' => $resultSpesificDonation->donation->getOrganizer(),
                    ],
                    'user' => [
                        'name'  => null,
                    ]
                ];

                View::renderDonationDetails('/Donations/donation-details', $model);
            }
        }catch (ValidationException $exception) {
            $model = [
                'title' => 'Details ' . $resultSpesificDonation->donation->getTitle(),
                'error' => 'Upps' . $exception->getMessage(),
            ];

            View::renderDonationDetails('/Donations/donation-details', $model);
        }
    }


}