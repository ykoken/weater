<?php

namespace App\Services\Response;

use Exception;
use Lang;

class ResponseMessenger
{
    private $errors = [];
    private $warnings = [];
    private $successes = [];


    /**
     * @param $messageKey
     * @return mixed
     * @throws Exception
     */
    private function getMessage($messageKey)
    {
        $key = env('APP_NAME').'::messages.' . $messageKey;
        if(Lang::has($key)){
            return Lang::get($key);
        }

        return $messageKey;
    }

    /**
     * @param $messageKey
     */
    public function addError($messageKey)
    {
        $this->errors[] = $this->getMessage($messageKey);
    }

    /**
     * @param $messageKey
     */
    public function addWarning($messageKey)
    {
        $this->warnings[] = $this->getMessage($messageKey);
    }

    /**
     * @param $messageKey
     */
    public function addSuccess($messageKey)
    {
        $this->successes[] = $this->getMessage($messageKey);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @return array
     */
    public function getSuccesses()
    {
        return $this->successes;
    }
}