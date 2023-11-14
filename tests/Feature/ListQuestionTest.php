<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should list all the question', function () {
    // Arrange

    $user      = User::factory()->create();
    $questions = Question::factory()->count(5)->create();

    actingAs($user);

    // Act
    $response = get(route('dashboard'));

    // Assert

    /** @var  Question  $q */
    foreach ($questions as $q) {

        $response->assertSee($q->question);
    }

});
