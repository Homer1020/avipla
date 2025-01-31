<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Log;

class FamilyImage implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value && !in_array($value->getClientOriginalExtension(), ['png', 'jpg', 'jpeg'])) return;
        
        $cloudinaryUpload = cloudinary()->upload($value->getRealPath());
        $cloudinaryPath = $cloudinaryUpload->getSecurePath();
        $categorizer = 'adult_content';

        $api_credentials = array(
            'key' => 'acc_cf0397ea3ba4ed0',
            'secret' => 'c0b79e56481d3c390e36613540905edb'
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.imagga.com/v2/categories/'.$categorizer.'?image_url='.urlencode($cloudinaryPath));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_USERPWD, $api_credentials['key'].':'.$api_credentials['secret']);

        $response = curl_exec($ch);
        curl_close($ch);

        $json_response = json_decode($response);

        Log::info($response);

        $publicId = $cloudinaryUpload->getPublicId();
        cloudinary()->destroy($publicId);

        $result = false;

        if(isset($json_response->result->categories)) {
            $categories = (array) $json_response->result->categories;

            $result = array_filter($categories, function($value) {
                return $value->name->en === 'safe';
            });
        }

        if(!$result || array_values($result)[0]->confidence < 50) {
            $fail('La inteligencia artificial detectó contenido inapropiado.');
        }
    }
}
