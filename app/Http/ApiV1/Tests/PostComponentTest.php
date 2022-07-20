<?php

use App\Http\ApiV1\Support\Tests\ApiV1ComponentTestCase;
use Database\Factories\PostFactory;

use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;

uses(ApiV1ComponentTestCase::class);
uses()->group('component');

test('POST|/api/v1/posts|200', function () {
    $testData = (new PostFactory())->definition();
    postJson('/api/v1/posts', $testData)->assertStatus(200);
});

test('POST|/api/v1/posts|400', function () {
    postJson('/api/v1/posts')
        ->assertStatus(400);
});

test("GET|api/v1/posts/{id}|200'", function () {
    $id = (new PostFactory())->create()->id;
    getJson('/api/v1/posts/' . $id)->assertStatus(200);
});

test('GET|/api/v1/posts/{id}|404', function () {
    getJson('/api/v1/posts/100000')
        ->assertStatus(404);
});

test('POST|/api/v1/posts:all|200', function () {
    (new PostFactory())->count(7)->create();
    postJson('/api/v1/posts:all')->assertStatus(200);
});


test('DELETE|/api/v1/posts/{id}|200', function () {
    $id = (new PostFactory())->create()->id;
    deleteJson('/api/v1/posts/' . $id)
        ->assertStatus(200);
});

test('DELETE|/api/v1/posts/{id}|404', function () {
    deleteJson('/api/v1/posts/100000')
        ->assertStatus(404);
});

test('PATCH|/api/v1/posts/{id}|200', function () {
    $factory = new PostFactory();
    $id = $factory->create()->id;
    $testData = $factory->definition();
    patchJson('/api/v1/posts/' . $id, $testData)->assertStatus(200);
});

test('PATCH /api/v1/posts/{id} 400', function () {
    $factory = new PostFactory();
    $id = $factory->create()->id;
    $testData = ['title' => 0];
    patchJson('/api/v1/posts/' . $id, $testData)->assertStatus(400);
});

test('POST|/api/v1/posts:search|200', function () {
    postJson('/api/v1/posts:search')->assertStatus(200);
});


test('POST|/api/v1/posts:search|400', function () {
    $testData = ['filter' => ['user_id'=>-100]];
    postJson('/api/v1/posts:search',$testData)->assertStatus(400);
});
