<?php

namespace Hikaru\MVC\Crowdfunding\Repository;

use Hikaru\MVC\Crowdfunding\Entity\Donation;
use Hikaru\MVC\Crowdfunding\Entity\Payment;
use Hikaru\MVC\Crowdfunding\Entity\User;

class PaymentRepositoryImpl implements PaymentRepository {

    var \PDO $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    function sendMoneyById(Payment $payment): Payment
    {
        $sql = 'INSERT INTO payment_details(id_donations, id_users, total_donations, address, city, country, zip_code) VALUES(?, ?, ?, ?, ?, ?, ?)';
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $payment->getIdDonations(),
                $payment->getIdUsers(),
                $payment->getTotalDonations(),
                $payment->getAddress(),
                $payment->getCity(),
                $payment->getCountry(),
                $payment->getZipCode(),
            ]);
        }catch (\PDOException $exception) {
            echo "error " . $exception->getMessage();
        }

        return $payment;
    }


    public function findDonationById(int $id): ?Donation
    {
        $sql = 'SELECT id, title, description, rest_of_the_day, money_needed, money_collected, image_url, organizer FROM Donation WHERE id = ?';
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $id
            ]);

            if ($row = $statement->fetch()) {
                return new Donation(
                    id:$row["id"],
                    title: $row["title"],
                    description: $row["description"],
                    restOfTheDay: $row["rest_of_the_day"],
                    moneyNeeded: $row["money_needed"],
                    moneyCollected: $row["money_collected"],
                    imageUrl: $row["image_url"],
                    organizer: $row["organizer"],
                );
            } else {
                return null;
            }
        }catch (\Exception $exception) {
            echo "Error" . $exception->getMessage();
        } finally {
            $statement->closeCursor();
        }

        return null;
    }

    function updateMoneyById(Donation $donation, Payment $payment): Donation
    {

        $sql = 'UPDATE Donation SET money_collected = ? WHERE id = ?';

        $currentMoneyCollected = $donation->getMoneyCollected();
        $moneyReceived = $payment->getTotalDonations();

        $finalCurrentMoney = $currentMoneyCollected + $moneyReceived;

        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $finalCurrentMoney,
                $donation->getId()
            ]);

        }catch (\PDOException $exception) {
            echo "error" . $exception->getMessage();
        }

        return $donation;
    }
}