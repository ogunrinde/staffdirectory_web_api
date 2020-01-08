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
    width: 50%;margin-left:25%;margin-right: 25%;margin-top: 20px;
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
  .search{
      width: 350px;
    }
    .panel-group{
      box-shadow: none;
    }
    #logo{
    width: 250px;height: 70px;
    }
    .subcontainer{
      width: 60px;height: 60px;
    }
    .search input{
       width: 350px;
     }
     .title{
       width: 200px;
     }
    .img{
        width: 50px;height: 50px;margin-top: 10px;text-align: center;
      }
  @media screen and (max-width: 768px) {
    .content {
          width: 98%;margin-left:auto;margin-right: auto;margin-top: 20px;
    }
    .img{
        width: 40px;height: 40px;margin-top: 10px;text-align: center;
      }
      .col-md-3 div{
         width:80%;text-align: center;height: 100px;border:7px;border-radius: 7px;
         margin-top: 10px;
      }
      .search input{
      width: 100%;
      }
      .user{
        color: #000;font-size: 15px;font-weight: bold;
        text-align: center;
      }
      .logo{
        width: auto;
        height: auto;
      }
      .search{
         width: 90%;
         margin-left: 5%;
         margin-right: 5%;
      }
      .logodiv{
        text-align: center;
      }
      .navbar .navbar-toggler{
        height: auto;
        width: auto;
      }
  }
