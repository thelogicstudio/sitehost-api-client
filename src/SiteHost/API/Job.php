<?php

namespace Chrometoaster\SiteHost\API;

class Job extends Response
{
    /**
     * Replicate self from a generic Response object
     *
     * @param Response $response
     * @return Job
     */
    public static function createFromResponse(Response $response)
    {
        $res = null;

        if ($response && $response->isValid()) {
            $res         = new \stdClass();
            $res->status = $response->getStatus();
            $res->msg    = $response->getMessage();
            $res->return = $response->getData();
        }

        return new self($res);
    }


    /**
     * Get job state
     *
     * @return string
     */
    public function getJobState()
    {
        if ($this->isValid()) {
            return (string) $this->getDataItem('state');
        }

        return Constants::JOB_STATE_FAILED;
    }


    /**
     * Is the job still pending?
     *
     * @return bool
     */
    public function isPending()
    {
        return $this->getJobState() === Constants::JOB_STATE_PENDING;
    }


    /**
     * Is the job already running?
     *
     * @return bool
     */
    public function isRunning()
    {
        return $this->getJobState() === Constants::JOB_STATE_RUNNING;
    }


    /**
     * Has the job completed successfully?
     *
     * @return bool
     */
    public function hasCompleted()
    {
        return $this->getJobState() === Constants::JOB_STATE_COMPLETED;
    }


    /**
     * Has the job failed?
     *
     * @return bool
     */
    public function hasFailed()
    {
        return $this->getJobState() === Constants::JOB_STATE_FAILED;
    }
}
