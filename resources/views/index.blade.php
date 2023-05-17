<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script
        src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
        crossorigin="anonymous"></script>

    <title>ToDo</title>
</head>
<body>


<ul style="width: 40%; margin: 50px auto" class="list-group">
    <form class="form-inline" action="{{route('todo.store')}}" method="POST">
        @csrf()
        <!-- <div class="form-group mb-2 w-100 p-2" style="background-color: #bdc3c7; border-radius: 5px"> -->
        <div class="row">
            <div class="col col-11 my-3 w-100">
                <div class="row bg-white rounded shadow-sm p-2 add-todo-wrapper align-items-center justify-content-center">
                    <div class="col">
                        <input class="form-control form-control-lg border-0 add-todo-input bg-transparent rounded" type="text" placeholder="Adicionar tarefa" name="task">
                    </div>
                    <div class="col-auto m-0 px-2 d-flex align-items-center">
                        <label class="text-secondary my-2 p-0 px-1 view-opt-label due-date-label d-none">Due date not set</label>
                        <i class="fa fa-calendar my-2 px-1 text-primary btn due-date-button" data-toggle="tooltip" data-placement="bottom" title="Set a Due date"></i>
                        <i class="fa fa-calendar-times-o my-2 px-1 text-danger btn clear-due-date-button d-none" data-toggle="tooltip" data-placement="bottom" title="Clear Due date"></i>
                    </div>
                    <div class="col-auto px-0 mx-0 mr-0">
                        <button type="submit" class="btn btn-primary"><i class="bi-plus" ></i></button>
                    </div>
                </div>
            </div>

        </div>
    </form>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-query="todos" data-bs-toggle="tab" data-bs-target="#todos" type="button" role="tab" aria-controls="todos" aria-selected="true">Todos</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-query="ativos" data-bs-toggle="tab" data-bs-target="#ativos" type="button" role="tab" aria-controls="ativos" aria-selected="false">Ativos</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-query="finalizados" data-bs-toggle="tab" data-bs-target="#finalizados" type="button" role="tab" aria-controls="finalizados" aria-selected="false">Finalizados</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
    </div>


    <script>
        let triggers = [].slice.call(document.querySelectorAll('#myTab a'))
        let query = "todos";
        fetchTodos(query);

        triggers.forEach(function (trigger) {
            trigger.addEventListener('click', function (event) {
                event.preventDefault();//para redirecionar
                query = $(this).attr('data-query');
                fetchTodos(query);
            });
        });

        function fetchTodos(_query = 'todos') {//recebe o valor para o filtro
            let url = '/public/filter/' + _query
            $.get(url, function (data) {

                $("#myTabContent").empty();//lipar a div
                data.forEach(function (valor) {
                    createListItem(valor);
                });
                addCheckClickListener();
            });
        }



        function createListItem(valor) {
            let traco = valor.task
            if (valor.status == 'c'){
                traco = '<s>' +valor.task+ '</s>'
            }

            let listItem = "<li class='list-group-item d-flex flex-row justify-content-between'>" +
                "<div class='form-check d-flex flex-row align-items-center'>" +
                "<a class='btn check' data-id=" + valor.id + "><i class='bi-check-lg'></i></a>" +
                "<label class='form-check-label'> <p>" + traco + "</p></label>" +
                "</div>" +
                "<div class='d-flex align-items-center'>" +
                "<a class='btn trash' data-id=" + valor.id + "><i class='bi-trash'></i></a>" +
                "</div>" +
                "</li>"

                console.log(listItem)
            $("#myTabContent").append(listItem); //adicionar elementos html
        }

        function addCheckClickListener() {
            $('.check').click(function () {
                let id = $(this).attr('data-id');
                markTodo(id);
                fetchTodos(query)

                console.log('aclicou para checar o ' + id);
            });
            $('.trash').click(function () {
                let id = $(this).attr('data-id');
                deleteTodo(id);
                fetchTodos(query)
                console.log('aclicou para deletar o ' + id);
            });
        }

        function deleteTodo(id) {
            $.get('/public/todo/' + id + '/delete');
        }
        function markTodo(id) {
            $.get('/public/todo/' + id + '/mark');
        }
    </script>

</ul>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
