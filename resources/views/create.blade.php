<h1>Criar Tarefa</h1>


<form action="{{route('todo.store')}}" method="POST">
    <!--<input type="hidden" value="{{ csrf_token() }}" name="_token">-->
    @csrf()
    <input type="text" placeholder="Tarefa" name="task">
    <!-- <textarea name="" id="" cols="30" rows="10"></textarea> -->
    <button type="submit">Adicionar</button>
</form>
