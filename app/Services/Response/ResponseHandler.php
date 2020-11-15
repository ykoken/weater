<?php

namespace App\Services\Response;

class ResponseHandler
{
    private $data = null;
    private $custom = null;

    private $pagination = [
        'page' => '',
        'pageCount' => '',
        'limit' => '',
        'total' => ''
    ];

    private $messenger;

    /**
     * @param array $pagination
     * @return $this
     */
    public function pagination($pagination)
    {
        $this->pagination = $pagination;

        return $this;
    }

    /**
     * ResponseHandler constructor.
     */
    public function __construct()
    {
        $this->messenger = new ResponseMessenger();
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function result($key, $value)
    {
        if (!is_array($this->data)) {
            $this->data = array();
        }
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     */
    public function custom($key, $value)
    {
        if (!is_array($this->custom)) {
            $this->custom = array();
        }

        $this->custom[$key] = $value;

        return $this;
    }

    /**
     * @param $messageKey
     * @param $statusKey
     * @return $this
     */
    public function message($statusKey, $messageKey)
    {
        switch ($statusKey) {
            case 'success':
                $this->messenger->addSuccess($messageKey);
                break;

            case 'warning':
                $this->messenger->addWarning($messageKey);
                break;

            case 'error':
                $this->messenger->addError($messageKey);
                break;
        }

        return $this;
    }

    /**
     * @return array
     */
    private function getResponse()
    {
        $response = [
            'meta' => [
                'messages' => [
                    'success' => $this->messenger->getSuccesses(),
                    'warning' => $this->messenger->getWarnings(),
                    'error' => $this->messenger->getErrors()
                ]
            ],
            'payload' => $this->data
        ];

        if ($this->pagination['page']) {
            $response['pagination'] = $this->pagination;
        }

        if ($this->custom) {
            foreach ($this->custom as $key => $item) {
                $response[$key] = $item;
            }
        }

        return $response;
    }


    /**
     * @param $responseStatus
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($responseStatus)
    {
        return response()->json($this->getResponse(), $responseStatus);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ok()
    {
        return response()->json($this->getResponse(), ResponseStatus::OK);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function badRequest()
    {
        return response()->json($this->getResponse(), ResponseStatus::BAD_REQUEST);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function internalServerError()
    {
        return response()->json($this->getResponse(), ResponseStatus::INTERNAL_SERVER_ERROR);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function unauthorized()
    {
        return response()->json($this->getResponse(), ResponseStatus::UNAUTHORIZED);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFound()
    {
        return response()->json($this->getResponse(), ResponseStatus::NOT_FOUND);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function validationFail()
    {
        return response()->json($this->message('error', 'VALIDATION_FAILED')
            ->getResponse(), ResponseStatus::UNPROCESSABLE_ENTITY);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function created()
    {
        return response()->json($this->getResponse(), ResponseStatus::CREATED);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function noContent()
    {
        return response()->json($this->getResponse(), ResponseStatus::NO_CONTENT);
    }
}