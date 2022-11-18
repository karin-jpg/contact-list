<?php

namespace tests\Controller;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;


class UsuariosControllerTests extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
    }

    protected function tearDown(): void
    {
        DB::rollback();
        parent::tearDown();
    }
    }
}
