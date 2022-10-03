<?php

namespace App\Http\Controllers\API\Device;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Device\BulkCreateCustomerAPIRequest;
use App\Http\Requests\Device\BulkUpdateCustomerAPIRequest;
use App\Http\Requests\Device\CreateCustomerAPIRequest;
use App\Http\Requests\Device\UpdateCustomerAPIRequest;
use App\Http\Resources\Device\CustomerCollection;
use App\Http\Resources\Device\CustomerResource;
use App\Repositories\CustomerRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class CustomerController extends AppBaseController
{
    /**
     * @var CustomerRepository
     */
    private CustomerRepository $customerRepository;

    /**
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Customer's Listing API.
     * Limit Param: limit
     * Skip Param: skip.
     *
     * @param Request $request
     *
     * @return CustomerCollection
     */
    public function index(Request $request): CustomerCollection
    {
        $customers = $this->customerRepository->fetch($request);

        return new CustomerCollection($customers);
    }

    /**
     * Create Customer with given payload.
     *
     * @param CreateCustomerAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return CustomerResource
     */
    public function store(CreateCustomerAPIRequest $request): CustomerResource
    {
        $input = $request->all();
        $customer = $this->customerRepository->create($input);

        return new CustomerResource($customer);
    }

    /**
     * Get single Customer record.
     *
     * @param int $id
     *
     * @return CustomerResource
     */
    public function show(int $id): CustomerResource
    {
        $customer = $this->customerRepository->findOrFail($id);

        return new CustomerResource($customer);
    }

    /**
     * Update Customer with given payload.
     *
     * @param UpdateCustomerAPIRequest $request
     * @param int                      $id
     *
     * @throws ValidatorException
     *
     * @return CustomerResource
     */
    public function update(UpdateCustomerAPIRequest $request, int $id): CustomerResource
    {
        $input = $request->all();
        $customer = $this->customerRepository->update($input, $id);

        return new CustomerResource($customer);
    }

    /**
     * Delete given Customer.
     *
     * @param int $id
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->customerRepository->delete($id);

        return $this->successResponse('Customer deleted successfully.');
    }

    /**
     * Bulk create Customer's.
     *
     * @param BulkCreateCustomerAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return CustomerCollection
     */
    public function bulkStore(BulkCreateCustomerAPIRequest $request): CustomerCollection
    {
        $customers = collect();

        $input = $request->get('data');
        foreach ($input as $key => $customerInput) {
            $customers[$key] = $this->customerRepository->create($customerInput);
        }

        return new CustomerCollection($customers);
    }

    /**
     * Bulk update Customer's data.
     *
     * @param BulkUpdateCustomerAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return CustomerCollection
     */
    public function bulkUpdate(BulkUpdateCustomerAPIRequest $request): CustomerCollection
    {
        $customers = collect();

        $input = $request->get('data');
        foreach ($input as $key => $customerInput) {
            $customers[$key] = $this->customerRepository->update($customerInput, $customerInput['id']);
        }

        return new CustomerCollection($customers);
    }
}
