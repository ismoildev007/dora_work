<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportResource;
use App\Models\Report;

class ApiController extends Controller
{
    public function report()
    {
        $reports = Report::all();
        return response()->json(['data' => ReportResource::collection($reports), 'status' => 200, 'success' => true]);
    }

    public function department($department){
        $department = Report::where('department_id', $department)->get();
        return response()->json(['data' => ReportResource::collection($department), 'status' => 200, 'success' => true]);
    }


}
