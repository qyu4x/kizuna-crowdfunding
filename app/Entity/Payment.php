<?php

namespace Hikaru\MVC\Crowdfunding\Entity;

class Payment {

    public function __construct(int $idDonations, string $idUsers, int $totalDonations,
                                string $address, string $city, string $country, string $zipCode)
    {
        $this->idDonations = $idDonations;
        $this->idUsers = $idUsers;
        $this->totalDonations = $totalDonations;
        $this->address = $address;
        $this->city = $city;
        $this->country = $country;
        $this->zipCode = $zipCode;
    }

    private int $idDonations;
    private string $idUsers;
    private int $totalDonations;
    private string $address;
    private string $city;
    private string $country;
    private string $zipCode;
    private string $donationAt;


    public function getIdDonations(): int
    {
        return $this->idDonations;
    }

    public function setIdDonations(int $idDonations): void
    {
        $this->idDonations = $idDonations;
    }


    public function getIdUsers(): string
    {
        return $this->idUsers;
    }

    public function setIdUsers(string $idUsers): void
    {
        $this->idUsers = $idUsers;
    }

    public function getTotalDonations(): int
    {
        return $this->totalDonations;
    }

    public function setTotalDonations(int $totalDonations): void
    {
        $this->totalDonations = $totalDonations;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }


    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    public function getDonationAt(): string
    {
        return $this->donationAt;
    }

    public function setDonationAt(string $donationAt): void
    {
        $this->donationAt = $donationAt;
    }


}