<?php
use PHPUnit\Framework\TestCase;
use source\backend\models\Socio;

class Socio_Test extends TestCase {
    private Socio $socio;

    protected function setUp(): void {
        $this->socio = new Socio();
    }

    public function test_verify_existente() {
        $input = [
            'ci' => '12345678',
            'email' => 'algo@gmail.com'
        ];
        $result = $this->socio->verify_existente($input);
        $this->assertFalse($result);
    }
}
?>
