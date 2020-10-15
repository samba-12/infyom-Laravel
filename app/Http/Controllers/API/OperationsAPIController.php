<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOperationsAPIRequest;
use App\Http\Requests\API\UpdateOperationsAPIRequest;
use App\Models\Operations;
use App\Repositories\OperationsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OperationsController
 * @package App\Http\Controllers\API
 */

class OperationsAPIController extends AppBaseController
{
    /** @var  OperationsRepository */
    private $operationsRepository;

    public function __construct(OperationsRepository $operationsRepo)
    {
        $this->operationsRepository = $operationsRepo;
    }

    /**
     * Display a listing of the Operations.
     * GET|HEAD /operations
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function index(Request $request)
    {
        $operations = $this->operationsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($operations->toArray(), 'Operations retrieved successfully');
    }

    /**
     * Store a newly created Operations in storage.
     * POST /operations
     *
     * @param CreateOperationsAPIRequest $request
     *
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function store(CreateOperationsAPIRequest $request)
    {
        $input = $request->all();

        $operations = $this->operationsRepository->create($input);

        return $this->sendResponse($operations->toArray(), 'Operations saved successfully');
    }

    /**
     * Display the specified Operations.
     * GET|HEAD /operations/{id}
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function show($id)
    {
        /** @var Operations $operations */
        $operations = $this->operationsRepository->find($id);

        if (empty($operations)) {
            return $this->sendError('Operations not found');
        }

        return $this->sendResponse($operations->toArray(), 'Operations retrieved successfully');
    }

    /**
     * Update the specified Operations in storage.
     * PUT/PATCH /operations/{id}
     *
     * @param int $id
     * @param UpdateOperationsAPIRequest $request
     *
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function update($id, UpdateOperationsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Operations $operations */
        $operations = $this->operationsRepository->find($id);

        if (empty($operations)) {
            return $this->sendError('Operations not found');
        }

        $operations = $this->operationsRepository->update($input, $id);

        return $this->sendResponse($operations->toArray(), 'Operations updated successfully');
    }

    /**
     * Remove the specified Operations from storage.
     * DELETE /operations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function destroy($id)
    {
        /** @var Operations $operations */
        $operations = $this->operationsRepository->find($id);

        if (empty($operations)) {
            return $this->sendError('Operations not found');
        }

        $operations->delete();

        return $this->sendSuccess('Operations deleted successfully');
    }
}
