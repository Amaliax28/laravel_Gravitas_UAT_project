<x-layout>
    <x-content>
        <div>
            <div class="back-btn-container">
                <x-back-btn href="/project/{{$project->id}}/sessions" />
            </div>
            <x-navbar>
                <x-searchbar />
                @if(isset($session))
                <a href="/project/{{$project->id}}/session/{{$session->id}}/">
                    <button class="h-100 btn blue btn-create-project" id="create-project-btn"
                        data-bs-target="#new-project-modal" data-bs-toggle="modal" type="button">
                        View Test Cases
                    </button>
                </a>
                @endif
            </x-navbar>
            <x-pageTitle>
                <span class="grey"> {{ $project['projectName'] }} / </span> {{ $session['sessionName'] }}
                <div class="btn-container ">
                    <button class="btn blue-border no-shadow border-0 " data-bs-target="#edit-session-modal" data-bs-toggle="modal"
                        type="button " title="Edit This Session's Details">
                        Edit Session
                    </button>
                    <a href="/session/{{$session->id}}/export">
                        <button class="btn blue-border " data-bs-target="#modal-edit" data-bs-toggle="modal" type="button"
                        title="Import all users' responses to Excel">
                            Export to Excel
                        </button>
                    </a>

                </div>
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
                            <th>Tester Name</th>
                            <th>Start Date</th>
                            <th>Details</th>
                            <th class="status-tbl-header">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (Auth::check() && !(Auth::user()->roles == 'tester'))
                            @unless (count($testers)==0)
                                @foreach($testers as $tester)
                                    <tr  data-bs-toggle="tooltip" data-bs-placement="top" title="View {{$tester->username}} responses">
                                        <td onclick="window.location.href='/project/{{$project['id']}}/session/{{$session['id']}}/tester/{{$tester['id']}}/responses';">
                                            <div class="tbl-content">
                                                {{$tester['username']}}
                                            </div>
                                        </td>
                                        <td onclick="window.location.href='/project/{{$project['id']}}/session/{{$session['id']}}/tester/{{$tester['id']}}/responses';">
                                            <div class="tbl-content">
                                                {{ $tester->created_at->format('j F Y')}}
                                            </div>
                                        </td>
                                        <td onclick="window.location.href='/project/{{$project['id']}}/session/{{$session['id']}}/tester/{{$tester['id']}}/responses';">
                                            <div class="tbl-content">
                                                {{$session->sessionDesc}}
                                            </div>
                                        </td>
                                        <td onclick="window.location.href='/project/{{$project['id']}}/session/{{$session['id']}}/tester/{{$tester['id']}}/responses';">
                                            <div class="status-box">
                                                @if (isset($response) && $response && $response != null)

                                                    @php
                                                        $unanswered = false;
                                                        $ongoing = false;
                                                        $updated = false;
                                                        $incomplete = false;
                                                        $others = "";

                                                    @endphp
                                                    @foreach ($response as $r)
                                                        @if($r->user_id == $tester->id)
                                                            @if($r->status == "ONGOING")
                                                                @php
                                                                    $ongoing = true;
                                                                @endphp
                                                            @elseif($r->status == "UPDATED")
                                                                @php
                                                                    $updated=true;
                                                                @endphp
                                                            @elseif($r->status == "INCOMPLETE")
                                                                @php
                                                                    $incomplete =true;
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $others = $r->status;
                                                                @endphp
                                                            @endif
                                                        @else
                                                            @php
                                                                $unanswered = true;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                @else
                                                    INCOMPLETE
                                                @endif

                                                @if($incomplete)
                                                    INCOMPLETE
                                                @elseif ($updated)
                                                    UPDATED
                                                @elseif ($ongoing)
                                                    ONGOING
                                                @elseif ($others)
                                                    {{$r->status}}
                                                @elseif ($unanswered)
                                                    NO ANSWERS
                                                @else
                                                    NO ANSWERS
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="ellipisis-btn ">
                                                <button class="border-0 bg-transparent p-0 m-0" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg width="32" height="16" viewBox="0 0 32 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="7.9" cy="7.9" r="1.9" fill="#9CA3AF" />
                                                        <circle cx="15.6998" cy="7.9" r="1.9" fill="#9CA3AF" />
                                                        <circle cx="23.5001" cy="7.9" r="1.9" fill="#9CA3AF" />
                                                    </svg>
                                                </button>
                                                <ul class="dropdown-menu shadow" aria-labelledby="dropdownMenuButton">
                                                    <li class="p-0">
                                                        <button role="button" data-bs-target="#modal-delete-user"
                                                            data-bs-toggle="modal" type="button">Remove User</button>
                                                    </li>
                                                    <li class="p-0">
                                                        <a href="/session/{{$session->id}}/tester/{{$tester->id}}/export">
                                                            <button data-bs-target="#modal-delete" data-bs-toggle="modal"
                                                                type="button">Export to Excel</button>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No Testers</td>
                                </tr>
                            @endunless
                        @endif

                        <!-- More rows... -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-100 duration">
            Total Duration :
                @if (isset($duration) && $duration)
                   @php
                       $durationString = $duration;

                        // Split the duration string into hours, minutes, and seconds
                        list($hours, $minutes, $seconds) = explode(":", $durationString);

                        echo $hours . 'h '. $minutes. 'm ' . $seconds . 's';
                   @endphp

                @endif
        </div>
        <x-pagination>
            {{$testers->links('pagination::bootstrap-5')}}
        </x-pagination>
        <x-pageFooter/>
    </x-content>
    @unless (count($testers)==0)
        @foreach($testers as $tester)
            @if (Auth::check() && !(Auth::user()->roles == 'tester')) <!--Layout for admin/strats-->
                @include('testers.destroy',['tester' => $tester])
            @endif
        @endforeach
    @endunless
    @include('sessions.edit',['session' => $session])
</x-layout>
