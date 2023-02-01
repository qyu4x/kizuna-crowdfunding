<?php

namespace  Hikaru\MVC\Crowdfunding\Repository;

use Hikaru\MVC\Crowdfunding\Entity\Donation;

interface DonationRepository {
    function findAll();
    function findById(int $id) : ?Donation;
    // nex service for send money
    function findHistoryById(string $idUser);
}

