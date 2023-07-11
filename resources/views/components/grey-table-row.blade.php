@props(['project'])

<tr onclick="window.location.href='/project/{{$project['id']}}/sessions';">
    <td >
        <div class="img-container">
            <img src="{{$project->projectImg ? asset('storage/'.$project->projectImg) : asset('images/no-image.png') }}" alt="">
        </div>
    </td>
    <td>
        <div class="tbl-content">
            {{$project->projectName}}
        </div>
    </td>
    <td>
        <div class="tbl-content">
            {{ $project->projectDetails}}
        </div>
    </td>
    <td>
        <div class="status-box">
            {{ $project->status}}
        </div>
    </td>

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
