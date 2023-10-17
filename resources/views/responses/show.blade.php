@php
    use Carbon\Carbon;
@endphp
<x-layout>
    <x-content class="response">
        <div>
            <div class="back-btn-container">
                <x-back-btn href="/project/{{ $project->id }}/sessions" />
            </div>
            <div class="header response">
                <div class="title ">
                    <span class="grey">{{ $project->projectName }} / </span>
                    {{ $session->sessionName }}
                </div>
                <!--RESPONSE FORM -->
                @unless (count($testcases) == 0)
                    @foreach ($testcases as $testcase)
                        <x-testcase-form action="/session/{{ $session->id }}/testcase/{{ $testcase->id }}/create"
                            enctype="multipart/form-data">
                            <div class="priorities-cont  ms-md-5 d-flex align-items-center ">
                                <select class="priorities " name="priorities" id="priorities">
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
                    <div class="item-col ">
                        <!-- test case image -->
                        <x-testcase-img>
                            <img src="{{ $testcase->testCaseImage ? asset('uploaded_files/' . $testcase->testCaseImage) : asset('images/no-pictures.png') }}"
                                alt="test case image">
                        </x-testcase-img>
                        <!-- test case comment -->
                        <x-testcase-comment-container>
                            <x-testcase-profile-pic>
                                {{ $user->userImage ? asset('storage/' . $user->userImage) : asset('images/user.png') }}
                            </x-testcase-profile-pic>
                            <x-testcase-username>{{ $user->username }}</x-testcase-username>
                            <x-testcase-comment>{{ $testcase->testCaseText }}</x-testcase-comment>
                        </x-testcase-comment-container>
                    </div>
                    @if (isset($responses) && $responses)
                        <!-- IF USER HAS RESPONDED ON THT TEST CASE -->
                        @foreach ($responses as $response)
                            <!-- right side col-->
                            <div class="item-col">
                                <!-- response requirements -->
                                <x-testcase-requirements-container>
                                    <div class="row table-header ">
                                        Desktop acceptance requirements
                                    </div>
                                    <div class="row table-btn table-header {{ $errors->has('desktop') ? 'bg-primary-color' : '' }}"
                                        id="desktopCont">
                                        <button class="btn accept" id="btnAcceptDesktop" type="button"
                                            data-active{{ $response->desktop == 'accept' ? '=true' : '' }} disabled>
                                            Accept
                                            <input type="radio" name="desktop" value="accept" class="d-none"
                                                id="acceptDesktop" {{ $response->desktop == 'accept' ? 'checked' : '' }}>
                                        </button>
                                        <button class="btn reject" id="btnRejectDesktop" type="button"
                                            data-active{{ $response->desktop == 'reject' ? '=true' : '' }} disabled>
                                            Reject
                                            <input type="radio" name="desktop" value="reject" class="d-none"
                                                id="rejectDesktop" {{ $response->desktop == 'reject' ? 'checked' : '' }}>
                                        </button>
                                    </div>
                                    <div class="row table-header">
                                        Mobile acceptance requirements
                                    </div>
                                    <div class="row table-btn @error('desktop') bg-primary-color @enderror" id="mobileCont">
                                        <button class="btn accept" id="btnAcceptMobile" type="button"
                                            data-active{{ $response->mobile == 'accept' ? '=true' : '' }} disabled>
                                            Accept
                                            <input type="radio" name="mobile" value="accept" class="d-none"
                                                id="acceptMobile" {{ $response->mobile == 'accept' ? 'checked' : '' }}>
                                        </button>
                                        <button class="btn reject" id="btnRejectMobile" type="button"
                                            data-active{{ $response->mobile == 'reject' ? '=true' : '' }} disabled>
                                            Reject
                                            <input type="radio" name="mobile" value="reject" class="d-none"
                                                id="rejectMobile" {{ $response->mobile == 'reject' ? 'checked' : '' }}>
                                        </button>
                                    </div>
                                </x-testcase-requirements-container>
                                <!-- response feedback -->
                                <x-response-feedback-cont>
                                    <x-response-timestamp>
                                        @php
                                            $createdAt = Carbon::parse($response->created_at);
                                            $createdAtSeconds = $createdAt->diffInSeconds(Carbon::createFromTime(0, 0, 0));
                                            $testCaseTimeSeconds = strtotime($testcase->testCaseTime) - strtotime('00:00:00');
                                            $duration = $createdAtSeconds - $testCaseTimeSeconds;

                                            $formatDuration = Carbon::now()
                                                ->subSeconds($duration)
                                                ->diff(Carbon::now())
                                                ->format('%H:%I:%S');
                                            $durationString = $formatDuration; // Replace with your duration string

                                            // Split the duration string into hours, minutes, and seconds
                                            [$hours, $minutes, $seconds] = explode(':', $durationString);

                                            if ($hours != 0) {
                                                echo $hours . 'h ' . $minutes . 'm ' . $seconds . 's';
                                            } else {
                                                echo $minutes . 'm ' . $seconds . 's';
                                            }

                                        @endphp
                                    </x-response-timestamp>

                                    <div class="row m-0 overflow-hidden text-break ">
                                        <div class="col-auto p-0">
                                            <div class="tc-profile-pic sticky-top">
                                                <img src={{ Auth::user()->userImage ? asset('storage/' . Auth::user()->userImage) : asset('images/user.png') }}
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col comment-cont ">
                                            <div class="feedback-username sticky-top ">
                                                <span class="comment-username ">{{ Auth::user()->username }}</span>
                                            </div>
                                            <div class=" feedback">
                                                <textarea name="responseText" id="feedback" class="text-start overflow-hidden"
                                                    placeholder="{{ $response->responseText ? $response->responseText : 'no comment' }}" oninput="autoResize()"
                                                    disabled></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ATTACHMENTS-->
                                    <div class=" row mt-2 m-0 ">
                                        <div class="col-auto p-0 me-2  mb-2 text-end">
                                            <div class="attachment " id="imgInfoBox">
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
                                                    <button type="button">
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
                                                    <button type="button">
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

                                    <!--INPUT IMAGE/FILE-->
                                    <div class="row attachments p-0 flex-grow-1 ">
                                        <div class="mt-auto px-0  feedback-btm">
                                            <div class="comment-field">
                                                <div class="input-cont ">
                                                    <input type="file"
                                                        accept=".doc, .docx, .pdf, .xls, .xlsx, .ppt, .pptx, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation"
                                                        style="display: none;" disabled>
                                                    <label for="fileInput" class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M6.75 17.9994L6.75 4.31244C6.75 2.28537 8.43228 0.63623 10.5 0.63623C12.5677 0.63623 14.25 2.28537 14.25 4.31244V17.8124C14.25 18.4092 14.0129 18.9815 13.591 19.4034C13.169 19.8254 12.5967 20.0624 12 20.0624C11.4033 20.0624 10.831 19.8254 10.409 19.4034C9.98705 18.9815 9.75 18.4092 9.75 17.8124V7.31244C9.75 7.11353 9.82902 6.92276 9.96967 6.78211C10.1103 6.64146 10.3011 6.56244 10.5 6.56244C10.6989 6.56244 10.8897 6.64146 11.0303 6.78211C11.171 6.92276 11.25 7.11353 11.25 7.31244V17.8124C11.25 18.0114 11.329 18.2021 11.4697 18.3428C11.6103 18.4834 11.8011 18.5624 12 18.5624C12.1989 18.5624 12.3897 18.4834 12.5303 18.3428C12.671 18.2021 12.75 18.0114 12.75 17.8124V4.31244C12.75 3.11246 11.7406 2.13623 10.5 2.13623C9.25937 2.13623 8.25 3.11246 8.25 4.31244L8.25 17.9994C8.25 18.994 8.64509 19.9478 9.34835 20.651C10.0516 21.3543 11.0054 21.7494 12 21.7494C12.9946 21.7494 13.9484 21.3543 14.6517 20.651C15.3549 19.9478 15.75 18.994 15.75 17.9994L15.75 7.49939C15.75 7.30048 15.829 7.10971 15.9697 6.96906C16.1103 6.82841 16.3011 6.74939 16.5 6.74939C16.6989 6.74939 16.8897 6.82841 17.0303 6.96906C17.171 7.10971 17.25 7.30048 17.25 7.49939V17.9994C17.25 19.3918 16.6969 20.7271 15.7123 21.7117C14.7277 22.6963 13.3924 23.2494 12 23.2494C10.6076 23.2494 9.27226 22.6963 8.28769 21.7117C7.30312 20.7271 6.75 19.3918 6.75 17.9994Z"
                                                                fill="#383839" />
                                                        </svg>
                                                    </label>
                                                </div>
                                                <div class="input-cont ">
                                                    <input type="file" accept="image/*" class="d-none" disabled>
                                                    <label for="feedbackImg" class="input-icon">
                                                        <svg width="20" height="20" viewBox="0 0 32 32"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g id="Image">
                                                                <path id="Vector"
                                                                    d="M21.0001 12.5V12.5004C21.0001 12.8983 20.842 13.2799 20.5606 13.5612C20.2792 13.8425 19.8977 14.0005 19.4998 14.0005C19.1019 14.0004 18.7204 13.8424 18.4391 13.561C18.1577 13.2797 17.9997 12.8981 17.9997 12.5002C17.9997 12.1024 18.1577 11.7208 18.4391 11.4395C18.7204 11.1581 19.1019 11 19.4998 11C19.8977 11 20.2792 11.158 20.5606 11.4393C20.842 11.7206 21.0001 12.1022 21.0001 12.5V12.5ZM29 7V25C28.9994 25.5302 28.7885 26.0386 28.4135 26.4135C28.0386 26.7885 27.5302 26.9994 27 27H5C4.46975 26.9994 3.9614 26.7885 3.58646 26.4135C3.21152 26.0386 3.00061 25.5302 3 25V7C3.00061 6.46975 3.21152 5.9614 3.58646 5.58646C3.9614 5.21152 4.46975 5.00061 5 5H27C27.5302 5.00061 28.0386 5.21152 28.4135 5.58646C28.7885 5.9614 28.9994 6.46975 29 7V7ZM27.001 20.5867L27 7H5V18.5857L9.58582 14C9.9612 13.6255 10.4698 13.4152 11.0001 13.4152C11.5303 13.4152 12.0389 13.6255 12.4143 14L18.0001 19.5859L20.5858 17C20.9612 16.6255 21.4698 16.4152 22.0001 16.4152C22.5303 16.4152 23.0389 16.6255 23.4143 17L27.001 20.5867Z"
                                                                    fill="#383839" />
                                                            </g>
                                                        </svg>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </x-response-feedback-cont>
                            </div>
                        @endforeach

                        <!-- SCRIPT FOR USER THAT HAS SUBMITTED RESPONSE ONLY -->

                        <!-- SETTING THE SELECTED PRIORITES -->
                        @php
                            $response->priorities;
                            $priorities = $response->priorities;
                        @endphp
                        <script>
                            const prioritiesValue = {!! json_encode($priorities) !!};
                            const priorities = document.getElementById('priorities');

                            priorities.disabled = true;
                            priorities.style.cursor = 'default';
                            for (let i = 1; i < priorities.options.length; i++) {
                                const option = priorities.options[i];
                                if (prioritiesValue == option.value) {
                                    option.selected = true;
                                }
                            }
                        </script>
                    @else
                        <!-- IF THERE IS NO RESPONSES YET -->
                        <!-- right side col-->
                        <div class="item-col">
                            <!-- response requirements -->
                            <x-testcase-requirements-container>
                                <div class="row table-header ">
                                    Desktop acceptance requirements
                                </div>
                                <div class="row table-btn table-header {{ $errors->has('desktop') ? 'bg-primary-color' : '' }}"
                                    id="desktopCont">
                                    <button class="btn accept" id="btnAcceptDesktop" type="button">
                                        Accept
                                        <input type="radio" name="desktop" value="accept" class="d-none"
                                            id="acceptDesktop" {{ old('desktop') == 'accept' ? 'checked' : '' }}>
                                    </button>
                                    <button class="btn reject" id="btnRejectDesktop" type="button">
                                        Reject
                                        <input type="radio" name="desktop" value="reject" class="d-none"
                                            id="rejectDesktop" {{ old('desktop') == 'reject' ? 'checked' : '' }}>
                                    </button>
                                </div>
                                <div class="row table-header">
                                    Mobile acceptance requirements
                                </div>
                                <div class="row table-btn @error('desktop') bg-primary-color @enderror" id="mobileCont">
                                    <button class="btn accept" id="btnAcceptMobile" type="button">
                                        Accept
                                        <input type="radio" name="mobile" value="accept" class="d-none"
                                            id="acceptMobile" {{ old('mobile') == 'accept' ? 'checked' : '' }}>
                                    </button>
                                    <button class="btn reject " id="btnRejectMobile" type="button">
                                        Reject
                                        <input type="radio" name="mobile" value="reject" class="d-none"
                                            id="rejectMobile" {{ old('mobile') == 'reject' ? 'checked' : '' }}>
                                    </button>
                                </div>
                            </x-testcase-requirements-container>
                            <!-- response feedback -->
                            <x-response-feedback-cont>
                                <x-response-timestamp>
                                    <!--the time this testcase had been created - the time now -->
                                    @php
                                        $currentTimeSeconds = strtotime($currentTime) - strtotime('00:00:00');
                                        $testCaseTimeSeconds = strtotime($testcase->testCaseTime) - strtotime('00:00:00');
                                        $duration = $currentTimeSeconds - $testCaseTimeSeconds;

                                        $formatDuration = Carbon::now()
                                            ->subSeconds($duration)
                                            ->diff(Carbon::now())
                                            ->format('%H:%I:%S');
                                        echo $formatDuration;

                                    @endphp
                                </x-response-timestamp>
                                <div class="row m-0 overflow-hidden text-break ">
                                    <div class="col-auto p-0">
                                        <div class="tc-profile-pic sticky-top">
                                            <img src={{ Auth::user()->userImage ? asset('storage/' . Auth::user()->userImage) : asset('images/user.png') }}
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="col comment-cont ">
                                        <div class="feedback-username sticky-top ">
                                            <span class="comment-username ">{{ Auth::user()->username }}</span>
                                        </div>
                                        <div class=" feedback">
                                            <textarea name="responseText" id="feedback" class="text-start overflow-hidden"
                                                placeholder="Leave your comment here ..." oninput="autoResize()"></textarea>
                                        </div>
                                    </div>
                                </div>


                                <!-- ATTACHMENTS-->
                                <div class=" row mt-2  m-0">
                                    <div class="col-auto p-0 me-2  mb-2 text-end">
                                        <div class="attachment" id="imgInfoBox">
                                            <span class="file-name" id="imgName"></span>
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
                                        <div class="attachment" id="fileInfoBox">
                                            <span class="file-name" id="fileName"></span>
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
                                <!--INPUT IMAGE/FILE-->
                                <div class="row attachments p-0 flex-grow-1 ">
                                    <div class="mt-auto px-0  feedback-btm">
                                        <div class="comment-field">
                                            <div class="input-cont ">
                                                <input type="file" id="fileInput" name="feedbackFile"
                                                    accept=".doc, .docx, .pdf, .xls, .xlsx, .ppt, .pptx, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation"
                                                    style="display: none;">
                                                <label for="fileInput" class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M6.75 17.9994L6.75 4.31244C6.75 2.28537 8.43228 0.63623 10.5 0.63623C12.5677 0.63623 14.25 2.28537 14.25 4.31244V17.8124C14.25 18.4092 14.0129 18.9815 13.591 19.4034C13.169 19.8254 12.5967 20.0624 12 20.0624C11.4033 20.0624 10.831 19.8254 10.409 19.4034C9.98705 18.9815 9.75 18.4092 9.75 17.8124V7.31244C9.75 7.11353 9.82902 6.92276 9.96967 6.78211C10.1103 6.64146 10.3011 6.56244 10.5 6.56244C10.6989 6.56244 10.8897 6.64146 11.0303 6.78211C11.171 6.92276 11.25 7.11353 11.25 7.31244V17.8124C11.25 18.0114 11.329 18.2021 11.4697 18.3428C11.6103 18.4834 11.8011 18.5624 12 18.5624C12.1989 18.5624 12.3897 18.4834 12.5303 18.3428C12.671 18.2021 12.75 18.0114 12.75 17.8124V4.31244C12.75 3.11246 11.7406 2.13623 10.5 2.13623C9.25937 2.13623 8.25 3.11246 8.25 4.31244L8.25 17.9994C8.25 18.994 8.64509 19.9478 9.34835 20.651C10.0516 21.3543 11.0054 21.7494 12 21.7494C12.9946 21.7494 13.9484 21.3543 14.6517 20.651C15.3549 19.9478 15.75 18.994 15.75 17.9994L15.75 7.49939C15.75 7.30048 15.829 7.10971 15.9697 6.96906C16.1103 6.82841 16.3011 6.74939 16.5 6.74939C16.6989 6.74939 16.8897 6.82841 17.0303 6.96906C17.171 7.10971 17.25 7.30048 17.25 7.49939V17.9994C17.25 19.3918 16.6969 20.7271 15.7123 21.7117C14.7277 22.6963 13.3924 23.2494 12 23.2494C10.6076 23.2494 9.27226 22.6963 8.28769 21.7117C7.30312 20.7271 6.75 19.3918 6.75 17.9994Z"
                                                            fill="#383839" />
                                                    </svg>
                                                </label>
                                            </div>
                                            <div class="input-cont ">
                                                <input type="file" accept="image/*" id="feedbackImg"
                                                    name="feedbackImg" class="d-none">
                                                <label for="feedbackImg" class="input-icon">
                                                    <svg width="20" height="20" viewBox="0 0 32 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g id="Image">
                                                            <path id="Vector"
                                                                d="M21.0001 12.5V12.5004C21.0001 12.8983 20.842 13.2799 20.5606 13.5612C20.2792 13.8425 19.8977 14.0005 19.4998 14.0005C19.1019 14.0004 18.7204 13.8424 18.4391 13.561C18.1577 13.2797 17.9997 12.8981 17.9997 12.5002C17.9997 12.1024 18.1577 11.7208 18.4391 11.4395C18.7204 11.1581 19.1019 11 19.4998 11C19.8977 11 20.2792 11.158 20.5606 11.4393C20.842 11.7206 21.0001 12.1022 21.0001 12.5V12.5ZM29 7V25C28.9994 25.5302 28.7885 26.0386 28.4135 26.4135C28.0386 26.7885 27.5302 26.9994 27 27H5C4.46975 26.9994 3.9614 26.7885 3.58646 26.4135C3.21152 26.0386 3.00061 25.5302 3 25V7C3.00061 6.46975 3.21152 5.9614 3.58646 5.58646C3.9614 5.21152 4.46975 5.00061 5 5H27C27.5302 5.00061 28.0386 5.21152 28.4135 5.58646C28.7885 5.9614 28.9994 6.46975 29 7V7ZM27.001 20.5867L27 7H5V18.5857L9.58582 14C9.9612 13.6255 10.4698 13.4152 11.0001 13.4152C11.5303 13.4152 12.0389 13.6255 12.4143 14L18.0001 19.5859L20.5858 17C20.9612 16.6255 21.4698 16.4152 22.0001 16.4152C22.5303 16.4152 23.0389 16.6255 23.4143 17L27.001 20.5867Z"
                                                                fill="#383839" />
                                                        </g>
                                                    </svg>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-response-feedback-cont>
                        </div>
                        <!-- IF USER HASNT RESPONDED ON THT TEST CASE -->
                    @endif
                </div>
            </x-testcase-section>
            <!--NEXT TEST CASE BUTTON FOR TESTER-->
            <div class="w-100 text-end next-cont">
                @if ($testcases->currentPage() != $testcases->lastPage())
                    @if (isset($responses) && $responses)
                        <a href="{{ $testcases->nextPageUrl() }}">
                            <button class="btn blue submitResponseBtn" type="button">Next Test Case</button>
                        </a>
                    @else
                        <button class="btn blue submitResponseBtn" id="submitResponseBtn">Submit</button>
                    @endif
                @else
                    @if (empty($responses))
                        <button class="btn blue submitResponseBtn" id="submitResponseBtn">Submit</button>
                    @endif
                @endif
            </div>
            </x-testcase-form>
            @endforeach
        @else
            <!-- IF THERE IS NO TEST CASE -->
            <script>
                window.history.back();
            </script>
        @endunless

        <x-pagination>
            @if (isset($responses) && $responses)
                <!-- IF USER HAS RESPONDED ON THT TEST CASE -->
                {{ $testcases->links('pagination::response', ['responses' => $responses]) }}
            @else
                {{ $testcases->links('pagination::no-response') }}
            @endif
        </x-pagination>

        <x-pageFooter />

    </x-content>
    <script>
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
        const feedbackImg = document.getElementById('feedbackImg');
        const fileInput = document.getElementById('fileInput');

        function showFileInfo(input, p) {
            const fileNameSpan = document.getElementById(p + 'Name');
            const fileFormat = document.getElementById(p + 'Format');
            const fileInfoBox = document.getElementById(p + 'InfoBox');

            if (input.files.length > 0) {
                const file = input.files[0];
                const fileName = file.name;
                const fileFormatIndex = fileName.lastIndexOf('.');
                const formattedFileName = fileFormatIndex !== -1 ? fileName.substring(0, fileFormatIndex) : fileName;

                fileNameSpan.textContent = formattedFileName;
                fileFormat.textContent = '.' + fileName.substring(fileName.lastIndexOf('.') + 1);
                fileInfoBox.classList.remove('d-none');
            } else {
                fileNameSpan.textContent = '';
                fileFormat.textContent = '';
            }
        }

        feedbackImg.addEventListener('change', () => {
            showFileInfo(feedbackImg, 'img');
        });

        fileInput.addEventListener('change', () => {
            showFileInfo(fileInput, 'file');
        });

        // TO REMOVE INPUT WHEN BUTTON X IS CLICKED
        const removeFileBtn = document.getElementById('removeFileBtn');
        const removeImgBtn = document.getElementById('removeImgBtn');

        function removeInput(p) {
            const fileInfoBox = document.getElementById(p + 'InfoBox');
            fileInput.value = ''; // Reset the value of the file input
            fileInfoBox.classList.add('d-none');
            event.preventDefault();
        }
        removeFileBtn.addEventListener('click', () => {
            removeInput('file');
        });
        removeImgBtn.addEventListener('click', () => {
            removeInput('img');
        });


        // FOR ACCEPTANCE REQUIREMENTS INPUT
        function setInputElement(type, action) {
            const inputElement = document.getElementById(action + type);
            inputElement.checked = true;

        }

        // FOR REMOVING THE STYLE THAT APPEARED WHEN AN INPUT WAS NOT FILLED
        function removeError(type) {
            const desktopCont = document.getElementById(type + 'Cont');
            desktopCont.classList.remove('bg-primary-color');

        }

        // FOR ACCEPTANCE REQUIREMENTS BUTTON
        const btnAcceptMobile = document.querySelector('#btnAcceptMobile');
        btnAcceptMobile.addEventListener('click', () => {
            setInputElement('Mobile', 'accept');
            removeError('mobile');
            console.log('ajsjasja');
            btnRejectMobile.classList.remove('clicked');
            btnAcceptMobile.classList.add('clicked');
            btnAcceptMobile.classList.remove('acceptClicked');

        });

        const btnRejectMobile = document.querySelector('#btnRejectMobile');
        btnRejectMobile.addEventListener('click', () => {
            setInputElement('Mobile', 'reject');
            removeError('mobile');
            btnRejectMobile.classList.add('clicked');
            btnAcceptMobile.classList.remove('clicked');
            btnAcceptMobile.classList.add('acceptClicked');

        });

        const btnAcceptDesktop = document.querySelector('#btnAcceptDesktop');
        btnAcceptDesktop.addEventListener('click', () => {
            setInputElement('Desktop', 'accept');
            removeError('desktop');
            btnRejectDesktop.classList.remove('clicked');
            btnAcceptDesktop.classList.add('clicked');
            btnAcceptDesktop.classList.remove('acceptClicked');

        });

        const btnRejectDesktop = document.querySelector('#btnRejectDesktop');
        btnRejectDesktop.addEventListener('click', () => {
            setInputElement('Desktop', 'reject');
            removeError('desktop');
            btnRejectDesktop.classList.add('clicked');
            btnAcceptDesktop.classList.remove('clicked');
            btnAcceptDesktop.classList.add('acceptClicked');

        });
    </script>
</x-layout>
