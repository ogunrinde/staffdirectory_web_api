@extends('templates.app')
@section('content')
<style type="text/css">
   thead tr {
     background-color: #f96332;
     color: #fff;
     padding: 4px;
   }
   tbody tr:nth-child(odd){
    background-color: #f2f2f2;
   }
   .content{
    width: 60%;margin-left:20%;margin-right: 20%;margin-top: 20px;
  }
  .panel-group{
    margin-top: 10px;
  }
  .navbar{
    width: 80%;
    margin:auto;
    background-color: #fff;
    box-shadow: none;
  }
  .search{
    width: 350px;
  }
  .panel-group{
    box-shadow: none;
  }
  @media screen and (max-width: 768px) {
    .content {
          width: 98%;margin-left:auto;margin-right: auto;margin-top: 20px;
    }
  }
</style>
<div class="" id="main-panel">
      <!-- Navbar -->
       <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{route('home')}}">
           <img src="{{asset('assets/img/churchlogo.png')}}" style="width: 250px;height: 70px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <input type="text" class="form-control search" placeholder="Search by name" style="background-color:#D8D6d6;" name="">
              </a>
            </li>
            <li class="nav-item">
              @if(Auth::user()->role == 'Admin')
              <a class="nav-link user" href="#" style="color: #000;font-size: 15px;font-weight: bold">{{Auth::user()->name}}</a>
              @else
              <a class="nav-link user" href="{{route('admin.index')}}" style="color: #000;font-size: 15px;font-weight: bold">{{Auth::user()->name}}</a>
              @endif
            </li>
          </ul>
          <span class="navbar-text">
            <a href="" class="btn" style="background-color: #790779;color: #fff;width: 150px;">Log Out</a>
          </span>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="">
      </div>
      <div class="content" style="">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <!--div class="card-header">
                <h4 class="card-title" style="color: #707070;">Priests</h4>
              </div-->
              <div class="card-body">
                   <div>
                      <div class="row">
                                   <div class="col-md-12" style="text-align: center;padding: 10px;">
                                        <img src="{{asset('assets/img/mike.jpg')}}" style="width: 100px;height: 100px;border-radius: 50px;">
                                   </div>
                      </div>
                      <div >
                          <h4 style="text-align: center;color: #707070;font-weight: 200;">Personal Information</h4>
                          <div class="row">
                             <div class="col-md-4">
                                Status
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Status</p>
                             </div>
                             <div class="col-md-8">
                                Name
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Name</p>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-6">
                                Date of Birth
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Status</p>
                             </div>
                             <div class="col-md-6">
                                Name of Spouse
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Name</p>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-6">
                                Email 1
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Email</p>
                             </div>
                             <div class="col-md-6">
                                 Email 2
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Email</p>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-6">
                                Phone Number 1
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Phone Number 1</p>
                             </div>
                             <div class="col-md-6">
                                 Phone Number 2
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Phone Number 2</p>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-6">
                                Date of Marriage 
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Email</p>
                             </div>
                             <div class="col-md-6">
                                 Spouse of Qualification
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Email</p>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-6">
                                Date deaconed 
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Email</p>
                             </div>
                             <div class="col-md-6">
                                 Date Priested
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Email</p>
                             </div>
                          </div>
                          <h4 style="text-align: center;">Educational Background </h4>
                          <div class="row">
                             <div class="col-md-12">
                                 
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Education 1</p>
                             </div>
                             <div class="col-md-12">
                                 
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Education 2</p>
                             </div>
                             <div class="col-md-12">
                                 
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Education 3</p>
                             </div>
                          </div>
                          <h4 style="text-align: center;color: #707070;">Parished served with Date </h4>
                          <div class="row">
                             <div class="col-md-12">
                                 
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Education 1</p>
                             </div>
                             <div class="col-md-12">
                                 
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Education 2</p>
                             </div>
                             <div class="col-md-12">
                                 
                                 <p style="border:1px solid #707070;color:#707070;text-align: center;padding: 7px;border-radius:5px;">Education 3</p>
                             </div>
                          </div>
                      </div>
                   </div>
              </div>
            </div>
            
          </div>
          
        </div>
      </div>
      
    </div>

@endsection