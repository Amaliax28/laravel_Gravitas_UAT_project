<x-layout>
    <x-content>
        <div>
            <div class="back-btn-container">
                @if (Auth::check() && !(Auth::user()->roles == 'admin')  && !(Auth::user()->roles == 'tester'))
                    <x-back-btn href="/my-projects" />
                @else
                    <x-back-btn href="/" />
                @endif
            </div>
            <x-navbar>
                <x-searchbar />
                @if (Auth::check() && !(Auth::user()->roles == 'tester') && $project->user_id == auth()->user()->id)
                    <button class="h-100 btn blue btn-create-project" id="create-project-btn"
                        data-bs-target="#new-project-modal" data-bs-toggle="modal" type="button">
                        Create new session
                    </button>
                @elseif (Auth::check() && (Auth::user()->roles == 'admin') )
                     <button class="h-100 btn blue btn-create-project" id="create-project-btn"
                    data-bs-target="#new-project-modal" data-bs-toggle="modal" type="button">
                    Create new session

                @endif
            </x-navbar>
            <x-pageTitle>
                {{ $project['projectName'] }}
                @if (Auth::check() && !(Auth::user()->roles == 'tester') && $project->user_id == auth()->user()->id)
                    <x-btn-edit-header :project="$project" :testers="$testers" />
                @elseif (Auth::check() && (Auth::user()->roles == 'admin') )
                    <x-btn-edit-header :project="$project" :testers="$testers" />
                @endif
            </x-pageTitle>
        </div>
        <div class="content ">
            <div class="table-container ">
                <table class="table-grey table-responsive ">
                    <colgroup>
                        <col class="tester-name">
                        <col class="date">
                        <col class="dtls2">
                        <col class="status">
                        <col class="more-btn">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Session Name</th>
                            <th>Start Date</th>
                            <th>Details</th>
                            <th class="status-tbl-header">Status</th>
                            @if (Auth::check() && !(Auth::user()->roles == 'tester')) <!--if not tester-->
                                @if(auth()->id() == $project->user_id || Auth::user()->roles == 'admin') <!--only the project creator or admin-->
                                    <th scope="col"></th>
                                @endif
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @unless (count($sessions) == 0)
                            @foreach ($sessions as $session)
                                @if (Auth::check() && (!(Auth::user()->roles == 'tester') && $project->user_id == auth()->user()->id || Auth::user()->roles == 'admin') )
                                    <tr data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="View testers assigned to this project">
                                        <td
                                            onclick="window.location.href='/project/{{ $project['id'] }}/session/{{ $session['id'] }}/testers';">
                                            <div class="tbl-content">
                                                {{ $session['sessionName'] }}
                                            </div>
                                        </td>
                                        <td
                                            onclick="window.location.href='/project/{{ $project['id'] }}/session/{{ $session['id'] }}/testers';">
                                            <div class="tbl-content">
                                                {{ \Carbon\Carbon::parse($session['sessionStartDate'])->format('j F Y') }}
                                            </div>
                                        </td>
                                        <td
                                            onclick="window.location.href='/project/{{ $project['id'] }}/session/{{ $session['id'] }}/testers';">
                                            <div class="tbl-content">
                                                {{ $session['sessionDesc'] }}
                                            </div>
                                        </td>
                                        <td onclick="window.location.href='/project/{{ $project['id'] }}/session/{{ $session['id'] }}/testers';">
                                            <div class="status-box">
                                                {{ $session['status'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="ellipisis-btn ">
                                                <button class="border-0 bg-transparent p-0 m-0" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg width="32" height="16" viewBox="0 0 32 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="7.9" cy="7.9" r="1.9"
                                                            fill="#9CA3AF" />
                                                        <circle cx="15.6998" cy="7.9" r="1.9"
                                                            fill="#9CA3AF" />
                                                        <circle cx="23.5001" cy="7.9" r="1.9"
                                                            fill="#9CA3AF" />
                                                    </svg>
                                                </button>
                                                <ul class="dropdown-menu shadow" aria-labelledby="dropdownMenuButton">
                                                    <li class="p-0">
                                                        <button data-bs-target="#modal-delete-session-{{ $session['id'] }}"
                                                            data-bs-toggle="modal" type="button">Delete session</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @else <!-- for tester -->
                                    <tr data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="View UAT Questions Form" onclick="window.location.href='/project/{{$project['id']}}/session/{{$session['id']}}/testcase/';">
                                        <td>
                                            <div class="tbl-content">
                                                {{ $session['sessionName'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="tbl-content">
                                                {{ \Carbon\Carbon::parse($session['sessionStartDate'])->format('j F Y') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="tbl-content">
                                                {{ $session['sessionDesc'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="status-box">
                                                {{ $session['status'] }}
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr onclick="window.location.href='/project/{{ $project['id'] }}/testers';"
                                class="align-middle border-0 " data-bs-toggle="tooltip" data-bs-placement="top"
                                title="View testers assigned to this project">
                                <td colspan="5" class="align-middle border-0 border-radius-10">There are currently no
                                    sessions created for this project.
                                </td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-100 duration">
            Total Duration :
            @php
                if (isset($totalDuration) && $totalDuration){
                    $durationString = $totalDuration;
                    $sumDurationFormatted = gmdate('H:i:s', $durationString);
                        // Split the duration string into hours, minutes, and seconds
                    list($hours, $minutes, $seconds) = explode(":", $sumDurationFormatted);
                    echo $hours . 'h '. $minutes. 'm ' . $seconds . 's';

                }
            @endphp

        </div>
        <x-pagination>
            {{$sessions->links('pagination::bootstrap-5')}}
        </x-pagination>
        <x-pageFooter />
    </x-content>
    @include('sessions.create')
    @include('projects.edit',['project'=> $project,'testers'=> $testers])
    @unless (count($sessions) == 0)
        @foreach ($sessions as $session)
            @if (Auth::check() && !(Auth::user()->roles == 'tester'))
                <!--Layout for admin/strats-->
                @include('sessions.destroy', ['session' => $session])
            @endif
        @endforeach
    @endunless
    <script>
           /* FOR STATUS BOX CHANGE STYLE */
    document.addEventListener('DOMContentLoaded', () => {
        const statusBoxes = document.querySelectorAll('.status-box');

        statusBoxes.forEach(statusBox => {
            const textContent = statusBox.textContent.trim();
            if (textContent === "ONGOING") {
                statusBox.classList.add('ongoing');
            } else if (textContent === "INCOMPLETE" || textContent === "UNANSWERED") {
                statusBox.classList.add('incomplete');
            } else if (textContent === "COMPLETE") {
                statusBox.classList.add('complete');
            }
        });
    });
    </script>
</x-layout>
