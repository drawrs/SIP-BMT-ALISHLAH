<!DOCTYPE html>
<html>
<head>
    <title>Form</title>
</head>
<body>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/cek" method="post">
{{csrf_field()}}
    <input type="text" name="text">
    <input type="submit" value="Send">
</form>
</body>
</html>