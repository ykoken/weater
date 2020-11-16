<?php

namespace App\Repositories\Weater;

use App\Exceptions\RepositoryException;
use App\Models\UserFavorites;
use App\Models\Weater;
use App\Services\Response\ResponseStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Exception;

class WeaterRepository extends BaseRepository
{
    public function getAll()
    {
        return Weater::all();
    }

    public function getCity($id)
    {
        return Weater::find($id);
    }

    public function getFavorites()
    {
        return UserFavorites::find(Auth::id());
    }

    public function addFavorites($data)
    {
        try {
            return UserFavorites::updateOrCreate($data);
        } catch (Exception $e) {
            \Log::error($e);

            throw new RepositoryException(ResponseStatus::BAD_REQUEST, $e->getMessage());
        }
    }

    public function removeFavorites($id)
    {
        try {
            $data = UserFavorites::find($id);
            return $data->delete();
        } catch (Exception $e) {
            \Log::error($e);

            throw new RepositoryException(ResponseStatus::BAD_REQUEST, $e->getMessage());
        }
    }
}
