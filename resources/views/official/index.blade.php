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
    width: 80%;margin-left:auto;margin-right: auto;margin-top: 20px;
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
  @media screen and (max-width: 768px) {
    .content {
          width: 98%;margin-left:auto;margin-right: auto;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);margin-top: 20px;
    }
  }
</style>
<div class="" id="main-panel">
      <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
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
                <input type="text" id="searchuser" class="form-control search" placeholder="Search by name" style="background-color:#D8D6d6;" name="">
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
              <div class="">
                <div>
                 <p style="font-size: 40px;color: #790779;"><a href = "{{route('diocese.index')}}"><i class="fas fa-long-arrow-alt-left"></i></a></p>
              </div>
              <div class="" style="text-align: center;margin-top: -50px;">
                <h2 style="font-weight: bolder;">Diocesan Officials</h2>
                </div>
                <!--h5 class="title" style="color: #707070;font-weight: lighter;">DIOCESE OF IFE</h5-->
              </div>
              <!--div class="card-header">
                <h4 class="card-title" style="color: #707070;">Diocesan Officials</h4>
              </div-->
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" >
                    <thead class=" text-primary" style='padding: 30px;'>
                     <tr style="background-color: #797907;text-align: center;"> 
                      <th style="font-weight: 200">
                        Position
                      </th>
                      <th style="font-weight: 200">
                        Name
                      </th>
                      <th style="font-weight: 200">
                        Address
                      </th>
                      <th style="font-weight: 200">
                        Email
                      </th>
                      <th style="font-weight: 200">
                        Phone Number
                      </th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr style="text-align: center;">
                        <td>
                          staff
                        </td>
                        <td>
                          staff
                        </td>
                        <td>
                          staff
                        </td>
                        <td>
                          staff
                        </td>
                        <td>
                          staff
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
  let officials = {!! $officials!!};
   $(function(e){
    console.log(officials);
      $('#searchuser').on('keyup', function(e){
        e.preventDefault();
        $('.initialview').show();
        let search = $('#searchuser').val();
        for(let r = 0; r < officials.length;r++){
          let name = officials[r].official_name.trim().toLowerCase();
          let n = name.search(search);
          if(n > -1){
            //alert(name);
          }else{
            $('.accord'+officials[r].id+'').hide();
            //alert(archdeaconaries[r].id);
          }
        }
      })
   });
</script>