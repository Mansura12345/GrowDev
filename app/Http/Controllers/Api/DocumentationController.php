<?php

namespace App\Http\Controllers\Api;

use App\Models\Documentation;
use App\Models\DocumentationTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class DocumentationController extends Controller
{
    /**
     * Get all documentation templates.
     */
    public function getTemplates(): JsonResponse
    {
        $templates = DocumentationTemplate::where('is_active', true)->get();

        return response()->json([
            'success' => true,
            'data' => $templates,
        ]);
    }

    /**
     * Get a specific template with its structure.
     */
    public function getTemplate($id): JsonResponse
    {
        $template = DocumentationTemplate::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $template,
        ]);
    }

    /**
     * Create a new documentation from a template.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:documentation_templates,id',
            'title' => 'required|string|max:255',
            'content' => 'required|array',
        ]);

        $documentation = Documentation::create([
            ...$validated,
            'created_by' => auth()->id(),
            'status' => 'draft',
            'version' => 1,
        ]);

        return response()->json([
            'success' => true,
            'data' => $documentation,
            'message' => 'Documentation created successfully',
        ], 201);
    }

    /**
     * Update a documentation.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $documentation = Documentation::findOrFail($id);
        $this->authorize('update', $documentation);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|array',
            'status' => 'sometimes|in:draft,review,approved',
        ]);

        $documentation->update($validated);

        return response()->json([
            'success' => true,
            'data' => $documentation,
            'message' => 'Documentation updated successfully',
        ]);
    }

    /**
     * Get a specific documentation.
     */
    public function show($id): JsonResponse
    {
        $documentation = Documentation::with(['template', 'diagrams', 'creator'])->findOrFail($id);
        $this->authorize('view', $documentation);

        return response()->json([
            'success' => true,
            'data' => $documentation,
        ]);
    }

    /**
     * Delete a documentation.
     */
    public function destroy($id): JsonResponse
    {
        $documentation = Documentation::findOrFail($id);
        $this->authorize('delete', $documentation);

        $documentation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Documentation deleted successfully',
        ]);
    }

    /**
     * List user's documentations.
     */
    public function list(): JsonResponse
    {
        $documentations = Documentation::where('created_by', auth()->id())
            ->with('template')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $documentations,
        ]);
    }
}
