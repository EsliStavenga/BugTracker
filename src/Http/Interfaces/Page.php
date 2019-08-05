<?php

namespace BugTracker\Http\Interfaces;

use BugTracker\Http\Request;

interface Page {
    
    public function GetTemplate() : string;
    public function OnLoad(Request $request) : void;
    public function OnRequire() : void;
}