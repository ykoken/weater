<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Weater\WeaterRepository;
use App\Services\Response\ResponseHandler;
use App\Services\Response\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeaterController extends Controller
{
    public $request;
    public $response;
    public $weater;

    public function __construct(
        Request $request,
        ResponseHandler $response,
        WeaterRepository $weater)
    {
        $this->request = $request;
        $this->response = $response;
        $this->weater = $weater;
    }

    public function index()
    {
        try {
            $weater = $this->weater->getAll();
            return $this->response
                ->result('city_weater', $weater)
                ->ok();
        } catch (RepositoryException $re) {
            return $this->response
                ->message('error', $re->getMessage())
                ->get($re->getStatusCode());
        }
    }

    public function getCity($id)
    {
        try {
            $weater = $this->weater->getCity($id);
            return $this->response
                ->result('city_weater', $weater)
                ->ok();
        } catch (RepositoryException $re) {
            return $this->response
                ->message('error', $re->getMessage())
                ->get($re->getStatusCode());
        }
    }

    public function getUserFavorites()
    {
        try {
            $favorites = $this->weater->getFavorites();
            return $this->response
                ->result('my_favorites', $favorites)
                ->ok();
        } catch (RepositoryException $re) {
            return $this->response
                ->message('error', $re->getMessage())
                ->get($re->getStatusCode());
        }
    }
    public function addUserFavorites()
    {
        $data = [
            'user_id' => Auth::id(),
            'city_id' => $this->request->get('city_id')
        ];
        try {
            $favorites = $this->weater->addFavorites($data);
            return $this->response
                ->result('my_favorites', $favorites)
                ->ok();
        } catch (RepositoryException $re) {
            return $this->response
                ->message('error', $re->getMessage())
                ->get($re->getStatusCode());
        }
    }
    public function removeUserFavorites($id)
    {
        try {
            $favorites = $this->weater->removeFavorites($id);
            return $this->response
                ->result('success', $favorites)
                ->ok();
        } catch (RepositoryException $re) {
            return $this->response
                ->message('error', $re->getMessage())
                ->get($re->getStatusCode());
        }
    }
}
