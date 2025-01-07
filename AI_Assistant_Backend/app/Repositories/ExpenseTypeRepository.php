<?php

namespace App\Repositories;

//GLOBAL IMPORT
use Exception;
use App\ActiveInterface;
use App\CreateInterface;
use App\UpdateInterface;

//LOCAL IMPORT
use App\ViewAllInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\ResourceNotFoundException;
use App\Models\ExpenseType;
use Symfony\Component\HttpFoundation\Response;
class ExpenseTypeRepository implements ViewAllInterface, CreateInterface, ActiveInterface, UpdateInterface
{

    /**
     * @throws ResourceNotFoundException
     * @throws Exception
     */

     public function viewAll()
     {
         try{
             $expenseTypes = ExpenseType::orderBy('name', 'description')->get();
             if($expenseTypes->isEmpty()){
                 throw new ResourceNotFoundException(trans('expense_types.notFound'), Response::HTTP_NOT_FOUND);
             }
         }catch(ResourceNotFoundException $e){
             throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
         }catch(Exception $e){
             throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
         }
         return $expenseTypes;
     }
 
     public function viewAllByStatus($status)
     {
         try{
             $expenseTypes = ExpenseType::where('status', $status)->orderBy('name', 'description')->get();
             if($expenseTypes->isEmpty()){
                 throw new ResourceNotFoundException(trans('expense_types.notFound'), Response::HTTP_NOT_FOUND);
             }
         }catch(ResourceNotFoundException $e){
             throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
         }catch(Exception $e){
             throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
         }
         return $expenseTypes;
     }
 
     public function create(array $request): object|null|array
     {
         try{
             $expenseType = new ExpenseType();
             $newexpenseType = $this->dataFormat($request, $expenseType);
             $newexpenseType->save();
             return $newexpenseType;
         }catch(Exception $e){
             throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
         }
     }
 
     public function update(int $id, array $request) : object|null|array
     {
         try{
             $expenseType = ExpenseType::find($id);
             if(!$expenseType){
                 throw new ResourceNotFoundException(trans('income_types.notFoundById'), Response::HTTP_NOT_FOUND);
             }
             $newexpenseType = $this->dataFormat($request, $expenseType);
             $newexpenseType->save();
             return $newexpenseType;
         }catch(ResourceNotFoundException $e){
             throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
         }catch(Exception $e){
             throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
         }
     }
 
     
 
     public function dataFormat($request, ExpenseType $expenseType) : object|null|array
     {
        $expenseType->name = $request['name'];
        $expenseType->description = $request['description'];
        $expenseType->status = $request['status'];
        return $expenseType; 
     }
     
}