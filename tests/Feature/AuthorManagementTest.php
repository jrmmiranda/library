<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Tests\TestCase;

use App\Models\Author;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function an_author_can_be_created()
    {
        $this->post('/author/store', [
            'name' => 'Author Name',
            'dob' => '05/14/1988',
        ]);

        $author = Author::all();

        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1988/14/05', $author->first()->dob->format('Y/d/m'));
    }
}
