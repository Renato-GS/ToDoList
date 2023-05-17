<h1>Editar Tarefa: {{ $task->id }}</h1>


<form action="{{route('todo.update', $task->id)}}" method="post">
    @csrf()
    @method('PUT')
    <input type="text"  placeholder="Tarefa" name="task" value="{{ $task->task }}">
    <button type="submit">Editar</button>
</form>

