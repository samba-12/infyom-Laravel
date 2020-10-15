<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEntrepriseAPIRequest;
use App\Http\Requests\API\UpdateEntrepriseAPIRequest;
use App\Models\Entreprise;
use App\Repositories\EntrepriseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EntrepriseController
 * @package App\Http\Controllers\API
 */

class EntrepriseAPIController extends AppBaseController
{
    /** @var  EntrepriseRepository */
    private $entrepriseRepository;

    public function __construct(EntrepriseRepository $entrepriseRepo)
    {
        $this->entrepriseRepository = $entrepriseRepo;
    }

    /**
     * Display a listing of the Entreprise.
     * GET|HEAD /entreprises
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function index(Request $request)
    {
        $entreprises = $this->entrepriseRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($entreprises->toArray(), 'Entreprises retrieved successfully');
    }

    /**
     * Store a newly created Entreprise in storage.
     * POST /entreprises
     *
     * @param CreateEntrepriseAPIRequest $request
     *
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function store(CreateEntrepriseAPIRequest $request)
    {
        $input = $request->all();

        $entreprise = $this->entrepriseRepository->create($input);

        return $this->sendResponse($entreprise->toArray(), 'Entreprise saved successfully');
    }

    /**
     * Display the specified Entreprise.
     * GET|HEAD /entreprises/{id}
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function show($id)
    {
        /** @var Entreprise $entreprise */
        $entreprise = $this->entrepriseRepository->find($id);

        if (empty($entreprise)) {
            return $this->sendError('Entreprise not found');
        }

        return $this->sendResponse($entreprise->toArray(), 'Entreprise retrieved successfully');
    }

    /**
     * Update the specified Entreprise in storage.
     * PUT/PATCH /entreprises/{id}
     *
     * @param int $id
     * @param UpdateEntrepriseAPIRequest $request
     *
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function update($id, UpdateEntrepriseAPIRequest $request)
    {
        $input = $request->all();

        /** @var Entreprise $entreprise */
        $entreprise = $this->entrepriseRepository->find($id);

        if (empty($entreprise)) {
            return $this->sendError('Entreprise not found');
        }

        $entreprise = $this->entrepriseRepository->update($input, $id);

        return $this->sendResponse($entreprise->toArray(), 'Entreprise updated successfully');
    }

    /**
     * Remove the specified Entreprise from storage.
     * DELETE /entreprises/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function destroy($id)
    {
        /** @var Entreprise $entreprise */
        $entreprise = $this->entrepriseRepository->find($id);

        if (empty($entreprise)) {
            return $this->sendError('Entreprise not found');
        }

        $entreprise->delete();

        return $this->sendSuccess('Entreprise deleted successfully');
    }
}
