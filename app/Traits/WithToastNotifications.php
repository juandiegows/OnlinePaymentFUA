<?php

namespace App\Traits;

trait WithToastNotifications
{

    public function showSuccess(string $title, string $message, int $duration = 3000): void
    {
        $this->emit('addNotification', [
            "type" => 'success',
            "title" => $title,
            "message" => $message,
            "duration" => $duration
        ]);
    }

    public function showDanger(string $title, string $message, int $duration = 3000): void
    {
        $this->emit('addNotification', [
            "type" => 'danger',
            "title" => $title,
            "message" => $message,
            "duration" => $duration
        ]);
    }

    public function showWarning(string $title, string $message, int $duration = 3000): void
    {
        $this->emit('addNotification', [
            "type" => 'warning',
            "title" => $title,
            "message" => $message,
            "duration" => $duration
        ]);
    }

    public function showInfo(string $title, string $message, int $duration = 3000): void
    {
        $this->emit('addNotification', [
            "type" => 'info',
            "title" => $title,
            "message" => $message,
            "duration" => $duration
        ]);
    }
}
