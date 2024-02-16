<?php

namespace GustavoMorais\Tests;

// use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestCase;

class MainTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // DB::beginTransaction();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        // DB::rollBack();
    }
}
