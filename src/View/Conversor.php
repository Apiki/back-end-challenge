<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>Conversor</title>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h1>Conversor</h1>
        </div>    
            <form action='/exchange/convert' method="post">
                <div class="form-group mb-2">
                    <div class="col">
                        <label for="from">De:</label>
                        <input type="text" id="from" name="from" class="form-control">
                    </div>
                    <div class="col">
                        <label for="to">Para:</label>
                        <input type="text" id="to" name="to" class="form-control">
                    </div>
                    <div class="col">
                        <label for="amount">Quantia:</label>
                        <input type="text" id="amount" name="amount" class="form-control">
                    </div>
                </div>
                <button class="btn btn-primary">Converter</button>
            </form>
        <label for="result">Valor:</label>
        <input type="text" id="result" name="result" class="form-control">
    </div>
</body>
<script>
var getJSON = function(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.responseType = 'json';
    xhr.onload = function() {
      var status = xhr.status;
      if (status === 200) {
        callback(null, xhr.response);
      } else {
        callback(status, xhr.response);
      }
    };
    xhr.send();
};
getJSON('/exchange/convert',
function(err, data) {
  if (err !== null) {
    alert('Something went wrong: ' + err);
  } else {
    console.log(data);
  }
});
</script>
</html>