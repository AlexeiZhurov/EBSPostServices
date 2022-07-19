<?php

use App\Http\ApiV1\Support\Tests\ApiV1ComponentTestCase;

use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\get;

uses(ApiV1ComponentTestCase::class);
uses()->group('component');

test('POST|/api/v1/posts|200', function () {
    $testData = ['title' => 'post', 'preview' => 'https://laravel.com/docs/9.x/database-testing', 'tags' => 'php,js', 'text' => 'post', 'user_id' => 1];
    postJson('/api/v1/posts', $testData)->assertStatus(200);
});

test("POST|api/v1/posts/{id}|200'", function () {
    getJson('/api/v1/posts/1')->assertStatus(200);
});

test('POST|/api/v1/posts:all|200', function () {
    postJson('/api/v1/posts:all')->assertStatus(200);
});

test('POST|/api/v1/posts|400', function () {
    postJson('/api/v1/posts')
        ->assertStatus(400);
});
test('GET|/api/v1/posts/{id}|404', function () {
    getJson('/api/v1/posts/100000')
        ->assertStatus(404);
});

test('DELETE|/api/v1/posts/{id}|200', function () {
    deleteJson('/api/v1/posts/1')
        ->assertStatus(200);
});

test('DELETE|/api/v1/posts/{id}|404', function () {
    deleteJson('/api/v1/posts/100000')
        ->assertStatus(404);
});

test('PATCH|/api/v1/posts/{id}|200', function () {
    $testData = ['title' => 'post', 'preview' => 'https://laravel.com/docs/9.x/database-testing', 'tags' => 'php,js', 'text' => 'post', 'user_id' => 1];
    patchJson('/api/v1/posts/1', $testData)->assertStatus(200);
});

// test('PATCH /api/v1/posts/{id} 400', function () {
//     patchJson('/api/v1/posts/1')->assertStatus(400);
// });

test('POST|/api/v1/posts:search|200', function () {
    postJson('/api/v1/posts:search')->assertStatus(200);
});

