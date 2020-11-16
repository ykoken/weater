<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\RepositoryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Campaigns\CampaignRelationRequest;
use App\Http\Requests\Campaigns\CampaignRequest;
use App\Models\CampaignCode;
use App\Models\UserCampaignRelation;
use App\Repositories\Campaign\CampaignRepository;
use App\Services\Response\ResponseHandler;
use App\Services\Response\ResponseStatus;
use App\User;
use CampaignCodes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CampaignController extends Controller
{
    public $user;
    public $campaign;
    public $request;
    public $response;
    public $campaignRelation;

    public function __construct(
        Request $request,
        ResponseHandler $response,
        User $user,
        CampaignRepository $campaign,
        UserCampaignRelation $campaignRelation)
    {
        $this->user = $user;
        $this->campaign = $campaign;
        $this->campaignRelation = $campaignRelation;
        $this->request = $request;
        $this->response = $response;
    }

    public function index()
    {
        try {
            $user = $this->campaign->getAll();
        } catch (RepositoryException $re) {
            return $this->response
                ->message('error', $re->getMessage())
                ->get($re->getStatusCode());
        }

        return $this->response
            ->result('user', $user)
            ->ok();
    }

    public function addCampaignCode(CampaignRequest $request)
    {
        $validated = $request->validated();
        $data = $this->request->only(['user_id', 'campaign_code']);

        try {
            $user_id = Auth::id() ? $data['user_id'] : Auth::id();
            $getUser = User::find($user_id);
            if ($getUser) {
                $getCampaignCode = CampaignCode::where('name', $data['campaign_code'])
                    ->where('status', 0)
                    ->first();
                if ($getCampaignCode) {
                    $this->campaign->addCampaignCode($data);
                } else {
                    throw new RepositoryException(ResponseStatus::BAD_REQUEST, 'CAMPAIGN_CODE_NOT_FOUND');
                }
            } else {
                throw new RepositoryException(ResponseStatus::BAD_REQUEST, 'USER_NOT_FOUND');
            }
            return $this->response
                ->result('user', $getUser)
                ->ok();
        } catch (RepositoryException $re) {
            return $this->response
                ->message('error', $re->getMessage())
                ->get($re->getStatusCode());
        }
    }
}
