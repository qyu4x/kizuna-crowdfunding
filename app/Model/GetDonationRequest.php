<?php

namespace Hikaru\MVC\Crowdfunding\Model;

class GetDonationRequest {
    private int $id;


   public function __construct($id)
   {
       $this->id = $id;
   }

    public function getId(): int
    {
        return $this->id;
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }
}


