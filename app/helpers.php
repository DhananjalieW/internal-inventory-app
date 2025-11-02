<?php

use Illuminate\Support\Facades\DB;

if (! function_exists('activity_log')) {
    function activity_log(string $event, ?string $description = null, ?string $subjectType = null, ?int $subjectId = null, array $meta = []): void
    {
        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'event' => $event,
            'subject_type' => $subjectType,
            'subject_id' => $subjectId,
            'description' => $description,
            'meta' => $meta ? json_encode($meta) : null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


}
