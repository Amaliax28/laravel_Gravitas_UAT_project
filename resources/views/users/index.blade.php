<x-layout>
    <x-content>
        <div>
            <x-navbar>
                <x-searchbar placeholder="Search for users" />
            </x-navbar>
        </div>
        @if (Auth::check() && !(Auth::user()->roles == 'tester') && Auth::user()->roles == 'admin')
            <x-pageTitle>ALL USERS</x-pageTitle>
        @endif
        <div class="content">
            <div class="table-container">
                @php
                    $col = ['img', 'name', 'email', 'role', 'more-btn'];
                    $tblHeaders = [['title' => 'Username', 'class' => '', 'colspan' => '2'], ['title' => 'Email', 'class' => '', 'colspan' => '1'], ['title' => 'Roles', 'class' => '', 'colspan' => '1'], ['title' => '', 'class' => '', 'colspan' => '1']];

                @endphp
                @unless (count($users) == 0)
                    @foreach ($users as $user)
                        @php
                            $data = [];
                            $data = [['class' => 'img-container', 'data' => $user->userImage ? asset('storage/' . $user->userImage) : asset('images/user.png'), 'type' => 'img', 'link' => '/user/' . $user->id], ['class' => 'tbl-content', 'data' => $user->username, 'link' => '/user/' . $user->id], ['class' => 'tbl-content', 'data' => $user->email, 'link' => '/user/' . $user->id], ['class' => 'tbl-content', 'data' => $user->roles, 'link' => '/user/' . $user->id], ['class' => 'ellipisis-btn', 'data' => $user->id, 'type' => 'elipsis']];
                            $dataSets[] = [
                                'data' => $data,
                            ];
                        @endphp
                    @endforeach
                @else
                    @php
                        $dataSets[] = '';
                    @endphp
                @endunless
                <x-table-layout :cols="$col" :tblHeaders="$tblHeaders" :dataSets="$dataSets" name="user" />
            </div>
        </div>
        <x-pagination>
            {{ $users->links('pagination::bootstrap-5') }}
        </x-pagination>
        <x-pageFooter />
    </x-content>
    @unless (count($users) == 0)
        @foreach ($users as $user)
            <x-modal-delete :data="$user" name="user" action="/delete-user/{{ $user->id }}/" />
        @endforeach
    @endunless
</x-layout>
