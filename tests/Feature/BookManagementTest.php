<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Author;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $response = $this->post('/store', [
            'title' => 'Cool Book Title',
            'author' => 'Author'
        ]);

        $book = Book::first();

        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/store', [
            'title' => '',
            'author' => 'Author'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function an_author_is_required()
    {
        $response = $this->post('/store', [
            'title' => 'Cool Book Title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->post('/store', [
            'title' => 'Cool Book Title',
            'author' => 'Author'
        ]);

        $book = Book::first();

        $response = $this->patch($book->updatePath(), [
            'title' => 'New Title',
            'author' => 'New Author'
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals(4, Book::first()->author_id);
        $response->assertRedirect($book->fresh()->path());
    }

    /** @test */
    public function a_book_can_be_deleted()
    {
        $this->post('/store', [
            'title' => 'Cool Book Title',
            'author' => 'Author'
        ]);

        $book = Book::first();
        $this->assertCount(1, Book::all());

        $response = $this->delete($book->destroyPath());

        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');
    }

    /** @test */
    public function a_new_author_is_automatically_added()
    {
        $this->withoutExceptionHandling();

        $this->post('/store', [
            'title' => 'Cool Book Title',
            'author' => 'Author'
        ]);

        $book = Book::first();
        $author = Author::first();

        $this->assertEquals($author->id, $book->author_id);
        $this->assertCount(1, Author::all());
    }
}
