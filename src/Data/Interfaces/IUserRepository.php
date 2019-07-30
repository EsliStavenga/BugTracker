<?php

namespace BugTracker\Data\Interfaces;

use BugTracker\Data\Models\User;


interface IUserRepository {

    public function GetAllUsers() : array;
    public function GetUserByID(int $id) : User;
    public function GetUserByEmail(string $email) : User;

}