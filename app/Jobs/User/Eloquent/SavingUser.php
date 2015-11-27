<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

use \App\Jobs\ValidateUser as Validate;
use \App\Models\User as Model;
use \App\JSend;
use Hash;

class SavingUser extends Job implements SelfHandling
{
    protected $model;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Model $model)
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
        // ------------------------------------------------------------------------
        // VALIDATE
        // ------------------------------------------------------------------------
        $js = $this->dispatch(new Validate($this->model->toArray() + ['password' => $this->model->password]));
        if ($js->isFail())
        {
            $this->model->setErrors($js->getData());
        }
        else
        {
            if (Hash::needsRehash($this->model->password))
            {
                $this->model->password = Hash::make($this->model->password);
            }
        }
        
        return $js;
    }
}
