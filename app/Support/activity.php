<?php

use App\Models\ActivityLog;

if (! function_exists('activity')) {
    function activity(string $event, ?object $subject = null, ?string $description = null, array $meta = []): void
    {
        ActivityLog::create([
            'user_id'      => auth()->id(),
            'event'        => $event,
            'subject_type' => $subject ? get_class($subject) : null,
            'subject_id'   => $subject->id ?? null,
            'description'  => $description,
            'meta'         => $meta ?: null,
        ]);
    }
}
