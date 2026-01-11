<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function currentUser(): ?array
{
    return $_SESSION['user'] ?? null;
}

function hasRole(string $role): bool
{
    $user = currentUser();
    if (!$user) return false;
    return strtoupper($user['role'] ?? '') === strtoupper($role);
}

function hasAnyRole(array $roles): bool
{
    $user = currentUser();
    if (!$user) return false;
    $r = strtoupper($user['role'] ?? '');
    foreach ($roles as $role) {
        if ($r === strtoupper($role)) return true;
    }
    return false;
}
