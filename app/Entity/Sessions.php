<?php

namespace Hikaru\MVC\Crowdfunding\Entity;

class Sessions {
    private string $id_sessios;
    private string $username_session_id;

    public function __construct(string $id_sessios, string $username_session_id)
    {
        $this->id_sessios = $id_sessios;
        $this->username_session_id = $username_session_id;
    }

    public function getIdSessios(): string
    {
        return $this->id_sessios;

    }


    public function setIdSessios(string $id_sessios): void
    {
        $this->id_sessios = $id_sessios;
    }

    public function getUsernameSessionId(): string
    {
        return $this->username_session_id;

    }


    public function setUsernameSessionId(string $username_session_id): void
    {
        $this->username_session_id = $username_session_id;
    }


}
