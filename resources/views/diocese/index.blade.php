@extends('templates.app')
@section('content')
<style type="text/css">
   #accordion .panel-heading { padding: 0;}
    #accordion .panel-title > a {
      display: block;
      padding: 0.4em 0.6em;
        outline: none;
        font-weight:bold;
        text-decoration: none;
    }

    #accordion .panel-title > a.accordion-toggle::before, #accordion a[data-toggle="collapse"]::before  {
        content:"\e113";
        float: left;
        font-family: 'Glyphicons Halflings';
      margin-right :1em;
    }
    #accordion .panel-title > a.accordion-toggle.collapsed::before, #accordion a.collapsed[data-toggle="collapse"]::before  {
        content:"\e114";
    }
    .content{
    width: 80%;margin-left:auto;margin-right: auto;margin-top: 20px;
    }
    .col-md-3 div{
      width:80%;text-align: center;height: 140px;border:7px;border-radius: 7px;
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
      .header{
        display: none
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
      .subcontainer{
        width: 80px;height: 60px;
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
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto search">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <input type="text" class="form-control " placeholder=" Search by name" style="background-color:#D8D6d6;padding: 10px;" name="">
              </a>
            </li>
            <li class="nav-item">
              @if(Auth::user()->role == 'Admin')
              <a class="nav-link user" href="#" style="color: #000;font-size: 15px;font-weight: bold">{{Auth::user()->name}}</a>
              @else
              <a class="nav-link user" href="{{route('admin.index')}}" style="color: #000;font-size: 15px;font-weight: bold">{{Auth::user()->name}}</a>
              @endif
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
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="">
              <!--div>
                 <p style="font-size: 40px;color: #790779;"><a href = "{{route('home')}}"><i class="fas fa-long-arrow-alt-left"></i></a></p>
              </div-->
              <div class="" style="text-align: center;margin-top: 50px;">
                <h2 style="color: #707070;font-weight: bolder;">Diocese of {{$dioceses[0]->diocese_name}}</h2>
                
                </div>
                <!--h5 class="title" style="color: #707070;font-weight: lighter;">DIOCESE OF IFE</h5-->
              </div>
              @if(Session::has('message'))
                     <div class="alert alert-success" role="alert" style="background: #6f42c1">
                      {{ Session::get('message') }}
                    </div> 
               @endif
              <div class="card-body">
                <!--form action="{{route('searchpriest')}}" method="POST">
                  @csrf
                  <div class="input-group no-border">
                    <input type="text" name="search" value="" class="form-control" placeholder="Search...">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <i class="now-ui-icons ui-1_zoom-bold" id="submiticon"></i>
                        <input type="submit" name="submit" id='submitbtn' style="display: none;">
                      </div>
                    </div>
                  </div>
                </form-->
                
                <div class="">
                  <div class="">
                    <div class="">
                          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                          
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12" style="text-align: center;padding: 10px;margin-bottom: 15px;">
                                        <img src="{{asset('assets/img/'.$profiles[0]->image)}}" style="width: 150px;height: 150px;transform: rotate(270deg);">
                                        <!--img src="{{asset('assets/img/'.$profiles[0]->image)}}" style="width: 100px;height: 100px;border-radius: 50px;"-->

                                        <p style="margin-top: 7px;font-size: 15px;">
                                            <a href ="{{route('profile',[base64_encode($dioceses[0]->id),'bishop'])}}" style="color:#707070;">Diocesan >></a></p>
                                   </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-6">
                                    <div style="background-color: #797907" class="subcontainer">
                                      
                                       <a href="{{route('official.index')}}">
                                        <img src="{{asset('assets/img/officials.png')}}" class="img" style="">
                                        <p style="color: #fff;margin-top: 7px;">DIOCESAN OFFICIALS</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-6">
                                    <div style="background-color: #790707;" class="subcontainer">
                                      
                                        <a href="{{route('archdeaconary.index')}}">
                                        <img src="{{asset('assets/img/arch.png')}}" class="img" style="">
                                        <p style="color: #fff;margin-top: 7px;">ARCHDEACONRY</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-6">
                                    <div style="background-color: #121EA8;" class="subcontainer">
                                      
                                        <a href="{{route('church.index')}}">
                                        <img src="{{asset('assets/img/churches.png')}}" class="img" style="">
                                        <p style="color: #fff;margin-top: 7px;">CHURCHES</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-6">
                                    <div style="background-color: #0A7B54;" class="subcontainer">
                                      
                                        <a href="{{route('priest.index')}}">
                                        <img src="{{asset('assets/img/priest.png')}}" class="img" style="">
                                        <p style="color: #fff;margin-top: 7px;">PRIESTS</p>
                                        </a>
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
          </div>
          <div class="col-md-4">
            <!--div class="card card-user">
              <div class="image">
                <img src="{{asset('assets/img/bg5.jpg')}}" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="{{asset('assets/img/mike.jpg')}}" alt="...">
                    <h5 class="title">Mike Andrew</h5>
                  </a>
                  <p class="description">
                    michael24
                  </p>
                </div>
                <p class="description text-center">
                  "Lamborghini Mercy
                  <br> Your chick she so thirsty
                  <br> I'm in that two seat Lambo"
                </p>
              </div>
              <hr>
              <div class="button-container">
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-facebook-f"></i>
                </button>
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-twitter"></i>
                </button>
                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-google-plus-g"></i>
                </button>
              </div>
            </div-->
          </div>
        </div>
      </div>
    </div>

@endsection
