<?php

namespace BugTracker\Data\Repositories;

use BugTracker\Data\Interfaces\IUserRepository;
use BugTracker\Data\Models\User;

class UserRepository implements IUserRepository {
 
    private $db;
    
    public function __construct() {

        $this->db = new Database();

    }

    public function GetAllUsers() : array {
        
    }

    public function GetUserById(int $id) : User {

    }

    public function GetUserByEmail(string $email) : User {

    }
    
}