<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('emailStore') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <textarea name="emails" id="exampleInputEmail1" cols="30" rows="2" class="form-control"></textarea>
                </div>


                <div class="mb-3">
                    <label for="exampleInputContent" class="form-label">Content</label>
                    <textarea name="content" id="exampleInputContent" cols="30" rows="2"
                              class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="interval" class="form-label">Interval</label>
                    <input type="number" class="form-control" id="interval" name="interval" value="0">
                </div>

                <div class="mb-3">
                    <label for="dateTime" class="form-label">Date Time</label>
                    <input type="datetime-local" class="form-control" id="dateTime" name="dateTime">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>


</body>
</html>
