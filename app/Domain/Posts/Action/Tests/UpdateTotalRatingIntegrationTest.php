<?php
use App\Http\ApiV1\Support\Tests\ApiV1ComponentTestCase;
use App\Domain\Posts\Action\UpdateTotalRatingAction;
uses(ApiV1ComponentTestCase::class);
uses()->group('integration');

test('return type value = int', function () {
    $value = (new UpdateTotalRatingAction())->execute(1);
    expect($value)->toBeInt();
});