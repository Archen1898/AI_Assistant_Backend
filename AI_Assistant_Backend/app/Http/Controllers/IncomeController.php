<?php

namespace App\Http\Controllers;

//Global Import
use Exception;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

//Local Import
use App\Http\Requests\IncomeRequest;
use App\Repositories\IncomeRepository;
use Symfony\Component\HttpFoundation\Response;

class IncomeController extends Controller
{
    use ResponseTrait;
    protected IncomeRepository $incomeRepository;
    public function __construct(IncomeRepository $incomeRepository)
    {
        $this->incomeRepository = $incomeRepository;
    }

    public function viewAll()
    {
        try {
            return $this->response(Response::HTTP_OK, trans('incomes.index'), $this->incomeRepository->viewAll(), null);
        } catch (Exception $exception) {
            return $this->response(Response::HTTP_BAD_REQUEST, $exception->getMessage(), [], $exception->getMessage());
        }
    }

    public function indexIncomes()
    {
        try {
            return $this->response(Response::HTTP_OK, trans('incomes.index'), $this->incomeRepository->viewAll(), null);
        } catch (Exception $exception) {
            return $this->response(Response::HTTP_BAD_REQUEST, $exception->getMessage(), [], $exception->getMessage());
        }
    }

    public function indexIncomesByStatus($status)
    {
        try {
            return $this->response(Response::HTTP_OK, trans('incomess.index'), $this->incomeRepository->viewAllByStatus($status), null);
        } catch (Exception $exception) {
            return $this->response(Response::HTTP_BAD_REQUEST, $exception->getMessage(), [], $exception->getMessage());
        }
    }

    public function createIncome(IncomeRequest $request)
    {
        try {
            return $this->response(Response::HTTP_OK, trans('incomes.created'), $this->incomeRepository->create($request->all()), null);
        } catch (Exception $exception) {
            return $this->response(Response::HTTP_BAD_REQUEST, $exception->getMessage(), [], $exception->getMessage());
        }
    }

    public function updateIncomeType(IncomeRequest $request, int $id)
    {
        try {
            return $this->response(Response::HTTP_OK, trans('incomes.updated'), $this->incomeRepository->update($id, $request->all()), null);
        } catch (Exception $exception) {
            return $this->response(Response::HTTP_BAD_REQUEST, $exception->getMessage(), [], $exception->getMessage());
        }
    }
}
