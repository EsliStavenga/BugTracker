<?php

class DatabaseTest extends PHPUnit_Framework_TestCase {

    public function testSelect() {
        $db = new Database();
        
        $db->Select("user");

        $this->assertSame("SELECT * FROM user ", $db->GetRawQuery());
    }

    public function testAndWhere() {
        $db = new Database();

        $return = $db->Where([
            ["email", "=", "test"]
        ]);

        $this->assertSame($db, $return);
        $this->assertSame("WHERE email = :email ", $db->GetRawQuery());
    }

    public function testAndWhereException() {
        $this->expectException(WrongArgumentException::class);

        $db = new Database();

        $db->Where([]);
    }

}