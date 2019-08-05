<?php

namespace BugTracker\Views\Pages;

use BugTracker\Http\Interfaces\Page;
use BugTracker\Http\BasePage;
use BugTracker\Http\Request;

class PageNotFound extends BasePage implements Page
{
    public $title = "Page Not Found";

    protected $template = "404.php";
    private $replaceValues = [];

    public function GetReplaceValues() : array {
        return $this->replaceValues;
    }

    public function GetTemplate() : string {
        return $this->template;
    }

    public function OnLoad(Request $request) : void {
        $this->request = $request;
    }

    public function OnRequire() : void {
        //could also write:
        //$this->pageVariables["url] = $this->request->url; 
        $this->url = $this->request->url;
    }

}