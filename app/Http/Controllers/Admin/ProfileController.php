<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show the user's profile detail.
     */
    public function show()
    {
        $user = auth()->user();

        return view('admin.profile.show', compact('user'));
    }

    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $user = auth()->user();

        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Stream the authenticated user's profile photo from storage.
     */
    public function photo()
    {
        $user = auth()->user();

        if (! $user || ! $user->profile_photo) {
            abort(404);
        }

        if (Str::startsWith($user->profile_photo, 'uploads/')) {
            $publicPath = public_path($user->profile_photo);

            if (! file_exists($publicPath)) {
                abort(404);
            }

            return response()->file($publicPath, [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            ]);
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($user->profile_photo)) {
            abort(404);
        }

        return response()->file($disk->path($user->profile_photo), [
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone'         => ['nullable', 'string', 'max:20'],
            'address'       => ['nullable', 'string', 'max:500'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'name.required'          => 'Nama lengkap wajib diisi.',
            'email.required'         => 'Email wajib diisi.',
            'email.email'            => 'Format email tidak valid.',
            'email.unique'           => 'Email sudah digunakan oleh pengguna lain.',
            'phone.max'              => 'Nomor telepon maksimal 20 karakter.',
            'address.max'            => 'Alamat maksimal 500 karakter.',
            'profile_photo.image'    => 'File harus berupa gambar.',
            'profile_photo.mimes'    => 'Format gambar harus JPG, JPEG, atau PNG.',
            'profile_photo.max'      => 'Ukuran gambar maksimal 2 MB.',
        ]);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');

            // Delete old photo if exists
            if ($user->profile_photo) {
                if (Str::startsWith($user->profile_photo, 'uploads/')) {
                    $oldPublicPath = public_path($user->profile_photo);

                    if (file_exists($oldPublicPath)) {
                        @unlink($oldPublicPath);
                    }
                } elseif (Storage::disk('public')->exists($user->profile_photo)) {
                    Storage::disk('public')->delete($user->profile_photo);
                }
            }

            $ext      = $file->getClientOriginalExtension();
            $newName  = $user->id . '_' . time() . '.' . $ext;
            $targetDir = public_path('uploads/profile_photos');

            if (! is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $file->move($targetDir, $newName);
            $validated['profile_photo'] = 'uploads/profile_photos/' . $newName;
        }

        $user->update($validated);

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required'         => 'Password saat ini wajib diisi.',
            'current_password.current_password'  => 'Password saat ini tidak sesuai.',
            'password.required'                  => 'Password baru wajib diisi.',
            'password.min'                       => 'Password baru minimal 8 karakter.',
            'password.confirmed'                 => 'Konfirmasi password tidak cocok.',
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Password berhasil diperbarui.');
    }
}
