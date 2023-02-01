<?php

namespace Hikaru\MVC\Crowdfunding\Entity;

class Donation {
    public function __construct(int $id, ?string $title, ?string $description, ?int $restOfTheDay,
                                ?int $moneyNeeded, ?int $moneyCollected, ?string $imageUrl, ?string $organizer)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->restOfTheDay = $restOfTheDay;
        $this->moneyNeeded = $moneyNeeded;
        $this->moneyCollected = $moneyCollected;
        $this->organizer = $organizer;
        $this->imageUrl = $imageUrl;

    }

    private string $id;
    private string $title;
    private string $description;
    private int $restOfTheDay;
    private int $moneyNeeded;
    private int $moneyCollected;
    private string $imageUrl;
    private string $organizer;



    public function getId(): int|string
    {
        return $this->id;
    }


    public function setId(int|string $id): void
    {
        $this->id = $id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    public function getDescription(): string
    {
        return $this->description;
    }


    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


    public function getRestOfTheDay(): int
    {
        return $this->restOfTheDay;
    }


    public function setRestOfTheDay(int $restOfTheDay): void
    {
        $this->restOfTheDay = $restOfTheDay;
    }


    public function getMoneyNeeded(): int
    {
        return $this->moneyNeeded;
    }


    public function setMoneyNeeded(int $moneyNeeded): void
    {
        $this->moneyNeeded = $moneyNeeded;
    }


    public function getMoneyCollected(): int
    {
        return $this->moneyCollected;
    }


    public function setMoneyCollected(int $moneyCollected): void
    {
        $this->moneyCollected = $moneyCollected;
    }


    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }


    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }


    public function getOrganizer(): string
    {
        return $this->organizer;
    }

    public function setOrganizer(string $organizer): void
    {
        $this->organizer = $organizer;
    }
}