<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use \App\Models\Website;
use \App\Jsend;

class DeleteWebsite extends Job implements SelfHandling
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        //
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $website = Website::find($this->id);

        if (!$website)
        {
            return JSend::fail(['website' => 'Data not found']);
        }
        else
        {
            if ($website->delete())
            {
                return JSend::success($website);
            }
            else
            {
                return JSend::fail($website->getErrors());
            }
        }
    }
}
