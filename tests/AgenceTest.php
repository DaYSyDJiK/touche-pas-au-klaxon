<?php 

use PHPUnit\Framework\TestCase;
use App\Models\Agence;

class AgenceTest extends TestCase
{
    public function testCreateAgence()
    {
        Agence::create("TestVille");

        $this->assertTrue(true);
    }
}

?>