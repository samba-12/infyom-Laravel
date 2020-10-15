<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Entreprise;

class EntrepriseApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_entreprise()
    {
        $entreprise = factory(Entreprise::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/entreprises', $entreprise
        );

        $this->assertApiResponse($entreprise);
    }

    /**
     * @test
     */
    public function test_read_entreprise()
    {
        $entreprise = factory(Entreprise::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/entreprises/'.$entreprise->id
        );

        $this->assertApiResponse($entreprise->toArray());
    }

    /**
     * @test
     */
    public function test_update_entreprise()
    {
        $entreprise = factory(Entreprise::class)->create();
        $editedEntreprise = factory(Entreprise::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/entreprises/'.$entreprise->id,
            $editedEntreprise
        );

        $this->assertApiResponse($editedEntreprise);
    }

    /**
     * @test
     */
    public function test_delete_entreprise()
    {
        $entreprise = factory(Entreprise::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/entreprises/'.$entreprise->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/entreprises/'.$entreprise->id
        );

        $this->response->assertStatus(404);
    }
}
