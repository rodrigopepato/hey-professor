<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, put};

it('should be able to update question', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    put(route('question.update', $question), [
        'question' => 'Update Question?',
    ])->assertRedirect(route('question.index'));

    $question->refresh();

    expect($question)
        ->question->toBe('Update Question?');

});

it('should make sure that only question with status DRAFT can be update', function () {

    $user            = User::factory()->create();
    $questionNoDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);

    $draftQuestion = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    put(route('question.update', $questionNoDraft))->assertForbidden();
    put(route('question.update', $draftQuestion), ['question' => 'New Question'])->assertRedirect();

});

it('should make sure that only the person who has created the question can update the question', function () {

    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    actingAs($wrongUser);
    put(route('question.update', $question))->assertForbidden();

    actingAs($rightUser);
    put(route('question.update', $question), ['question' => 'New Question'])->assertRedirect();

});

it('should be able to update a new question bigger than 255 characters', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 260) . '?',

    ]);

    $request->assertRedirect();
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);

});

it('should check if ends with question mark ?', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 10),

    ]);

    $request->assertSessionHasErrors([
        'question' => 'Are you sure that this is a question? It is missing the question mark in the end',
    ]);

    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]);

});

it('should have at least 10 characters', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 8) . '?',

    ]);

    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 1);

});
