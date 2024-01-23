<!DOCTYPE html>

<html lang="en">

<head>

    <style>
        .bg-red {
            background-color: #f14435;
        }

        .text-red {
            color: #f14435;
        }

        .text-red:hover {
            color: #c53225;
        }

        .btn-red-cust {
            background-color: #f14435;
            color: #ffffff;
        }

        .btn-red-cust:hover {
            background-color: #c53225;
            color: #ffffff;
        }
    </style>
</head>

<body class="sign-inup" id="body">

    <div class="container d-flex align-items-center justify-content-center form-height-login pt-24px pb-24px">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="card">
                
                    <div class="card-body p-5">
                        <h4 class="text-dark mb-5" style="font-weight:600; font-size:30px;">Login Page</h4>

                        <form method="POST" action="{{ route('user.userlogin') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Enter email">
                                </div>

                                <div class="form-group col-md-12 ">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter Password" required>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex my-2 justify-content-between">
                                        <div class="d-inline-block mr-3">

                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-red-cust btn-block mb-4">login</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
