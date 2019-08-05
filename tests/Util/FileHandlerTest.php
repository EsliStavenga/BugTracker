<?php

namespace BugTracker\Util\test\units;

use atoum;

define("APP_ROOT", "");

class FileHandler extends atoum
{

    public function testLoadFileValidPath() 
    {
        $this->given($this->newTestedInstance)
            ->if($class = $this->testedClass->getClass())
            ->then
            ->string($class::LoadFile("tests/files/test.txt"))
            ->isEqualTo("test");
    }

    public function testLoadFileInvalidPath() 
    {
        $this->given($this->newTestedInstance)
            ->if($class = $this->testedClass->getClass())
            ->then
            ->string($class::LoadFile(""))
            ->isEqualTo("");
    }

}