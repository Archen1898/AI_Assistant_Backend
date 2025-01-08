<?php

namespace App\Repositories;

//GLOBAL IMPORT
use Exception;
use Symfony\Component\HttpFoundation\Response;

//LOCAL IMPORT
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\ResourceNotFoundException;
use App\Interfaces\CrudInterface;
use App\Models\Expense;
class ExpenseRepository implements CrudInterface
{

    public function viewAll()
    {
        try{
            $Expenses = Expense::orderBy('name', 'description')->get();
            if($Expenses->isEmpty()){
                throw new ResourceNotFoundException(trans('expenses.notFound'), Response::HTTP_NOT_FOUND);
            }
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $Expenses;
    }

    public function viewById(int $id)
    {
        try{
            $Expense = Expense::find($id);
            if(!$Expense){
                throw new ResourceNotFoundException(trans('expenses.notFoundById'), Response::HTTP_NOT_FOUND);
            }
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $Expense;
    }

    public function viewByBalanceId($status)
    {
        try{
            $Expenses = Expense::where('balance_id', $status)->orderBy('name', 'description')->get();
            if($Expenses->isEmpty()){
                throw new ResourceNotFoundException(trans('expenses.notFound'), Response::HTTP_NOT_FOUND);
            }
            return $Expenses;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function viewAllByStatus($status)
    {
        try{
            $Expenses = Expense::where('status', $status)->orderBy('name', 'description')->get();
            if($Expenses->isEmpty()){
                throw new ResourceNotFoundException(trans('expenses.notFound'), Response::HTTP_NOT_FOUND);
            }
            return $Expenses;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(array $request): object|null|array
    {
        try{
            $Expense = new Expense();
            $newIncome = $this->dataFormat($request, $Expense);
            $newIncome->save();
            return $newIncome;
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(int $id, array $request) : object|null|array
    {
        try{
            $Expense = Expense::find($id);
            if(!$Expense){
                throw new ResourceNotFoundException(trans('expenses.notFoundById'), Response::HTTP_NOT_FOUND);
            }
            $newIncome = $this->dataFormat($request, $Expense);
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
            $Expense = Expense::find($id);
            if(!$Expense){
                throw new ResourceNotFoundException(trans('expenses.notFoundById'), Response::HTTP_NOT_FOUND);
            }
            $Expense->delete();
            return $Expense;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    

    public function dataFormat($request, Expense $Expense) : object|null|array
    {
       $Expense->name = $request['name'];
       $Expense->description = $request['description'];
       $Expense->date = $request['date'];
       $Expense->balance_id = $request['balance_id'];
       $Expense->amount = $request['amount'];
       $Expense->recurring = $request['recurring'];
       $Expense->expense_type_id = $request['expense_type_id'];
       $Expense->status = $request['status'];
       return $Expense; 
    }

}