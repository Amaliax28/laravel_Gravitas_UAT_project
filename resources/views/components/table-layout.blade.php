@props(['cols'])
@props(['tblHeaders'])
@props(['dataSets'])
@props(['name'])

<table class="table-grey table-responsive ">
    <colgroup>
        @foreach ( $cols as $col)
            <col class="{{$col}}">
        @endforeach
    </colgroup>
    <thead>
        <tr>
           @foreach ($tblHeaders as $tblHeader)
                <th
                class="{{$tblHeader['class']}}"
                colspan="{{$tblHeader['colspan']}}"
                scope="{{isset($tblHeader['scope']) ? $tblHeader['scope']: ''}}">
                    {{$tblHeader['title']}}
                </th>
           @endforeach
        </tr>
    </thead>
    <tbody>
        @if (isset($dataSets) )
            @foreach ($dataSets as $dataSet)
            <tr onclick="redirectToLink('{{ $dataSet['link'] ?? '' }}')">
                    @foreach ($dataSet['data'] as $data)
                        <td onclick="redirectToLink('{{ $data['link'] ?? '' }}')">
                            <div class="{{isset($data['class']) ? $data['class'] : ''}}">
                                @if(isset($data['type']) && $data['type'] == 'img')
                                    <img src="{{$data['data'] }}" alt="">
                                @elseif(isset($data['type']) && $data['type'] == 'elipsis')
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
                                            <button
                                            data-bs-target="#modal-delete-{{$name}}-{{ isset($data['data']) ?$data['data'] : '' }}"
                                            data-bs-toggle="modal" type="button">Delete {{$name}}</button>
                                        </li>
                                    </ul>
                                @else
                                    {{$data['data']}}
                                @endif
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        @else
            <tr >
                <td colspan="{{count($cols)}}">
                    <div class="img-container w-100 d-flex align-items-center">
                        No Data Found
                    </div>
                </td>
            </tr>
        @endif
    </tbody>
</table>
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
   function redirectToLink(link) {
            if (link !== '') {
                window.location.href = link;
            }
    }
</script>
