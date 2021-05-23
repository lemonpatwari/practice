<!DOCTYPE HTML>
<html>
<head>
    <title>Relay control</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>
<body>
<table style="margin: 20px;">
    <tr>
        <td style="padding: 10px;">
            <form action="{{ route('lmn') }}" method="post">
                @csrf
                <input type="hidden" name="action" value="{{ $button1action }}">
                <button type="button" class="btn btn-lg {{ $td1st }}" onclick="this.form.submit();">Channel 1</button>
            </form>
        </td>
        <td style="padding: 10px;">
            <form action="{{ route('lmn') }}" method="post">
                @csrf
                <input type="hidden" name="action" value="{{ $button2action }}">
                <button type="button" class="btn btn-lg {{ $td2st }}" onclick="this.form.submit();">Channel 2</button>
            </form>
        </td>
        {{--<td style="padding: 10px;">
            <form action="{{ route('lmn') }}" method="post">
                @csrf
                <input type="hidden" name="action" value="{{ $button3action }}">
                <button type="button" class="btn btn-lg {{ $td3st }}" onclick="this.form.submit();">Channel 3</button>
            </form>
        </td>--}}
    </tr>
</table>
</body>
</html>
