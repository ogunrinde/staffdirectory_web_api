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
    .img{
        width: 50px;height: 50px;margin-top: 10px;text-align: center;
      }
      .title{
        width: 200px;
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
    .title{
      width: 200px;
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
     .title{
        text-align: center;
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
                <a class="nav-link">
                  <input type="text" id="searchuser" class="form-control " placeholder=" Search by name" style="background-color:#D8D6d6;padding: 10px;" name="">
                </a>
              </li>
              <li class="nav-item user">
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
              <div class="" style="text-align: center;margin-top: -10px;">
                <h2 style="font-weight: bolder;color: #707070">Diocesan Officials</h2>
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
                     <tr style="background-color: #797907"> 
                      <th style="font-weight: 200">
                        S/N
                      </th>
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
                     <p style="display: none;">{{$p = 1}}</p> 
                     @foreach($officials as $f)    
                      <tr style="" class="accord{{$f->id}} initialview">
                        <td>
                          {{$p++}}
                        </td>
                        <td>
                          {{$f->position}}
                        </td>
                        <td>
                          {{$f->official_name}}
                        </td>
                        <td>
                          {{$f->address}}
                        </td>
                        <td>
                          {{$f->email}}
                        </td>
                        <td>
                          {{$f->phone_number}}
                        </td>
                      </tr>
                      @endforeach
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
        let search = $('#searchuser').val().trim().toLowerCase();
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