<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function siteContent()
    {
        $settings = SiteSetting::current();

        return view('backEnd.pages.setting.siteContent', compact('settings'));
    }


    /**
     * Update a single section of the singleton settings row.
     * Route: PUT /admin/site-content/{section}
     */
    public function update(Request $request, string $section)
    {
        $settings = SiteSetting::current();

        [$rules, $fileFields] = $this->rulesFor($section);

        $validated = $request->validate($rules);

        // Strip any HTML tags from plain text/textarea fields so nobody can
        // inject <script>, onerror=, <img>, etc. through a normal input.
        // map_embed_code is handled separately below since it legitimately
        // needs an <iframe> tag.
        foreach ($validated as $key => $value) {
            if ($key === 'map_embed_code' || in_array($key, $fileFields, true)) {
                continue;
            }
            if (is_string($value)) {
                $validated[$key] = trim(strip_tags($value));
            }
        }

        if (array_key_exists('map_embed_code', $validated)) {
            $validated['map_embed_code'] = $this->sanitizeMapEmbed($validated['map_embed_code']);
        }

        // Handle file uploads (brand logo / hero image) for the sections that have them.
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $columnMap = [
                    'brand_logo' => 'brand_logo_path',
                    'hero_image' => 'hero_image_path',
                ];
                $column = $columnMap[$field] ?? null;

                if ($column) {
                    $destination = public_path('backAssets/upload/site content');

                    if ($settings->{$column} && file_exists(public_path($settings->{$column}))) {
                        @unlink(public_path($settings->{$column}));
                    }

                    $filename = uniqid() . '_' . $request->file($field)->getClientOriginalName();
                    $request->file($field)->move($destination, $filename);

                    $validated[$column] = 'backAssets/upload/site content/' . $filename;
                }
            }
            // Never let the raw file object reach $settings->update()
            unset($validated[$field]);
        }

        $settings->update($validated);

        return response()->json([
            'message' => ucfirst(str_replace('_', ' ', $section)) . ' updated successfully.',
            'settings' => $settings->fresh(),
        ]);
    }

    /**
     * Validation rules per section. Nothing outside this whitelist can ever
     * be written to the database — any extra/unexpected field sent by a
     * tampered request is simply ignored because $request->validate() only
     * returns the keys listed here.
     */
    private function rulesFor(string $section): array
    {
        return match ($section) {
            'brand' => [[
                'brand_logo_text' => ['required', 'string', 'max:100'],
                'brand_tagline'   => ['nullable', 'string', 'max:150'],
                'brand_logo'      => ['nullable', 'file', 'mimes:svg,png,jpg,jpeg,webp', 'max:5120'],
            ], ['brand_logo']],

            'hero' => [[
                'hero_headline' => ['required', 'string', 'max:200'],
                'hero_subtext'  => ['nullable', 'string', 'max:600'],
                'hero_image'    => ['nullable', 'file', 'mimes:svg,png,jpg,jpeg,webp', 'max:5120'],
            ], ['hero_image']],

            'info' => [[
                'legal_entity_name' => ['required', 'string', 'max:150'],
                'studio_location'   => ['nullable', 'string', 'max:150'],
                'map_embed_code'    => ['nullable', 'string', 'max:2000'],
            ], []],

            'services' => [[
                'services_headline' => ['nullable', 'string', 'max:200'],
                'services_subtext'  => ['nullable', 'string', 'max:600'],
                'services_bullets'  => ['nullable', 'string', 'max:1000'],
            ], []],

            'shop' => [[
                'shop_headline' => ['nullable', 'string', 'max:200'],
                'shop_subtext'  => ['nullable', 'string', 'max:600'],
                'shop_bullets'  => ['nullable', 'string', 'max:1000'],
            ], []],

            'contact' => [[
                'contact_email'    => ['required', 'email', 'max:150'],
                'contact_phone'    => ['nullable', 'string', 'max:30', 'regex:/^[0-9+\-\s()]+$/'],
                'business_hours'   => ['nullable', 'string', 'max:150'],
                'copyright_notice' => ['nullable', 'string', 'max:150'],
            ], []],

            'socials' => [[
                'instagram_url' => ['nullable', 'url', 'max:255'],
                'facebook_url'  => ['nullable', 'url', 'max:255'],
                'twitter_url'   => ['nullable', 'url', 'max:255'],
            ], []],

            default => abort(404, 'Unknown settings section.'),
        };
    }

    /**
     * Only allow a Google Maps <iframe> embed through. Anything else
     * (script tags, event handlers, non-Google src) is rejected outright
     * rather than partially cleaned, since partial cleaning of HTML is
     * unreliable.
     */
    private function sanitizeMapEmbed(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        $value = trim($value);

        // Must be a single <iframe ...></iframe> block.
        if (!preg_match('/^<iframe\b[^>]*><\/iframe>$/i', $value)) {
            abort(422, 'Map embed code must be a single valid <iframe> tag.');
        }

        // Block any event-handler attribute (onload=, onerror=, etc.)
        if (preg_match('/\son\w+\s*=/i', $value)) {
            abort(422, 'Map embed code contains disallowed attributes.');
        }

        // Only allow src pointing at Google Maps.
        if (!preg_match('/src=["\']https:\/\/www\.google\.com\/maps[^"\']*["\']/i', $value)) {
            abort(422, 'Map embed code must point to a google.com/maps source.');
        }

        return $value;
    }
}
