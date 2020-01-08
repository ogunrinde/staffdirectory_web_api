@extends('templates.app')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
              <a class="nav-link user" href="#" style="color: #000;font-size: 15px;font-weight: bold">Welcome {{Auth::user()->name}}</a>
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
              <!--div class="card-header">
                <h5 class="title">CHURCH OF NIGERIA</h5>
              </div-->
              <div style="text-align: center;">
                <h2 style="color: #707070;font-weight: bolder;">Pay Now</h2>
                <!--p style="color: #707070;font-weight: bolder;">List of Province(s)</p-->
              </div>
              @if(Session::has('message'))
                     <div class="alert alert-success" role="alert" style="background: #6f42c1;color: #fff">
                      {{ Session::get('message') }}
                    </div> 
               @endif
              <div class="card-body">
                <!--form action="{{route('searchpriest')}}" method="POST">
                  @csrf
                  <div class="input-group no-border">
                    <input type="text" name="search" value="" class="form-control" placeholder="Search...">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <i class="now-ui-icons ui-1_zoom-bold" id="submiticon"></i>
                        <input type="submit" name="submit" id='submitbtn' style="display: none;">
                      </div>
                    </div>
                  </div>
                </form-->
                
                <div class="">
                  <div class="">
                    <div class="">
                        <form action="{{route('updatepayment')}}" method="POST">
                            @csrf
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" disabled="true" id ='email' value="{{Auth::user()->email}}" name="email" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                              <label>Amount to Pay</label>
                              <input type="number" disabled="true" id ='amount' name="amount" class="form-control" placeholder="" value="1000">
                            </div>
                            <div class="form-group">
                              <label>Expiration Date</label>
                              <input type="text" disabled="true" id ='date' value="31/12/<?=date('Y')?>" name="date" class="form-control" placeholder="">
                            </div>
                            <div class="form-group" style="display: none;">
                              <label>Status </label>
                              <input type="text" id ='status' name="status" class="form-control" placeholder="">
                            </div>
                            <div class="form-group" style="display: none;">
                              <label>Reference </label>
                              <input type="text" id ='reference' name="reference" class="form-control" placeholder="">
                            </div>
                            <div class="form-group" style="display: none;">
                              <label>Message </label>
                              <input type="text" id ='message' name="message" class="form-control" placeholder="">
                            </div>
                            <div class="form-group" style="display: none;">
                              <label>Transaction </label>
                              <input type="text" id ='transaction' name="transaction" class="form-control" placeholder="">
                            </div>
                            <button class="btn btn-primary" style="width: 200px;padding: 10px;" type="button" onclick="payWithPaystack()"> Pay Now</button>
                            <button type="submit" id="submitdata" class="btn btn-primary" style="width: 200px;padding: 10px;display: none" >Submit</button> 
                          </form>
                      
                      </div>
                    
                  </div>
                </div>
               
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <!--div class="card card-user">
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
            </div-->
          </div>
        </div>
      </div>
    
    </div>

@endsection
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
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
<script>
  $.post('/updatepayment',   // url
           {  _token: $('meta[name=csrf-token]').attr('content'), myData: 'This is my data.' },
           function(data, status, jqXHR) {// success callback
                    alert(status);
            })
          console.log(response);
  function payWithPaystack(){
    let email = $('#email').val();
    let amount = 100000;
    var handler = PaystackPop.setup({
      key: 'pk_test_e6081be0199b85660e2f466dab4dab608d43c828',
      email: email,
      amount: amount,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "+2348012345678"
            }
         ]
      },
      callback: function(response){
          //alert('success. transaction ref is ' + response.reference);
          $('#reference').val(response.reference);
          $('#message').val(response.message);
          $('#status').val(response.status);
          $('#transaction').val(response.transaction);
          $('#submitdata').trigger('click');
          console.log(response);
      },
      onClose: function(){
          //alert('window closed');
          //$('submitdata').trigger('click');
      }
    });
    handler.openIframe();
  }
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