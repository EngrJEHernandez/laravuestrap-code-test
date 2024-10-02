<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

Artisan::command('fetch:posts', function () {
    $response = Http::get('https://jsonplaceholder.typicode.com/posts');

    if ($response->successful()) {
        foreach ($response->json() as $postData) {
            \App\Models\Post::updateOrCreate(
                ['id' => $postData['id']],
                [
                    'title' => $postData['title'],
                    'body' => $postData['body'],
                    'user_id' => $postData['userId'],
                ]
            );
        }
        $this->info('Posts fetched successfully.');
    } else {
        $this->error('Failed to fetch posts from API.');
    }
})->describe('Fetch posts from the JSONPlaceholder API');
