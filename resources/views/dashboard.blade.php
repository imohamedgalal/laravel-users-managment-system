@extends('layouts.adminlte.master')

@section('title')
{{ trans('main_translate.Home') }}
@endsection


@section('title_page')
@endsection



@section('content')
@if (session()->has('success'))
<script>
    window.onload = function() {
        notif({
            msg: "{{session()->get('success')}}",
            type: "success"
        });
    }
</script>
@endif


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$users}}</h3>

                  <p>{{ trans('main_translate.All Users') }}</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-stalker"></i>
                </div>
                @can('show_users')
                <a href="{{ route('index_users') }}" class="small-box-footer">{{ trans('main_translate.More info') }}<i class="fas fa-arrow-circle-right"></i></a>
                @endcan
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $active_users}}</h3>

                  <p>{{ trans('main_translate.Active Users') }}</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-stalker"></i>
                </div>
                @can('show_users')
                <a href="{{ route('active_users') }}" class="small-box-footer">{{ trans('main_translate.More info') }}<i class="fas fa-arrow-circle-right"></i></a>
                @endcan
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $unconfirmed_users }}</h3>

                  <p>{{ trans('main_translate.Unconfirmed Users') }}</p>
                </div>
                <div class="icon">
                  <i class="ion ion-help"></i>
                </div>
                @can('show_users')
                <a href="{{ route('unconfirmed_users') }}" class="small-box-footer">{{ trans('main_translate.More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                @endcan
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $disabled_users}}</h3>

                  <p>{{ trans('main_translate.Disabled Users') }}</p>
                </div>
                <div class="icon">
                  <i class="ion ion-log-out"></i>
                </div>
                @can('show_users')
                <a href="{{ route('disabled_users') }}" class="small-box-footer">{{ trans('main_translate.More info') }}<i class="fas fa-arrow-circle-right"></i></a>
                @endcan
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- /.row (main row) -->
            <div class="row">
            <canvas id="myChart" height="100"></canvas>
            </div>
        </div><!-- /.container-fluid -->
      </section>

@endsection

@section('css')
<link href="{{ URL::asset('adminlte/assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection


@section('scripts')

<!--Internal  Notify js -->
<script src="{{ URL::asset('adminlte/assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('adminlte/assets/plugins/notify/js/notifit-custom.js') }}"></script>

<script src="{{ URL::asset('adminlte/assets/plugins/chart.js/Chart.min.js') }}"></script>
<script type="text/javascript">
  
    var labels =  {{ Js::from($labels) }};
    var users =  {{ Js::from($data) }};
  
    const data = {
        labels: labels,
        datasets: [{
            label: 'Users Numbers',
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(201, 203, 207)',
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
            ],
            borderWidth: 1,
            data: users,
        }]
    };
  
    const config = {
        type: 'bar',
        data: data,
        options: {}
    };
  
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    
  
</script>

@endsection
