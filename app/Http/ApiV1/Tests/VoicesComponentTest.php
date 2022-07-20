<?php

use App\Http\ApiV1\Support\Tests\ApiV1ComponentTestCase;
use Database\Factories\VoiceFactory;
use Database\Factories\PostFactory;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;

uses(ApiV1ComponentTestCase::class);
uses()->group('component');

test('GET|/api/v1/posts/{id}/voices|200', function () {
    $postId = (new PostFactory())->create()->id;
    (new VoiceFactory())->state([
        'post_id' => $postId,
    ])->count(10)->create();
    getJson("/api/v1/posts/{$postId}/voices")->assertStatus(200);
});

test('GET|/api/v1/posts/{id}/voices|404', function () {
    getJson('/api/v1/posts/1000000/voices')
        ->assertStatus(404);
});

test('POST|/api/v1/posts/{id}/voices|200', function () {
    $postId = (new PostFactory())->create()->id;
    $testData = (new VoiceFactory())->definition();
    postJson("/api/v1/posts/{$postId}/voices", $testData)->assertStatus(200);
});

test('POST|/api/v1/posts/{id}/voices|400', function () {
    $postId = (new PostFactory())->create()->id;
    postJson("/api/v1/posts/{$postId}/voices")->assertStatus(400);
});

test('DELETE|/api/v1/posts/{id}/voices|200', function () {
    $postId = (new PostFactory())->create()->id;
    (new VoiceFactory())->state([
        'post_id' => $postId,
    ])->count(10)->create();
    deleteJson("/api/v1/posts/{$postId}/voices")->assertStatus(200);
});

test('DELETE|/api/v1/posts/{id}/voices|404', function () {
    deleteJson('/api/v1/posts/1000000/voices')
        ->assertStatus(404);
});

test('DELETE|/api/v1/posts/{id}/voices/{voiceId}|200', function () {
    $postId = (new PostFactory())->create()->id;
    $voiceId = (new VoiceFactory())->state(['post_id' => $postId])->create()->id;
    deleteJson("/api/v1/posts/{$postId}/voices/{$voiceId}")->assertStatus(200);
});

test('DELETE|/api/v1/posts/{id}/voices/{voiceId}|404', function () {
    deleteJson('/api/v1/posts/100000/voices/100000')->assertStatus(404);
});

test('PATCH /api/v1/posts/{id}/voices/{voiceId} 200', function () {
    $postId = (new PostFactory())->create()->id;
    $voiceFactory = new VoiceFactory();
    $voiceId = $voiceFactory->state(['post_id' => $postId])->create()->id;
    $testData = $voiceFactory->definition();
    patchJson("/api/v1/posts/{$postId}/voices/{$voiceId}", $testData)->assertStatus(200);
});

test('PATCH /api/v1/posts/{id}/voices/{voiceId} 400', function () {
    $postId = (new PostFactory())->create()->id;
    $voiceFactory = new VoiceFactory();
    $voiceId = $voiceFactory->state(['post_id' => $postId])->create()->id;
    $testData = ['voices' => 0];
    patchJson("/api/v1/posts/{$postId}/voices/{$voiceId}", $testData)->assertStatus(400);
});

test('POST /api/v1/posts/voices:search 200', function () {
    $postId = (new PostFactory())->create()->id;
    $testData = ['filter' =>['post_id' => $postId]];
    postJson('/api/v1/posts/voices:search',$testData)->assertStatus(200);
});

test('POST /api/v1/posts/voices:search 400', function () {
    $testData = ['filter' =>['post_id' => -1]];
    postJson('/api/v1/posts/voices:search',$testData)->assertStatus(400);
});
