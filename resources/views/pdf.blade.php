<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">provinsi</th>
      <th scope="col">kota</th>
      <th scope="col">stasiun</th>
      <th scope="col">fm</th>
    </tr>
  </thead>
  <tbody>
      @foreach($data as $data)
    <tr>
      <th scope="row">1</th>
      <td>{{$data->provinsi}}</td>
      <td>{{$data->kota}}</td>
      <td>{{$data->stasiun_id}}</td>
      <td>{{$data->fm}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</body>
</html>