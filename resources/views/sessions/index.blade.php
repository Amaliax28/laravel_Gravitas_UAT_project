<x-layout>
    <x-content>
        <div>
            <div class="back-btn-container">
                @if (Auth::check() && !(Auth::user()->roles == 'admin') && !(Auth::user()->roles == 'tester'))
                    <x-back-btn href="/my-projects" />
                @else
                    <x-back-btn href="/" />
                @endif
            </div>
            <x-navbar>
                <x-searchbar placeholder="Search for sessions">
                    @if (Auth::check() && !(Auth::user()->roles == 'tester') && $project->user_id == auth()->user()->id)
                        <button class="h-100 btn blue btn-create-project" id="create-project-btn"
                            data-bs-target="#new-project-modal" data-bs-toggle="modal" type="button">
                            Create new session
                        </button>
                    @elseif (Auth::check() && Auth::user()->roles == 'admin')
                        <button class="h-100 btn blue btn-create-project" id="create-project-btn"
                            data-bs-target="#new-project-modal" data-bs-toggle="modal" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Create a New Session For This Project" type="button">
                            Create new session
                    @endif
                </x-searchbar>
            </x-navbar>
            <x-pageTitle>
                {{ $project['projectName'] }}
                @if (
                    (Auth::check() && !(Auth::user()->roles == 'tester') && $project->user_id == auth()->user()->id) ||
                        Auth::user()->roles == 'admin')
                    <x-btn-edit-header :project="$project" :testers="$testers" />
                @endif
            </x-pageTitle>
        </div>
        <div class="content ">
            <div class="table-container ">
                @php
                    $cols = ['tester-name', 'date', 'dtls2', 'status', 'more-btn'];
                    $tblHeaders = [['title' => 'Session Name', 'class' => '', 'colspan' => '1'], ['title' => 'Start Date', 'class' => '', 'colspan' => '1'], ['title' => 'Details', 'class' => '', 'colspan' => '1'], ['title' => 'Status', 'class' => 'status-tbl-header', 'colspan' => '1']];
                    if (Auth::check() && !(Auth::user()->roles == 'tester')) {
                        if (auth()->id() == $project->user_id || Auth::user()->roles == 'admin') {
                            $tblHeaders[] = ['title' => '', 'class' => '', 'colspan' => '', 'scope' => 'col'];
                            // <th scope="col"></th>
                        }
                    }
                @endphp
                @unless (count($sessions) == 0)
                    @foreach ($sessions as $session)
                        @php
                            $data = [];

                            // FOR ADMIN/STRAT/NONTESTER VIEW
                            if (Auth::check() && ((!(Auth::user()->roles == 'tester') && $project->user_id == auth()->user()->id) || Auth::user()->roles == 'admin')) {
                                $link = '/project/' . $project['id'] . '/session/' . $session['id'] . '/testers';
                            } else {
                                // FOR TESTER VIEW/project/{project}/session/{session}/testcase/
                                $link = '/project/' . $project['id'] . '/session/' . $session['id'] . '/testcase/';
                            }

                            $data = [['class' => 'tbl-content', 'data' => $session['sessionName'], 'link' => $link], ['class' => 'tbl-content', 'data' => \Carbon\Carbon::parse($session['sessionStartDate'])->format('j F Y'), 'link' => $link], ['class' => 'tbl-content', 'data' => $session['sessionDesc'], 'link' => $link], ['class' => 'status-box', 'data' => $session['status'], 'link' => $link]];

                            if (Auth::check() && ((!(Auth::user()->roles == 'tester') && $project->user_id == auth()->user()->id) || Auth::user()->roles == 'admin')) {
                                $data[] = ['class' => 'ellipisis-btn', 'data' => $session['id'], 'type' => 'elipsis'];
                            }

                            $dataSets[] = [
                                'data' => $data,
                            ];

                        @endphp
                    @endforeach
                    <x-table-layout :cols="$cols" :tblHeaders="$tblHeaders" :dataSets="$dataSets" name="session" />
                @else
                    <x-table-layout :cols="$cols" :tblHeaders="$tblHeaders" />
                @endunless

            </div>
        </div>
        <div class="w-100 duration">
            @php
                if (isset($totalDuration) && $totalDuration) {
                    $durationString = $totalDuration;
                    $sumDurationFormatted = gmdate('H:i:s', $durationString);
                    // Split the duration string into hours, minutes, and seconds
                    [$hours, $minutes, $seconds] = explode(':', $sumDurationFormatted);
                    echo 'Total Duration :' . $hours . 'h ' . $minutes . 'm ' . $seconds . 's';
                }
            @endphp

        </div>
        <x-pagination>
            {{ $sessions->links('pagination::bootstrap-5') }}
        </x-pagination>
        <x-pageFooter />
    </x-content>

    @include('sessions.create')
    @include('projects.edit', ['project' => $project, 'testers' => $testers])
    @unless (count($sessions) == 0)
        @foreach ($sessions as $session)
            @if (Auth::check() && !(Auth::user()->roles == 'tester'))
                <!--Layout for admin/strats-->
                <x-modal-delete :data="$session" name="session"
                    action="/sessions/{{ $session->projects_id }}/{{ $session->id }}" />
            @endif
        @endforeach
    @endunless
</x-layout>
