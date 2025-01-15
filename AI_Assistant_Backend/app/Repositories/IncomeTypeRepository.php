<?php

namespace App\Repositories;

//GLOBAL IMPORT
use Exception;
use App\Interfaces\ActiveInterface;
use App\Interfaces\CreateInterface;
use App\Interfaces\UpdateInterface;

//LOCAL IMPORT
use App\Interfaces\ViewAllInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\ResourceNotFoundException;
use App\Models\IncomeType;
use Symfony\Component\HttpFoundation\Response;
class IncomeTypeRepository implements ViewAllInterface, CreateInterface, ActiveInterface, UpdateInterface
{

    /**
     * @throws ResourceNotFoundException
     * @throws Exception
     */

    public function viewAll()
    {
        try{
            $incomeTypes = IncomeType::orderBy('name', 'description')->get();
            if($incomeTypes->isEmpty()){
                throw new ResourceNotFoundException(trans('income_types.notFound'), Response::HTTP_NOT_FOUND);
            }
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $incomeTypes;
    }

    public function viewAllByStatus($status)
    {
        try{
            $incomeTypes = IncomeType::where('status', $status)->orderBy('name', 'description')->get();
            if($incomeTypes->isEmpty()){
                throw new ResourceNotFoundException(trans('income_types.notFound'), Response::HTTP_NOT_FOUND);
            }
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $incomeTypes;
    }

    public function create(array $request): object|null|array
    {
        try{
            $incomeType = new IncomeType();
            $newIncomeType = $this->dataFormat($request, $incomeType);
            $newIncomeType->save();
            return $newIncomeType;
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(int $id, array $request) : object|null|array
    {
        try{
            $incomeType = IncomeType::find($id);
            if(!$incomeType){
                throw new ResourceNotFoundException(trans('income_types.notFoundById'), Response::HTTP_NOT_FOUND);
            }
            $newIncomeType = $this->dataFormat($request, $incomeType);
            $newIncomeType->save();
            return $newIncomeType;
        }catch(ResourceNotFoundException $e){
            throw new ResourceNotFoundException($e->getMessage(), $e->getCode());
        }catch(Exception $e){
            throw new Exception(trans('messages.exception'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    

    public function dataFormat($request, IncomeType $incomeType) : object|null|array
    {
       $incomeType->name = $request['name'];
       $incomeType->description = $request['description'];
       $incomeType->status = $request['status'];
       return $incomeType; 
    }

}