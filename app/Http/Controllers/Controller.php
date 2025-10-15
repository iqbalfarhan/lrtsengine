<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected ?User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function pass(string $ability, mixed $arguments = null): bool
    {
        abort_unless($this->user?->can($ability, $arguments), 403);
        return true;
    }
}