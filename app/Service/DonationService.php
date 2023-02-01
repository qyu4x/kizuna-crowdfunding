<?php

namespace Hikaru\MVC\Crowdfunding\Service;

use Hikaru\MVC\Crowdfunding\Model\GetDonationRequest;
use Hikaru\MVC\Crowdfunding\Model\GetDonationResponse;

interface DonationService {

    function findAll();
    function findById(GetDonationRequest $getDonationRequest) : ?GetDonationResponse;
    function findHistoryDonationById(string $idUsername);

}
