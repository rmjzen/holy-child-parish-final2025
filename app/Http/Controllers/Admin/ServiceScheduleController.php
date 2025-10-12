<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SacramentalService;
use Illuminate\Http\Request;

class ServiceScheduleController extends Controller
{
    public function index(){
        $sacramentalServices = SacramentalService::all();
        return view('admin.service_schedule.index', compact('sacramentalServices'));
    }
     public function edit($id)
    {
        $service = SacramentalService::findOrFail($id);
        return view('admin.service_schedule.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service_type' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string',
            'full_name' => 'required|string',
            'contact_number' => 'required|string',
        ]);

        $service = SacramentalService::findOrFail($id);
        $service->update($request->all());

        return redirect()->route('service_schedule.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = SacramentalService::findOrFail($id);
        $service->delete();

        return redirect()->route('service_schedule.index')->with('success', 'Service deleted successfully.');
    }
}
