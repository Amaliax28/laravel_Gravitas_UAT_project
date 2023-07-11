<x-header>UAT Tool</x-header>
<div class="container-fluid login  min-vh-100  w-100">
    <div class="row ">
        <div class="col-auto p-0 min-vh-100 ">
            <div class="login-section-1 min-vh-100"></div>
        </div>
        <div class="col p-0 g-0 overflow-auto">
            <div class="login-section-2 d-flex flex-column justify-content-between">
                <div class="login-container w-auto">
                    <div class="login-header">Welcome Again!</div>
                    <form method="POST" action="/users/authenticate" class="login">
                        @csrf
                        <div class="row m-0 text-start ">
                            <div class="col-auto p-0 ">
                                <div class="row m-0 login-label">
                                    <div class="col-auto p-0 ">
                                        <label for="username">Username</label>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-auto p-0">
                                        <input type="text" name="username" id="username"
                                            value="{{ old('username') }}" class="login-input">
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto g-0  login-gap d-sm-none d-md-block"></div>

                            <div class="col-12 col-md-auto p-0 mt-4 mt-sm-0 ">
                                <div class="row m-0 login-label password-section">
                                    <div class="col-auto p-0">
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-auto p-0">
                                        <div class="input-group login">
                                            <input type="password" name="password" id="password"
                                                class="border-0 login-password"  autocomplete="off">
                                            <button class="border-0 toggle-password m-0 text-wrap text-center"
                                                type="button">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg" id="toggle-password-show"
                                                    class="">
                                                    <g id="24/User Interface/Hide">
                                                        <g>
                                                            <path id="Intersect"
                                                                d="M20.7994 11.2156L21.4575 10.8557L20.7994 11.2156ZM20.7994 12.7846L21.4574 13.1444L20.7994 12.7846ZM3.20058 11.2154L3.8586 11.5753L3.20058 11.2154ZM3.20057 12.7844L2.54254 13.1443H2.54254L3.20057 12.7844ZM19.5236 8.30907C19.227 8.0199 18.7522 8.0259 18.463 8.32247C18.1738 8.61904 18.1798 9.09387 18.4764 9.38304L19.5236 8.30907ZM9.68628 16.9596C9.28505 16.8567 8.87638 17.0986 8.7735 17.4998C8.67062 17.9011 8.91249 18.3097 9.31372 18.4126L9.68628 16.9596ZM14.604 6.34114L14.4099 7.06559L14.604 6.34114ZM7.07264 16.7089L6.70374 17.3619L7.50475 16.0959L7.07264 16.7089ZM3.8586 11.5753C5.43153 8.69919 8.4879 6.75 12 6.75V5.25C7.91882 5.25 4.36847 7.51686 2.54256 10.8556L3.8586 11.5753ZM20.1414 12.4247C18.5685 15.3008 15.5121 17.25 12 17.25V18.75C16.0812 18.75 19.6315 16.4831 21.4574 13.1444L20.1414 12.4247ZM20.1414 11.5754C20.2862 11.8402 20.2862 12.1599 20.1414 12.4247L21.4574 13.1444C21.8475 12.4312 21.8475 11.569 21.4575 10.8557L20.1414 11.5754ZM2.54256 10.8556C2.15249 11.5688 2.15248 12.431 2.54254 13.1443L3.8586 12.4246C3.7138 12.1598 3.7138 11.8401 3.8586 11.5753L2.54256 10.8556ZM18.4764 9.38304C19.1347 10.0249 19.6974 10.7635 20.1414 11.5754L21.4575 10.8557C20.9413 9.91179 20.2876 9.05403 19.5236 8.30907L18.4764 9.38304ZM12 17.25C11.2002 17.25 10.4251 17.1491 9.68628 16.9596L9.31372 18.4126C10.1732 18.633 11.0735 18.75 12 18.75V17.25ZM12 6.75C12.8346 6.75 13.6423 6.85991 14.4099 7.06559L14.7981 5.6167C13.905 5.37739 12.9668 5.25 12 5.25V6.75ZM5.92995 14.9904C5.09529 14.2678 4.39151 13.399 3.8586 12.4246L2.54254 13.1443C3.16202 14.2771 3.97944 15.2858 4.94816 16.1244L5.92995 14.9904ZM7.44154 16.0559C6.90181 15.751 6.3956 15.3935 5.92995 14.9904L4.94816 16.1244C5.48873 16.5924 6.07659 17.0076 6.70374 17.3619L7.44154 16.0559ZM5.00695 16.1704L6.64054 17.3219L7.50475 16.0959L5.87116 14.9444L5.00695 16.1704ZM14.4099 7.06559C15.1269 7.2577 15.8096 7.53359 16.4471 7.88219L17.1668 6.56615C16.426 6.161 15.6321 5.84016 14.7981 5.6167L14.4099 7.06559Z"
                                                                fill="#9CA3AF" />
                                                            <path id="Line" d="M19.4644 4.46433L4.46436 19.4643"
                                                                stroke="#9CA3AF" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path id="Ellipse 44" d="M9 12C9 10.3431 10.3431 9 12 9"
                                                                stroke="#9CA3AF" stroke-width="1.5"
                                                                stroke-linecap="round" />
                                                        </g>
                                                    </g>
                                                </svg>
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg" id="toggle-password-hide"
                                                    class="d-none">
                                                    <path
                                                        d="M12 4C6 4 1.5 7.5 1.5 12C1.5 16.5 6 20 12 20C18 20 22.5 16.5 22.5 12C22.5 7.5 18 4 12 4ZM12 17C9.34315 17 7.5 15.1569 7.5 12C7.5 8.84315 9.34315 7 12 7C14.6569 7 16.5 8.84315 16.5 12C16.5 15.1569 14.6569 17 12 17Z"
                                                        fill="#9CA3AF" />
                                                    <path
                                                        d="M12 10.5C10.067 10.5 8.5 12.067 8.5 14C8.5 15.933 10.067 17.5 12 17.5C13.933 17.5 15.5 15.933 15.5 14C15.5 12.067 13.933 10.5 12 10.5ZM12 15.5C11.1716 15.5 10.5 14.8284 10.5 14C10.5 13.1716 11.1716 12.5 12 12.5C12.8284 12.5 13.5 13.1716 13.5 14C13.5 14.8284 12.8284 15.5 12 15.5Z"
                                                        fill="#9CA3AF" />
                                                    <path
                                                        d="M12 11.5C11.1716 11.5 10.5 12.1716 10.5 13C10.5 13.8284 11.1716 14.5 12 14.5C12.8284 14.5 13.5 13.8284 13.5 13C13.5 12.1716 12.8284 11.5 12 11.5ZM12 13.5C11.6716 13.5 11.4 13.8284 11.4 14.2C11.4 14.5716 11.6716 14.9 12 14.9C12.3284 14.9 12.6 14.5716 12.6 14.2C12.6 13.8284 12.3284 13.5 12 13.5Z"
                                                        fill="#9CA3AF" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-auto px-0 mt-md-0">
                                <div class="row-0 m-0 text-danger pt-2 ps-2">
                                    @error('password')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 text-start ">
                            <div class="col-auto px-0 mt-sm-4 mt-md-0 btn-login-container">
                                <button type="submit" id="loginBtn" class="btn blue">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--FOOTER-->
                <div class=" footer login text-end login-footer">
                    Copyright 2023 All rights reserved | Gravitas Digital
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    // FOR HIDE/SHOW PASSWORD
    document.addEventListener('DOMContentLoaded', function() {
        var passwordInput = document.getElementById('password');
        var toggleButton = document.querySelector('.toggle-password');
        var toggleIconShow = document.getElementById('toggle-password-show');
        var toggleIconHide = document.getElementById('toggle-password-hide');

        toggleButton.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIconShow.classList.add('d-none');
                toggleIconHide.classList.remove('d-none');
            } else {
                passwordInput.type = 'password';
                toggleIconShow.classList.remove('d-none');
                toggleIconHide.classList.add('d-none');
            }
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</body>

</html>
