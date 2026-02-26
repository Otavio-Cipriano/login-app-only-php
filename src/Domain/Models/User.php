<?php

namespace App\Domain\Models;

class User
{
    public protected(set) ?int $id;
    public protected(set) ?string $name;
    private string $pass;
    public protected(set) string $email;

    /**
     * @param string $name
     * @param string $pass
     * @param string $email
     */
    public function __construct(?int $id, string $email, string $pass, ?string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->pass = $pass;
        $this->email = $email;
    }

    public function verifyPassword(string $plain): bool
    {
        return strcmp($plain, $this->pass);
    }

}