<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\BulkCreatePlanAPIRequest;
use App\Http\Requests\Admin\BulkUpdatePlanAPIRequest;
use App\Http\Requests\Admin\CreatePlanAPIRequest;
use App\Http\Requests\Admin\UpdatePlanAPIRequest;
use App\Http\Resources\Admin\PlanCollection;
use App\Http\Resources\Admin\PlanResource;
use App\Repositories\PlanRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class PlanController extends AppBaseController
{
    /**
     * @var PlanRepository
     */
    private PlanRepository $planRepository;

    /**
     * @param PlanRepository $planRepository
     */
    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    /**
     * Plan's Listing API.
     * Limit Param: limit
     * Skip Param: skip.
     *
     * @param Request $request
     *
     * @return PlanCollection
     */
    public function index(Request $request): PlanCollection
    {
        $plans = $this->planRepository->fetch($request);

        return new PlanCollection($plans);
    }

    /**
     * Create Plan with given payload.
     *
     * @param CreatePlanAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return PlanResource
     */
    public function store(CreatePlanAPIRequest $request): PlanResource
    {
        $input = $request->all();
        $plan = $this->planRepository->create($input);

        return new PlanResource($plan);
    }

    /**
     * Get single Plan record.
     *
     * @param int $id
     *
     * @return PlanResource
     */
    public function show(int $id): PlanResource
    {
        $plan = $this->planRepository->findOrFail($id);

        return new PlanResource($plan);
    }

    /**
     * Update Plan with given payload.
     *
     * @param UpdatePlanAPIRequest $request
     * @param int                  $id
     *
     * @throws ValidatorException
     *
     * @return PlanResource
     */
    public function update(UpdatePlanAPIRequest $request, int $id): PlanResource
    {
        $input = $request->all();
        $plan = $this->planRepository->update($input, $id);

        return new PlanResource($plan);
    }

    /**
     * Delete given Plan.
     *
     * @param int $id
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->planRepository->delete($id);

        return $this->successResponse('Plan deleted successfully.');
    }

    /**
     * Bulk create Plan's.
     *
     * @param BulkCreatePlanAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return PlanCollection
     */
    public function bulkStore(BulkCreatePlanAPIRequest $request): PlanCollection
    {
        $plans = collect();

        $input = $request->get('data');
        foreach ($input as $key => $planInput) {
            $plans[$key] = $this->planRepository->create($planInput);
        }

        return new PlanCollection($plans);
    }

    /**
     * Bulk update Plan's data.
     *
     * @param BulkUpdatePlanAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return PlanCollection
     */
    public function bulkUpdate(BulkUpdatePlanAPIRequest $request): PlanCollection
    {
        $plans = collect();

        $input = $request->get('data');
        foreach ($input as $key => $planInput) {
            $plans[$key] = $this->planRepository->update($planInput, $planInput['id']);
        }

        return new PlanCollection($plans);
    }
}
