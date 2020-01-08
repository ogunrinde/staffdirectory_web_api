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
              <a class="nav-link user" href="#" style="color: #000;font-size: 15px;font-weight: bold">Welcome {{Auth::user()->name}}</a>
              @else
              <a class="nav-link user" href="{{route('admin.index')}}" style="color: #000;font-size: 15px;font-weight: bold">Welcome {{Auth::user()->name}}</a>
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
            <div class="card">
              <div class="card-header">
                <h5 class="title">Add Diocese</h5>
              </div>
              @if(Session::has('message'))
                     <div class="alert alert-success" role="alert" style="background: #6f42c1;color: #fff">
                      {{ Session::get('message') }}
                    </div> 
               @endif
              <div class="card-body">
                <form action="{{route('diocese.store')}}" method="POST">
                   @csrf
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Province Name</label>
                        <select name="province_name" class="form-control" style="padding: 2px;">
                          <option value=""></option>
                          @foreach($provinces as $province)
                           <option value="{{$province->id}}">{{$province->province_name}}</option>
                           @endforeach
                        </select>
                        @if ($errors->has('province_name')) 
                          <small class="text-danger">{{ $errors->first('province_name') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div> 
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Diocese Name</label>
                        <input type="text" name="diocese_name" class="form-control" placeholder="">
                        @if ($errors->has('diocese_name')) 
                          <small class="text-danger">{{ $errors->first('diocese_name') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                      <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit Data</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h5 class="title">Edit Diocese</h5>
              </div>
              @if(Session::has('editmessage'))
                     <div class="alert alert-success" role="alert" style="background: #6f42c1;color: #fff">
                      {{ Session::get('editmessage') }}
                    </div> 
               @endif
              <div class="card-body">
                <form action="{{route('editdiocese')}}" method="POST">
                   @csrf
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Select Diocese</label>
                        <select name='diocese_id' id ='select_diocese' class="form-control" style="padding: 2px;">
                            <option value=""></option>
                          @foreach($dioceses as $diocese)
                            <option value="{{$diocese->id}}">{{$diocese->diocese_name}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('diocese_id')) 
                          <small class="text-danger">{{ $errors->first('diocese_id') }}</small>
                          
                        @endif
                      </div>
                      <div class="form-group">
                        <label>Diocese Name</label>
                        <input type="text" id ='add_diocese' name="diocese_name" class="form-control" placeholder="">
                        
                        @if ($errors->has('diocese_name')) 
                          <small class="text-danger">{{ $errors->first('diocese_name') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                      <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-sm btn-primary">Edit Data</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h5 class="title">Delete Diocese</h5>
              </div>
              @if(Session::has('deletemessage'))
                     <div class="alert alert-success" role="alert" style="background: #6f42c1;color: #fff">
                      {{ Session::get('deletemessage') }}
                    </div> 
               @endif
              <div class="card-body">
                <form action="{{route('deletediocese')}}" method="POST">
                   @csrf
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Select Diocese</label>
                        <select name='diocese_id' class="form-control" style="padding: 2px;">
                            <option value=""></option>
                          @foreach($dioceses as $diocese)
                            <option value="{{$diocese->id}}">{{$diocese->diocese_name}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('diocese_name')) 
                          <small class="text-danger">{{ $errors->first('diocese_name') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                      <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-sm btn-primary">Delete Data</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
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