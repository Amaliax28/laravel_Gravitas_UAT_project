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
            <x-pageTitle>My Projects</x-pageTitle>
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
                                @php
                                    $val = [];
                                    $val[] = $project->id;
                                    $val[] = $project->projectImg;
                                    $val[] = $project->projectName;
                                    $val[] = $project->projectDetails;
                                    $val[] = $project->status;
                                @endphp
                                <x-grey-table-row :value="$val" />
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
        <x-pagination/>
        <x-pageFooter/>
    </x-content>
    @include('projects.create')
</x-layout>
