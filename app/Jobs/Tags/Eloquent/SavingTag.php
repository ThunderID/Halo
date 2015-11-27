<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

use \App\Jobs\ValidateTag as Validate;
use \App\Models\Tag as Model;
use \App\JSend;
use Hash;

class SavingTag extends Job implements SelfHandling
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
		// ------------------------------------------------------------------------
		// VALIDATE
		// ------------------------------------------------------------------------
		$js = $this->dispatch(new Validate($this->model->toArray()));
		if ($js->isFail())
		{
			$this->model->setErrors($js->getData());
		}
		else
		{
			// Check if same tag already exist
			$tag = Model::tag($this->model->tag)->first();
			if (!$tag)
			{
				return JSend::success($this->model);
			}
			else
			{
				return JSend::fail(['unique' => 'Tag already exists' ]);
			}
		}
		
		return $js;
	}
}
