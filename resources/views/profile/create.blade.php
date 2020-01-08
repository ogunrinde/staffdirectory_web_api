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
            <div class="card add_activity" id="add_activity">
              <div class="card-header">
                <h5 class="title">Add Profile</h5>
              </div>
              @if(Session::has('message'))
                     <div class="alert alert-success" role="alert" style="background: #6f42c1;color: #fff">
                      {{ Session::get('message') }}
                    </div> 
               @endif
              <div class="card-body">
                <form action="{{route('priest.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>Status</label>
                        <input type="text" name="status" class="form-control" placeholder="Rev">
                        @if ($errors->has('status')) 
                          <small class="text-danger">{{ $errors->first('status') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="firstname" class="form-control" placeholder="" value="">
                        @if ($errors->has('firstname')) 
                          <small class="text-danger">{{ $errors->first('firstname') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Surname</label>
                        <input type="text" name="surname" class="form-control" placeholder="" value="">
                        @if ($errors->has('surname')) 
                          <small class="text-danger">{{ $errors->first('surname') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Middlename</label>
                        <input type="text" name="middlename" class="form-control" placeholder="">
                        @if ($errors->has('middlename')) 
                          <small class="text-danger">{{ $errors->first('middlename') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Email 1</label>
                        <input type="email" name="email_a" class="form-control" placeholder="" value="">
                        @if ($errors->has('email_a')) 
                          <small class="text-danger">{{ $errors->first('email_a') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Email 2</label>
                        <input type="email" name="email_b" class="form-control" placeholder="" value="">
                        @if ($errors->has('email_b')) 
                          <small class="text-danger">{{ $errors->first('email_b') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" placeholder="" value="">
                        @if ($errors->has('address')) 
                          <small class="text-danger">{{ $errors->first('address') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Martial Status</label>
                        <select name="martial_status" class="form-control" style="padding: 2px;">
                          <option value=""></option>
                           <option value="single">Single</option>
                           <option value="married">Married</option>
                        </select>
                        @if ($errors->has('marital_status')) 
                          <small class="text-danger">{{ $errors->first('marital_status') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Date Deaconed</label>
                        <input type="date" name="date_deaconed" class="form-control" placeholder="" value="">
                        @if ($errors->has('date_deaconed')) 
                          <small class="text-danger">{{ $errors->first('date_deaconed') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Date Priested</label>
                        <input type="date" name="date_priested" class="form-control" placeholder="">
                        @if ($errors->has('date_priested')) 
                          <small class="text-danger">{{ $errors->first('date_priested') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>Phone Number 1</label>
                        <input type="number" name="phone_number_a" class="form-control" placeholder="" value="">
                        @if ($errors->has('phone_number_a')) 
                          <small class="text-danger">{{ $errors->first('phone_number_a') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Phone Number 2</label>
                        <input type="number" name="phone_number_b" class="form-control" placeholder="" value="">
                        @if ($errors->has('phone_number_b')) 
                          <small class="text-danger">{{ $errors->first('phone_number_b') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control" placeholder="" value="">
                        @if ($errors->has('dob')) 
                          <small class="text-danger">{{ $errors->first('dob') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Position</label>
                        <input type="text" name="position" class="form-control" placeholder="Vicar, bishop etc" value="">
                        @if ($errors->has('position')) 
                          <small class="text-danger">{{ $errors->first('position') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>If Married (Spouse Name)</label>
                        <input type="text" name ='spouse_name' class="form-control" placeholder="" value="">
                        @if ($errors->has('spouse_name')) 
                          <small class="text-danger">{{ $errors->first('spouse_name') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Date of Marriage</label>
                        <input type="date" name="date_married" class="form-control" placeholder="Country" value="">
                         @if ($errors->has('date_married')) 
                          <small class="text-danger">{{ $errors->first('date_married') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Spouse Qualification</label>
                        <input type="text" name="spouse_qualification" class="form-control" placeholder="">
                        @if ($errors->has('spouse_qualification')) 
                          <small class="text-danger">{{ $errors->first('spouse_qualification') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group educational_background">
                        
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Educational Background</label>
                        <input type="text" id = 'edu' name='educational_background' class="form-control" placeholder="">
                        <input type="text" style="display: none" id = 'all_edu' name='all_education' class="form-control" placeholder="">
                        <button type="button" id="add_edu" class="btn btn-sm btn-primary" style="background-color: #fff;border: 1px solid orangered;color:orangered">Add</button>
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-12">
                      <div class="form-group parish">
                        
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Parish served till date</label>
                        <input type="text" name="parish" id = 'input_parish' class="form-control" placeholder="">
                        <input type="text" style="display: none" id = 'all_parish' name='all_parish' class="form-control" placeholder="">
                        <button type="button" id='add_parish' class="btn btn-sm btn-primary" style="background-color: #fff;border: 1px solid orangered;color:orangered">Add</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group perferment">
                        
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Perferment</label>
                        <input type="text" id ='perferment' name="perferment" class="form-control" placeholder="">
                        <input type="text" style="display: none" id = 'all_perferment' name='all_perferment' class="form-control" placeholder="">
                        <button type="button" id ='add_perferment' class="btn btn-sm btn-primary" style="background-color: #fff;border: 1px solid orangered;color:orangered">Add</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Current Province</label>
                        <select name="province_name" id='eachprovinces' class="form-control provinces" style="padding: 2px;">
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
                    <div class="col-md-6 px-1">
                      <div class="form-group">
                        <label>Current Diocese</label>
                        <select name="diocese_name" id='eachdioceses' class="dioceses form-control" style="padding: 2px;">
                          
                          
                        </select>
                        @if ($errors->has('diocese_name')) 
                          <small class="text-danger">{{ $errors->first('diocese_name') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Current Archdeaconary</label>
                        <select name="archdeaconary_name" id ='eacharchdeaconary' class="archdeaconaries form-control" style="padding: 2px;">
                          <option value=""></option>
                          
                        </select>
                        @if ($errors->has('archdeaconary')) 
                          <small class="text-danger">{{ $errors->first('archdeaconary') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Current Parish</label>
                        <select name="parish_name" id='eachparish' class="form-control" style="padding: 2px;">
                          <option value=""></option>
                          
                        </select>
                        @if ($errors->has('parish_name')) 
                          <small class="text-danger">{{ $errors->first('parish_name') }}</small>
                        @endif  
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="">
                      <label>Profile Image</label>
                      <div class="form-group">
                          <input type="file" style="" name='image' class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="text-align: center;">
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
  let all_edu = [];
  let parish = [];
  let perferment = [];
  let provinces = [];
  let dioceses = {!! $dioceses !!};
  let archdeaconary = {!! $archdeaconary !!};
  let parishes = {!! $parishes !!};
  let allprofile = {!! $profile !!}
  $(function(){
     $('#add_edu').on('click', function(e){
       e.preventDefault();
       let val = $("#edu").val();
       if(val == '') return false;
        $('.educational_background').append('<input type="text" value = "'+val+'" class="form-control" placeholder="" style="margin:3px;">');
        all_edu.push(val.trim());
        $('#all_edu').val(all_edu.join(' '));
        $("#edu").val('');
     });
     $('#add_parish').on('click', function(e){
       e.preventDefault();
       let val = $("#input_parish").val();
       if(val == '') return false;
        $('.parish').append('<input type="text" value = "'+val+'" class="form-control" placeholder="" style="margin:3px;">');
        parish.push(val.trim());
        $('#all_parish').val(parish.join(' '));
        $("#input_parish").val('');
     });
     $('#add_perferment').on('click', function(e){
       e.preventDefault();
       let val = $("#perferment").val();
       if(val == '') return false;
        $('.perferment').append('<input type="text" value = "'+val+'" class="form-control" placeholder="" style="margin:3px;">');
        perferment.push(val.trim());
        $('#all_perferment').val(perferment.join(' '));
        $("#perferment").val('');
     });
     $('#submiticon').on('click', function(e){
       //alert('a');
       e.preventDefault();
       $('#submitbtn').trigger('click');
     });
     $('#eachprovinces').change(function(e){
        let province = $('#eachprovinces').val();
        $('#eachdioceses').html('');
        //alert(province);
        $('#eachdioceses').append('<option value=""></option');
        for(let r = 0; r < dioceses.length; r++){
          if(province == dioceses[r].province_id){
            $('#eachdioceses').append("<option value='"+dioceses[r].id+"'>"+dioceses[r].diocese_name+"</option>");
          }
        }
     });
     $('#eachdioceses').change(function(e){
        let diocese = $('#eachdioceses').val();
        $('#eacharchdeaconary').html('');
        //alert(province);
        $('#eacharchdeaconary').append('<option value=""></option');
        for(let r = 0; r < archdeaconary.length; r++){
          if(diocese == archdeaconary[r].diocese_id){
            $('#eacharchdeaconary').append("<option value='"+archdeaconary[r].id+"'>"+archdeaconary[r].archdeaconary_name+"</option>");
          }
        }
     });
     $('#eacharchdeaconary').change(function(e){
        let arch = $('#eacharchdeaconary').val();
        $('#eachparish').html('');
        //alert(province);
        $('#eachparish').append('<option value=""></option');
        for(let r = 0; r < parishes.length; r++){
          if(arch == parishes[r].archdeaconary_id){
            $('#eachparish').append("<option value='"+parishes[r].id+"'>"+parishes[r].parish_name+"</option>");
          }
        }
     });
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