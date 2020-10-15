<?php namespace Tests\Repositories;

use App\Models\Operations;
use App\Repositories\OperationsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OperationsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OperationsRepository
     */
    protected $operationsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->operationsRepo = \App::make(OperationsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_operations()
    {
        $operations = factory(Operations::class)->make()->toArray();

        $createdOperations = $this->operationsRepo->create($operations);

        $createdOperations = $createdOperations->toArray();
        $this->assertArrayHasKey('id', $createdOperations);
        $this->assertNotNull($createdOperations['id'], 'Created Operations must have id specified');
        $this->assertNotNull(Operations::find($createdOperations['id']), 'Operations with given id must be in DB');
        $this->assertModelData($operations, $createdOperations);
    }

    /**
     * @test read
     */
    public function test_read_operations()
    {
        $operations = factory(Operations::class)->create();

        $dbOperations = $this->operationsRepo->find($operations->id);

        $dbOperations = $dbOperations->toArray();
        $this->assertModelData($operations->toArray(), $dbOperations);
    }

    /**
     * @test update
     */
    public function test_update_operations()
    {
        $operations = factory(Operations::class)->create();
        $fakeOperations = factory(Operations::class)->make()->toArray();

        $updatedOperations = $this->operationsRepo->update($fakeOperations, $operations->id);

        $this->assertModelData($fakeOperations, $updatedOperations->toArray());
        $dbOperations = $this->operationsRepo->find($operations->id);
        $this->assertModelData($fakeOperations, $dbOperations->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_operations()
    {
        $operations = factory(Operations::class)->create();

        $resp = $this->operationsRepo->delete($operations->id);

        $this->assertTrue($resp);
        $this->assertNull(Operations::find($operations->id), 'Operations should not exist in DB');
    }
}
