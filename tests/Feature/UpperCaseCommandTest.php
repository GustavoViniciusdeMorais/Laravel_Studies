<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\StCommands\UpperCaseCommand;

class UpperCaseCommandTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpperCaseLetter()
    {
        $upperCommand = new UpperCaseCommand();
        $input = 'gustavo';
        $result = $upperCommand->withData($input)->execute();
        $this->assertEquals('GUSTAVO', $result);
    }
}
