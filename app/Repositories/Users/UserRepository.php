<?php

namespace App\Repositories\Users;

use App\Exceptions\RepositoryException;
use App\Http\Requests\Users\UpdateRequest;
use App\Services\Response\ResponseStatus;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{

    public function updateUser($data)
    {
        DB::beginTransaction();
        try {
            // If user exists when we find it
            $user = User::find($data['id']);
            // Check the user
            if (!$user) {
                throw new RepositoryException(ResponseStatus::BAD_REQUEST, 'USER_NOT_FOUND');
            }else{
                $data =[
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => preg_replace('/\s+/', '', strtolower($data['email'])),
                    'password' => \Hash::make($data['password']),
                    'mobile_number' => $data['mobile_number'],
                    'profile_url' => isset($data['file']) ? $data['file']->store('avatar', 'public') : null,
                    'timezone' => $data['timezone'],
                    'language' =>  $data['language'],
                    'device_system'=> $data['device_system'],
                    'notification' => $data['notification']
                ];
            }

            $user->where('id',$data['id'])->update($data);

            DB::commit();
            return $user;
        } catch (RepositoryException $re) {
            return $this->response
                ->message('error', $re->getMessage())
                ->get($re->getStatusCode());
        }
    }

    public function deleteUser($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);

            // Check the user
            if (!$user) {
                throw new RepositoryException(ResponseStatus::BAD_REQUEST, 'USER_NOT_FOUND');
            }

            // Delete the user
            $user->delete();

            DB::commit();
            return $this->success("User deleted", $user);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
