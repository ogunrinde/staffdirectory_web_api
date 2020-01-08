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
        font-size: 19px;
        font-family: 'Glyphicons Halflings';
      margin-right :1em;
    }
    #accordion .panel-title > a.accordion-toggle.collapsed::before, #accordion a.collapsed[data-toggle="collapse"]::before  {
        content:"";
    }
     .content{
    width: 60%;margin-left:auto;margin-right: auto;margin-top: 20px;
  }
  .user{
    color: #000;font-size: 15px;margin-left: 10px;font-weight: bold;
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
  .search input{
    width: 350px;
  }
  .panel-group{
    box-shadow: none;
  }
  #logo{
    width: 250px;height: 70px;
  }
  .details{
    width:50%;margin-left:25%;padding: 10px;
  }
  @media screen and (max-width: 768px) {
    .content {
          width: 98%;margin-left:auto;margin-right: auto;margin-top: 20px;
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
    .search input{
      width: 80%;
    }
    .logodiv{
      text-align: center;
    }
    .navbar .navbar-toggler{
      height: auto;
      width: auto;
    }
    .details{
      width:90%;margin-left:5%;padding: 10px;
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
              <!--div class="card-header">
                <h5 class="title">CHURCH OF NIGERIA</h5>
              </div-->
              <div style="text-align: center;">
                <h2 style="color: #707070;font-weight: bolder;">List of Province(s)</h2>
                <!--p style="color: #707070;font-weight: bolder;">List of Province(s)</p-->
              </div>
              @if(Session::has('message'))
                     <div class="alert alert-success" role="alert" style="background: #6f42c1;color: #fff">
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
                      @foreach($provinces as $p)   
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="heading{{$p->id}}" style="border:2px solid #790779;border-radius: 10px;text-align: center;padding: 7px;">
                            <h5 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$p->id}}" aria-expanded="true" aria-controls="collapse{{$p->id}}" style="color:#790779;font-size: 16px;font-weight: bolder;text-transform: uppercase;">
                                {{$p->province_name}}
                              </a>
                            </h5>
                          </div>
                          <div id="collapse{{$p->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$p->id}}">
                            <div class="panel-body" style="background-color: #790779;margin-top: 7px;color:#fff;">
                               <div class="row">
                                   <div class="col-md-12" style="text-align: center;padding: 10px;">
                                        <img src="{{asset('assets/img/ibadan.jpg')}}" style="width: 150px;height: 150px;">
                                   </div>
                                   <div class="col-md-12" style="text-align: center;padding: 7px;">
                                        {{$p->archbishop}}
                                        <h6 style="font-size: 1.0em;font-weight: bolder;margin-top: 4px;margin-bottom: 14px;">Archbishop of {{$p->province_name}} Province</h6>
                                   </div>
                                   <div class="col-md-12 details" style="">
                                        <p>Episcopal Secretary: <span style="font-weight: lighter;font-size: 13px;">{{$p->e_secretary}}</span></p>
                                        <p>Clerical Secretary:<span style="font-weight: lighter;font-size: 13px;margin-left: 15px;"> {{$p->c_secretary}}</span></p>
                                        <p>Treasurer: <span style="font-weight: lighter;font-size: 13px;;margin-left: 65px;">{{$p->treasurer}}</span></p>
                                   </div>
                                   <div class="col-md-12" style="text-align: center;padding: 10px;">
                                        <h6 style="font-size: 1.0em;font-weight:bolder">Diocese(s) in {{$p->province_name}} Province</h6>
                                   </div>
                                   <div class="col-md-12" style="text-align: center;padding: 10px;margin-top: -10px;">
                                   @foreach($dioceses as $d)
                                   
                                   
                                    @if($d->province_id == $p->id)
                                        <a class="btn btn" style="width: 80%;color:#790779;background-color: #fff;font-size: 20px;margin-bottom:0px;" href="{{route('diocesedetails',[base64_encode($d->id)])}}"> {{$d->diocese_name}}</a>
                                    @endif    
                                    
                                   
                                   @endforeach   
                                   </div> 
                               </div>
                           </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      
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
  $(function(){
     $('#add_edu').on('click', function(e){
       e.preventDefault();
       let val = $("#edu").val();
       if(val == '') return false;
        $('.educational_background').append('<input type="text" value = "'+val+'" class="form-control" placeholder="" style="margin:3px;">');
        all_edu.push(val.trim());
        $('#all_edu').val(all_edu.join('%%'));
        $("#edu").val('');
     });
     $('#add_parish').on('click', function(e){
       e.preventDefault();
       let val = $("#parish").val();
       if(val == '') return false;
        $('.parish').append('<input type="text" value = "'+val+'" class="form-control" placeholder="" style="margin:3px;">');
        parish.push(val.trim());
        $('#all_parish').val(parish.join('%%'));
        $("#parish").val('');
     });
     $('#add_perferment').on('click', function(e){
       e.preventDefault();
       let val = $("#perferment").val();
       if(val == '') return false;
        $('.perferment').append('<input type="text" value = "'+val+'" class="form-control" placeholder="" style="margin:3px;">');
        perferment.push(val.trim());
        $('#all_perferment').val(perferment.join('%%'));
        $("#perferment").val('');
     });
     $('#submiticon').on('click', function(e){
       //alert('a');
       e.preventDefault();
       $('#submitbtn').trigger('click');
     })
   })
</script>
<script type="text/javascript">
   var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>