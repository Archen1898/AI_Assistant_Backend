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
        
    }

    public function create(array $request): object|null|array
    {

    }

    public function update(int $id, array $request) : object|null|array
    {

    }

    public function viewAllByStatus($status)
    {
        
    }

    public function dataFormat($request, IncomeType $incomeType) : object|null|array
    {
        
    }

}