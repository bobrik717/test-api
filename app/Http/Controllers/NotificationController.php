<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->user
            ->notifications()
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->only(
            'name', 'period', 'pages_count', 'idealist', 'idealist_url', 'olx', 'olx_url', 'fb', 'fb_url', 'telegram_settings'
        );

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'period' => 'required|integer',
            'pages_count' => 'required|integer',
            'idealist' => 'required|integer',
            'idealist_url' => 'required_if:idealist,1',
            'olx' => 'required|integer',
            'olx_url' => 'required_if:olx,1',
            'fb' => 'required|integer',
            'fb_url' => 'required_if:fb,1',
            'telegram_settings' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        $notification = $this->user->notifications()->create([
            'name' => $data['name'],
            'period' => $data['period'],
            'pages_count' => $data['pages_count'],
            'idealist' => $data['idealist'],
            'idealist_url' => $data['idealist_url'],
            'olx' => $data['olx'],
            'olx_url' => $data['olx_url'],
            'fb' => $data['fb'],
            'fb_url' => $data['fb_url'],
            'telegram_settings' => $data['telegram_settings'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Notification created successfully',
            'data' => $notification
        ], Response::HTTP_OK);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $product = $this->user->products()->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, notification not found.'
            ], 400);
        }

        return $product;
    }

    /**
     * @param Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification): \Illuminate\Http\Response
    {
        //
    }

    /**
     * @param Request $request
     * @param Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification): \Illuminate\Http\Response
    {
        //
    }

    /**
     * @param Notification $notification
     * @return JsonResponse
     */
    public function destroy(Notification $notification): JsonResponse
    {
        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notification deleted successfully'
        ], Response::HTTP_OK);
    }
}
