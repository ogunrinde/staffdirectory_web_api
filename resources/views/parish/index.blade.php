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
</style>
<div class="main-panel" id="main-panel">
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
              <a class="nav-link" href="#">
                <input type="text" class="form-control search" placeholder="Search by name" style="background-color:#C1C1C1;" name="">
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
          <span class="navbar-text">
            <a href="" class="btn" style="background-color: #790779;color: #fff;width: 150px;">Log Out</a>
          </span>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"><a href="{{route('diocesedetails',['id'=>base64_encode($diocese_id)])}}"><span style="font-size: 30px;color: #f96332"><i class="fas fa-arrow-left"></i></span></a> Parish</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        S/N
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        Province 
                      </th>
                      <th>
                        Diocese
                      </th>
                      <th>
                        Arch deaconary
                      </th>
                      <th>
                        More
                      </th>
                    </thead>
                    <tbody>
                      <p style="display: none;">{{$p=1}}</p>
                      @foreach($parishes as $parish)
                      <tr>
                        <td>{{$p++}}</td>
                        <td>
                          {{$parish->parish_name}}
                        </td>
                        <td>
                          {{$parish->province_name}}
                        </td>
                        <td>
                          {{$parish->diocese_name}}
                        </td>
                        <td>
                          {{$parish->archdeaconary_name}}
                        </td>
                        <td class="">
                           <a href="{{route('priestdetails',['id'=>base64_encode($parish->id)])}}" class="btn btn-primary btn-sm">View Priest</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @if(count($parishes) == 0)
                    <h3>No record found</h3>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy;
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by
            <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
          </div>
        </div>
      </footer>
    </div>

@endsection