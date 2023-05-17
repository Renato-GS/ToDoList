<h1>Tarefa de ID {{$task->id}}</h1>
<h2>Tarefa:{{$task->task}}</h2>
<h3>Criado em:{{$task->created_at}}</h3>

<form action="{{ route('todo.delete', $task->id) }}" method="post">
    <button type="submit">Apagar</button>
    @method('DELETE')
    @csrf()
</form>
