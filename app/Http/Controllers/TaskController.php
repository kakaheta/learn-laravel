<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;


class TaskCOntroller extends Controller
{

    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * TaskCOntroller constructor.
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * @param Request $request
     * @return response
     */
    public function index(Request $request)
    {

        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        // Create The Task
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     * Destory the given task.
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {

        $this->authorize('destory', $task);

        // Delete The Task
        $task->delete();

        return redirect('/tasks');
    }
}
