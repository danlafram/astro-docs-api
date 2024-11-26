<?php

namespace App\Http\Controllers;

use App\Models\JobBatch;
use Illuminate\Http\Request;

class JobStatusController extends Controller
{
    /**
     * Thi
     */
    public function get_job_status(Request $request, $id)
    {
        $job = JobBatch::find($id);

        $progress = $job->progress();

        return response()->json([
            'progress' => $progress,
        ]);
    }
}
