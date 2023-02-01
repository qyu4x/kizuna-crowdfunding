<?php

namespace  Hikaru\MVC\Crowdfunding\Repository;

use Hikaru\MVC\Crowdfunding\Entity\Donation;
use phpDocumentor\Reflection\PseudoTypes\NegativeInteger;
use function PHPUnit\Framework\containsEqual;

class DonationRepositoryImpl implements DonationRepository {
    var \PDO $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    function findAll() {
        $sql = 'SELECT id, title, description, rest_of_the_day, money_needed, money_collected, image_url, organizer FROM Donation';
        try {
            $statement = $this->connection->query($sql);
            $result = $statement->fetchAll();

            return $result;

        }catch (\Exception $exception) {
            echo "Error" . $exception->getMessage();
        } finally {
            $statement->closeCursor();
        }

        return null;
    }

    public function findById(int $id): ?Donation
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

    function findHistoryById(string $idUser)
    {
        try {
            if ($idUser != null) {
                $sql = 'SELECT title, organizer, image_url, total_donations, created_at FROM payment_details
                JOIN Donation on payment_details.id_donations = Donation.id WHERE id_users = ?';

                $statement = $this->connection->prepare($sql);
                $statement->execute([
                    $idUser
                ]);

                $result = $statement->fetchAll();
                return $result;
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
}
