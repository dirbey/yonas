<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Admin\ActivityLogCollection;
use App\Repositories\ActivityLogRepository;
use Illuminate\Http\Request;

class ActivityLogController extends AppBaseController
{
    /**
     * @var ActivityLogRepository
     */
    private $activityLogRepository;

    /**
     * @param ActivityLogRepository $activityLogRepository
     */
    public function __construct(ActivityLogRepository $activityLogRepository)
    {
        $this->activityLogRepository = $activityLogRepository;
    }

    /**
     * @param Request $request
     *
     * @return ActivityLogCollection
     */
    public function index(Request $request): ActivityLogCollection
    {
        $activityLogs = $this->activityLogRepository->fetch($request);

        return new ActivityLogCollection($activityLogs);
    }
}
