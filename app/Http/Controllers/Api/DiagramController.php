<?php

namespace App\Http\Controllers\Api;

use App\Models\Diagram;
use App\Models\Documentation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class DiagramController extends Controller
{
    /**
     * Store a newly created diagram.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'documentation_id' => 'required|exists:documentations,id',
            'type' => 'required|in:flowchart,sequence,class,gantt,er,state,pie',
            'mermaid_syntax' => 'required|string|min:3',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $documentation = Documentation::findOrFail($validated['documentation_id']);
        $this->authorize('update', $documentation);

        $diagram = Diagram::create([
            ...$validated,
            'created_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'data' => $diagram,
            'message' => 'Diagram created successfully',
        ], 201);
    }

    /**
     * Update the specified diagram.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $diagram = Diagram::findOrFail($id);
        $this->authorize('update', $diagram->documentation);

        $validated = $request->validate([
            'mermaid_syntax' => 'required|string|min:3',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $diagram->update($validated);

        return response()->json([
            'success' => true,
            'data' => $diagram,
            'message' => 'Diagram updated successfully',
        ]);
    }

    /**
     * Delete the specified diagram.
     */
    public function destroy($id): JsonResponse
    {
        $diagram = Diagram::findOrFail($id);
        $this->authorize('update', $diagram->documentation);

        $diagram->delete();

        return response()->json([
            'success' => true,
            'message' => 'Diagram deleted successfully',
        ]);
    }

    /**
     * Get all diagrams for a documentation.
     */
    public function getForDocumentation($documentationId): JsonResponse
    {
        $documentation = Documentation::findOrFail($documentationId);
        $this->authorize('view', $documentation);

        $diagrams = $documentation->diagrams()->get();

        return response()->json([
            'success' => true,
            'data' => $diagrams,
        ]);
    }
}
