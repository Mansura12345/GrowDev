<?php

namespace App\Http\Controllers;

use App\Models\Diagram;
use App\Models\Documentation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DiagramController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of diagrams for a documentation.
     */
    public function index(Documentation $documentation): JsonResponse
    {
        $this->authorize('view', $documentation);

        $diagrams = $documentation->diagrams()->with('creator')->get();

        return response()->json([
            'success' => true,
            'data' => $diagrams,
        ]);
    }

    /**
     * Store a newly created diagram.
     */
    public function store(Request $request, Documentation $documentation): JsonResponse
    {
        $this->authorize('update', $documentation);

        try {
            $validated = $request->validate([
                'type' => 'required|in:flowchart,sequence,class,gantt,er,state,pie',
                'mermaid_syntax' => 'required|string|min:3',
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:1000',
            ]);

            // Validate Mermaid syntax
            if (!Diagram::validateMermaidSyntax($validated['mermaid_syntax'])) {
                throw ValidationException::withMessages([
                    'mermaid_syntax' => 'Invalid Mermaid syntax provided.',
                ]);
            }

            $diagram = Diagram::create([
                'documentation_id' => $documentation->id,
                'type' => $validated['type'],
                'mermaid_syntax' => $validated['mermaid_syntax'],
                'title' => $validated['title'] ?? 'Untitled Diagram',
                'description' => $validated['description'],
                'created_by' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Diagram created successfully.',
                'data' => $diagram->load('creator'),
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Display the specified diagram.
     */
    public function show(Diagram $diagram): JsonResponse
    {
        $this->authorize('view', $diagram->documentation);

        return response()->json([
            'success' => true,
            'data' => $diagram->load('creator', 'documentation'),
        ]);
    }

    /**
     * Update the specified diagram.
     */
    public function update(Request $request, Diagram $diagram): JsonResponse
    {
        $this->authorize('update', $diagram->documentation);

        try {
            $validated = $request->validate([
                'mermaid_syntax' => 'required|string|min:3',
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:1000',
                'type' => 'nullable|in:flowchart,sequence,class,gantt,er,state,pie',
            ]);

            // Validate Mermaid syntax
            if (!Diagram::validateMermaidSyntax($validated['mermaid_syntax'])) {
                throw ValidationException::withMessages([
                    'mermaid_syntax' => 'Invalid Mermaid syntax provided.',
                ]);
            }

            $diagram->update($validated);

            // Broadcast update via event (if WebSockets configured)
            // event(new DiagramUpdated($diagram));

            return response()->json([
                'success' => true,
                'message' => 'Diagram updated successfully.',
                'data' => $diagram,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Remove the specified diagram.
     */
    public function destroy(Diagram $diagram): JsonResponse
    {
        $this->authorize('delete', $diagram->documentation);

        $diagram->delete();

        return response()->json([
            'success' => true,
            'message' => 'Diagram deleted successfully.',
        ]);
    }

    /**
     * Get diagram preview (render as SVG).
     */
    public function preview(Diagram $diagram)
    {
        $this->authorize('view', $diagram->documentation);

        // This would integrate with Mermaid CLI or API
        // For now, returning the Mermaid syntax for client-side rendering
        return response()->json([
            'success' => true,
            'type' => $diagram->type,
            'syntax' => $diagram->mermaid_syntax,
            'title' => $diagram->title,
        ]);
    }

    /**
     * Export diagram as SVG.
     */
    public function exportSvg(Diagram $diagram)
    {
        $this->authorize('view', $diagram->documentation);

        // This would integrate with Mermaid CLI or an external service
        // For now, returning placeholder
        return response()->json([
            'success' => true,
            'message' => 'Export functionality coming soon.',
        ]);
    }

    /**
     * Validate Mermaid syntax without saving.
     */
    public function validateSyntax(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'syntax' => 'required|string|min:3',
            ]);

            $isValid = Diagram::validateMermaidSyntax($validated['syntax']);

            return response()->json([
                'success' => true,
                'isValid' => $isValid,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        }
    }
}
