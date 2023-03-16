<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/todos" method="POST">
        @csrf
        <input name="title" type="text">
        <button>Save</button>
    </form>

    <ul>
        @foreach($todos as $todo)
        <li>
            <input onchange="updateTodo(event, {{ $todo->id }})" {{ $todo->is_done ? "checked" : "" }} type="checkbox">
            {{ $todo->title }}
        </li>
        @endforeach
    </ul>

    <script>

        function updateTodo (event, id) {
            fetch("/todos/" + id, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    is_done: event.target.checked,
                    _token: @json(csrf_token())
                })
            })
        }


    </script>

</body>
</html>
