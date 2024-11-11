<?php

namespace Tests\Unit;

use Tests\TestCase;
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

        //the test.
        $fakeTest = TaskController::create($fakeData);

        $this->assertModelExists($fakeTest);
    }

    public function test_task_can_be_deleted(): void
    {
        //setup
        $fakeTask = Task::create([
            'title' => '** title **',
            'description' => '** description **',
        ]);

        //the test.
        TaskController::delete($fakeTask->id);

        $this->assertModelMissing($fakeTask);
    }

    public function test_task_can_be_completed(): void
    {
        //setup
        $fakeTask = Task::create([
            'title' => '** title **',
            'description' => '** description **',
        ]);

        //the test.
        $fakeTask->markCompleted();

        $expected = true;
        $this->assertEquals($expected, $fakeTask->completed);
    }

    public function test_tasks_can_be_listed(): void
    {
        //setup
        $fakeTask1 = Task::create(['title' => '** title1 **', 'description' => '** description1 **']);
        $fakeTask2 = Task::create(['title' => '** title2 **', 'description' => '** description2 **']);
        $fakeTask3 = Task::create(['title' => '** title3 **', 'description' => '** description3 **']);

        $ids = [
            $fakeTask1->id,
            $fakeTask2->id,
            $fakeTask3->id,
        ];

        //the test
        $taskList = TaskController::getTasks($ids);

        $expected = '';
        $this->assertJsonStringEqualsJsonString($expected, $taskList);
    }
}
