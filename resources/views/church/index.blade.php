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
  .list-church li{
      margin-top: 10px;
    }
    .listitem{
      width:60%;margin-left:20%;
    }
  @media screen and (max-width: 768px) {
    .content {
          width: 98%;margin-left:auto;margin-right: auto;margin-top: 20px;
    }
    .header{
      display: none;
    }
    .listitem{
      width:98%;margin-left:1%;
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
    #navbarText{
      text-align: center;
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
                <a class="nav-link">
                  <input type="text" id ='searchuser' class="form-control search" placeholder="Search by Church" style="background-color:#C1C1C1;" name="">
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
                 <p style="font-size: 40px;color: #790779;"><a href = "{{route('diocese.index')}}"><i class="fas fa-long-arrow-alt-left"></i></a></p>
              </div-->
              <div class="" style="text-align: center;margin-top: -10px;">
                <h2 style="color: #707070;font-weight: bolder;">Churches</h2>
              </div>
              <!--div class="card-header">
                <h5 class="title" style="font-weight: 200;color: #707070">CHURCHES</h5>
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
                          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @if(count($parishes) > 0)
                            <div class="panel panel-default" >
                              <p style="display: none">{{$x=1}}</p>
                               <ol class="list-church" style="list-style-type: none;">
                                 @foreach($parishes as $p)
                                  <li class='initialview accord{{$p->id}}' style="border:1px solid #ccc;padding: 15px;color:#121EA8;box-shadow: 0 4px 8px 0 #ccc;">
                                    <p style="color:#121EA8;font-size: 14px;font-weight: bold;">{{$p->parish_name}}</p>
                                    <p style="margin-top: -12px;">
                                        {{$p->archdeaconary_name}} Archdeaconry
                                    </p>
                                    @if($p->parish_name != 'Cathedral Church of St.Philip, Ayetoro, Ile - Ife')
                                    @foreach($dean as $m)
                                    @if($m->current_parish == $p->id)
                                    <p class="listitem" style="margin-top: -12px;">
                                        <a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}">{{$m->status}} {{$m->firstname}} {{$m->surname}} {{$m->middlename}} - {{$m->position}}</a>
                                    </p>
                                    @endif
                                    @endforeach
                                    @foreach($vicar as $m)
                                    @if($m->current_parish == $p->id)
                                    <p class="listitem" style="margin-top: -12px;">
                                        <a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}">{{$m->status}} {{$m->firstname}} {{$m->surname}} {{$m->middlename}} - {{$m->position}}</a>
                                    </p>
                                    @endif
                                    @endforeach
                                    @foreach($curate as $m)
                                    @if($m->current_parish == $p->id)
                                    <p class="listitem" style="margin-top: -12px;">
                                        <a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}">{{$m->status}} {{$m->firstname}} {{$m->surname}} {{$m->middlename}} - {{$m->position}}</a>
                                    </p>
                                    @endif
                                    @endforeach
                                    @foreach($chaplincurate as $m)
                                    @if($m->current_parish == $p->id)
                                    <p class="listitem" style="margin-top: -12px;">
                                        <a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}">{{$m->status}} {{$m->firstname}} {{$m->surname}} {{$m->middlename}} - {{$m->position}}</a>
                                    </p>
                                    @endif
                                    @endforeach
                                    @foreach($chaplin as $m)
                                    @if($m->current_parish == $p->id)
                                    <p class="listitem" style="margin-top: -12px;">
                                        <a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}">{{$m->status}} {{$m->firstname}} {{$m->surname}} {{$m->middlename}} - {{$m->position}}</a>
                                    </p>
                                    @endif
                                    @endforeach
                                    @else
                                    @foreach($rtrev as $m)
                                    @if($m->current_parish == $p->id)
                                    <p class="listitem" style="margin-top: -12px;">
                                        <a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}">{{$m->status}} {{$m->firstname}} {{$m->surname}} {{$m->middlename}} - {{$m->position}}</a>
                                    </p>
                                    @endif
                                    @endforeach
                                    @foreach($vyrev as $m)
                                    @if($m->current_parish == $p->id)
                                    <p class="listitem" style="margin-top: -12px;">
                                        <a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}">{{$m->status}} {{$m->firstname}} {{$m->surname}} {{$m->middlename}} - {{$m->position}}</a>
                                    </p>
                                    @endif
                                    @endforeach
                                    @foreach($ven as $m)
                                    @if($m->current_parish == $p->id)
                                    <p class="listitem" style="margin-top: -12px;">
                                        <a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}">{{$m->status}} {{$m->firstname}} {{$m->surname}} {{$m->middlename}} - {{$m->position}}</a>
                                    </p>
                                    @endif
                                    @endforeach
                                    @foreach($revcan as $m)
                                    @if($m->current_parish == $p->id)
                                    <p class="listitem" style="margin-top: -12px;">
                                        <a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}">{{$m->status}} {{$m->firstname}} {{$m->surname}} {{$m->middlename}} - {{$m->position}}</a>
                                    </p>
                                    @endif
                                    @endforeach
                                    @foreach($rev as $m)
                                    @if($m->current_parish == $p->id)
                                    <p class="listitem" style="margin-top: -12px;">
                                        <a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}">{{$m->status}} {{$m->firstname}} {{$m->surname}} {{$m->middlename}} - {{$m->position}}</a>
                                    </p>
                                    @endif
                                    @endforeach
                                    @foreach($evang as $m)
                                    @if($m->current_parish == $p->id)
                                    <p class="listitem" style="margin-top: -12px;">
                                        <a href="{{route('viewpriest',[base64_encode($m->id),base64_encode($p->diocese_id),$m->position])}}">{{$m->status}} {{$m->firstname}} {{$m->surname}} {{$m->middlename}} - {{$m->position}}</a>
                                    </p>
                                    @endif
                                    @endforeach
                                    @endif
                                  </li>
                                  @endforeach
                               </ol>
                            </div>
                            @else 
                             <h1>No Record Found</h1>
                            @endif
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
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
  let all_edu = [];
  let parish = [];
  let perferment = [];
  let parishes = {!! $parishes!!};
   $(function(e){
    console.log(parishes);
      $('#searchuser').on('keyup', function(e){
        //alert('aaa');
        //alert(parishes.length);
        e.preventDefault();
        $('.initialview').show();
        let search = $('#searchuser').val().trim().toLowerCase();
        for(let r = 0; r < parishes.length;r++){
          let name =    parishes[r].parish_name.trim().toLowerCase();
          /*let fpriest = parishes[r].firstname.trim().toLowerCase();
          let spriest = parishes[r].surname.trim().toLowerCase();
          let mpriest = parishes[r].middlename.trim().toLowerCase();
          let status = parishes[r].status.trim().toLowerCase();*/
          let n = name.search(search);
          //alert(n);
          //let m = fpriest.search(search);
          //let k = spriest.search(search);
          //let g = status.search(search);
          //let u = mpriest.search(search);
          //alert(n);
          if(n > -1){
            //alert(name);
          }else{
            //alert('aaa');
            $('.accord'+parishes[r].id+'').hide();
            //alert(archdeaconaries[r].id);
          }
        }
      })
   });
</script>