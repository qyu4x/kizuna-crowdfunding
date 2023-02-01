<?php

namespace Hikaru\MVC\Crowdfunding\App;

class View {
    public static function renderHome(string $pathFileView, $model) {

        require __DIR__ . '/../View' . $pathFileView . '.php';

    }

    public static function renderDonationDetails(string $pathFileView, $model) {

        require __DIR__ . '/../View' . $pathFileView . '.php';

    }

    public static function renderLoginManagement(string $pathFileView, $model) {
        require __DIR__ . '/../View/ViewSection/header.php';
        require __DIR__ . '/../View' . $pathFileView . '.php';
        require __DIR__ . '/../View/ViewSection/footer.php';
    }

    public static function redirectUrl(string $url) : void {
        header("Location: $url");
        exit();
    }

    public static function renderDasboard(string $pahFileView, $model) {
        require __DIR__ . '/../View' . $pahFileView . '.php';
    }

    public static function renderPayment(string $pahFileView, $model) {
        require __DIR__ . '/../View' . $pahFileView . '.php';
    }
    public static function renderStatusPayment(string $pahFileView, $model) {
        require __DIR__ . '/../View' . $pahFileView . '.php';
    }

}