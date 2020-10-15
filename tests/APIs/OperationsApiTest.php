<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Operations;

class OperationsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_operations()
    {
        $operations = factory(Operations::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/operations', $operations
        );

        $this->assertApiResponse($operations);
    }

    /**
     * @test
     */
    public function test_read_operations()
    {
        $operations = factory(Operations::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/operations/'.$operations->id
        );

        $this->assertApiResponse($operations->toArray());
    }

    /**
     * @test
     */
    public function test_update_operations()
    {
        $operations = factory(Operations::class)->create();
        $editedOperations = factory(Operations::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/operations/'.$operations->id,
            $editedOperations
        );

        $this->assertApiResponse($editedOperations);
    }

    /**
     * @test
     */
    public function test_delete_operations()
    {
        $operations = factory(Operations::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/operations/'.$operations->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/operations/'.$operations->id
        );

        $this->response->assertStatus(404);
    }
}
