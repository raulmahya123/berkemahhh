<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Reset Password</title>
    </head>
    <body>
        <main>
            <div class="container">
                <section
                    class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
                >
                    <div class="container">
                        <div class="row justify-content-center">
                            <div
                                class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
                            >
                                <!-- End Logo -->

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="pt-4 pb-2">
                                            <h5
                                                class="card-title text-center pb-0 fs-4"
                                            >
                                                Recover Your Password
                                            </h5>
                                            <p class="text-center small">
                                                Create Your new Password
                                            </p>
                                        </div>
                                        {{-- display flash message here --}}
                                        @if (Session::has('success'))
                                        <div class="alert alert-success">
                                            {{Session::get('success')}}
                                        </div>
                                        @endif @if (Session::has('error'))
                                        <div class="alert alert-danger">
                                            {{Session::get('error')}}
                                        </div>
                                        @endif
                                        <form
                                            class="row g-3"
                                            action="{{
                                                route('ResetPassword')
                                            }}"
                                            method="POST"
                                        >
                                            @csrf
                                            <input
                                                type="hidden"
                                                name="user_id"
                                                value="{{$user_data->id}}"
                                            />
                                            <input
                                                type="hidden"
                                                name="user_email"
                                                value="{{$user_data->email}}"
                                            />
                                            <div class="col-12">
                                                <label
                                                    for="yourPassword"
                                                    class="form-label"
                                                    >New Password</label
                                                >
                                                <input
                                                    type="password"
                                                    name="password"
                                                    class="form-control"
                                                />
                                                <span class="text-danger"
                                                    >@error('password'){{
                                                        $message
                                                    }}@enderror</span
                                                >
                                            </div>
                                            <div class="col-12">
                                                <label
                                                    for="yourPassword"
                                                    class="form-label"
                                                    >Confirm Password</label
                                                >
                                                <input
                                                    type="password"
                                                    name="password_confirmation"
                                                    class="form-control"
                                                />
                                                <span class="text-danger"
                                                    >@error('cpassword'){{
                                                        $message
                                                    }}@enderror</span
                                                >
                                            </div>
                                            <div class="col-12">
                                                <button
                                                    class="btn btn-primary w-100"
                                                    type="submit"
                                                >
                                                    Reset Password
                                                </button>
                                            </div>
                                            <div class="col-12">
                                                <p class="small mb-0">
                                                    <a href="/login/form"
                                                        >login</a
                                                    >
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </body>
</html>
