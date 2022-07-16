@extends('layouts.dashboard', ['title' => 'Dashboard'])

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    @auth
    <h1 class="h2">{{ auth()->user()->username }}'s Dashboard</h1>
    @else
    <h1 class="h2">Dashboard</h1>
    @endauth
  </div>

  <div class="row mt-4 mb-5">
    <div class="col-lg-4">
      <div class="card border-0 bg-dark" style="height: 135px">
        <div class="card-body row justify-content-center align-items-center">
          <div class="col-lg-6">
            <h1 class="card-text text-start text-white fw-bold">{{ $space_count }}</h1>
            <h6 class="card-title text-white text-opacity-75">Total Workspaces</h6>
          </div>
          <div class="col-lg-5">
            <i class="fas fa-space-shuttle text-secondary text-opacity-75" style="font-size: 64px"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card border-0 bg-dark" style="height: 135px">
        <div class="card-body row justify-content-center align-items-center">
          <div class="col-lg-6">
            <h1 class="card-text text-start text-white fw-bold">64</h1>
            <h6 class="card-title text-white text-opacity-75">Stars</h6>
          </div>
          <div class="col-lg-5">
            <i class="fas fa-star text-secondary text-opacity-75" style="font-size: 64px"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card border-0 bg-dark" style="height: 135px">
        <div class="card-body row justify-content-center align-items-center">
          <div class="col-lg-6">
            <h1 class="card-text text-start text-white fw-bold">343</h1>
            <h6 class="card-title text-white text-opacity-75">Total Likes</h6>
          </div>
          <div class="col-lg-5">
            <i class="fas fa-thumbs-up text-secondary text-opacity-75" style="font-size: 64px"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h2>Your Activities</h2>
  <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Header</th>
          <th scope="col">Header</th>
          <th scope="col">Header</th>
          <th scope="col">Header</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1,001</td>
          <td>random</td>
          <td>data</td>
          <td>placeholder</td>
          <td>text</td>
        </tr>
        <tr>
          <td>1,002</td>
          <td>placeholder</td>
          <td>irrelevant</td>
          <td>visual</td>
          <td>layout</td>
        </tr>
      </tbody>
    </table>
  </div>
</main>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script>
  // Graphs
  const ctx = document.getElementById('myChart')
  const myChart = new Chart(ctx, {
    type: 'line'
    , data: {
      labels: [
        'Sunday'
        , 'Monday'
        , 'Tuesday'
        , 'Wednesday'
        , 'Thursday'
        , 'Friday'
        , 'Saturday'
      ]
      , datasets: [{
        data: [
          15339
          , 21345
          , 18483
          , 24003
          , 23489
          , 24092
          , 12034
        , ]
        , lineTension: 0
        , backgroundColor: 'transparent'
        , borderColor: '#007bff'
        , borderWidth: 4
        , pointBackgroundColor: '#007bff'
      }]
    }
    , options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      }
      , legend: {
        display: false
      }
    }
  })

</script>
@endsection
