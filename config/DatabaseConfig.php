<?php

function getDatabaseConfig() : array {
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3360;dbname=kizuna_crowdfunding_test",
                "username" => "root",
                "password" => "neko"
            ],

            "localhost" => [
                "url" => "mysql:host=localhost:3360;dbname=kizuna_crowdfunding",
                "username" => "root",
                "password" => "neko"
            ],

            "production" => [
                "url" => "mysql:host=sql11.freemysqlhosting.net:3306;dbname=sql11503582",
                "username" => "sql11503582",
                "password" => "nrQWbkAnbh"
            ]


        ]
    ];
}
