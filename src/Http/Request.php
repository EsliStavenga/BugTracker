<?php

namespace BugTracker\Http;

class Request
{
    public $url;

    public function __construct(string $url = "") {

        $this->parseVariables($_GET);
        $this->parseVariables($_POST);
        $this->path = $url;
        $this->host = $_SERVER["SERVER_NAME"] . "/"; 
        $this->url = $this->host . $this->path;
    }

    /**
     * Set all values of an array as a field
     *
     * @param array $array An associative array
     * @return void
     */
    private function parseVariables(array $array) : void {
        foreach($array as $key=>$value) {
            $this->{$key} = $value;
        }
    }

}