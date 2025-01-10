<?php

namespace  App\Repositories;



//Global Import
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Exceptions\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\PersonalAccessTokenResult;
use Symfony\Component\HttpKernel\Exception\HttpException;

//Local Import

class AuthRepository
{

    /**
     * @throws Exception
     */

    public function login(array $data):?User
    {
        
        try {
            $user =  User::where('email', $data['email'])
                ->where('active','=', true)
                //->with(['roles.permissions', 'permissions'])
                ->first();
            Log::info($user);

            if (!$user) {
                throw new Exception(trans('auth.user'), response::HTTP_NOT_FOUND);
            }
            $user->accessToken = $this->createAuthToken($user)->accessToken;
            return $user;
        } catch (ResourceNotFoundException $e) {
            Log::error($e);
            throw new ResourceNotFoundException($e->getMessage(),$e->getCode());
        } catch (QueryException $e){
            Log::error($e);
            throw new HttpException($e->getMessage(),response::HTTP_INTERNAL_SERVER_ERROR);
        }
        catch (Exception $e){
            Log::error($e);
            throw new Exception($e->getMessage(), response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createAuthToken(User $user): PersonalAccessTokenResult
    {
        return $user->createToken('authToken');
    }
}
