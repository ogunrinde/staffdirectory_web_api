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
                <h5 class="title">Select Activity</h5>
              </div>
              <div class="card-body">
                @if(Session::has('editmessage'))
                     <div class="alert alert-success" role="alert" style="background: #;color: #fff">
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
                      <div class="form-group archdeaconaries">
                        <label>Select Archdeaconary</label>
                        <select name="archdeaconary" id ='eacharchdeaconary' class="form-control" style="padding: 2px;">
                          <option value=""></option>
                         
                        </select>
                      </div>
                      <div class="form-group parish">
                        <label>Select Parish</label>
                        <select name="parish" id ='eachparish' class="form-control" style="padding: 2px;">
                          <option value=""></option>
                         
                        </select>
                      </div>
                      <div class="form-group priest">
                        <label>Select Priest</label>
                        <select name="priest" id ='eachpriest' class="form-control" style="padding: 2px;">
                          <option value=""></option>
                         
                        </select>
                      </div>
                    </div>
                  </div> 
              </div>
            </div>
            <div class="card edit_activity hide" id="add_activity">
              <div class="card-header">
                <h5 class="title">Edit Profile</h5>
              </div>
              @if(Session::has('message'))
                     <div class="alert alert-success" role="alert" style="background: #6f42c1;color: #fff">
                      {{ Session::get('message') }}
                    </div> 
               @endif
              <div class="card-body">
                <form action="{{route('savedpriestdata')}}" method="POST">
                  @csrf
                  <div class="row" style="text-align: center">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        
                      </div>
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>Status</label>
                        <input type="text" style="display: none;" name="editid" id='editid' class="form-control" placeholder="Rev">
                        <input type="text" name="status" id='editstatus' class="form-control" placeholder="Rev">
                        @if ($errors->has('status')) 
                          <small class="text-danger">{{ $errors->first('status') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="firstname" id="editfirstname" class="form-control" placeholder="" value="">
                        @if ($errors->has('firstname')) 
                          <small class="text-danger">{{ $errors->first('firstname') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Surname</label> 
                        <input type="text" name="surname" id="editsurname" class="form-control" placeholder="" value="">
                        @if ($errors->has('surname')) 
                          <small class="text-danger">{{ $errors->first('surname') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Middlename</label>
                        <input type="text" name="middlename" id="editmiddlename" class="form-control" placeholder="">
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
                        <input type="email" name="email_a" id="editemail_a" class="form-control" placeholder="" value="">
                        @if ($errors->has('email_a')) 
                          <small class="text-danger">{{ $errors->first('email_a') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Email 2</label>
                        <input type="email" name="email_b" id="editemail_b" class="form-control" placeholder="" value="">
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
                        <input type="text" name="address" id="editaddress" class="form-control" placeholder="" value="">
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
                        <select name="marital_status" id="editmartial_status" class="form-control" style="padding: 2px;">
                           <option value="Single">Single</option>
                           <option value="Married">Married</option>
                        </select>
                        @if ($errors->has('marital_status')) 
                          <small class="text-danger">{{ $errors->first('marital_status') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Date Deaconed</label>
                        <input type="date" name="date_deaconed" id="editdate_deaconed" class="form-control" placeholder="" value="">
                        @if ($errors->has('date_deaconed')) 
                          <small class="text-danger">{{ $errors->first('date_deaconed') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Date Priested</label>
                        <input type="date" name="date_priested" id="editdate_priested" class="form-control" placeholder="">
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
                        <input type="number" name="phone_number_a" id="editphone_number_a" class="form-control" placeholder="" value="">
                        @if ($errors->has('phone_number_a')) 
                          <small class="text-danger">{{ $errors->first('phone_number_a') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Phone Number 2</label>
                        <input type="number" name="phone_number_b" id="editphone_number_b" class="form-control" placeholder="" value="">
                        @if ($errors->has('phone_number_b')) 
                          <small class="text-danger">{{ $errors->first('phone_number_b') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control" placeholder="" value="">
                        @if ($errors->has('dob')) 
                          <small class="text-danger">{{ $errors->first('dob') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Position</label>
                        <input type="text" name="position" id="position" class="form-control" placeholder="Bishop, Vicar" value="">
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
                        <input type="text" name ='spouse_name' id="editspouse_name" class="form-control" placeholder="" value="">
                        @if ($errors->has('spouse_name')) 
                          <small class="text-danger">{{ $errors->first('spouse_name') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Date of Marriage</label>
                        <input type="date" name="date_married" id="editdate_married" class="form-control" placeholder="Country" value="">
                         @if ($errors->has('date_married')) 
                          <small class="text-danger">{{ $errors->first('date_married') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Spouse Qualification</label>
                        <input type="text" name="spouse_qualification" id="editspouse_qualification" class="form-control" placeholder="">
                        @if ($errors->has('spouse_qualification')) 
                          <small class="text-danger">{{ $errors->first('spouse_qualification') }}</small>
                          
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group educational_background">
                         <ul class="list-group list_edu"></ul>
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Educational Background</label>
                        <input type="text" id = 'edu' name='educational_background' class="form-control" placeholder="">
                        <input type="text" style="display: none;" id = 'all_edu' name='all_education' class="form-control" placeholder="">
                        <button type="button" id="add_edu" class="btn btn-sm btn-primary" style="background-color: #fff;border: 1px solid orangered;color:orangered">Add</button>
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-12">
                      <div class="form-group parish">
                        <ul class="list-group list_par"></ul>
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Parish served till date</label>
                        <input type="text" name="parish" id = 'input_parish' class="form-control" placeholder="">
                        <input type="text" style="display: none;" id = 'all_parish' name='all_parish' class="form-control" placeholder="">
                        <button type="button" id='add_parish' class="btn btn-sm btn-primary" style="background-color: #fff;border: 1px solid orangered;color:orangered">Add</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group perferment">
                        <ul class="list-group list_per"></ul>
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Perferment</label>
                        <input type="text" id ='perferment' name="perferment" class="form-control" placeholder="">
                        <input type="text" style="display: none;" id = 'all_perferment' name='all_perferment' class="form-control" placeholder="">
                        <button type="button" id ='add_perferment' class="btn btn-sm btn-primary" style="background-color: #fff;border: 1px solid orangered;color:orangered">Add</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Current Province</label>
                        <select name="province_name" class="thisprovince form-control" style="padding: 2px;">
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
                        <select name="diocese_name"  class="form-control thisdiocese" style="padding: 2px;">
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
                    
                    
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Current Archdeaconary</label>
                        <select name="archdeaconary_name" class="form-control thisarchdeaconary" style="padding: 2px;">
                          <option value=""></option>
                          @foreach($archdeaconary as $arch)
                           <option value="{{$arch->id}}">{{$arch->archdeaconary_name}}</option>
                           @endforeach
                        </select>
                        @if ($errors->has('archdeaconary')) 
                          <small class="text-danger">{{ $errors->first('archdeaconary') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Current Parish</label>
                        <select name="parish_name" class="form-control priestparish" style="padding: 2px;">
                          <option value=""></option>
                          @foreach($parishes as $parish)
                           <option value="{{$parish->id}}">{{$parish->parish_name}}</option>
                           @endforeach
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
                          <input type="text" style="display: none;" id ='savedimage' name='savedimage' value="" class="form-control" placeholder="">
                          <input type="file" style="" name='image' class="form-control" placeholder="">
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
  let all_edu = [];
  let parish = [];
  let perferment = [];
  let provinces = {!! $provinces !!};
  let dioceses = {!! $dioceses !!};
  let archdeaconary = {!! $archdeaconary !!};
  let parishes = {!! $parishes !!};
  let profile = {!! $profile !!};
  $(function(){
     $('#add_edu').on('click', function(e){
       e.preventDefault();
       let val = $("#edu").val();
       if(val == '') return false;
       let date = new Date();
       let r = date.getMilliseconds();
        //$('.educational_background').append('<input type="text" value = "'+val+'" class="form-control" placeholder="" style="margin:3px;">');
        //alert(all_edu);
        //let array_edu = all_edu.split('%%');
        all_edu.push(val.trim());
        //alert(array_edu);
        $('#all_edu').val(all_edu.join('%%'));
        $('.list_edu').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+val.trim()+''
          +'<span class="badge badge-pill edu" id="edu'+r+'" all_education = "'+all_edu.join('%%')+'" value = "'+val.trim()+'" style="position: absolute;right: 0;margin-right: 20px;color:red;font-size:20px;">X'
                         +'</span>'
                       +'</li>');
        $("#edu").val('');
     });
     $('#add_parish').on('click', function(e){
       e.preventDefault();
       let val = $("#input_parish").val();
       if(val == '') return false;
        //$('.parish').append('<input type="text" value = "'+val+'" class="form-control" placeholder="" style="margin:3px;">');
        //alert(val);
        let date = new Date();
        let r = date.getMilliseconds();
        parish.push(val.trim());
        //alert(parish);
        $('#all_parish').val(parish.join('%%'));
        $('.list_par').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+val.trim()+''
          +'<span class="badge badge-pill par" id="par'+r+'" all_parish = "'+parish.join('%%')+'" value = "'+val.trim()+'" style="position: absolute;right: 0;margin-right: 20px;color:red;font-size:20px;">X'
                         +'</span>'
                       +'</li>');
        $("#input_parish").val('');
     });
     $('#add_perferment').on('click', function(e){
       e.preventDefault();
       let val = $("#perferment").val();
       if(val == '') return false;
        //$('.perferment').append('<input type="text" value = "'+val+'" class="form-control" placeholder="" style="margin:3px;">');
        let date = new Date();
        let r = date.getMilliseconds();
        perferment.push(val.trim());
        $('#all_perferment').val(perferment.join('%%'));
        $('.list_per').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+val.trim()+''
          +'<span class="badge badge-pill per" id="per'+r+'" all_perferment = "'+parish.join('%%')+'" value = "'+val.trim()+'" style="position: absolute;right: 0;margin-right: 20px;color:red;font-size:20px;">X'
                         +'</span>'
                       +'</li>');
        $("#perferment").val('');
     });
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
      $('.archdeaconaries').on('change', function(e){
         e.preventDefault();
         thisdiocese = [];
         console.log(dioceses);
         $('#eachparish').html('');
         let arch_id = $('#eacharchdeaconary').val();
         //alert(province_id);
         //for(let t = 0; t < provinces.length; t++){
          $("#eachparish").append('<option value =""></option>');
            for(let w = 0; w < parishes.length; w++){
              if(arch_id == parishes[w]['archdeaconary_id']){
                 //alert(dioceses[w]['diocese_name']);
                  //thisdiocese.push({name:dioceses[w]['diocese_name'], id:dioceses[w]['id']});
                  $('#eachparish').append('<option value="'+parishes[w]['id']+'">'+parishes[w]['parish_name']+'</option>');
              }
            }
         //}

     });
     $('.dioceses').on('change', function(e){
         e.preventDefault();
         thisarch = [];
         console.log(archdeaconary);
         $('#eacharchdeaconary').html('');
         let diocese_id = $('#eachdioceses').val();
         //for(let t = 0; t < provinces.length; t++){
          $("#eacharchdeaconary").append('<option value =""></option>');
            for(let w = 0; w < archdeaconary.length; w++){
              if(diocese_id == archdeaconary[w]['diocese_id']){
                //alert(archdeaconary[w]['archdeaconary_name']);
                  //thisarch.push({name:dioceses[w]['diocese_name'], id:dioceses[w]['id']});
                  $('#eacharchdeaconary').append('<option value="'+archdeaconary[w]['id']+'">'+archdeaconary[w]['archdeaconary_name']+'</option>')
              }
            }
         //}

     });
     $('.parish').on('change', function(e){
         e.preventDefault();
         thisparish = [];
         console.log(parishes);
         $('#eachpriest').html('');
         let parish_id = $('#eachparish').val();
         //alert(parish_id);
         //for(let t = 0; t < provinces.length; t++){
          $("#eachpriest").append('<option value =""></option>');
            for(let w = 0; w < profile.length; w++){
              if(parish_id == profile[w]['current_parish']){
                //alert(parishes[w]['parish_name']);
                  //thisarch.push({name:dioceses[w]['diocese_name'], id:dioceses[w]['id']});
                  $('#eachpriest').append('<option value="'+profile[w]['id']+'">'+profile[w]['status']+' '+profile[w]['firstname']+' '+profile[w]['surname']+' '+profile[w]['middlename']+'</option>')
              }
            }
         //}

     });
     $('.priest').on('change', function(e){
         e.preventDefault();
         thispriest = [];
         $('.edit_activity').removeClass('hide');
         //console.log(parishes);
        $('#thispriestid').val()
         console.log(provinces);
         //$('#eachpriest').html('');
         let priest_id = $('#eachpriest').val();
         $('#thispriestid').val(priest_id);
         let current_province;
         let current_parish;
         let current_diocese;
         let current_archdeaconary;   


            for(let w = 0; w < profile.length; w++){

              if(priest_id == profile[w]['id']){
                  $('#editstatus').val(profile[w]['status']);
                  $('#editfirstname').val(profile[w]['firstname']);
                  $('#editsurname').val(profile[w]['surname']);
                  $('#editmiddlename').val(profile[w]['middlename']);
                  $('#editemail_b').val(profile[w]['email_b']);
                  $('#editemail_a').val(profile[w]['email_a']);
                  $('#editmartial_status').val(profile[w]['marital_status']);
                  $('#editphone_number_b').val(profile[w]['phone_number_b']);
                  $('#editphone_number_a').val(profile[w]['phone_number_a']);
                  $('#editdate_married').val(profile[w]['date_married']);
                  $('#editdate_priested').val(profile[w]['date_priested']);
                  $('#editdate_deaconed').val(profile[w]['date_deaconed']);
                  $('#editspouse_name').val(profile[w]['spouse_name']);
                  $('#editspouse_qualification').val(profile[w]['spouse_qualification']);
                  $('#editaddress').val(profile[w]['address']);
                  $('#editid').val(profile[w]['id']);
                  $('#savedimage').val(profile[w]['image']);
                  $('#all_edu').val(profile[w]['all_education']);
                  $('#all_parish').val(profile[w]['all_parish']);
                  $('#all_perferment').val(profile[w]['all_perferment']);
                  $('.thisprovince option[value="'+profile[w]['current_province']+'"]').attr("selected", "selected");
                  $('.thisdiocese option[value="'+profile[w]['current_diocese']+'"]').attr("selected", "selected");
                  $('.thisarchdeaconary option[value="'+profile[w]['current_archdeaconary']+'"]').attr("selected", "selected");
                  $('.priestparish option[value="'+profile[w]['current_parish']+'"]').attr("selected", "selected");
                  //all_edu = profile[w]['all_education'].split('%%');
                  //alert(all_edu);
                  all_edu = profile[w]['all_education'] == null ? [] : profile[w]['all_education'].split('%%');
                  parish = profile[w]['all_parish'] == null ? [] : profile[w]['all_parish'].split('%%');
                  perferment = profile[w]['all_perferment'] == null ? [] :profile[w]['all_perferment'].split('%%');
                  for(let r = 0; r < all_edu.length; r++){
                    $('.list_edu').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+all_edu[r]+''
                         +'<span class="badge badge-pill edu" id="edu'+r+'" all_education = "'+profile[w]['all_education']+'" value = "'+all_edu[r]+'" style="position: absolute;right: 0;margin-right: 20px;color:red;font-size:20px;">X'
                         +'</span>'
                       +'</li>');
                  }
                  for(let r = 0; r < parish.length; r++){
                    $('.list_par').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+parish[r]+''
                         +'<span class="badge badge-pill par" id="par'+r+'" all_parish = "'+profile[w]['all_parish']+'" value = "'+parish[r]+'" style="position: absolute;right: 0;margin-right: 20px;color:red;font-size:20px;">X'
                         +'</span>'
                       +'</li>');
                  }
                  for(let r = 0; r < perferment.length; r++){
                    $('.list_per').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+perferment[r]+''
                         +'<span class="badge badge-pill per" id="per'+r+'" all_perferment = "'+profile[w]['all_perferment']+'" value = "'+perferment[r]+'" style="position: absolute;right: 0;margin-right: 20px;color:red;font-size:20px;">X'
                         +'</span>'
                       +'</li>');
                  }
              }
            }
            //alert(current_province);
     });
     //$('body').on('k')
     $('body').on('click','.edu', function(e){
       e.preventDefault();
       //$('.list_edu').html('');
       let edu = $("#"+this.id+"").attr('all_education');
       let value = $("#"+this.id+"").attr('value');
       all_edu = edu.split("%%");
       let index = all_edu.indexOf(value);
       //alert(index);
       if(index > -1) all_edu.splice(index,1);
       //alert(all_edu);
       edu = all_edu.join('%%');
       $('#all_edu').val(all_edu.join('%%'));
       $('.list_edu').html('');
       for(let r = 0; r < all_edu.length; r++){
                    $('.list_edu').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+all_edu[r]+''
                         +'<span class="badge badge-pill edu" id="edu'+r+'" all_education = "'+edu+'" value = "'+all_edu[r]+'" style="font-size: 20px;position: absolute;right: 0;margin-right: 20px;color:red;">X'
                         +'</span>'
                       +'</li>');
                  }
     });
     $('body').on('click','.par', function(e){
       e.preventDefault();
       //$('.list_edu').html('');
       let par = $("#"+this.id+"").attr('all_parish');
       let value = $("#"+this.id+"").attr('value');
       parish = par.split("%%");
       let index = parish.indexOf(value);
       //alert(index);
       if(index > -1) parish.splice(index,1);
       //alert(all_edu);
       par = parish.join('%%');
       $("#all_parish").val(par);
       $('.list_par').html('');
       for(let r = 0; r < parish.length; r++){
                    $('.list_par').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+parish[r]+''
                         +'<span class="badge badge-pill par" id="par'+r+'" all_parish = "'+par+'" value = "'+parish[r]+'" style="font-size: 20px;position: absolute;right: 0;margin-right: 20px;color:red;">X'
                         +'</span>'
                       +'</li>');
                  }
     });
     $('body').on('click','.per', function(e){
       e.preventDefault();
       //$('.list_edu').html('');
       let per = $("#"+this.id+"").attr('all_perferment');
       let value = $("#"+this.id+"").attr('value');
       perferment = per.split("%%");
       let index = perferment.indexOf(value);
       //alert(index);
       if(index > -1) perferment.splice(index,1);
       //alert(all_edu);
       per = perferment.join('%%');
       $('#all_perferment').val(perferment.join('%%'));
       $('.list_per').html('');
       for(let r = 0; r < perferment.length; r++){
                    $('.list_per').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+perferment[r]+''
                         +'<span class="badge badge-pill par" id="par'+r+'" all_perferment = "'+per+'" value = "'+perferment[r]+'" style="font-size: 20px;position: absolute;right: 0;margin-right: 20px;color:red;">X'
                         +'</span>'
                       +'</li>');
                  }
     });
     $('#activity').on('change', function(e){
        e.preventDefault();
        let activity = $(this).val();
        if(activity == 'add'){
          $('#add_activity').removeClass('hide');
          $('#edit_activity').addClass('hide');
          $('#delete_activity').addClass('hide');
          $('.provinces').addClass('hide');
          $('.dioceses').addClass('hide');
          $('.archdeaconarries').addClass('hide');
          $('.parish').addClass('hide');
          $('.priest').addClass('hide');
        } 
        else if(activity == 'edit'){
          $('#edit_activity').removeClass('hide');
          $('#add_activity').addClass('hide');
          $('#delete_activity').addClass('hide');
          $('.provinces').removeClass('hide');
          $('.dioceses').removeClass('hide');
          $('.archdeaconaries').removeClass('hide');
          $('.parish').removeClass('hide');
          $('.priest').removeClass('hide');
        } 
        else if(activity == 'delete'){
          $('edit_activity').addClass('hide');
          $('#add_activity').addClass('hide');
          //$('#delete_activity').removeClass('hide');
          $('.provinces').removeClass('hide');
          $('.dioceses').removeClass('hide');
          $('.archdeaconaries').removeClass('hide');
          $('.parish').removeClass('hide');
          $('.priest').removeClass('hide');
          $('.deletepriest').removeClass('hide');
        }
     })
   })
</script>