</style>
<div class="" id="main-panel">
      <!-- Navbar -->
         <nav class="navbar navbar-expand-lg navbar-light">
        <div class="logodiv">
        <a class="navbar-brand" href="{{route('home')}}">
           <img id="logo" src="{{asset('assets/img/churchlogo.png')}}" style="">
        </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText" style="text-align: center;">
          <ul class="navbar-nav mr-auto search">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <input type="text" class="form-control " placeholder=" Search by name" style="background-color:#D8D6d6;padding: 10px;" name="">
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link title" href="#" style="color: #000;font-size: 15px;font-weight: bold">Welcome {{Auth::user()->name}}</a>
            </li>
            <li class="nav-item" style="text-align: center;">
              <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button class="btn btn-default btn-flat" style="background-color: #790779;color: #fff;width: 150px;text-align: center;margin-right: auto;margin-left: auto;text-align: center;" type="submit">Log out</button>
              </form>
            </li>
          </ul>
          <span class="navbar-text" style="text-align: center;">
            
          </span>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="">
      </div>
      <div class="content" style="">
        <div class="row">
          <div class="col-md-12">
             @if(count($profile) > 0)
                      <div class="row">
                                   <div class="col-md-12" style="text-align: center;padding: 10px;">
                                       
                                        <img src="{{asset('assets/img/'.$profile[0]->image)}}" style="width: 100px;height: 100px;transform: rotate(270deg);">
                                   </div>
                      </div>
              @endif  
            <div class="" style="border:1px solid #707070">
              <!--div class="card-header">
                <h4 class="card-title" style="color: #707070;">Priests</h4>
              </div-->

              <div class="card-body view">
                   <div>
                      @if(count($profile) > 0) 
                      <div >
                          <h4 style="text-align: center;color: #707070;font-weight: 200;">Personal Information</h4>
                          <div class="row">
                             <div class="col-md-6" style="color: #707070">
                                &nbsp;&nbsp;Status
                                 <p style="color:#707070;padding: 7px;border-radius:5px;font-weight: bolder;font-size: 14px;">{{$profile[0]->status}}</p>
                             </div>
                             <div class="col-md-6" style="color: #707070">
                                &nbsp;&nbsp;Name
                                 <p style="color:#707070;padding: 7px;border-radius:5px;font-weight: bolder;font-size: 14px;">{{$profile[0]->firstname}} {{$profile[0]->surname}} {{$profile[0]->middlename}}</p>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-6" style="color: #707070">
                                &nbsp;&nbsp;Date of Birth
                                 <p style="color:#707070;padding: 7px;border-radius:5px;font-weight: bolder;font-size: 14px;">{{$profile[0]->dob}}</p>
                             </div>
                             <div class="col-md-6" style="color: #707070">
                                &nbsp;&nbsp;Name of Spouse
                                 <p style="color:#707070;padding: 7px;border-radius:5px;font-weight: bolder;font-size: 14px;">{{$profile[0]->spouse_name}}</p>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-6" style="color: #707070">
                                &nbsp;&nbsp;Email 1
                                 <p style="color:#707070;padding: 7px;border-radius:5px;font-weight: bolder;font-size: 14px;">{{$profile[0]->email_a}}</p>
                             </div>
                             <div class="col-md-6" style="color: #707070">
                                 &nbsp;&nbsp;Email 2
                                 <p style="color:#707070;padding: 7px;border-radius:5px;font-weight: bolder;">{{$profile[0]->email_b}}</p>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-6" style="color: #707070">
                                &nbsp;&nbsp;Phone Number 1
                                 <p style="color:#707070;padding: 7px;border-radius:5px;font-weight: bolder;font-size: 14px;">{{$profile[0]->phone_number_a}}</p>
                             </div>
                             <div class="col-md-6" style="color: #707070">
                                 &nbsp;&nbsp;Phone Number 2
                                 <p style="color:#707070;padding: 7px;border-radius:5px;font-weight: bolder;font-size: 14px;">{{$profile[0]->phone_number_b}}</p>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-6" style="color: #707070">
                                &nbsp;&nbsp;Date Married 
                                 <p style="color:#707070;padding: 7px;border-radius:5px;font-weight: bolder;font-size: 14px;">{{$profile[0]->date_married}}</p>
                             </div>
                             <div class="col-md-6" style="color: #707070">
                                 &nbsp;&nbsp;Spouse's Qualification
                                 <p style="color:#707070;padding: 7px;border-radius:5px;font-weight: bolder;font-size: 14px;">{{$profile[0]->spouse_qualification}}</p>
                             </div>
                          </div>
                          <div class="row" style="border-bottom: 1px solid #707070;">
                             <div class="col-md-6" style="color: #707070">
                                &nbsp;&nbsp;Date Deaconed 
                                 <p style="color:#707070;padding: 7px;border-radius:5px;font-weight: bolder;font-size: 14px;">{{$profile[0]->date_deaconed}}</p>
                             </div>
                             <div class="col-md-6" style="color: #707070">
                                 &nbsp;&nbsp;Date Priested
                                 <p style="color:#707070;padding: 7px;border-radius:5px;font-weight: bolder;font-size: 14px;">{{$profile[0]->date_priested}}</p>
                             </div>
                          </div>
                          <h4 style="text-align: center;color: #707070;margin-top: 10px;">Educational Background </h4>
                          <div class="row" style="border-bottom: 1px solid #707070;">
                             <div class="col-md-12">
                                 
                                 <p style="color:#707070;text-align: center;padding: 7px;border-radius:5px;">{{$profile[0]->all_education}}</p>
                             </div>
                          </div>
                          <h4 style="text-align: center;color: #707070;margin-top: 10px;">Parished served with Date </h4>
                          <div class="row" style="border-bottom: 1px solid #707070;">
                             <div class="col-md-12">
                                 
                                 <p style="color:#707070;text-align: center;padding: 7px;border-radius:5px;">{{$profile[0]->all_parish}}</p>
                             </div>
                            
                          </div>
                          <h4 style="text-align: center;color: #707070;margin-top: 10px;">Perferment </h4>
                          <div class="row" style="">
                             <div class="col-md-12">
                                 
                                 <p style="color:#707070;text-align: center;padding: 7px;border-radius:5px;">{{$profile[0]->all_perferment}}</p>
                             </div>
                            
                          </div>
                      </div>
                      @else 
                       <h4>No Record Found</h4>
                      @endif
                   </div>
              </div>
            </div>
            
          </div>
          
        </div>
      </div>
      
    </div>

@endsection