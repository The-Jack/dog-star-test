<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    public function test_task_can_be_created(): void
    {
        //setup
        $fakeData = [
            'title' => '** title **',
            'description' => '** description **',
        ];
        $this->actingAs($user = User::factory()->create());


        //the test.
        $this->postJson(route('tasks.store', $fakeData))
            ->assertSuccessful();
    }

    public function test_task_can_be_deleted(): void
    {
        //setup
        $this->actingAs($user = User::factory()->create());
        $fakeTask = Task::create([
            'title' => '** title **',
            'description' => '** description **',
            'owner' => $user->id,
        ]);

        //the test.
        $this->postJson(route('tasks.delete', [ 'id' => $fakeTask->id]))
            ->assertSuccessful();

        $this->assertModelMissing($fakeTask);
    }

    public function test_task_can_be_completed(): void
    {
        //setup

        $this->actingAs($user = User::factory()->create());
        $fakeTask = Task::create([
            'title' => '** title **',
            'description' => '** description **',
            'owner' => $user->id,
        ]);

        //the test.
        $this->postJson(route('tasks.complete', [ 'id' => $fakeTask->id]))
            ->assertSuccessful();

        $expected = true;
        $this->assertEquals($expected, $fakeTask->fresh()->complete);
    }

    public function test_tasks_can_be_listed(): void
    {
        //setup
        $this->actingAs($user = User::factory()->create());
        $fakeTask1 = Task::create(['title' => '** title1 **', 'description' => '** description1 **', 'owner' => $user->id,]);
        $fakeTask2 = Task::create(['title' => '** title2 **', 'description' => '** description2 **', 'owner' => $user->id,]);
        $fakeTask3 = Task::create(['title' => '** title3 **', 'description' => '** description3 **', 'owner' => $user->id,]);

        //the test
        $this->get(route('tasks.list'))
            ->assertSuccessful();
    }
}
