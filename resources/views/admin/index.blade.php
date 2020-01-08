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
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Admin Add/Edit/Delete</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary" style="background-color: #f96332;color:#fff">
                      <th style="font-weight: 800;color:#fff;font-size: 16px;">
                        S/N
                      </th>
                      <th style="font-weight: 800;color:#fff;font-size: 16px;">
                        Activities
                      </th>
                      <th style="font-weight: 800;color:#fff;font-size: 16px;">
                        View
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          1
                        </td>
                        <td>
                          Province
                        </td>
                        <td class="">
                           <a href="{{route('provinces.create')}}" class="btn btn-primary btn-sm">view</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          2
                        </td>
                        <td>
                          Diocese
                        </td>
                        <td class="">
                           <a href="{{route('diocese.create')}}" class="btn btn-primary btn-sm">view</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          3
                        </td>
                        <td>
                          ArchDeaconary
                        </td>
                        <td class="">
                           <a href="{{route('archdeaconary.create')}}" class="btn btn-primary btn-sm">view</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          4
                        </td>
                        <td>
                          Parish
                        </td>
                        <td class="">
                           <a href="{{route('parish.create')}}" class="btn btn-primary btn-sm">view</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          5
                        </td>
                        <td>
                          Add Priest
                        </td>
                        <td class="">
                           <a href="{{route('profile.create')}}" class="btn btn-primary btn-sm">view</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          6
                        </td>
                        <td>
                          Delete Priest
                        </td>
                        <td class="">
                           <a href="{{route('showpriest')}}" class="btn btn-primary btn-sm">view</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          7
                        </td>
                        <td>
                          Edit Priest
                        </td>
                        <td class="">
                           <a href="{{route('editpriest')}}" class="btn btn-primary btn-sm">view</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          8
                        </td>
                        <td>
                          Add Official
                        </td>
                        <td class="">
                           <a href="{{route('addofficial')}}" class="btn btn-primary btn-sm">view</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          9
                        </td>
                        <td>
                          Edit Official
                        </td>
                        <td class="">
                           <a href="{{route('editofficial')}}" class="btn btn-primary btn-sm">view</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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