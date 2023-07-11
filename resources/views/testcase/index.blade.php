<x-layout>
    <x-content>
        <div>
            <div class="back-btn-container">
                <x-back-btn href="/project/{{$project->id}}/session/{{$session->id}}/testers" />
            </div>
            <x-navbar>
                <x-searchbar/>
                <button class="h-100 btn blue btn-create-project" id="create-project-btn"
                data-bs-target="#new-testcase-modal" data-bs-toggle="modal" type="button">
                    Create test case
                </button>
            </x-navbar>
            <x-pageTitle>
                <span class="grey"> {{ $project['projectName'] }} / </span> {{ $session['sessionName'] }}
            </x-pageTitle>
        </div>
        <div class="content">
            <div class="table-container">
                <table class="table-grey table-responsive ">
                    <colgroup>
                        <col class="testcase-img">
                        <col class="dtls">
                        <col class="status">
                    </colgroup>
                    <thead >
                    <tr>
                        <th>Image</th>
                        <th>Details</th>
                        <th  class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @unless (count($testcases)==0 )
                            @foreach ($testcases as $testcase )
                                <tr>
                                    <td >
                                        <div class="tc-img-container ">
                                            <img src="{{$testcase->testCaseImage ? asset('storage/'.$testcase->testCaseImage) : asset('/images/no-pictures.png') }}" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="tbl-content">
                                            {{$testcase->testCaseText}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="ellipisis-btn text-center">
                                            <button class="border-0 bg-transparent p-0 m-0" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <svg width="32" height="16" viewBox="0 0 32 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="7.9" cy="7.9" r="1.9" fill="#9CA3AF" />
                                                    <circle cx="15.6998" cy="7.9" r="1.9" fill="#9CA3AF" />
                                                    <circle cx="23.5001" cy="7.9" r="1.9" fill="#9CA3AF" />
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu shadow" aria-labelledby="dropdownMenuButton">
                                                <li class="p-0">
                                                    <button data-bs-target="#modal-edit-testcase-{{$testcase['id']}}" data-bs-toggle="modal" type="button">Edit Test Case</button>
                                                </li>
                                                <li class="p-0">
                                                    <button data-bs-target="#modal-delete" data-bs-toggle="modal"
                                                        type="button">Delete Test Case</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No Test Case</td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
            </div>
        </div>
        <x-pagination>
            {{$testcases->links('pagination::bootstrap-5')}}
        </x-pagination>
        <x-pageFooter />
    </x-content>
    @include('testcase.create')
    @unless (count($testcases)==0 )
        @foreach ($testcases as $testcase )
            @include('testcase.edit', ['testcase' => $testcase])
        @endforeach
        @include('testcase.destroy',['testcase' => $testcase, 'project' => $project, 'session' => $session])
    @endunless
</x-layout>
