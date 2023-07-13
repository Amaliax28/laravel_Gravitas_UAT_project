<x-layout>
    <x-content>
        <div>

            <x-navbar>
                <x-searchbar>
                    @if(Auth::check() && !(Auth::user()->roles == 'tester') )
                        <button class="h-100 btn blue btn-create-project" id="create-project-btn" data-bs-target="#new-project-modal" data-bs-toggle="modal" type="button">Create project</button>
                    @endif
                </x-searchbar>
            </x-navbar>
        </div>
        @if(Auth::check() && !(Auth::user()->roles == 'tester') ) <!-- Check if the user is not tester -->
            @if(Auth::check() && !(Auth::user()->roles == 'admin') ) <!-- Check if user is not admin -->
                <x-pageTitle>ALL PROJECTS</x-pageTitle>
            @else
                <x-pageTitle>ALL PROJECTS</x-pageTitle>
            @endif
        @else
            <x-pageTitle>ALL PROJECTS</x-pageTitle>
        @endif
        <div class="content">
            <div class="table-container">
                <table class="table-grey table-responsive ">
                    <colgroup>
                        <col class="img">
                        <col class="name" >
                        <col class="dtls">
                        <col class="status">
                    </colgroup>
                    <thead>
                    <tr>
                        <th colspan="2">Project Name</th>
                        <th>Details</th>
                        <th  class="status-tbl-header">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @unless(count($projects)==0)
                            @foreach($projects as $project)
                                <x-grey-table-row :project="$project" />
                            @endforeach
                        @else
                            <tr >
                                <td colspan="4">
                                    <div class="img-container w-100 d-flex align-items-center">
                                        No Projects Found
                                    </div>
                                </td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-100 duration">

            @php
                if (isset($totalDuration) && $totalDuration){
                    echo "Total Duration :";
                    $durationString = $totalDuration;
                    $sumDurationFormatted = gmdate('H:i:s', $durationString);
                        // Split the duration string into hours, minutes, and seconds
                    list($hours, $minutes, $seconds) = explode(":", $sumDurationFormatted);
                    echo $hours . 'h '. $minutes. 'm ' . $seconds . 's';

                }
            @endphp

        </div>
        <x-pagination>
            {{$projects->links('pagination::bootstrap-5')}}
        </x-pagination>
        <x-pageFooter/>
    </x-content>
    @include('projects.create')
</x-layout>
