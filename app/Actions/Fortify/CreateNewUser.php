<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'user_type' => ['required', 'string'],
            // Make these fields optional
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png'], // Assuming image is a file upload
            'cover_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png'], // Assuming cover_image is a file upload
            'company_url' => ['nullable', 'url'],
            'facebook_url' => ['nullable', 'url'],
            'linkedin_url' => ['nullable', 'url'],
            'instagram_url' => ['nullable', 'url'],
            'twitter_url' => ['nullable', 'url'],
            'location' => ['nullable', 'string'],
        ])->validate();

        $status = $input['user_type'] === 'company' ? 'inactive' : 'active';
        // Handle file uploads safely
        $imagePath = $input['image'] ?? null;
        if ($imagePath instanceof \Illuminate\Http\UploadedFile) {
            $imagePath = $imagePath->store('images', 'public');
        }

        $coverImagePath = $input['cover_image'] ?? null;
        if ($coverImagePath instanceof \Illuminate\Http\UploadedFile) {
            $coverImagePath = $coverImagePath->store('cover_images', 'public');
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'user_type' => $input['user_type'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'description' => $input['description'],
            'status' => $status,
            'image' => $imagePath,
            'cover_image' => $coverImagePath,
            'company_url' => $input['company_url'],
            'facebook_url' => $input['facebook_url'],
            'linkedin_url' => $input['linkedin_url'],
            'instagram_url' => $input['instagram_url'],
            'twitter_url' => $input['twitter_url'],
            'location' => $input['location'],
            'password' => Hash::make($input['password']),
        ]);

        
    }
    
}
