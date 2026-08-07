
<html>
<title>CONVICLOUD LOGIN PAGE</title>
<head>
<link rel='stylesheet' type='text/css' href='/assets/css/style.css'>
<link rel='stylesheet' type='text/css' href='/assets/css/loginstyle.css'>
<link rel='stylesheet' type='text/css' href='/assets/css/bootstrap.css'>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<!--  -->

<!--    <form class="form" method="post" action="{{ route('validar_usuarios')}}">
<!---->
<!--      <p class="field">-->
<!--        <input type="text" name="email" placeholder="email" required/>-->
<!--        <i class="fa fa-user"></i>-->
<!--      </p>-->
<!---->
<!--      <p class="field">-->
<!--        <input type="password" name="password" placeholder="Contraseña" required/>-->
<!--        <i class="fa fa-lock"></i>-->
<!--      </p>-->
<!---->
<!--      <p class="submit"><input type="submit" name="sent" value="Login"></p>-->
<!---->
<!---->
<!--    </form>-->
<!--    <!--<div class=texto>-->
<!--    <!--  <button type=button onclick="window.open('/recuperar')">contraseña olvidada</a>-->
<!--    <!--</div>-->
<!--  </div>-->
  
  
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">

        <div class="px-5 ms-xl-4">
          <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
          <span class="h1 fw-bold mb-0"></span>
        </div>

        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
        	
          <form style="width: 23rem;"  method="post" action="{{ route('validar_usuarios')}}">
        @csrf
            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

            <div data-mdb-input-init class="form-outline mb-4">
              <input type="email" name=email class="form-control form-control-lg" />
              <label class="form-label" for="email">Email address</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" name=password id=password class="form-control form-control-lg" />
              <label class="form-label" for="password">Password</label>
              @if(session('mensaje'))
                <p class="text-{{session('mensaje')[0]}}"><b>{{session('mensaje')[1]}}</b></p>
              @endif
            </div>
    
            <div class="pt-1 mb-4">
              <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block" type="submit">Login</button>
            </div>


          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="https://portal.edu.gva.es/03001891/wp-content/uploads/sites/668/2023/05/fotofachada.jpg"
          alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: right;">
      </div>
    </div>
  </div>
</section>
