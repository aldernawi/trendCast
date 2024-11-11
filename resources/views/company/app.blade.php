@extends('company.home')

@section('content')

<div class="row">
    
  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
    <div class="card">
        <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-book opacity-10"></i>
            </div>
            <div class="text-start pt-1">
                <p class="text-sm mb-0 text-capitalize">إجمالي الحجوزات</p>
                <h4 class="mb-0">{{$bookings}}</h4> 
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            <p class="mb-0"><span class="text-success text-sm font-weight-bolder ms-1">+3% </span>من الأسبوع الماضي</p>
        </div>
    </div>
</div>
  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
    <div class="card">
        <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-clock opacity-10"></i>
            </div>
            <div class="text-start pt-1">
                <p class="text-sm mb-0 text-capitalize">الحجوزات المعلقة</p>
                <h4 class="mb-0">{{$newBookingsCount}}</h4>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            <p class="mb-0"><span class="text-success text-sm font-weight-bolder ms-1">+55% </span>من الأسبوع الماضي</p>
        </div>
    </div>
  </div>

  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
      <div class="card">
          <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-check opacity-10"></i>
              </div>
              <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize">الحجوزات المقبولة</p>
                  <h4 class="mb-0">{{$Accepted}}</h4>
              </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder ms-1">+3% </span>من الأسبوع الماضي</p>
          </div>
      </div>
  </div>

  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
      <div class="card">
          <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-times opacity-10"></i>
              </div>
              <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize">الحجوزات المرفوضة</p>
                  <h4 class="mb-0">{{$Rejected}}</h4>
              </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder ms-1">+3% </span>من الأسبوع الماضي</p>
          </div>
      </div>
  </div>

  <div class="row mt-4"> 

  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
      <div class="card">
          <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-cogs opacity-10"></i>
              </div>
              <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize">إجمالي الخدمات</p>
                  <h4 class="mb-0">{{$services}}</h4> 
              </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder ms-1">+3% </span>من الأسبوع الماضي</p>
          </div>
      </div>
  </div>

  <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
      <div class="card">
          <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-file-text opacity-10"></i>
              </div>
              <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize">إجمالي المنشورات</p>
                  <h4 class="mb-0">{{$posts}}</h4>
              </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder ms-1">+3% </span>من الأسبوع الماضي</p>
          </div>
      </div>
  </div>
</div>

</div>

@endsection
