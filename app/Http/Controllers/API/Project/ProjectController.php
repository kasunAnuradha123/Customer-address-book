<?php

namespace App\Http\Controllers\API\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Project\ProjectCreateRequest;
use App\Http\Requests\API\Project\ProjectUpdateRequest;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use App\Repositories\Interfaces\Project\ProjectRepositoryInterface;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository, protected ProjectRepositoryInterface $projectRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @return [type]
     */
    public function index()
    {
        try {
            $project = $this->projectRepository->all();
            return response()->json([
                'message' => 'Project retrieved successfully',
                'project' => $project
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param ProjectCreateRequest $request
     * 
     * @return [type]
     */
    public function store(ProjectCreateRequest $request)
    {
        try {
            $project = $this->projectRepository->create($request->all());
            return response()->json([
                'message' => 'Project created successfully',
                'project' => $project
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function show(int $id)
    {
        try {
            $project = $this->projectRepository->findById($id);
            return response()->json([
                'message' => 'Project retrieved successfully',
                'project' => $project
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function edit(int $id)
    {
        try {
            $project = $this->projectRepository->findById($id);
            return response()->json([
                'message' => 'Project retrieved successfully',
                'project' => $project
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    /**
     * @param ProjectUpdateRequest $request
     * @param int $id
     * 
     * @return [type]
     */
    public function update(ProjectUpdateRequest $request, int $id)
    {
        try {
            $project = $this->projectRepository->update($id, $request->all());
            return response()->json([
                'message' => 'Project updated successfully',
                'project' => $project
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function destroy(int $id)
    {
        try {
            $this->projectRepository->deleteById($id);
            return response()->json([
                'message' => 'Project deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
