<?php

//I'm going to say this once and for all, if we put the using ABOVE the namespace, it will look better for sure
//However it will also cause our code to break for some reason
namespace BugTracker\Data\Database;

use BugTracker\Util\BugString;
use BugTracker\Exceptions\WrongArgumentException;
use BugTracker\Exceptions\BadQueryException;

class Database {

    private const DB_NAME = "bugtracker";
    private const HOST = "127.0.0.1";
    private const USERNAME = "root";
    private const PASSWORD = "";
    private static $pdo;
    private $query;
    private $values = [];
    private $whereAdded = false;

    public function __construct() {
        //some sort of DB Singleton
        if(!isset(self::$pdo)) {
            self::$pdo = new \PDO(BugString::Format("mysql:dbname={0};host={1}", self::DB_NAME, self::HOST), self::USERNAME, self::PASSWORD);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    /**
     * Start a new select query
     *
     * @param string $table The table to execute the select on
     * @return Database The instance of the object
     */
    public function Select(string $table) : Database {
        $this->query = "SELECT * FROM $table ";
        $this->whereAdded = false;

        return $this;
    }

    /**
     * Add a where AND clause
     *
     * @param array $statements A multidimensional array [ [ 'column', 'operator', 'value' ], ... ];
     * @throws WrongArgumentException
     * @return Database The instance of the object
     */
    public function Where(array $statements) : Database 
    {
        $this->addWhereToQuery("AND", $statements);
        return $this;
    }

    /**
     * Add a where OR clause
     *
     * @param array $statements A multidimensional array [ [ 'column', 'operator', 'value' ], ... ];
     * @throws WrongArgumentException
     * @return Database The instance of the object
     */
    public function OrWhere(array $statements) : Database 
    {
        $this->addWhereToQuery("OR", $statements);
        return $this;
    }

    /**
     * Get the current SQL query
     *
     * @return string The query
     */
    public function GetRawQuery() : ?string {
        return $this->query;
    }

    /**
     * Add a where clause to a query
     *
     * @param string $operator The operator, presumably AND or OR
     * @param array $statements The where statements. A multidimensional array [ [ 'column', 'operator', 'value' ], ... ];
     * @throws WrongArgumentException
     * @return void
     */
    private function addWhereToQuery(string $operator, array $statements) {
        if(count($statements) == 0) {
            throw new WrongArgumentException("At least one where clause should be specified");
        } else if($this->query == "") {
            throw new BadQueryException("Query should start with a SELECT statement");
        }

        //TODO refactor
        foreach($statements as $statement) {
            if(count($statement) != 3) {
                throw new WrongArgumentException("Subarray should have the format [ 'column', 'operator', 'value' ], but actual length was " . count($statement));
            }

            //? = prepared statements
            $count = 0;
            $key = $statement[0];

            while(array_key_exists($key, $this->values)) {
                $key = $statement[0] . ++$count;
            }

            $this->query .= ($this->whereAdded ? $operator : "WHERE") . " " . BugString::Format("{0} {1} :{2} ", $statement[0], $statement[1], $key);
            $this->values[$key] = $statement[2];

            $this->whereAdded = true;
        }

    }

}
