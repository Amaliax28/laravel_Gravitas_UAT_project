<x-layout>
    <x-content>
        <div>
            <x-navbar>
                <x-searchbar placeholder="Search for projects">
                    @if (Auth::check() && !(Auth::user()->roles == 'tester'))
                        <button class="h-100 btn blue btn-create-project" id="create-project-btn"
                            data-bs-target="#new-project-modal" data-bs-toggle="modal" type="button">Create
                            project</button>
                    @endif
                </x-searchbar>
            </x-navbar>
        </div>
        @if (Auth::check() && !(Auth::user()->roles == 'tester')) <!-- Check if the user is not tester -->
            @if (Auth::check() && !(Auth::user()->roles == 'admin'))
                <!-- Check if user is not admin -->
                <x-pageTitle>ALL PROJECTS</x-pageTitle>
            @else
                <x-pageTitle>ALL PROJECTS</x-pageTitle>
            @endif
        @else
            <x-pageTitle>ALL PROJECTS</x-pageTitle>
        @endif
        <div class="content">
            <div class="table-container">
                @php
                    $cols = [];
                    $cols = ['img', 'name', 'dtls', 'status'];

                    $tblHeaders = [];
                    $tblHeaders = [['title' => 'Project Name', 'class' => '', 'colspan' => '2'], ['title' => 'Details', 'class' => '', 'colspan' => '1'], ['title' => 'Status', 'class' => 'status-tbl-header', 'colspan' => '1']];
                @endphp
                @unless (count($projects) == 0)
                    @foreach ($projects as $project)
                        @php
                            $data = [];
                            $data = [['class' => 'img-container', 'data' => $project->projectImg ? asset('storage/' . $project->projectImg) : asset('images/user.png'), 'type' => 'img'], ['class' => 'tbl-content', 'data' => $project->projectName], ['class' => 'tbl-content', 'data' => $project->projectDetails], ['class' => 'status-box', 'data' => $project->status]];
                            $dataSets[] = [
                                'data' => $data,
                                'link' => '/project/' . $project->id . '/sessions',
                            ];
                        @endphp
                    @endforeach
                    <x-table-layout :cols="$cols" :tblHeaders="$tblHeaders" :dataSets="$dataSets" />
                @else
                    <x-table-layout :cols="$cols" :tblHeaders="$tblHeaders" />
                @endunless
            </div>
        </div>
        <div class="w-100 duration">
            @php
                if (isset($totalDuration) && $totalDuration) {
                    echo 'Total Duration :';
                    $durationString = $totalDuration;
                    $sumDurationFormatted = gmdate('H:i:s', $durationString);
                    // Split the duration string into hours, minutes, and seconds
                    [$hours, $minutes, $seconds] = explode(':', $sumDurationFormatted);
                    echo $hours . 'h ' . $minutes . 'm ' . $seconds . 's';
                }
            @endphp

        </div>
        <x-pagination>
            {{ $projects->links('pagination::bootstrap-5') }}
        </x-pagination>
        <x-pageFooter />
    </x-content>
    @include('projects.create')
</x-layout>
