<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Users\UserRepository;
use App\Services\Response\ResponseHandler;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $request;
    protected $response;
    protected $user;


    public function __construct(
        Request $request,
        ResponseHandler $response,
        UserRepository $user
    )
    {
        $this->request = $request;
        $this->response = $response;
        $this->user = $user;

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_id = Auth::user()->id;
        if ($user_id) {
            $user = User::find($user_id);
            if ($user) {
                return response()->json($user);
            }
        } else {
            return response()->json(['message' => 'User not found!'], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $data = $this->request->only(
            ['id','name', 'email','password','mobile_number', 'profile_url', 'city', 'timezone', 'language', 'device_system', 'notification']);
        try {
            $user = $this->user->updateUser($data);
        } catch (RepositoryException $re) {
            return $this->response
                ->message('error', $re->getMessage())
                ->get($re->getStatusCode());
        }

        return $this->response
            ->message('success', 'USER_UPDATED')
            ->result('user', $user)
            ->ok();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
