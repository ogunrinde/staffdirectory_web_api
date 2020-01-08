@extends('templates.app')
@section('content')
<style type="text/css">
  .hide{
    display: none;
  }
  .form-group input[type=file] {
    position: inherit;
    opacity: 1;
    height: 40px;
  }
  .form-group input[type=submit] {
    margin-top: 40px;
  }
</style>
<div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">User Profile</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="now-ui-icons users_single-02"></i>                               
                                        {{ __('Logout') }}
                                    </a>
                  
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                  </form>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Select Activity</h5>
              </div>
              <div class="card-body">
                @if(Session::has('deletemessage'))
                     <div class="alert alert-success" role="alert" style="background: #6f42c1">
                      {{ Session::get('deletemessage') }}
                    </div> 
               @endif
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Activity</label>
                        <select name="activity" id ='activity' class="form-control">
                          <option value=""></option>
                          <option value="add">Add Profile</option>
                          <option value="edit">Edit Profile</option>
                          <option value="delete">Delete Profile</option>
                        </select>
                      </div>
                      <div class="form-group provinces hide">
                        <label>Select Province</label>
                        <select name="provinces" id ='eachprovinces' class="form-control">
                          <option value=""></option>
                          @foreach($provinces as $province)
                           <option value="{{$province->id}}">{{$province->province_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group dioceses hide">
                        <label>Select Dioceses</label>
                        <select name="dioceses" id ='eachdioceses' class="form-control">
                          <option value=""></option>
                         
                        </select>
                      </div>
                      <div class="form-group archdeaconaries hide">
                        <label>Select Archdeaconary</label>
                        <select name="archdeaconary" id ='eacharchdeaconary' class="form-control">
                          <option value=""></option>
                         
                        </select>
                      </div>
                      <div class="form-group parish hide">
                        <label>Select Parish</label>
                        <select name="parish" id ='eachparish' class="form-control">
                          <option value=""></option>
                         
                        </select>
                      </div>
                      <div class="form-group priest hide">
                        <label>Select Priest</label>
                        <select name="priest" id ='eachpriest' class="form-control">
                          <option value=""></option>
                         
                        </select>
                      </div>
                    </div>
                  </div> 
                  <form action="{{route('deletepriest')}}" method="POST">
                   @csrf 
                    <div class="form-group priest hide">
                          <label>Select Priest</label>
                          <input type="text" name="thispriestid" id ='thispriestid'>
                        </div> 
                    <div class="row deletepriest hide">
                      <div class="col-md-12" style="text-align: center;">
                        <div class="form-group">
                          <button type="submit" id ='' name="submit" class="btn btn-sm btn-primary">Delete Data</button>
                        </div>
                      </div>
                    </div>
                </form>
              </div>
            </div>
            <div class="card add_activity hide" id="add_activity">
              <div class="card-header">
                <h5 class="title">Add Profile</h5>
              </div>
              @if(Session::has('message'))
                     <div class="alert alert-success" role="alert" style="background: #6f42c1">
                      {{ Session::get('message') }}
                    </div> 
               @endif
              <div class="card-body">
                <form action="{{route('profile.store')}}" method="POST">
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
                        <select name="martial_status" class="form-control">
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
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Phone Number 1</label>
                        <input type="number" name="phone_number_a" class="form-control" placeholder="" value="">
                        @if ($errors->has('phone_number_a')) 
                          <small class="text-danger">{{ $errors->first('phone_number_a') }}</small>
                          
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6 px-1">
                      <div class="form-group">
                        <label>Phone Number 2</label>
                        <input type="number" name="phone_number_b" class="form-control" placeholder="" value="">
                        @if ($errors->has('phone_number_b')) 
                          <small class="text-danger">{{ $errors->first('phone_number_b') }}</small>
                          
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
                        <button type="button" id="add_edu" class="btn btn-sm btn-primary" style="">Add Educational Background</button>
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
                        <button type="button" id='add_parish' class="btn btn-sm btn-primary" style="">Add Parish served</button>
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
                        <button type="button" id ='add_perferment' class="btn btn-sm btn-primary" style="">Add Perferment</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label>Current Province</label>
                        <select name="province_name" class="form-control">
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
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Current Diocese</label>
                        <select name="diocese_name" class="form-control">
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
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label>Current Archdeaconary</label>
                        <select name="archdeaconary_name" class="form-control">
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
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label>Current Parish</label>
                        <select name="parish_name" class="form-control">
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
                          <input type="file" style="" name='image' class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                      <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-sm btn-outline" style="">Submit Data</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            
          </div>
          <div class="col-md-4">
            <div class="card card-user">
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
                alert(archdeaconary[w]['archdeaconary_name']);
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
         //for(let t = 0; t < provinces.length; t++){
          $("#eachpriest").append('<option value =""></option>');
            for(let w = 0; w < profile.length; w++){
              if(parish_id == profile[w]['id']){
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
         //console.log(parishes);
        $('#thispriestid').val()

         //$('#eachpriest').html('');
         let priest_id = $('#eachpriest').val();
         $('#thispriestid').val(priest_id);
            for(let w = 0; w < profile.length; w++){
              if(priest_id == profile[w]['id']){
                  $('#editstatus').val(profile[w]['status']);
                  $('#editfirstname').val(profile[w]['firstname']);
                  $('#editsurname').val(profile[w]['surname']);
                  $('#editmiddlename').val(profile[w]['middlename']);
                  $('#editemail_b').val(profile[w]['email_b']);
                  $('#editemail_a').val(profile[w]['email_a']);
                  $('#editphone_number_b').val(profile[w]['phone_number_b']);
                  $('#editphone_number_a').val(profile[w]['phone_number_a']);
                  $('#editdate_married').val(profile[w]['date_married']);
                  $('#editdate_priested').val(profile[w]['date_priested']);
                  $('#editdate_deaconed').val(profile[w]['date_deaconed']);
                  $('#editspouse_name').val(profile[w]['spouse_name']);
                  $('#editspouse_qualification').val(profile[w]['spouse_qualification']);
                  $('#editaddress').val(profile[w]['address']);
                  $('#editstatus').val(profile[w]['status']);
                  let edu = profile[w]['all_education'] == null ? [] : profile[w]['all_education'].split('%%');
                  let par = profile[w]['all_parish'] == null ? [] : profile[w]['all_parish'].split('%%');
                  let per = profile[w]['all_perferment'] == null ? [] :profile[w]['all_perferment'].split('%%');
                  for(let r = 0; r < edu.length; r++){
                    $('.list_edu').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+edu[r]+''
                         +'<span class="badge badge-pill edu" id="edu'+r+'" all_education = "'+profile[w]['all_education']+'" value = "'+edu[r]+'" style="font-size: 15px;background-color: #fff;color:#73879C;width: 25px;height: 25px;border-radius: 14px;border: 1px solid #ccc;position: absolute;right: 0;margin-right: 20px;color:red;">X'
                         +'</span>'
                       +'</li>');
                  }
                  for(let r = 0; r < par.length; r++){
                    $('.list_par').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+par[r]+''
                         +'<span class="badge badge-pill par" id="par'+r+'" all_parish = "'+profile[w]['all_parish']+'" value = "'+par[r]+'" style="font-size: 15px;background-color: #fff;color:#73879C;width: 25px;height: 25px;border-radius: 14px;border: 1px solid #ccc;position: absolute;right: 0;margin-right: 20px;color:red;">X'
                         +'</span>'
                       +'</li>');
                  }
                  for(let r = 0; r < per.length; r++){
                    $('.list_per').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+per[r]+''
                         +'<span class="badge badge-pill per" id="per'+r+'" all_perferment = "'+profile[w]['all_perferment']+'" value = "'+per[r]+'" style="font-size: 15px;background-color: #fff;color:#73879C;width: 25px;height: 25px;border-radius: 14px;border: 1px solid #ccc;position: absolute;right: 0;margin-right: 20px;color:red;">X'
                         +'</span>'
                       +'</li>');
                  }
              }
            }
     });
     //$('body').on('k')
     $('body').on('click','.edu', function(e){
       e.preventDefault();
       $('.list_edu').html('');
       let edu = $("#"+this.id+"").props('value');
       alert(edu);
       let value = $("#"+this.id+"").attr('value');
       let this_edu = edu.split("%%");
       let index = this_edu.indexOf(value);
       alert(index);
       if(index > -1) this_edu.splice(index,1);
       alert(this_edu);
       for(let r = 0; r < this_edu.length; r++){
                    $('.list_edu').append('<li class="list-group-item d-flex justify-content-between align-items-center">'+this_edu[r]+''
                         +'<span class="badge badge-pill edu" id="edu'+r+'" all_education = "'+edu+'" value = "'+this_edu[r]+'" style="font-size: 15px;background-color: #fff;color:#73879C;width: 25px;height: 25px;border-radius: 14px;border: 1px solid #ccc;position: absolute;right: 0;margin-right: 20px;color:red;">X'
                         +'</span>'
                       +'</li>');
                  }
     })
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