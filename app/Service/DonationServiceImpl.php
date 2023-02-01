<?php

namespace Hikaru\MVC\Crowdfunding\Service;

use Hikaru\MVC\Crowdfunding\Exception\ValidationException;
use Hikaru\MVC\Crowdfunding\Model\GetDonationRequest;
use Hikaru\MVC\Crowdfunding\Model\GetDonationResponse;
use Hikaru\MVC\Crowdfunding\Repository\DonationRepository;
use http\Exception;

class DonationServiceImpl implements DonationService {

    var DonationRepository $repository;
    public function __construct(DonationRepository $repository)
    {
        $this->repository = $repository;

    }


    function findAll()
    {
        $resultListAllDonation = $this->repository->findAll();
        try {
            if ($resultListAllDonation != null) {
                return $resultListAllDonation;
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            throw new ValidationException("no data can be displayed");
        }
    }

    function findById(GetDonationRequest $getDonationRequest): ?GetDonationResponse
    {
        $resultSpecificDonation = $this->repository->findById($getDonationRequest->getId());

        try {
            $getDonationResponse = new GetDonationResponse();
            if ($resultSpecificDonation != null) {
                // parsing to response
                $getDonationResponse->donation = $resultSpecificDonation;
                return $getDonationResponse;
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            throw new ValidationException("data with id " . $getDonationRequest->getId() ." not found");
        }
    }

    function findHistoryDonationById(string $idUsername)
    {
        $resultAllHistoryTransaction = $this->repository->findHistoryById($idUsername);
        try {
            if ($resultAllHistoryTransaction != null) {
                return $resultAllHistoryTransaction;
            }
        }catch (\Exception $exception) {
            throw new ValidationException("no data can be displayed");
        }
    }
}