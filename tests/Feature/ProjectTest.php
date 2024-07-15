<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_project()
    {
        $project = Project::create([
            'name' => 'New Project',
        ]);

        $this->assertEquals('New Project', $project->name);
    }

    public function test_read_project()
    {
        $project = Project::create([
            'name' => 'Project to read',
        ]);

        $foundProject = Project::find($project->id);
        $this->assertEquals('Project to read', $foundProject->name);
    }

    public function test_update_project()
    {
        $project = Project::create([
            'name' => 'Project to update',
        ]);

        $project->update([
            'name' => 'Updated Project Name',
        ]);

        $updatedProject = Project::find($project->id);
        $this->assertEquals('Updated Project Name', $updatedProject->name);
    }

    public function test_delete_project()
    {
        $project = Project::create([
            'name' => 'Project to delete',
        ]);

        $project->delete();

        $deletedProject = Project::find($project->id);
        $this->assertNull($deletedProject);
    }
}
