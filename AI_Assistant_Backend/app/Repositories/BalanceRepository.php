<?php

namespace App\Repositories;

//GLOBAL IMPORT
use Exception;

//LOCAL IMPORT
use Carbon\Carbon;
use App\Models\Income;
use App\Models\Balance;
use App\Models\Expense;
use App\Interfaces\CrudInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class BalanceRepository implements CrudInterface
{

    public function viewAll()
    {
        try{
            $Balances =Balance::orderBy('name', 'description')->get();
            if($Balances->isEmpty()){
                throw new ResourceNotFoundException(trans('expenses.notFound'), Response::HTTP_NOT_FOUND);
            }
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $Balances;
    }

    public function viewById(int $id)
    {
        try{
            $Expense = Balance::find($id);
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

    public function viewAllIncomes($id)
    {
        try{
            $Incomes = Income::where('balance_id', $id)->orderBy('name', 'description')->get();
            if($Incomes->isEmpty()){
                throw new ResourceNotFoundException(trans('expenses.notFound'), Response::HTTP_NOT_FOUND);
            }
            return $Incomes;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function viewAllExpenses($id)
    {
        try{
            $Expenses = Expense::where('balance_id', $id)->orderBy('name', 'description')->get();
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
            $Balances = Balance::where('status', $status)->orderBy('name', 'description')->get();
            if($Balances->isEmpty()){
                throw new ResourceNotFoundException(trans('expenses.notFound'), Response::HTTP_NOT_FOUND);
            }
            return $Balances;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(array $request): object|null|array
    {
        try{
            $balance = new Balance();
            $newBalance = $this->dataFormat($request, $balance);
            $newBalance->save();
            return $newBalance;
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(int $id, array $request) : object|null|array
    {
        try{
            $Expense = Balance::find($id);
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
            $balance = Balance::find($id);
            if(!$balance){
                throw new ResourceNotFoundException(trans('expenses.notFoundById'), Response::HTTP_NOT_FOUND);
            }
            $balance->delete();
            return $balance;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    

    public function dataFormat($request, Balance $balance) : object|null|array
    {
       $balance->user_id = $request['user_id'];
       $balance->income_id = 0;
       $balance->expense_id = 0;
       $balance->balance = 0;
       $balance->status = $request['status'];
       return $balance; 
    }

    public function dataFormatUpdate($request, Balance $balance) : object|null|array
    {
       $balance->user_id = $request['user_id'];
       $balance->total_income = $this->calculateIncome($balance->id);
       $balance->total_expenses = $this->calculateExpense($balance->id);
       $balance->balance = $this->calculateBalance($balance->id);
       $balance->status = $request['status'];
       return $balance; 
    }
    public function calculateIncome($balanceId){

        try{
            $balance = Balance::find($balanceId);
            if(!$balance){
                throw new ResourceNotFoundException(trans('expenses.notFoundById'), Response::HTTP_NOT_FOUND);
            }
            $incomeSum = Income::where('balance_id', $balanceId)->sum('amount');
            if(!$incomeSum){
                $incomeSum = 0;
            }
            return $incomeSum;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function calculateExpense($balanceId){

        try{
            $balance = Balance::find($balanceId);
            if(!$balance){
                throw new ResourceNotFoundException(trans('expenses.notFoundById'), Response::HTTP_NOT_FOUND);
            }
            $expenseSum = Expense::where('balance_id', $balanceId)->sum('amount');
            if(!$expenseSum){
                $expenseSum = 0;
            }
            return $expenseSum;
        }catch(ResourceNotFoundException $e){
                
            }
    }

    public function calculateBalance($balanceId){
        
        try{
            $balance = Balance::find($balanceId);
            if(!$balance){
                throw new ResourceNotFoundException(trans('expenses.notFoundById'), Response::HTTP_NOT_FOUND);
            }

            $incomeSum = Income::where('balance_id', $balanceId)->sum('amount');
            if(!$incomeSum){
                $incomeSum = 0;
            }
            $expenseSum = Expense::where('balance_id', $balanceId)->sum('amount');
            if(!$expenseSum){
                $expenseSum = 0;
            }
            $totalSum = $incomeSum - $expenseSum;
            return $totalSum;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    

}