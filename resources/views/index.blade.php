@extends('layout.apps')
@section('content')

  <!-- /.row-->
  <div class="card mb-4">
    <div class="card-header">
      Dashboard
  </div>
    <div class="card-body">
      <div class="justify-content-between">
        <div class="row">
          @foreach ($balances as $balance)
          <div class="col-sm-6 col-lg-4">
            <div class="card mb-4 text-white bg-info">
              <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                  <div class="fs-4 fw-semibold">{{ $balance->currency_symbol }} {{ isset($balance->amount) ? $balance->amount : '0.00'  }}</div>
                </div>
                <div class="dropdown">
                  <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                    </svg>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                </div>
              </div>
              <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <div>Balance of {{ $balance->name }}</div>
              </div>
            </div>
          </div>

          <?php 
              $balance_per_day = $balance->amount/$dayToSalary;
          ?>
          <div class="col-sm-6 col-lg-4">
            <div class="card mb-4 text-white bg-info">
              <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                  <div class="fs-4 fw-semibold">{{ $balance->currency_symbol }} {{ isset($balance_per_day) ? number_format($balance_per_day, 2)  : '0.00'  }}</div>
                </div>
                <div class="dropdown">
                  <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                    </svg>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                </div>
              </div>
              <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <div>Max money for 1 day</div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="card mb-4 text-white bg-info">
              <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                  <div class="fs-4 fw-semibold">{{ $balance->currency_symbol }} {{ isset($balance->expenses) ? number_format($balance->expenses->sum('amount'), 2)  : '0.00'  }}</div>
                </div>
                <div class="dropdown">
                  <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                    </svg>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                </div>
              </div>
              <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <div>Total Expense (30 days)</div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

  </div>
@endsection

@section('scripts')
      <!-- Plugins and scripts required by this view-->
      <script src="{{ asset('vendors/chart.js/js/chart.min.js') }}"></script>
      <script src="{{ asset('vendors/@coreui/chartjs/js/coreui-chartjs.js') }}"></script>
      <script src="{{ asset('vendors/@coreui/utils/js/coreui-utils.js') }}"></script>
      <script src="{{ asset('js/main.js') }}"></script>
@endsection