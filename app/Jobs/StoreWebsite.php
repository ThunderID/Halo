<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use \App\JSend;
use \App\Models\Website;

class StoreWebsite extends Job implements SelfHandling
{
    protected $website_data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $website_data, $id = null)
    {
        //
        $this->website_data = $website_data;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // ----------------------------------------------------------------------------------------------------------------
        // SAVE WEBSITE
        // ----------------------------------------------------------------------------------------------------------------
        if ($this->id)
        {
            $website = Website::find($this->id);
            if (!$website)
            {
                return JSend::fail(['Website' => 'ID not found']);
            }
        }
        else
        {
            $website = new Website;
        }
        $website->fill($this->website_data);

        if ($website->save())
        {
            return JSend::success($website);
        }
        else
        {
            return JSend::fail($website->getErrors());
        }
    }
}
