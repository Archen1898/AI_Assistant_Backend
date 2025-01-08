<?php

namespace App\Repositories;

//GLOBAL IMPORT
use Exception;
use Symfony\Component\HttpFoundation\Response;

//LOCAL IMPORT
use App\ViewAllInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\ResourceNotFoundException;
use App\Interfaces\CrudInterface;
use App\Models\Income;
class IncomeRepository implements CrudInterface
{

    public function viewAll()
    {
        try{
            $incomes = Income::orderBy('name', 'description')->get();
            if($incomes->isEmpty()){
                throw new ResourceNotFoundException(trans('incomes.notFound'), Response::HTTP_NOT_FOUND);
            }
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $incomes;
    }

    public function viewById(int $id)
    {
        try{
            $income = Income::find($id);
            if(!$income){
                throw new ResourceNotFoundException(trans('incomes.notFoundById'), Response::HTTP_NOT_FOUND);
            }
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $income;
    }

    public function viewByBalanceId($status)
    {
        try{
            $incomes = Income::where('balance_id', $status)->orderBy('name', 'description')->get();
            if($incomes->isEmpty()){
                throw new ResourceNotFoundException(trans('incomes.notFound'), Response::HTTP_NOT_FOUND);
            }
            return $incomes;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function viewAllByStatus($status)
    {
        try{
            $incomes = Income::where('status', $status)->orderBy('name', 'description')->get();
            if($incomes->isEmpty()){
                throw new ResourceNotFoundException(trans('incomes.notFound'), Response::HTTP_NOT_FOUND);
            }
            return $incomes;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(array $request): object|null|array
    {
        try{
            $income = new Income();
            $newIncome = $this->dataFormat($request, $income);
            $newIncome->save();
            return $newIncome;
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(int $id, array $request) : object|null|array
    {
        try{
            $income = Income::find($id);
            if(!$income){
                throw new ResourceNotFoundException(trans('incomes.notFoundById'), Response::HTTP_NOT_FOUND);
            }
            $newIncome = $this->dataFormat($request, $income);
            $newIncome->save();
            return $newIncome;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(int $id):  Object | null
    {
        try{
            $income = Income::find($id);
            if(!$income){
                throw new ResourceNotFoundException(trans('incomes.notFoundById'), Response::HTTP_NOT_FOUND);
            }
            $income->delete();
            return $income;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    

    public function dataFormat($request, Income $income) : object|null|array
    {
       $income->name = $request['name'];
       $income->description = $request['description'];
       $income->date = $request['date'];
       $income->balance_id = $request['balance_id'];
       $income->amount = $request['amount'];
       $income->recurring = $request['recurring'];
       $income->income_type_id = $request['income_type_id'];
       $income->status = $request['status'];
       return $income; 
    }

}
