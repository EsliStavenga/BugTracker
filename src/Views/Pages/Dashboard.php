<?php

namespace BugTracker\Views\Pages;

use BugTracker\Http\BasePage;
use BugTracker\Http\Interfaces\Page;
use BugTracker\Http\Request;

class Dashboard extends BasePage implements Page {

    public $title = "Home";
    protected $template = "dashboard.php";

    public function GetTemplate() : string {
        return $this->template;
    }

    public function OnLoad(Request $request) : void
    {
        $this->replaceValues["url"] = "test";
    }

    public function OnRequire() : void {
    }

}