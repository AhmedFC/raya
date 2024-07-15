<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_task()
    {
        $task = Task::create([
            'name' => 'New Task',
        ]);

        $this->assertEquals('New Task', $task->name);
    }

    public function test_read_task()
    {
        $task = Task::create([
            'name' => 'Task to read',
        ]);

        $foundTask = Task::find($task->id);
        $this->assertEquals('Task to read', $foundTask->name);
    }

    public function test_update_task()
    {
        $task = Task::create([
            'name' => 'Task to update',
        ]);

        $task->update([
            'name' => 'Updated Task Name',
        ]);

        $updatedTask = Task::find($task->id);
        $this->assertEquals('Updated Task Name', $updatedTask->name);
    }

    public function test_delete_task()
    {
        $task = Task::create([
            'name' => 'Task to delete',
        ]);

        $task->delete();

        $deletedTask = Task::find($task->id);
        $this->assertNull($deletedTask);

    }
}
