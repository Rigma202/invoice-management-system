<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\StaffCredentialsMail;

class StaffService
{
    public function getAll()
    {
        return User::where('role', 'staff')
            ->latest()
            ->get();
    }

    public function find($id)
    {
        return User::where('role', 'staff')
            ->findOrFail($id);
    }

    public function store(array $data)
    {
        $password = Str::random(10);

        $staff = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'role'     => 'staff',
            'password' => Hash::make($password),
        ]);

        Mail::to($staff->email)
            ->queue(new StaffCredentialsMail($staff, $password));

        return $staff;
    }

    public function update($id, array $data)
    {
        $staff = User::where('role', 'staff')
            ->findOrFail($id);

        $staff->update([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        return $staff;
    }

    public function delete($id)
    {
        $staff = User::where('role', 'staff')
            ->findOrFail($id);

        return $staff->delete();
    }
}
