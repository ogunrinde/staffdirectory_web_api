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
        content:"";
        float: left;
        font-family: 'Glyphicons Halflings';
      margin-right :1em;
    }
    #accordion .panel-title > a.accordion-toggle.collapsed::before, #accordion a.collapsed[data-toggle="collapse"]::before  {
        content:"";
    }
     .content{
    width: 60%;margin-left:auto;margin-right: auto;margin-top: 20px;
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
  }.card-body{
    width: 100%;
    margin: auto;
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
         display: none;
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
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto search">
            <li class="nav-item">
              <a class="navbar-brand">
                <input type="text" id="searchuser" class="form-control " placeholder=" Search by name" style="background-color:#D8D6d6;padding: 10px;" name="">
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
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="">
              <div class="">
                <!--div>
                 <p style="font-size: 40px;color: #790779;"><a href = "{{route('diocese.index')}}"><i class="fas fa-long-arrow-alt-left"></i></a></p>
              </div-->
              <div class="" style="text-align: center;margin-top: -50px;">
                <h2 style="font-weight: bolder;color: #707070;">Archdeaconry</h2>
                </div>
                <!--h5 class="title" style="color: #707070;font-weight: lighter;">DIOCESE OF IFE</h5-->
              </div>
              <!--div class="card-header">
                <h5 class="title">ARCHDEACONARIES</h5>
              </div-->
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
                      @foreach($archdeaconaries as $arch)    
                      <div class="panel-group initialview accord{{$arch->id}}" attr = "{{$arch->id}}" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="heading{{$arch->id}}" style="border:2px solid #790707;border-radius: 7px;text-align: center;color: #790707;">
                            <h5 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$arch->id}}" aria-expanded="true" aria-controls="collapse{{$arch->id}}" style="color:#790707;font-size: 16px;font-weight: bolder;padding: 15px;">
                                {{$arch->archdeaconary_name}}
                              </a>
                            </h5>
                          </div>
                          
                         @foreach($parishes as $p)
                          @if($p->archdeaconary_id == $arch->id)
                          <div id="collapse{{$arch->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$arch->id}}">
                            <div class="panel-body" style="background-color: #fff;margin-top: 7px;color:#fff;">
                               <div class="row">
                                   <div class="col-md-12" style="text-align: center;padding: 10px;margin-bottom:-30px;">
                                        <div class="btn" style="color:#fff;width:100%;background-color: #790707;font-size: 14px;font-weight: 900;border-radius: 10px;margin-bottom: 10px;">
                                            {{$p->parish_name}}
                                            <ol style="list-style-type: none;">
                                            @foreach($rtrev as $m)
                                            @if($m->current_parish == $p->id)
                                            <li style=""><a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}" style="font-weight: 200;font-size: 12px;color: #fff;">{{$m->status}} {{$m->firstname}} {{$m->surname}} - {{$m->position}}</a></li>
                                            @endif
                                            @endforeach
                                            @foreach($vyrev as $m)
                                            @if($m->current_parish == $p->id)
                                            <li style=""><a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}" style="font-weight: 200;font-size: 12px;color: #fff;">{{$m->status}} {{$m->firstname}} {{$m->surname}} - {{$m->position}}</a></li>
                                            @endif
                                            @endforeach
                                            @foreach($ven as $m)
                                            @if($m->current_parish == $p->id)
                                            <li style=""><a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}" style="font-weight: 200;font-size: 12px;color: #fff;">{{$m->status}} {{$m->firstname}} {{$m->surname}} - {{$m->position}}</a></li>
                                            @endif
                                            @endforeach
                                            @foreach($revcan as $m)
                                            @if($m->current_parish == $p->id)
                                            <li style=""><a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}" style="font-weight: 200;font-size: 12px;color: #fff;">{{$m->status}} {{$m->firstname}} {{$m->surname}} - {{$m->position}}</a></li>
                                            @endif
                                            @endforeach
                                            @foreach($rev as $m)
                                            @if($m->current_parish == $p->id)
                                            <li style=""><a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}" style="font-weight: 200;font-size: 12px;color: #fff;">{{$m->status}} {{$m->firstname}} {{$m->surname}} - {{$m->position}}</a></li>
                                            @endif
                                            @endforeach
                                            @foreach($evang as $m)
                                            @if($m->current_parish == $p->id)
                                            <li style=""><a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}" style="font-weight: 200;font-size: 12px;color: #fff;">{{$m->status}} {{$m->firstname}} {{$m->surname}} - {{$m->position}}</a></li>
                                            @endif
                                            @endforeach
                                          </ol>
                                      </div>
                                      
                                   </div>
                                   
                               </div>
                           </div>
                          </div>
                          @endif
                          @endforeach
                          
                        </div>
                      </div>
                      @endforeach
                      @if(count($archdeaconaries) == 0)
                         <h1>No Record Found</h1>
                      @endif
                      
                    </div>
                    
                  </div>
                </div>
               
              </div>
            </div>
          </div>
          <div class="col-md-4 yes">
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
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
  let all_edu = [];
  let parish = [];
  let perferment = [];
  let archdeaconaries = {!! $archdeaconaries!!};
   $(function(e){
    console.log(archdeaconaries);
      $('#searchuser').on('keyup', function(e){
        e.preventDefault();
        $('.initialview').show();
        let search = $('#searchuser').val();
        for(let r = 0; r < archdeaconaries.length;r++){
          let name = archdeaconaries[r].archdeaconary_name.trim().toLowerCase();
          let n = name.search(search);
          //alert(n);
          if(n > -1){
            //alert(name);
          }else{
            $('.accord'+archdeaconaries[r].id+'').hide();
            //alert(archdeaconaries[r].id);
          }
        }
      })
   });
</script>