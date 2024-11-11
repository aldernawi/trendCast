@extends('admin.home')

@section('content')

<div class="row">
  <div class="col-lg-3 col-sm-6">
    <div class="card">
        <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="fa fa-users  opacity-10"></i> <!-- أيقونة الباحثين -->
            </div>
            <div class="text-start pt-1">
                <p class="text-sm mb-0 text-capitalize">اجمالي المستخدمين</p>
                <h4 class="mb-0">{{$users}}</h4>
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
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-building opacity-10"></i>
              </div>
              <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize"> اجمالي الشركات</p>
                  <h4 class="mb-0">{{$companies}}</h4>
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
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-user opacity-10"></i> 
              </div>
              <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize">اجمالي المستقلين</p>
                  <h4 class="mb-0">{{$freelancers}}</h4>
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
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-file-text opacity-10"></i>
              </div>
              <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize"> اجمالي العملاء</p>
                  <h4 class="mb-0">{{$Clients}}</h4>
              </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder ms-1">+3% </span>من الأسبوع الماضي</p>
          </div>
        
      </div>
  </div>
  
</div>

<!-- تباعد بين الصفين 
<div class="row mt-4"> 
        <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">hourglass_empty</i> 
                </div>
                <div class="text-start pt-1">
                    <p class="text-sm mb-0 text-capitalize">الابحاث المعلقة</p>
                    <h4 class="mb-0"></h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">+55% </span>من الأسبوع الماضي</p>
            </div>
        </div>
    </div>
    

    <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">cancel</i>
                </div>
                <div class="text-start pt-1">
                    <p class="text-sm mb-0 text-capitalize">الابحاث المرفوضة</p>
                    <h4 class="mb-0"></h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">+55% </span>من الأسبوع الماضي</p>
            </div>
        </div>
    </div>
</div>
-->

@endsection
