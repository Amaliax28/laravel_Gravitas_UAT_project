<x-layout>
    @auth
    <x-content class="response">
            @unless (count($responses) == 0 && count($response) == 0)
                @php
                    $testcase = $testcases->first();
                    $response = $responses->first();
                @endphp

                <div class="back-btn-container">
                   <x-back-btn href="/project/{{$project->id}}/session/{{$session->id}}/testers" />
                </div>
                @if ($testcase->id == $response->test_cases_id)
                    <x-testcase-form action="/response/{{$response->id}}" id="responseForm" >
                        @method('PUT')
                        <div>
                            <div class="header response align-items-center">
                                <div class="title ">
                                    <span class="grey">{{$project->projectName}} / </span>
                                    {{$session->sessionName}}
                                </div>
                                <div class=" ms-auto responseStatus" id="responseStatus">{{$response->status}}</div>

                                <div class="priorities-cont  ms-md-5 d-flex align-items-center ">
                                    <select class="priorities pe-none" name="priorities" id="priorities" disabled>
                                        <option class="d-none">Priorities</option>
                                        <option value="not important">Not important</option>
                                        <option value="very important">Very important</option>
                                        <option value="important">Important</option>
                                        <option value="less important">Less important</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <x-testcase-section>
                            <div class="response-container">
                                 <!-- left side col-->
                                <div class="item-col">
                                    <!-- test case image -->
                                    <x-testcase-img>
                                        <img src="{{ $testcase->testCaseImage ? asset('storage/' . $testcase->testCaseImage) : asset('images/no-pictures.png') }}"
                                            alt="test case image">
                                    </x-testcase-img>
                                    <!-- test case comment -->
                                    <x-testcase-comment-container>
                                        <x-testcase-profile-pic>
                                            {{ $testCaseCreator->userImage ? asset('storage/' . $testCaseCreator->userImage) : asset('images/user.png') }}
                                        </x-testcase-profile-pic>
                                        <x-testcase-username>{{ $testCaseCreator->username }}</x-testcase-username>
                                        <x-testcase-comment>{{ $testcase->testCaseText }}</x-testcase-comment>
                                    </x-testcase-comment-container>
                                </div>
                                   <!-- right side col-->
                                   <div class="item-col">
                                    <!-- response requirements -->
                                    <x-testcase-requirements-container>
                                        <div class="row table-header ">
                                            Desktop acceptance requirements
                                        </div>
                                        <div class="row table-btn table-header {{ $errors->has('desktop') ? 'bg-primary-color' : '' }}"
                                            id="desktopCont">
                                            <button class="btn accept pe-none" id="btnAcceptDesktop" type="button" data-active{{ $response->desktop == 'accept' ? '=true' : '' }}>
                                                Accept
                                                <input type="radio" name="desktop" value="accept" class="d-none"  id="acceptDesktop"
                                                {{ $response->desktop == 'accept' ? 'checked' : '' }} disabled>
                                            </button>
                                            <button class="btn reject pe-none" id="btnRejectDesktop" type="button" data-active{{ $response->desktop == 'reject' ? '=true' : '' }}>
                                                Reject
                                                <input type="radio" name="desktop" value="reject" class="d-none"  id="rejectDesktop"
                                                {{ $response->desktop == 'reject' ? 'checked' : '' }} disabled>
                                            </button>
                                        </div>
                                        <div class="row table-header">
                                            Mobile acceptance requirements
                                        </div>
                                        <div class="row table-btn @error('desktop') bg-primary-color @enderror"
                                            id="mobileCont">
                                            <button class="btn accept pe-none" id="btnAcceptMobile" type="button"  data-active{{ $response->mobile == 'accept' ? '=true' : '' }}>
                                                Accept
                                                <input type="radio" name="mobile" value="accept" class="d-none"  id="acceptMobile"
                                                    {{ $response->mobile == 'accept' ? 'checked' : '' }} disabled>
                                            </button>
                                            <button class="btn reject pe-none" id="btnRejectMobile" type="button"  data-active{{ $response->mobile == 'reject' ? '=true' : '' }}>
                                                Reject
                                                <input type="radio" name="mobile" value="reject" class="d-none"  id="rejectMobile"
                                                {{ $response->mobile == 'reject' ? 'checked' : '' }} disabled>
                                            </button>
                                        </div>
                                    </x-testcase-requirements-container>
                                    <!-- response feedback -->
                                    <x-response-feedback-cont>
                                        <x-response-timestamp></x-response-timestamp>

                                        <div class="row m-0 overflow-hidden text-break ">
                                            <div class="col-auto p-0">
                                                <div class="tc-profile-pic sticky-top">
                                                    <img src={{ $tester->userImage ? asset('storage/' . $tester->userImage) : asset('images/user.png') }}
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col comment-cont ">
                                                <div class="feedback-username sticky-top ">
                                                    <span class="comment-username ">{{ $tester->username }}</span>
                                                </div>
                                                <div class=" feedback">
                                                    <textarea name="responseText" id="feedback" class="text-start overflow-hidden"
                                                        placeholder="Leave your comment here ..." oninput="autoResize()" disabled>{{$response->responseText}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ATTACHMENTS-->
                                        <div class=" row mt-2  m-0">
                                            <div class="col-auto p-0 me-2  mb-2 text-end">
                                                <div class="attachment" id="imgInfoBox">
                                                    <span class="file-name" id="imgName">
                                                        @php
                                                            if (isset($response->feedbackImg) && $response->feedbackImg !== null) {
                                                                $responseImg = $response->feedbackImg;
                                                                $imgName = explode('_', $responseImg)[1];
                                                                echo $imgName;
                                                            }
                                                        @endphp
                                                    </span>
                                                    <span class="file-format" id="imgFormat"></span>
                                                    <span class="close-button ">
                                                        <button id="removeImgBtn" type="button">
                                                            <svg width="16" height="17" viewBox="0 0 16 17"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="X">
                                                                    <path id="Vector"
                                                                        d="M8.7073 8.49977L12.8538 4.35331C12.9474 4.25953 13 4.13238 13 3.99983C12.9999 3.86728 12.9473 3.74017 12.8535 3.64644C12.7598 3.55272 12.6327 3.50004 12.5001 3.5C12.3676 3.49996 12.2405 3.55255 12.1467 3.64622L8.00021 7.79268L3.85376 3.64622C3.75997 3.55255 3.63283 3.49996 3.50028 3.5C3.36773 3.50004 3.24061 3.55272 3.14689 3.64644C3.05316 3.74017 3.00049 3.86728 3.00044 3.99983C3.0004 4.13238 3.053 4.25953 3.14667 4.35331L7.29312 8.49977L3.14667 12.6462C3.10019 12.6926 3.06332 12.7478 3.03815 12.8084C3.01298 12.8691 3.00002 12.9341 3 12.9998C2.99998 13.0655 3.0129 13.1306 3.03803 13.1913C3.06316 13.2519 3.1 13.3071 3.14644 13.3535C3.19289 13.4 3.24803 13.4368 3.30872 13.462C3.36941 13.4871 3.43446 13.5 3.50015 13.5C3.56583 13.5 3.63087 13.487 3.69155 13.4618C3.75222 13.4367 3.80734 13.3998 3.85376 13.3533L8.00021 9.20686L12.1467 13.3533C12.2405 13.447 12.3676 13.4996 12.5001 13.4995C12.6327 13.4995 12.7598 13.4468 12.8535 13.3531C12.9473 13.2594 12.9999 13.1323 13 12.9997C13 12.8672 12.9474 12.74 12.8538 12.6462L8.7073 8.49977Z"
                                                                        fill="#383839" />
                                                                </g>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-auto p-0 text-end">
                                                <div class="attachment " id="fileInfoBox">
                                                    <span class="file-name" id="fileName">
                                                        @php
                                                        if (isset($response->feedbackFile) && $response->feedbackFile !== null) {
                                                            $responseFile = $response->feedbackFile;
                                                            $fileName = explode('_', $responseFile)[1];
                                                            echo $fileName;
                                                        }
                                                    @endphp
                                                    </span>
                                                    <span class="file-format" id="fileFormat"></span>
                                                    <span class="close-button">
                                                        <button id="removeFileBtn" type="button">
                                                            <svg width="16" height="17" viewBox="0 0 16 17"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="X">
                                                                    <path id="Vector"
                                                                        d="M8.7073 8.49977L12.8538 4.35331C12.9474 4.25953 13 4.13238 13 3.99983C12.9999 3.86728 12.9473 3.74017 12.8535 3.64644C12.7598 3.55272 12.6327 3.50004 12.5001 3.5C12.3676 3.49996 12.2405 3.55255 12.1467 3.64622L8.00021 7.79268L3.85376 3.64622C3.75997 3.55255 3.63283 3.49996 3.50028 3.5C3.36773 3.50004 3.24061 3.55272 3.14689 3.64644C3.05316 3.74017 3.00049 3.86728 3.00044 3.99983C3.0004 4.13238 3.053 4.25953 3.14667 4.35331L7.29312 8.49977L3.14667 12.6462C3.10019 12.6926 3.06332 12.7478 3.03815 12.8084C3.01298 12.8691 3.00002 12.9341 3 12.9998C2.99998 13.0655 3.0129 13.1306 3.03803 13.1913C3.06316 13.2519 3.1 13.3071 3.14644 13.3535C3.19289 13.4 3.24803 13.4368 3.30872 13.462C3.36941 13.4871 3.43446 13.5 3.50015 13.5C3.56583 13.5 3.63087 13.487 3.69155 13.4618C3.75222 13.4367 3.80734 13.3998 3.85376 13.3533L8.00021 9.20686L12.1467 13.3533C12.2405 13.447 12.3676 13.4996 12.5001 13.4995C12.6327 13.4995 12.7598 13.4468 12.8535 13.3531C12.9473 13.2594 12.9999 13.1323 13 12.9997C13 12.8672 12.9474 12.74 12.8538 12.6462L8.7073 8.49977Z"
                                                                        fill="#383839" />
                                                                </g>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </x-response-feedback-cont>
                                </div>
                            </div>
                        </x-testcase-section>
                        <div class="w-100 text-end  ">
                            <input type="time" name="responseTime" id="responseTime" value="{{$response->responseTime ? $response->responseTime : "" }}" required>
                            <input type="hidden" name="statusHidden" id="statusHidden">
                            <button class="btn blue submitResponseBtn" id="btnMarkComplete" type="button">Mark as Complete</button>
                            <button class="btn blue submitResponseBtn d-none" id="btnMarkIncomplete" type="button">Mark as Incomplete</button>
                        </div>
                        <script>
                            const btnMarkComplete = document.getElementById('btnMarkComplete');
                            const btnMarkIncomplete = document.getElementById('btnMarkIncomplete');
                            const statusHidden = document.getElementById('statusHidden');
                            const responseForm = document.getElementById('responseForm');
                            const responseStatus = document.getElementById('responseStatus');

                            if(responseStatus.textContent == "COMPLETE"){
                                responseStatus.classList.add('complete');
                                btnMarkIncomplete.classList.remove('d-none');
                                btnMarkComplete.classList.add('d-none');
                            }
                            else if(responseStatus.textContent == "INCOMPLETE"){
                                btnMarkComplete.classList.remove('d-none');
                                btnMarkIncomplete.classList.add('d-none');

                            }
                            else if(responseStatus.textContent == "ONGOING" || responseStatus.textContent == "PENDING"){
                                responseStatus.classList.add('ongoing');


                            }


                            btnMarkComplete.addEventListener('click',()=>{
                                statusHidden.value = "COMPLETE";
                                btnMarkComplete.classList.add('d-none');
                                responseForm.submit();
                            })

                            btnMarkIncomplete.addEventListener('click',()=>{
                                statusHidden.value = "INCOMPLETE";
                                btnMarkIncomplete.classList.remove('d-none');
                                responseForm.submit();

                            })

                        </script>
                    </x-testcase-form>
                @endif
            @endunless
        <x-pagination>
            {{$testcases->links('pagination::bootstrap-5-notext', ['responses' => $responses])}}
        </x-pagination>
    </x-content>
    @endauth

    @php
        $response->priorities;
        $priorities = $response->priorities;
    @endphp
    <script>
        const prioritiesValue = {!! json_encode($priorities) !!};
        const priorities = document.getElementById('priorities');
        for (let i = 1; i < priorities.options.length; i++) {
            const option = priorities.options[i];
            if (prioritiesValue == option.value) {
                option.selected = true;
            }
        }


        // RESPONSE PAGE //

        // TEXT AREA SIZE GROW WITH TEXT
        function autoResize() {
            const textarea = document.getElementById('feedback');
            textarea.style.height = 'auto'; // Reset the height to auto
            textarea.style.height = textarea.scrollHeight + 'px'; // Set the height to fit the content
        }


        // MAKE THE ATTACHMENT BOX NOT VISIBLE IF GOT NO TEXT
        const spanFile = document.getElementById('fileName');
        const fileBox = document.getElementById('fileInfoBox');
        if (spanFile.textContent.trim() == '') {
            fileBox.classList.add('d-none');

        }
        const spanImg = document.getElementById('imgName');
        const imgBox = document.getElementById('imgInfoBox');
        if (spanImg.textContent.trim() == '') {
            imgBox.classList.add('d-none');

        }
        // DISPLAY FILE NAME

        function showFileInfo( p) {
            const fileNameSpan = document.getElementById(p + 'Name');
            const fileFormat = document.getElementById(p + 'Format');
            const fileInfoBox = document.getElementById(p + 'InfoBox');

            if (fileNameSpan.textContent.trim().length > 0 ) {
                let filePath = "";

                if(p == "img"){
                    filePath = @json($response->feedbackImg);

                }
                else if(p == "file"){
                    filePath = @json($response->feedbackFile);
                }

                const fileName = filePath.substring(filePath.lastIndexOf('/') + 1);
                const fileFormatIndex = fileName.lastIndexOf('.');
                const formattedFileName = fileFormatIndex !== -1 ? fileName.substring(0, fileFormatIndex) : fileName;
                const originalFileName = formattedFileName.split('_').pop();

                fileNameSpan.textContent = originalFileName;
                const format = '.' + fileName.substring(fileName.lastIndexOf('.') + 1);
                fileFormat.textContent = format;

                fileInfoBox.addEventListener('click', () => {
                                                // Create a fetch request to fetch the image file
                    fetch(filePath)
                        .then(response => response.blob())
                        .then(blob => {
                            // Generate a download link
                            const downloadLink = document.createElement('a');
                            downloadLink.href = URL.createObjectURL(blob);
                            downloadLink.download = originalFileName + format;
                            downloadLink.click();
                        })
                        .catch(error => {
                            console.log('Error fetching the image:', error);
                        });
                });




            } else {
                fileNameSpan.textContent = '';
                fileFormat.textContent = '';
            }
        }

        showFileInfo( 'img');
        showFileInfo('file');

        // FOR ACCEPTANCE REQUIREMENTS INPUT
        function setInputElement(type, action) {
            const inputElement = document.getElementById(action + type);
            inputElement.checked = true;

        }

        // FOR ACCEPTANCE REQUIREMENTS BUTTON
        const btnAcceptMobile = document.querySelector('#btnAcceptMobile');
        btnAcceptMobile.addEventListener('click', () => {
            setInputElement('Mobile', 'accept');
            btnAcceptMobile.setAttribute('data-active', 'true');

            btnRejectMobile.classList.remove('clicked');
            btnRejectMobile.removeAttribute('data-active');
            btnAcceptMobile.classList.add('clicked');
            btnAcceptMobile.classList.remove('acceptClicked');

        });

        const btnRejectMobile = document.querySelector('#btnRejectMobile');
        btnRejectMobile.addEventListener('click', () => {
            setInputElement('Mobile', 'reject');
            btnRejectMobile.setAttribute('data-active', 'true');
            btnRejectMobile.classList.add('clicked');
            btnAcceptMobile.classList.remove('clicked');
            btnAcceptMobile.removeAttribute('data-active');
            btnAcceptMobile.classList.add('acceptClicked');

        });

        const btnAcceptDesktop = document.querySelector('#btnAcceptDesktop');
        btnAcceptDesktop.addEventListener('click', () => {
            setInputElement('Desktop', 'accept');
            btnAcceptDesktop.setAttribute('data-active', 'true');

            btnRejectDesktop.classList.remove('clicked');
            btnAcceptDesktop.classList.add('clicked');
            btnAcceptDesktop.classList.remove('acceptClicked');
            btnRejectDesktop.removeAttribute('data-active');


        });

        const btnRejectDesktop = document.querySelector('#btnRejectDesktop');
        btnRejectDesktop.addEventListener('click', () => {
            setInputElement('Desktop', 'reject');
            btnRejectDesktop.setAttribute('data-active', 'true');
            btnRejectDesktop.classList.add('clicked');
            btnAcceptDesktop.classList.remove('clicked');
            btnAcceptDesktop.classList.add('acceptClicked');
            btnAcceptDesktop.removeAttribute('data-active');


        });
    </script>
</x-layout>
