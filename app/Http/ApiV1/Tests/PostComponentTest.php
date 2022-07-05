<?php

use App\Http\ApiV1\Support\Tests\ApiV1ComponentTestCase;

use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;

uses(ApiV1ComponentTestCase::class);
uses()->group('component');

test('GET /api/v1/posts 200', function () {
    getJson('/api/v1/posts')
        ->assertStatus(200);
});

test('POST /api/v1/posts 200', function () {
    postJson('/api/v1/posts')
        ->assertStatus(200);
});

test('POST /api/v1/posts 400', function () {
    postJson('/api/v1/posts')
        ->assertStatus(400);
});

test('GET /api/v1/posts/{id} 200', function () {
    getJson('/api/v1/posts/{id}')
        ->assertStatus(200);
});

test('GET /api/v1/posts/{id} 404', function () {
    getJson('/api/v1/posts/{id}')
        ->assertStatus(404);
});

test('DELETE /api/v1/posts/{id} 200', function () {
    deleteJson('/api/v1/posts/{id}')
        ->assertStatus(200);
});

test('DELETE /api/v1/posts/{id} 404', function () {
    deleteJson('/api/v1/posts/{id}')
        ->assertStatus(404);
});

test('PATCH /api/v1/posts/{id} 200', function () {
    patchJson('/api/v1/posts/{id}')
        ->assertStatus(200);
});

test('PATCH /api/v1/posts/{id} 400', function () {
    patchJson('/api/v1/posts/{id}')
        ->assertStatus(400);
});

test('POST /api/v1/posts:search 200', function () {
    postJson('/api/v1/posts:search')
        ->assertStatus(200);
});

test('POST /api/v1/posts:search 400', function () {
    postJson('/api/v1/posts:search')
        ->assertStatus(400);
});
