<x-header>UAT</x-header>
<div class="container-fluid min-vh-100 ">
    <div class="row overflow-hidden">
        <!--SideBar-->
        <div class="col-auto sidebar min-vh-100 p-0">
            <div class="container-fluid h-100 p-0 ">
                <div class="row m-0 h-100">
                    <div class="col-auto p-0 w-100">
                        <div class="sidebar-top ">
                            <div class="profile-pic  mx-auto">
                                <img src="{{ auth()->user()->userImage ? asset('storage/' . auth()->user()->userImage) : asset('images/user.png') }}"
                                    alt="profile-pic">
                            </div>
                            <div class="username  mx-auto">
                                {{ auth()->user()->username }}
                            </div>
                        </div>
                        <div class="sbl-container ">
                            <ul class="nav nav-pills flex-column justify-content-center align-items-center link-list">
                                <x-sidebarHome/>
                                @if (Auth::check() && !(Auth::user()->roles == 'tester'))
                                    <!-- IF NOT TESTER  / project manager-->
                                    <x-sidebarProjects />
                                    @if (Auth::check() && Auth::user()->roles == 'admin')
                                        <x-sidebarCreateUser />
                                    @endif
                                @else
                                    <!-- IF TESTER -->
                                    <x-sidebarMyProjects />
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sbl-bottom-container ">
                <ul class="nav nav-pills flex-column justify-content-center align-items-center link-list">
                    <li class="nav-item">
                        <a href="/profile-settings">
                            <div class="sidebar-link bottom d-flex ">
                                <svg width="23" height="23" viewBox="0 0 28 28" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="default-icon">
                                    <path
                                        d="M27.3512 16.8006L25.4914 14.3212C25.4942 14.1022 25.492 13.8685 25.4888 13.682L27.3503 11.2C27.4414 11.0785 27.5037 10.9379 27.5324 10.7888C27.5611 10.6397 27.5554 10.486 27.5159 10.3394C27.2037 9.18258 26.7436 8.07087 26.147 7.03177C26.0713 6.90005 25.9667 6.7873 25.8409 6.70209C25.7152 6.61687 25.5716 6.56142 25.4212 6.53995L22.3603 6.10282C22.2105 5.94425 22.0562 5.78993 21.8974 5.63987L21.4604 2.5803C21.439 2.42998 21.3835 2.28653 21.2984 2.16082C21.2132 2.03511 21.1005 1.93045 20.9689 1.85477C19.9302 1.25752 18.8188 0.796743 17.6622 0.483862C17.5156 0.444227 17.3618 0.438517 17.2126 0.467166C17.0634 0.495815 16.9227 0.55807 16.8012 0.649206L14.3277 2.50456C14.1097 2.49852 13.8911 2.49852 13.6731 2.50456L11.2007 0.650132C11.0792 0.55904 10.9385 0.496801 10.7894 0.468132C10.6403 0.439463 10.4866 0.445117 10.34 0.484666C9.1832 0.796798 8.07149 1.25685 7.03239 1.85344C6.90067 1.92912 6.78792 2.0338 6.70269 2.15956C6.61746 2.28531 6.562 2.42882 6.54051 2.57921L6.10344 5.64006C5.94493 5.7899 5.79061 5.94424 5.64049 6.10307L2.58092 6.54002C2.4306 6.56149 2.28715 6.61691 2.16144 6.70207C2.03573 6.78723 1.93107 6.89991 1.85539 7.03154C1.25813 8.07026 0.797354 9.18168 0.484484 10.3383C0.444835 10.4849 0.439124 10.6387 0.467784 10.7879C0.496445 10.9371 0.558723 11.0778 0.649889 11.1993L2.50963 13.6786C2.50682 13.8977 2.50908 14.1314 2.51232 14.3179L0.650743 16.7999C0.559632 16.9213 0.497376 17.062 0.468696 17.2111C0.440017 17.3602 0.445666 17.5139 0.485216 17.6605C0.797376 18.8173 1.25745 19.929 1.85405 20.9681C1.92972 21.0998 2.03441 21.2125 2.16016 21.2978C2.28592 21.383 2.42944 21.4384 2.57982 21.4599L5.64073 21.897C5.79058 22.0556 5.94487 22.2099 6.10362 22.36L6.54064 25.4195C6.56211 25.5699 6.61754 25.7133 6.70271 25.839C6.78789 25.9647 6.90057 26.0694 7.03221 26.1451C8.07089 26.7423 9.18228 27.2031 10.3389 27.516C10.4855 27.5556 10.6393 27.5614 10.7885 27.5327C10.9376 27.5041 11.0783 27.4418 11.1999 27.3506L13.6733 25.4953C13.8913 25.5014 14.11 25.5014 14.328 25.4953L16.8004 27.3497C16.9219 27.4408 17.0625 27.5031 17.2116 27.5318C17.3608 27.5604 17.5145 27.5548 17.6611 27.5152C18.8179 27.2031 19.9296 26.743 20.9687 26.1464C21.1004 26.0707 21.2132 25.966 21.2984 25.8403C21.3836 25.7145 21.4391 25.571 21.4606 25.4206L21.8987 22.3525C22.0555 22.1995 22.2191 22.0327 22.3487 21.8985L25.4202 21.4598C25.5705 21.4384 25.7139 21.3829 25.8396 21.2978C25.9653 21.2126 26.07 21.0999 26.1457 20.9683C26.7429 19.9296 27.2037 18.8182 27.5166 17.6615C27.5562 17.5149 27.5619 17.3611 27.5333 17.212C27.5046 17.0628 27.4423 16.9221 27.3512 16.8006ZM14.0005 19.4999C12.9127 19.4999 11.8493 19.1773 10.9448 18.5729C10.0404 17.9686 9.33542 17.1096 8.91914 16.1046C8.50285 15.0996 8.39393 13.9938 8.60615 12.9269C8.81837 11.86 9.3422 10.88 10.1114 10.1108C10.8806 9.34159 11.8606 8.81776 12.9275 8.60555C13.9944 8.39333 15.1002 8.50224 16.1052 8.91853C17.1102 9.33481 17.9692 10.0398 18.5736 10.9442C19.1779 11.8487 19.5005 12.9121 19.5005 13.9999C19.4988 15.458 18.9188 16.856 17.8877 17.8871C16.8566 18.9182 15.4587 19.4982 14.0005 19.4999Z"
                                        fill="#9CA3AF" />
                                </svg>
                                <svg width="23" height="23" viewBox="0 0 29 28" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="hover-icon">
                                    <path
                                        d="M27.8512 16.8006L25.9914 14.3212C25.9942 14.1022 25.992 13.8685 25.9888 13.682L27.8503 11.2C27.9414 11.0785 28.0037 10.9379 28.0324 10.7888C28.0611 10.6397 28.0554 10.486 28.0159 10.3394C27.7037 9.18258 27.2436 8.07087 26.647 7.03177C26.5713 6.90005 26.4667 6.7873 26.3409 6.70209C26.2152 6.61687 26.0716 6.56142 25.9212 6.53995L22.8603 6.10282C22.7105 5.94425 22.5562 5.78993 22.3974 5.63987L21.9604 2.5803C21.939 2.42998 21.8835 2.28653 21.7984 2.16082C21.7132 2.03511 21.6005 1.93045 21.4689 1.85477C20.4302 1.25752 19.3188 0.796743 18.1622 0.483862C18.0156 0.444227 17.8618 0.438517 17.7126 0.467166C17.5634 0.495815 17.4227 0.55807 17.3012 0.649206L14.8277 2.50456C14.6097 2.49852 14.3911 2.49852 14.1731 2.50456L11.7007 0.650132C11.5792 0.55904 11.4385 0.496801 11.2894 0.468132C11.1403 0.439463 10.9866 0.445117 10.84 0.484666C9.6832 0.796798 8.57149 1.25685 7.53239 1.85344C7.40067 1.92912 7.28792 2.0338 7.20269 2.15956C7.11746 2.28531 7.062 2.42882 7.04051 2.57921L6.60344 5.64006C6.44493 5.7899 6.29061 5.94424 6.14049 6.10307L3.08092 6.54002C2.9306 6.56149 2.78715 6.61691 2.66144 6.70207C2.53573 6.78723 2.43107 6.89991 2.35539 7.03154C1.75813 8.07026 1.29735 9.18168 0.984484 10.3383C0.944835 10.4849 0.939124 10.6387 0.967784 10.7879C0.996445 10.9371 1.05872 11.0778 1.14989 11.1993L3.00963 13.6786C3.00682 13.8977 3.00908 14.1314 3.01232 14.3179L1.15074 16.7999C1.05963 16.9213 0.997376 17.062 0.968696 17.2111C0.940017 17.3602 0.945666 17.5139 0.985216 17.6605C1.29738 18.8173 1.75745 19.929 2.35405 20.9681C2.42972 21.0998 2.53441 21.2125 2.66016 21.2978C2.78592 21.383 2.92944 21.4384 3.07982 21.4599L6.14073 21.897C6.29058 22.0556 6.44487 22.2099 6.60362 22.36L7.04064 25.4195C7.06211 25.5699 7.11754 25.7133 7.20271 25.839C7.28789 25.9647 7.40057 26.0694 7.53221 26.1451C8.57089 26.7423 9.68228 27.2031 10.8389 27.516C10.9855 27.5556 11.1393 27.5614 11.2885 27.5327C11.4376 27.5041 11.5783 27.4418 11.6999 27.3506L14.1733 25.4953C14.3913 25.5015 14.61 25.5015 14.828 25.4953L17.3004 27.3497C17.4219 27.4408 17.5625 27.5031 17.7116 27.5318C17.8608 27.5604 18.0145 27.5548 18.1611 27.5152C19.3179 27.2031 20.4296 26.743 21.4687 26.1464C21.6004 26.0707 21.7132 25.966 21.7984 25.8403C21.8836 25.7145 21.9391 25.571 21.9606 25.4206L22.3987 22.3525C22.5555 22.1995 22.7191 22.0327 22.8487 21.8985L25.9202 21.4598C26.0705 21.4384 26.2139 21.3829 26.3396 21.2978C26.4653 21.2126 26.57 21.0999 26.6457 20.9683C27.2429 19.9296 27.7037 18.8182 28.0166 17.6615C28.0562 17.5149 28.0619 17.3611 28.0333 17.212C28.0046 17.0628 27.9423 16.9221 27.8512 16.8006V16.8006ZM14.5005 19.4999C13.4127 19.4999 12.3493 19.1773 11.4448 18.5729C10.5404 17.9686 9.83542 17.1096 9.41914 16.1046C9.00285 15.0996 8.89393 13.9938 9.10615 12.9269C9.31837 11.86 9.8422 10.88 10.6114 10.1108C11.3806 9.34159 12.3606 8.81776 13.4275 8.60555C14.4944 8.39333 15.6002 8.50224 16.6052 8.91853C17.6102 9.33481 18.4692 10.0398 19.0736 10.9442C19.6779 11.8487 20.0005 12.9121 20.0005 13.9999C19.9988 15.458 19.4188 16.856 18.3877 17.8871C17.3566 18.9182 15.9587 19.4982 14.5005 19.4999V19.4999Z"
                                        fill="#FBFBFA" />
                                </svg>
                                <div class="sidebar-label ">
                                    Account Settings
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <form action="/logout" method="POST" class="d-inline">
                            @csrf
                            <button  type="submit" class="w-100 border-0 bg-transparent ">
                                <div class="sidebar-link bottom d-flex  ">
                                    <svg width="23" height="23" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="default-icon">
                                        <path
                                            d="M23.7072 12.707L18.4586 17.957C18.3188 18.0969 18.1406 18.1922 17.9466 18.2308C17.7526 18.2694 17.5515 18.2496 17.3688 18.1739C17.186 18.0983 17.0298 17.9701 16.9199 17.8056C16.81 17.6412 16.7513 17.4478 16.7513 17.25V13H9C8.73478 13 8.48043 12.8946 8.29289 12.7071C8.10536 12.5196 8 12.2652 8 12C8 11.7348 8.10536 11.4804 8.29289 11.2929C8.48043 11.1054 8.73478 11 9 11H16.7513V6.75C16.7513 6.5522 16.81 6.35884 16.9199 6.19438C17.0298 6.02991 17.186 5.90174 17.3688 5.82605C17.5515 5.75037 17.7526 5.73058 17.9466 5.7692C18.1406 5.80781 18.3188 5.90308 18.4586 6.04297L23.7072 11.293C23.8947 11.4805 24 11.7348 24 12C24 12.2652 23.8947 12.5195 23.7072 12.707ZM9 22H2V2H9C9.26522 2 9.51957 1.89464 9.70711 1.70711C9.89464 1.51957 10 1.26522 10 1C10 0.734784 9.89464 0.48043 9.70711 0.292893C9.51957 0.105357 9.26522 0 9 0H2C1.46975 0.000606423 0.961398 0.211515 0.586456 0.586456C0.211515 0.961398 0.000606423 1.46975 0 2V22C0.000606423 22.5302 0.211515 23.0386 0.586456 23.4135C0.961398 23.7885 1.46975 23.9994 2 24H9C9.26522 24 9.51957 23.8946 9.70711 23.7071C9.89464 23.5196 10 23.2652 10 23C10 22.7348 9.89464 22.4804 9.70711 22.2929C9.51957 22.1054 9.26522 22 9 22Z"
                                            fill="#9CA3AF" />
                                    </svg>
                                    <svg width="23" height="23" viewBox="0 0 25 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="hover-icon">
                                        <path
                                            d="M24.2072 12.707L18.9586 17.957C18.8188 18.0969 18.6406 18.1922 18.4466 18.2308C18.2526 18.2694 18.0515 18.2496 17.8688 18.1739C17.686 18.0983 17.5298 17.9701 17.4199 17.8056C17.31 17.6412 17.2513 17.4478 17.2513 17.25V13H9.5C9.23478 13 8.98043 12.8946 8.79289 12.7071C8.60536 12.5196 8.5 12.2652 8.5 12C8.5 11.7348 8.60536 11.4804 8.79289 11.2929C8.98043 11.1054 9.23478 11 9.5 11H17.2513V6.75C17.2513 6.5522 17.31 6.35884 17.4199 6.19438C17.5298 6.02991 17.686 5.90174 17.8688 5.82605C18.0515 5.75037 18.2526 5.73058 18.4466 5.7692C18.6406 5.80781 18.8188 5.90308 18.9586 6.04297L24.2072 11.293C24.3947 11.4805 24.5 11.7348 24.5 12C24.5 12.2652 24.3947 12.5195 24.2072 12.707V12.707ZM9.5 22H2.5V2H9.5C9.76522 2 10.0196 1.89464 10.2071 1.70711C10.3946 1.51957 10.5 1.26522 10.5 1C10.5 0.734784 10.3946 0.48043 10.2071 0.292893C10.0196 0.105357 9.76522 0 9.5 0H2.5C1.96975 0.000606423 1.4614 0.211515 1.08646 0.586456C0.711515 0.961398 0.500606 1.46975 0.5 2V22C0.500606 22.5302 0.711515 23.0386 1.08646 23.4135C1.4614 23.7885 1.96975 23.9994 2.5 24H9.5C9.76522 24 10.0196 23.8946 10.2071 23.7071C10.3946 23.5196 10.5 23.2652 10.5 23C10.5 22.7348 10.3946 22.4804 10.2071 22.2929C10.0196 22.1054 9.76522 22 9.5 22Z"
                                            fill="#FBFBFA" />
                                    </svg>
                                    <div class="sidebar-label ">
                                        Log Out
                                    </div>
                                </div>
                            </button>
                        </form>

                    </li>
                </ul>
            </div>
        </div>
        <!--Content-->
        {{ $slot }}

    </div>
