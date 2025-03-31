<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MotelroomResource;
use App\Motelroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MotelroomController extends Controller
{
    public function index()
    {
        $motelrooms = Motelroom::with(['category', 'user', 'district'])
            ->where('approve', 1)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return MotelroomResource::collection($motelrooms);
    }

    public function show($slug)
    {
        $motelroom = Motelroom::with(['category', 'user', 'district'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment view count
        $motelroom->increment('count_view');

        return new MotelroomResource($motelroom);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'area' => 'required|integer|min:0',
            'address' => 'required|string',
            'images' => 'required|array',
            'latlng' => 'required|array',
            'phone' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'district_id' => 'required|exists:districts,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $motelroom = Motelroom::create([
            ...$request->all(),
            'user_id' => auth()->id(),
            'approve' => false,
            'count_view' => 0
        ]);

        return new MotelroomResource($motelroom);
    }

    public function update(Request $request, $id)
    {
        $motelroom = Motelroom::findOrFail($id);

        // Check if user owns the motelroom
        if ($motelroom->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|integer|min:0',
            'area' => 'sometimes|integer|min:0',
            'address' => 'sometimes|string',
            'images' => 'sometimes|array',
            'latlng' => 'sometimes|array',
            'phone' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
            'district_id' => 'sometimes|exists:districts,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $motelroom->update($request->all());

        return new MotelroomResource($motelroom);
    }

    public function destroy($id)
    {
        $motelroom = Motelroom::findOrFail($id);

        // Check if user owns the motelroom
        if ($motelroom->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $motelroom->delete();

        return response()->json(['message' => 'Motelroom deleted successfully']);
    }

    public function search(Request $request)
    {
        $query = Motelroom::with(['category', 'user', 'district'])
            ->where('approve', 1);

        if ($request->has('district_id')) {
            $query->where('district_id', $request->district_id);
        }

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $motelrooms = $query->orderBy('id', 'desc')->paginate(10);

        return MotelroomResource::collection($motelrooms);
    }
} 