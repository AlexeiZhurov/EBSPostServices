<?php

use App\Http\ApiV1\Support\Tests\ApiV1ComponentTestCase;
use Database\Factories\PostFactory;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;

uses(ApiV1ComponentTestCase::class);
uses()->group('component');

test('POST|/api/v1/posts|200', function () {
    $testData = PostFactory::new()->definition();
    postJson('/api/v1/posts', $testData)->assertStatus(200);
});

test('POST|/api/v1/posts|400', function () {
    postJson('/api/v1/posts')
        ->assertStatus(400);
});

test("GET|api/v1/posts/{id}|200'", function () {
    $id = PostFactory::new()->create()->id;
    getJson('/api/v1/posts/' . $id)->assertStatus(200);
});

test('GET|/api/v1/posts/{id}|404', function () {
    getJson('/api/v1/posts/100000')
        ->assertStatus(404);
});

test('POST|/api/v1/posts:all|200', function () {
    PostFactory::new()->count(7)->create();
    postJson('/api/v1/posts:all')->assertStatus(200);
});


test('DELETE|/api/v1/posts/{id}|200', function () {
    $id = PostFactory::new()->create()->id;
    deleteJson('/api/v1/posts/' . $id)
        ->assertStatus(200);
});

test('DELETE|/api/v1/posts/{id}|404', function () {
    deleteJson('/api/v1/posts/11111111111')
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
    $testData = ['filter' => ['user_id' => -100]];
    postJson('/api/v1/posts:search', $testData)->assertStatus(400);
});

test('RBC|POST|api/v1/posts', function () {
    $testData = PostFactory::new()->definition();
    $testResponse = postJson('/api/v1/posts', $testData);
    $testResponse->assertJson(
        fn (AssertableJson $json) => $json
            ->has('data')
            ->has('data.id')
            ->where('data.title', $testData['title'])
            ->where('data.preview', $testData['preview'])
            ->where('data.text', $testData['text'])
            ->where('data.tags', $testData['tags'])
            ->where('data.user_id', $testData['user_id'])
            ->has('data.created_at')
            ->etc()
    );
});
test('RBC|POST|/api/v1/posts:all', function () {
    PostFactory::new()->count(7)->create();
    $testResponse = postJson('/api/v1/posts:all');
    $testResponse->assertJson(
        fn (AssertableJson $json) => $json
            ->has('data')
            ->has('meta')
            ->where('meta.pagination.total', 7)
    );
});
test('RBC|PATCH|/api/v1/posts/{id}', function () {
    $factory = new PostFactory();
    $id = $factory->create()->id;
    $testData = $factory->definition();
    $testResponse = patchJson('/api/v1/posts/' . $id, $testData);
    $testResponse->assertJson(
        fn (AssertableJson $json) => $json
            ->has('data')
            ->has('data.id')
            ->where('data.title', $testData['title'])
            ->where('data.preview', $testData['preview'])
            ->where('data.text', $testData['text'])
            ->where('data.tags', $testData['tags'])
            ->has('data.created_at')
            ->etc()
    );
});

test('RBC|POST|/api/v1/posts:search', function () {
    $testResponse = postJson('/api/v1/posts:search');
    $testResponse->assertJson(
        fn (AssertableJson $json) => $json
            ->has('data')
            ->has('meta')
    );
});
test('RBC|DELETE|/api/v1/posts/{id}', function () {
    $id = PostFactory::new()->create()->id;
    $testResponse = deleteJson('/api/v1/posts/' . $id);
    $testResponse->assertJson(
        fn (AssertableJson $json) => $json
            ->has('data')
            ->where('data', null)
    );
});
