<?php

namespace App\Http\Controllers;

use Iam\Client\WebhookVerifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $rawBody = $request->getContent();
        $timestamp = (string) $request->header('X-IAM-Timestamp', '');
        $signature = (string) $request->header('X-IAM-Signature', '');
        $secret = (string) config('iam.webhook_secret');

        if (! $secret || ! WebhookVerifier::verify($rawBody, $timestamp, $signature, $secret)) {
            return response()->json(['error' => 'invalid_signature'], 401);
        }

        $data = json_decode($rawBody, true) ?: [];
        $eventType = (string) ($data['type'] ?? 'unknown');

        Log::info('[IAM Webhook] Event received in Portfolio Admin:', [
            'type' => $eventType,
            'data' => $data,
        ]);

        return response()->json(['received' => true]);
    }
}
