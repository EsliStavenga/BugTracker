<?php

namespace BugTracker\Util\test\units;

use atoum;

class BugString extends atoum
{

    public function testFormatOneReplacement()
    {
        $testString0 = "test";

        $this->given($this->newTestedInstance)
            ->if($class = $this->testedClass->getClass())
            ->then
            ->string($class::Format("{0}", $testString0))
            ->isEqualTo($testString0);
    }

    public function testFormatMultipleReplacements() 
    {
        $testString0 = "test";
        $testString1 = "test123";

        $this->given($this->newTestedInstance)
            ->if($class = $this->testedClass->getClass())
            ->then
            ->string($class::Format("{0} {1}", $testString0, $testString1))
            ->isEqualTo($testString0 . " " . $testString1);
    }

    public function testFormatMultipleReplacementsReoccuringValues() 
    {
        $testString0 = "test";
        $testString1 = "test123";

        $this->given($this->newTestedInstance)
            ->if($class = $this->testedClass->getClass())
            ->then
            ->string($class::Format("{0} {1}{0}", $testString0, $testString1))
            ->isEqualTo($testString0 . " " . $testString1 . $testString0);
    }

    public function testFormatReplaceWithObject() 
    {
        $this->given($this->newTestedInstance)
        ->if($class = $this->testedClass->getClass())
        ->then
        ->string($class::Format("{0}", $this->testedClass))
        ->isEqualTo($this->testedClass->getClass());
    }

    public function testFormatWithNamedKey() 
    {
        $key = "test";
        $value = "Hello I am here as well";

        $this->given($this->newTestedInstance)
        ->if($class = $this->testedClass->getClass())
        ->then
        ->string($class::FormatNamedKeys("{".$key."}", $key, $value))
        ->isEqualTo($value);
    }

    public function testFormatWithNamedKeyRepeatingKey() 
    {
        $key = "test";
        $value = "Hello I am here as well";

        $this->given($this->newTestedInstance)
        ->if($class = $this->testedClass->getClass())
        ->then
        ->string($class::FormatNamedKeys("{".$key."}"."{".$key."}", $key, $value))
        ->isEqualTo($value . $value);
    }

    public function testFormatWithNamedKeyFullString() 
    {
        $key = "test";
        $value = "Hello I am here as well";

        $this->given($this->newTestedInstance)
        ->if($class = $this->testedClass->getClass())
        ->then
        ->string($class::FormatNamedKeys("{".$key."} "."$value", $key, $value))
        ->isEqualTo($value . " " . $value);
    }

}