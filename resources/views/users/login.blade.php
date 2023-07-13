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
                            <div class="col-12 pb-3 pb-md-0 col-md-auto p-0 ">
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

                            <div class="col-12 col-md-auto p-0 mt-sm-0 ">
                                <div class="row m-0 login-label password-section">
                                    <div class="col-auto p-0">
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="row m-0">
                                    <div class="col-auto p-0">
                                        <div class="pass-group d-flex login-input p-0  password">
                                            <input type="password" name="password" id="passwordInput" class="" autocomplete="off">
                                            <button class="border-0 toggle-password m-0 text-wrap text-center" type="button" id="togglePassBtn" >
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" id="closeEyeIcon"
                                                    xmlns="http://www.w3.org/2000/svg"
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
                                                <svg width="24" height="24" viewBox="0 0 24 24" class="d-none" id="openEyeIcon" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#9CA3AF">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0001 5.25C9.22586 5.25 6.79699 6.91121 5.12801 8.44832C4.28012 9.22922 3.59626 10.0078 3.12442 10.5906C2.88804 10.8825 2.70368 11.1268 2.57736 11.2997C2.51417 11.3862 2.46542 11.4549 2.43187 11.5029C2.41509 11.5269 2.4021 11.5457 2.393 11.559L2.38227 11.5747L2.37911 11.5794L2.10547 12.0132L2.37809 12.4191L2.37911 12.4206L2.38227 12.4253L2.393 12.441C2.4021 12.4543 2.41509 12.4731 2.43187 12.4971C2.46542 12.5451 2.51417 12.6138 2.57736 12.7003C2.70368 12.8732 2.88804 13.1175 3.12442 13.4094C3.59626 13.9922 4.28012 14.7708 5.12801 15.5517C6.79699 17.0888 9.22586 18.75 12.0001 18.75C14.7743 18.75 17.2031 17.0888 18.8721 15.5517C19.72 14.7708 20.4039 13.9922 20.8757 13.4094C21.1121 13.1175 21.2964 12.8732 21.4228 12.7003C21.4859 12.6138 21.5347 12.5451 21.5682 12.4971C21.585 12.4731 21.598 12.4543 21.6071 12.441L21.6178 12.4253L21.621 12.4206L21.6224 12.4186L21.9035 12L21.622 11.5809L21.621 11.5794L21.6178 11.5747L21.6071 11.559C21.598 11.5457 21.585 11.5269 21.5682 11.5029C21.5347 11.4549 21.4859 11.3862 21.4228 11.2997C21.2964 11.1268 21.1121 10.8825 20.8757 10.5906C20.4039 10.0078 19.72 9.22922 18.8721 8.44832C17.2031 6.91121 14.7743 5.25 12.0001 5.25ZM4.29022 12.4656C4.14684 12.2885 4.02478 12.1311 3.92575 12C4.02478 11.8689 4.14684 11.7115 4.29022 11.5344C4.72924 10.9922 5.36339 10.2708 6.14419 9.55168C7.73256 8.08879 9.80369 6.75 12.0001 6.75C14.1964 6.75 16.2676 8.08879 17.8559 9.55168C18.6367 10.2708 19.2709 10.9922 19.7099 11.5344C19.8533 11.7115 19.9753 11.8689 20.0744 12C19.9753 12.1311 19.8533 12.2885 19.7099 12.4656C19.2709 13.0078 18.6367 13.7292 17.8559 14.4483C16.2676 15.9112 14.1964 17.25 12.0001 17.25C9.80369 17.25 7.73256 15.9112 6.14419 14.4483C5.36339 13.7292 4.72924 13.0078 4.29022 12.4656ZM14.25 12C14.25 13.2426 13.2427 14.25 12 14.25C10.7574 14.25 9.75005 13.2426 9.75005 12C9.75005 10.7574 10.7574 9.75 12 9.75C13.2427 9.75 14.25 10.7574 14.25 12ZM15.75 12C15.75 14.0711 14.0711 15.75 12 15.75C9.92898 15.75 8.25005 14.0711 8.25005 12C8.25005 9.92893 9.92898 8.25 12 8.25C14.0711 8.25 15.75 9.92893 15.75 12Z" fill="#9CA3AF">
                                                        </path> </g>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="login-error">
                                    <span class="text-error">
                                        @error('password'){{$message}}@enderror
                                    </span>
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
    const togglePassBtn = document.querySelector('#togglePassBtn');
        const passwordInput = document.querySelector('#passwordInput');
        const closeEyeIcon = document.querySelector('#closeEyeIcon');
        const openEyeIcon = document.querySelector('#openEyeIcon');


        togglePassBtn.addEventListener('click', () => {

            if(passwordInput.type === "password"){
                passwordInput.type = "text";
                closeEyeIcon.classList.add("d-none");
                openEyeIcon.classList.remove("d-none");
            }
            else{
                    passwordInput.type = "password";
                    closeEyeIcon.classList.remove("d-none");
                    openEyeIcon.classList.add("d-none");
            }
        });




</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</body>

</html>
