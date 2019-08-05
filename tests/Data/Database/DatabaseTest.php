<?php


# src/Vendor/Project/tests/units/HelloWorld.php

// The test class has is own namespace :
// The namespace of the tested class + "test\units"
namespace BugTracker\Data\Database\test\units;

// You must include the tested class (if you don't have an autoloader)

use atoum;
use BugTracker\Exceptions\WrongArgumentException;
use BugTracker\Exceptions\BadQueryException;

/*
 * Test class for Vendor\Project\HelloWorld
 *
 * Note that they had the same name that the tested class
 * and that it derives frim the atoum class
 */
class Database extends atoum
{
    /*
     * This method is dedicated to testing an empty query will return null
     */
    public function testEmptyQuery ()
    {
        $this->given($this->newTestedInstance)
            ->then
            ->variable($this->testedInstance->GetRawQuery())
            ->isNull();
        ;
    }

    public function testSelectQuery() 
    {
        $this->given($this->newTestedInstance)
            ->and($this->testedInstance->Select("user"))
            ->then->variable($this->testedInstance->GetRawQuery())
            ->isEqualTo("SELECT * FROM user ");
    }

    public function testWhereQuery() 
    {
        $this->given($this->newTestedInstance)
            ->and($this->testedInstance->Select("user"))
            ->and($this->testedInstance->Where([
                ["email", "=", "123"]
            ]))
            ->then->variable($this->testedInstance->GetRawQuery())
            ->isEqualTo("SELECT * FROM user WHERE email = :email ");
    }

    public function testWhereAndQuery() 
    {
        $this->given($this->newTestedInstance)
            ->and($this->testedInstance->Select("user"))
            ->and($this->testedInstance->Where([
                ["email", "=", "123"],
                ["id", ">", 1]
            ]))
            ->then->variable($this->testedInstance->GetRawQuery())
            ->isEqualTo("SELECT * FROM user WHERE email = :email AND id > :id ");
    }

    public function testMultipleWhereAndQuery() 
    {
        $this->given($this->newTestedInstance)
            ->and($this->testedInstance->Select("user"))
            ->and($this->testedInstance->Where([
                ["email", "=", "123"],
                ["id", ">", 1],
                ["id", "<", 3]
            ]))
            ->then->variable($this->testedInstance->GetRawQuery())
            ->isEqualTo("SELECT * FROM user WHERE email = :email AND id > :id AND id < :id1 ");
    }

    public function testMultipleWhereOrQuery() 
    {
        $this->given($this->newTestedInstance)
        ->and($this->testedInstance->Select("user"))
        ->and($this->testedInstance->OrWhere([
            ["email", "=", "123"],
            ["id", ">", 1],
            ["id", "<", 3]
        ]))
        ->then->variable($this->testedInstance->GetRawQuery())
        ->isEqualTo("SELECT * FROM user WHERE email = :email OR id > :id OR id < :id1 ");
    }

    public function testWhereOrAndQuery() 
    {
        $this->given($this->newTestedInstance)
        ->and($this->testedInstance->Select("user"))
        ->and($this->testedInstance->OrWhere([
            ["email", "=", "123"],
            ["id", ">", 1]
        ]))
        ->and($this->testedInstance->Where([
            ["id", "<", 3]
        ]))
        ->then->variable($this->testedInstance->GetRawQuery())
        ->isEqualTo("SELECT * FROM user WHERE email = :email OR id > :id AND id < :id1 ");
    }

    public function testExceptionBadWhere() 
    {
        $base = $this->given($this->newTestedInstance)
            ->and($this->testedInstance->Select("user"));
        
        //we can't just do $this->AssertEqual(true, true);
        try {
            $base->and($this->testedInstance->OrWhere([]));
        } catch(WrongArgumentException $e) {
           $base->variable($this->testedInstance->GetRawQuery())
                ->isEqualTo("SELECT * FROM user ");
        } catch(\Exception $e) {
            $base->variable($this->testedInstance->GetRawQuery())
            ->isEqualTo(null);
        }

    }

    public function testExceptionWhereBeforeSelect() 
    {
        $base = $this->given($this->newTestedInstance);
        
        //we can't just do $this->AssertEqual(true, true);
        try {
            $base->and($this->testedInstance->OrWhere([
                ["email", "=", "test"]
            ]));
        } catch(BadQueryException $e) {
           $base->variable($this->testedInstance->GetRawQuery())
                ->isEqualTo(null);
        } catch(\Exception $e) {
            $base->variable($this->testedInstance->GetRawQuery())
            ->isEqualTo(" * ");
        }
    }

    public function testExceptionWhereBadSubArrayFormat() 
    {
        $base = $this->given($this->newTestedInstance)
            ->and($this->testedInstance->Select("user"));
        
        //we can't just do $this->AssertEqual(true, true);
        try {
            $base->and($this->testedInstance->Where([
                ["email", "="]
            ]));
        } catch(WrongArgumentException $e) {
           $base->variable($this->testedInstance->GetRawQuery())
                ->isEqualTo("SELECT * FROM user ");
        } catch(\Exception $e) {
            $base->variable($this->testedInstance->GetRawQuery())
            ->isEqualTo(null);
        }
    }

    public function testReturnTypes() {
        $this->given($this->newTestedInstance)
            ->then
            ->object($this->testedInstance->Select("user"))->isTestedInstance()
            ->object($this->testedInstance->Where([
                ["email", "=", "test"]
            ]))->isTestedInstance()
            ->object($this->testedInstance->OrWhere([
                ["email", "=", "test"]
            ]))->isTestedInstance();
    }
}