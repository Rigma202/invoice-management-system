<?php

namespace App\Http\Controllers;

use App\Services\StaffService;
use App\Http\Requests\StaffStoreRequest;
use App\Http\Requests\StaffUpdateRequest;

class StaffController extends Controller
{
    protected $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    public function index()
    {
        $staffs = $this->staffService->getAll();

        return view('staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new staff.
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created staff.
     */
    public function store(StaffStoreRequest $request)
    {
        $this->staffService->store(
            $request->validated()
        );

        return response()->json([
            'status' => true,
            'message' => 'Staff created successfully'
        ]);
    }

    /**
     * Show the form for editing the specified staff.
     */
    public function edit(int $id)
    {
        $staff = $this->staffService->find($id);

        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified staff.
     */
    public function update(
        StaffUpdateRequest $request,
        int $id
    ) {
        $this->staffService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'status' => true,
            'message' => 'Staff updated successfully'
        ]);
    }

    /**
     * Remove the specified staff.
     */
    public function destroy(int $id)
    {
        $this->staffService->delete($id);

        return response()->json([
            'status' => true,
            'message' => 'Staff deleted successfully'
        ]);
    }
}
