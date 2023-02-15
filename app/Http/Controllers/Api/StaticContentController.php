<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\ContentResource;
use App\Models\Content;
use App\Models\HelpSupportMessage;
use App\Services\Api\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StaticContentController extends ApiController
{
    public function view(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug' => ['required', Rule::in( config('app.static_content_slugs') ) ]
        ]);

        if ($validator->fails()) {
            return $this->validation_error_response($validator);
        }

        $slug = $request->get('slug');

        $content = Content::where('slug', $slug)->first()
            ?? new Content(['slug' => $slug]);

        return ApiResponse::ok(
            \Illuminate\Support\Str::headline($content->slug),
            new ContentResource($content)
        );
    }

    public function help_support_message(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['nullable', 'string', 'max:191'],
            'email' => ['required', 'email', 'max:191'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        if ($validator->fails()) {
            return $this->validation_error_response($validator);
        }

        HelpSupportMessage::create($validator->validated());

        return ApiResponse::ok(__('Message received'));
    }
}
