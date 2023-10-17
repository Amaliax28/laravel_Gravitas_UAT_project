@props(['value'])
@props(['val'])


<tr onclick="window.location.href='/project/{{$value[0]}}/sessions';">
    <td >
        <div class="img-container">
            <img src="{{$value[1] ? asset('storage/'.$value[1]) : asset('images/no-image.png') }}" alt="">
        </div>
    </td>
    @for ($i = 2; $i<count($value); $i++)
        <td>
            <div class="{{$value[$i] == 'INCOMPLETE' || $value[$i] == 'COMPLETE' ? 'status-box' : 'tbl-content'}}">
                {{$value[$i]}}
            </div>
        </td>
    @endfor

</tr>

<script>
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
