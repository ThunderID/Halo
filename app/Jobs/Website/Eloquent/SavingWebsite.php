<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

use \App\Jobs\ValidateWebsite as Validate;
use \App\Models\Website as Model;
use \App\JSend;

class SavingWebsite extends Job implements SelfHandling
{
    protected $model;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
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
