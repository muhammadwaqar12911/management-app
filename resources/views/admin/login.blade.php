<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="{{asset('management_app/public/admin/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Management App</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="{{url('login')}}">
                                            @csrf
                                            <div class="form-floating mt-3 mb-3">
                                                <input class="form-control <?php if(Session::get('email_error') || $errors->has('email')) echo("is-invalid")?>" value="{{old('email')}}" id="email" type="email" name="email" placeholder="name@example.com" required autofocus/>
                                                <label for="email">Email address</label>
                                                @if(Session::get('email_error') || $errors->has('email'))
                                                <div class="text-danger mb-4" id="divID">
                                                    {{$errors->first('email')}}
                                                    {{Session::get('email_error')}}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control <?php if(Session::get('password_error') || $errors->has('password')) echo("is-invalid")?>" value="{{old('password')}}" id="password" type="password" name="password" placeholder="Password" />
                                                <label for="password">Password</label>
                                                @if(Session::get('password_error') || $errors->has('password'))
                                                <div class="text-danger mb-4" id="divID">
                                                    {{$errors->first('password')}}
                                                    {{Session::get('password_error')}}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between my-4">
                                                <input class="btn text-white form-control btn-lg bg-primary"type="submit" value="Login">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Management App 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('management_app/public/admin/js/scripts.js')}}"></script>
    </body>
</html>
