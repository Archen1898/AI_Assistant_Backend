<?php

namespace App\Http\Controllers;

//Global Import

use Exception;
use Symfony\Component\HttpFoundation\Response;

//Local Import
use App\Traits\ResponseTrait;
use App\Repositories\IncomeTypeRepository;
use App\Http\Requests\IncomeTypeRequest;


class IncomeTypeController extends Controller
{
    protected IncomeTypeRepository $incomeTypeRepository;
    use ResponseTrait;
    public function __construct(IncomeTypeRepository $incomeTypeRepository)
    {
        $this->incomeTypeRepository = $incomeTypeRepository;
    }

    public function indexIncomeTypes()
    {
        try {
            return $this->response(Response::HTTP_OK, trans('income_types.index'), $this->incomeTypeRepository->viewAll(), null);
        } catch (Exception $exception) {
            return $this->response(Response::HTTP_BAD_REQUEST, $exception->getMessage(), [], $exception->getMessage());
        }
    }

    public function indexIncomeTypesByStatus($status)
    {
        try {
            return $this->response(Response::HTTP_OK, trans('income_types.index'), $this->incomeTypeRepository->viewAllByStatus($status), null);
        } catch (Exception $exception) {
            return $this->response(Response::HTTP_BAD_REQUEST, $exception->getMessage(), [], $exception->getMessage());
        }
    }

    public function createIncomeType(IncomeTypeRequest $request)
    {
        try {
            return $this->response(Response::HTTP_OK, trans('income_types.created'), $this->incomeTypeRepository->create($request->all()), null);
        } catch (Exception $exception) {
            return $this->response(Response::HTTP_BAD_REQUEST, $exception->getMessage(), [], $exception->getMessage());
        }
    }

    public function updateIncomeType(IncomeTypeRequest $request, int $id)
    {
        try {
            return $this->response(Response::HTTP_OK, trans('income_types.updated'), $this->incomeTypeRepository->update($id, $request->all()), null);
        } catch (Exception $exception) {
            return $this->response(Response::HTTP_BAD_REQUEST, $exception->getMessage(), [], $exception->getMessage());
        }
    }
}
