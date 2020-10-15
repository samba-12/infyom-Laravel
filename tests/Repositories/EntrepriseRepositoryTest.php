<?php namespace Tests\Repositories;

use App\Models\Entreprise;
use App\Repositories\EntrepriseRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EntrepriseRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EntrepriseRepository
     */
    protected $entrepriseRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->entrepriseRepo = \App::make(EntrepriseRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_entreprise()
    {
        $entreprise = factory(Entreprise::class)->make()->toArray();

        $createdEntreprise = $this->entrepriseRepo->create($entreprise);

        $createdEntreprise = $createdEntreprise->toArray();
        $this->assertArrayHasKey('id', $createdEntreprise);
        $this->assertNotNull($createdEntreprise['id'], 'Created Entreprise must have id specified');
        $this->assertNotNull(Entreprise::find($createdEntreprise['id']), 'Entreprise with given id must be in DB');
        $this->assertModelData($entreprise, $createdEntreprise);
    }

    /**
     * @test read
     */
    public function test_read_entreprise()
    {
        $entreprise = factory(Entreprise::class)->create();

        $dbEntreprise = $this->entrepriseRepo->find($entreprise->id);

        $dbEntreprise = $dbEntreprise->toArray();
        $this->assertModelData($entreprise->toArray(), $dbEntreprise);
    }

    /**
     * @test update
     */
    public function test_update_entreprise()
    {
        $entreprise = factory(Entreprise::class)->create();
        $fakeEntreprise = factory(Entreprise::class)->make()->toArray();

        $updatedEntreprise = $this->entrepriseRepo->update($fakeEntreprise, $entreprise->id);

        $this->assertModelData($fakeEntreprise, $updatedEntreprise->toArray());
        $dbEntreprise = $this->entrepriseRepo->find($entreprise->id);
        $this->assertModelData($fakeEntreprise, $dbEntreprise->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_entreprise()
    {
        $entreprise = factory(Entreprise::class)->create();

        $resp = $this->entrepriseRepo->delete($entreprise->id);

        $this->assertTrue($resp);
        $this->assertNull(Entreprise::find($entreprise->id), 'Entreprise should not exist in DB');
    }
}
