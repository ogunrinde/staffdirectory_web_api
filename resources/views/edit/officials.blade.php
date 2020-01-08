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
    .form-group input[type=file]{
      opacity: 1;
      height: 45px;
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
                <h5 class="title">Select Official to Edit</h5>
              </div>
              <div class="card-body">
                @if(Session::has('editmessage'))
                     <div class="alert alert-success" role="alert" style="background: #790779;color: #fff">
                      {{ Session::get('editmessage') }}
                    </div> 
               @endif
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group provinces">
                        <label>Select Province</label>
                        <select name="provinces" id ='eachprovinces' class="form-control" style="padding: 2px;">
                          <option value=""></option>
                          @foreach($provinces as $province)
                           <option value="{{$province->id}}">{{$province->province_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group dioceses">
                        <label>Select Dioceses</label>
                        <select name="dioceses" id ='eachdioceses' class="form-control" style="padding: 2px;">
                          <option value=""></option>
                         
                        </select>
                      </div>
                      <div class="form-group priest">
                        <label>Select Officials</label>
                        <select name="Official" id ='eachofficial' class="form-control" style="padding: 2px;">
                          <option value=""></option>
                         
                        </select>
                      </div>
                    </div>
                  </div> 
              </div>
            </div>
            <div class="card edit_activity hide" id="add_activity">
              <div class="card-header">
                <h5 class="title">Edit Official</h5>
              </div>
              @if(Session::has('message'))
                     <div class="alert alert-success" role="alert" style="background: #790779;color: #fff">
                      {{ Session::get('message') }}
                    </div> 
               @endif
              <div class="card-body">
                <form action="{{route('savedofficialdata')}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Position</label>
                        
                        <input type="text" name="position" id='editposition' class="form-control" placeholder="Rev">
                        @if ($errors->has('position')) 
                          <small class="text-danger">{{ $errors->first('position') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6 px-1">
                      <div class="form-group">
                        <label>Official Name</label>
                        <input type="text" name="official_name" id="editname" class="form-control" placeholder="" value="">
                        @if ($errors->has('official_name')) 
                          <small class="text-danger">{{ $errors->first('official_name') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    
                    
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="editemail" class="form-control" placeholder="" value="">
                        @if ($errors->has('email')) 
                          <small class="text-danger">{{ $errors->first('email') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="">
                        @if ($errors->has('phone')) 
                          <small class="text-danger">{{ $errors->first('phone') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" id="editaddress" class="form-control" placeholder="" value="">
                        <input type="text" style="display: none" name="official_id" id="official_id" class="form-control" placeholder="" value="">
                        @if ($errors->has('address')) 
                          <small class="text-danger">{{ $errors->first('address') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div>
                 
                  
                  <div class="row">
                    <div class="col-md-12" style="text-align: center;margin-top: 25px;">
                      <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-sm btn-outline" style="background-color: #fff;border: 1px solid orangered;color:orangered">Submit Data</button>
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
  let provinces = {!! $provinces !!};
  let dioceses = {!! $dioceses !!};
  let officials = {!! $officials !!};
  console.log(officials);
  $(function(){
     $('.provinces').on('change', function(e){
         e.preventDefault();
         thisdiocese = [];
         console.log(dioceses);
         $('#eachdioceses').html('');
         let province_id = $('#eachprovinces').val();
         //alert(province_id);
         //for(let t = 0; t < provinces.length; t++){
          $("#eachdioceses").append('<option value =""></option>');
            for(let w = 0; w < dioceses.length; w++){
              if(province_id == dioceses[w]['province_id']){
                 //alert(dioceses[w]['diocese_name']);
                  thisdiocese.push({name:dioceses[w]['diocese_name'], id:dioceses[w]['id']});
                  $('#eachdioceses').append('<option value="'+dioceses[w]['id']+'">'+dioceses[w]['diocese_name']+'</option>');
              }
            }
         //}

     });
     $('.dioceses').on('change', function(e){
         e.preventDefault();
         $('#eachofficial').html('');
         let diocese_id = $('#eachdioceses').val();
         //for(let t = 0; t < provinces.length; t++){
          $("#eachofficial").append('<option value =""></option>');
            for(let w = 0; w < officials.length; w++){
              if(diocese_id == officials[w]['diocese_id']){
                  $('#eachofficial').append('<option value="'+officials[w]['id']+'">'+officials[w]['official_name']+'</option>')
              }
            }
         //}

     });
     $('#eachofficial').on('change', function(e){
         e.preventDefault();
         $('.edit_activity').removeClass('hide');
         let official_id = $('#eachofficial').val();
            for(let w = 0; w < officials.length; w++){
              if(official_id == officials[w]['id']){
                  $('#editposition').val(officials[w]['position']);
                  $('#editname').val(officials[w]['official_name']);
                  $('#editaddress').val(officials[w]['address']);
                  $('#phone').val(officials[w]['phone_number']);
                  $('#editemail').val(officials[w]['email']);
                  $('#official_id').val(officials[w]['id']);
                  
              }
            }
     });
   })
</script>