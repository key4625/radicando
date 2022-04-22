<?php

namespace App\Http\Controllers\Backend;

use App\Models\Plant;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $actual_month = intval(date('n'));
        $piante_semina_mese = Plant::piante_semina_mese($actual_month);
        $piante_semina_out_mese = Plant::piante_semina_out_mese($actual_month);
        $piante_trapianto_mese = Plant::piante_trapianto_mese($actual_month);
        return view('backend.dashboard',compact('piante_semina_mese','piante_semina_out_mese','piante_trapianto_mese'));
    }
}