</div>
<x-flash-message />


<script>
    /* FOR SIDEBAR DROPDOWN */
    const dropdownLink = document.querySelector('.dropdown a');
    const dropdownMenu = document.querySelector('.dropdown-content');
    const dropdown = document.querySelector('.dropdown');
    const downIcon = document.querySelector('.down-icon');
    const downWhiteIcon = document.querySelector('.down-white-icon');
    const upIcon = document.querySelector('.up-icon');
    const upWhiteIcon = document.querySelector('.up-white-icon');


    dropdownLink.addEventListener('click', function(event) {
        event.preventDefault();

        dropdownMenu.classList.toggle('d-none');

        downWhiteIcon.classList.toggle('d-none');

        if (!dropdownMenu.classList.contains('d-none')) {
            downIcon.classList.add('d-none');
            downWhiteIcon.classList.add('d-none');
            upIcon.classList.remove('d-none');
            upWhiteIcon.classList.remove('d-none');


        } else {
            downIcon.classList.remove('d-none');
            downWhiteIcon.classList.remove('d-none');
            upIcon.classList.add('d-none');
            upWhiteIcon.classList.add('d-none');
        }

    });


    /* FOR SIDEBAR ACTIVE LINK */
    const currentPageUrl = window.location.href;
    const sidebarLinks = document.querySelectorAll('.sidebar a');// Get all the sidebar links

    const dd = document.querySelector('.dropdown a');

    sidebarLinks.forEach((link) => {
        if (link.href === currentPageUrl) {
            link.dataset.active=""

            if(link.classList.contains("dd-link")){
                dd.dataset.active=""
            }

        }
    })

    /* FOR STATUS BOX CHANGE STYLE */
    document.addEventListener('DOMContentLoaded', () => {
        const statusBoxes = document.querySelectorAll('.status-box');

        statusBoxes.forEach(statusBox => {
            const textContent = statusBox.textContent.trim();
            if (textContent === "ONGOING" || textContent === "PENDING") {
                statusBox.classList.add('ongoing');
            } else if (textContent === "INCOMPLETE" || textContent === "NO ANSWERS") {
                statusBox.classList.add('incomplete');
            } else if (textContent === "COMPLETE" || textContent === "UPDATED") {
                statusBox.classList.add('complete');
            }
        });
    });

    // For Image Preview when Image is Uploaded
    function preview() {
        var addLogo = document.getElementById('add-logo');
        var frame = document.getElementById('frame');

        frame.classList.remove("d-none"); //display image
        addLogo.classList.add("d-none"); // remove the add icon
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

    // For Selected Status on Form
    var status = document.getElementById('status');
    var incomplete = document.getElementById('incomplete');
    var ongoing = document.getElementById('ongoing');
    var complete = document.getElementById('complete');

    const projectInfo = document.getElementById("project-status");
    const projectStatus = projectInfo.getAttribute("data-project-status");

    if (projectStatus == "COMPLETE" || projectStatus == "complete") {
        complete.selected = true;
    } else if (projectStatus == "ONGOING" || projectStatus == "complete") {
        ongoing.selected = true;
    } else {
        incomplete.selected = true;
    }

    // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>

<x-footer />
