<?php

namespace App\Repositories\Campaign;

use App\Exceptions\RepositoryException;
use App\Models\CampaignCode;
use App\Models\UserCampaignRelation;
use App\Services\Response\ResponseStatus;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;

class CampaignRepository extends BaseRepository
{

    public function getAll()
    {
        return CampaignCode::where('status', 0)->get();
    }

    public function addCampaignCode($data)
    {
        try {
            $addCodeRelation = UserCampaignRelation::insert($data);
            if ($addCodeRelation) {
                CampaignCode::where('name', $data['campaign_code'])->update(['status' => 1]);
            }
            return $addCodeRelation;
        } catch (Exception $e) {
            \Log::error($e);
            throw new RepositoryException(ResponseStatus::BAD_REQUEST, $e->getMessage());
        }
    }

}
