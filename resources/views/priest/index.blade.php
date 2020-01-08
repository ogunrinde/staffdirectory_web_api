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
  #logo{
    width: 250px;height: 70px;
  }
  .search{
    width: 350px;
  }
  .panel-group{
    box-shadow: none;
   }
   .search input{
       width: 350px;
    }
   .title{
     width: 200px;
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
              <a class="nav-link">
                <input type="text" id="searchuser" class="form-control " placeholder=" Search by priest" style="background-color:#D8D6d6;padding: 10px;" name="">
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
      <div class="content" style="">
        <div class="row">
          <div class="col-md-12">
            <div class="">
              <!--div>
                 <p style="font-size: 40px;color: #790779;"><a href = "{{route('diocese.index')}}"><i class="fas fa-long-arrow-alt-left"></i></a></p>
              </div-->
              <div class="" style="text-align: center;margin-top: -10px;">
                <h2 style="color: #707070;font-weight: bolder;">Priests</h2>
                
              </div>
              <!--div class="card-header">
                <h4 class="card-title" style="color: #707070;">Priests</h4>
              </div-->
              <div class="card-body">
                @if(count($profiles) > 0)
                <div class="table-responsive">
                  <table class="table" >
                    <thead class=" text-primary" >
                     <tr style="background-color: #0A7B54;padding: 10px;"> 
                      <th style="font-weight: 200">
                        S/N
                      </th>
                      <th style="font-weight: 200">
                        Name
                      </th>
                      <th style="font-weight: 200">
                        Archdeaconry
                      </th>
                      <th style="font-weight: 200">
                        Church
                      </th>
                    </tr>
                    </thead>
                    <tbody>
                      <p style="display: none;">{{$x=1}}</p>
                      @foreach($rtrev as $p)
                      <tr class="accord{{$p->id}} initialview">
                        <td>
                          {{$x++}}
                        </td>
                        <td>
                          <a href="{{route('viewpriest',[base64_encode($p->id),base64_encode($p->current_diocese),$p->position])}}">{{$p->status}} {{$p->surname}} {{$p->firstname}} </a>
                        </td>  
                        <td>
                         @foreach($archdeaconaries as $a)    
                          @if($p->current_archdeaconary == $a->id)
                          <a href ="{{route('archdeaconary.index')}}">{{$a->archdeaconary_name}}</a>
                          @endif
                         @endforeach
                        </td>
                        <td>
                         @foreach($parishes as $a) 
                          @if($p->current_parish == $a->id) 
                            <a href ="#">{{$a->parish_name}}</a>
                          @endif    
                         @endforeach
                        </td>
                      </tr>
                      @endforeach
                      @foreach($vyrev as $p)
                      <tr class="accord{{$p->id}} initialview">
                        <td>
                          {{$x++}}
                        </td>
                        <td>
                          <a href="{{route('viewpriest',[base64_encode($p->id),base64_encode($p->current_diocese),$p->position])}}">{{$p->status}} {{$p->surname}} {{$p->firstname}} </a>
                        </td>  
                        <td>
                         @foreach($archdeaconaries as $a)    
                          @if($p->current_archdeaconary == $a->id)
                          <a href ="{{route('archdeaconary.index')}}">{{$a->archdeaconary_name}}</a>
                          @endif
                         @endforeach
                        </td>
                        <td>
                         @foreach($parishes as $a) 
                          @if($p->current_parish == $a->id) 
                            <a href ="#">{{$a->parish_name}}</a>
                          @endif    
                         @endforeach
                        </td>
                      </tr>
                      @endforeach
                      @foreach($ven as $p)
                      <tr class="accord{{$p->id}} initialview">
                        <td>
                          {{$x++}}
                        </td>
                        <td>
                          <a href="{{route('viewpriest',[base64_encode($p->id),base64_encode($p->current_diocese),$p->position])}}">{{$p->status}} {{$p->surname}} {{$p->firstname}} </a>
                        </td>  
                        <td>
                         @foreach($archdeaconaries as $a)    
                          @if($p->current_archdeaconary == $a->id)
                          <a href ="{{route('archdeaconary.index')}}">{{$a->archdeaconary_name}}</a>
                          @endif
                         @endforeach
                        </td>
                        <td>
                         @foreach($parishes as $a) 
                          @if($p->current_parish == $a->id) 
                            <a href ="#">{{$a->parish_name}}</a>
                          @endif    
                         @endforeach
                        </td>
                      </tr>
                      @endforeach
                      @foreach($revcan as $p)
                      <tr class="accord{{$p->id}} initialview">
                        <td>
                          {{$x++}}
                        </td>
                        <td>
                          <a href="{{route('viewpriest',[base64_encode($p->id),base64_encode($p->current_diocese),$p->position])}}">{{$p->status}} {{$p->surname}} {{$p->firstname}} </a>
                        </td>  
                        <td>
                         @foreach($archdeaconaries as $a)    
                          @if($p->current_archdeaconary == $a->id)
                          <a href ="{{route('archdeaconary.index')}}">{{$a->archdeaconary_name}}</a>
                          @endif
                         @endforeach
                        </td>
                        <td>
                         @foreach($parishes as $a) 
                          @if($p->current_parish == $a->id) 
                            <a href ="#">{{$a->parish_name}}</a>
                          @endif    
                         @endforeach
                        </td>
                      </tr>
                      @endforeach
                      @foreach($rev as $p)
                      <tr class="accord{{$p->id}} initialview">
                        <td>
                          {{$x++}}
                        </td>
                        <td>
                          <a href="{{route('viewpriest',[base64_encode($p->id),base64_encode($p->current_diocese),$p->position])}}">{{$p->status}} {{$p->surname}} {{$p->firstname}} </a>
                        </td>  
                        <td>
                         @foreach($archdeaconaries as $a)    
                          @if($p->current_archdeaconary == $a->id)
                          <a href ="{{route('archdeaconary.index')}}">{{$a->archdeaconary_name}}</a>
                          @endif
                         @endforeach
                        </td>
                        <td>
                         @foreach($parishes as $a) 
                          @if($p->current_parish == $a->id) 
                            <a href ="#">{{$a->parish_name}}</a>
                          @endif    
                         @endforeach
                        </td>
                      </tr>
                      @endforeach
                      @foreach($evang as $p)
                      <tr class="accord{{$p->id}} initialview">
                        <td>
                          {{$x++}}
                        </td>
                        <td>
                          <a href="{{route('viewpriest',[base64_encode($p->id),base64_encode($p->current_diocese),$p->position])}}">{{$p->status}} {{$p->surname}} {{$p->firstname}} </a>
                        </td>  
                        <td>
                         @foreach($archdeaconaries as $a)    
                          @if($p->current_archdeaconary == $a->id)
                          <a href ="{{route('archdeaconary.index')}}">{{$a->archdeaconary_name}}</a>
                          @endif
                         @endforeach
                        </td>
                        <td>
                         @foreach($parishes as $a) 
                          @if($p->current_parish == $a->id) 
                            <a href ="#">{{$a->parish_name}}</a>
                          @endif    
                         @endforeach
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
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

@endsection

<script src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
  let all_edu = [];
  let parish = [];
  let perferment = [];
  let profiles = {!! $profiles!!};
   $(function(e){
    console.log(profiles);
      $('#searchuser').on('keyup', function(e){
        e.preventDefault();
        $('.initialview').show();
        //alert('ass');
        let search = $('#searchuser').val().toLowerCase();
        for(let r = 0; r < profiles.length;r++){
          let name = profiles[r].surname.trim().toLowerCase();
          let fname = profiles[r].firstname.trim().toLowerCase();
          let mname = profiles[r].middlename.trim().toLowerCase();
          let n = name.search(search);
          let m = fname.search(search);
          let j = mname.search(search);
          //alert(n);
          if(n > -1 || m > -1 || j > -1){
            //alert(name);
          }else{
            $('.accord'+profiles[r].id+'').hide();
            //alert(archdeaconaries[r].id);
          }
        }
      })
   });
</script>