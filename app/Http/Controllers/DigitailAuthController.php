<?php

namespace App\Http\Controllers;

use App\Services\DigitailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DigitailAuthController extends Controller
{
    protected $digitailService;

    public function __construct(DigitailService $digitailService)
    {
        $this->digitailService = $digitailService;
    }

    /**
     * Redirect to Digitail OAuth page
     */
    public function redirect()
    {
        try {
            $url = $this->digitailService->getAuthorizationUrl();
            return redirect($url);
        } catch (\Exception $e) {
            Log::error('Digitail Auth Redirect Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to initialize Digitail authentication. Check application logs for details.');
        }
    }

    /**
     * Handle Digitail OAuth callback
     */
    public function handleCallback(Request $request)
    {
        try {
            $code = $request->input('code');
            $state = $request->input('state');

            if (!$code || !$state) {
                throw new \Exception('Missing code or state parameter.');
            }

            $this->digitailService->handleCallback($code, $state);

            return redirect()->route('admin.digitail-sync.status')
                ->with('success', 'Successfully connected to Digitail!');
        } catch (\Exception $e) {
            Log::error('Digitail Auth Callback Error: ' . $e->getMessage());
            return redirect()->route('admin.digitail-sync.status')
                ->with('error', 'Failed to authenticate with Digitail. Check application logs for details.');
        }
    }
}
