<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

use \App\Jobs\ValidateContent as Validate;
use \App\JSend;

class SavingContent extends Job implements SelfHandling
{
    protected $model;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Content $model)
    {
        //
        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // VALIDATE
        $js = $this->dispatch(new Validate($this->model->toArray()));
        if ($js->isFail())
        {
            $this->model->setErrors($js->getData());
        }
        return $js;
    }
}
