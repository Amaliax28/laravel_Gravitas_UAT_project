<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<table class="excelTable">
    <!--For Testers Status Table-->
    <tr>
        <th style="background-color: #003B5A;  color: #FFFFFF;font-size:12;font-weight:bold">No</th>
        <th style="background-color: #003B5A;  color: #FFFFFF;font-size:12;font-weight:bold">Tester's Username</th>
        <th style="background-color: #003B5A;  color: #FFFFFF;font-size:12;font-weight:bold">Status</th>
    </tr>
    @foreach ($testersInfo as $index => $testerInfo)
        <tr>
            <td style="text-align: center">{{ $index + 1 }}</td>
            <td>{{ $testerInfo[0] }}</td>
            <td style="font-weight:bold; color: {{ $testerInfo[1] === 'RESPONSES SUBMITTED' ? 'darkgreen' : 'red' }}">
                {{ $testerInfo[1] }}
            </td>
        </tr>
    @endforeach

    <tr></tr>
    <tr></tr>
    <tr>
        <td style="font-size:12;font-weight:bold">TEST CASES</td>
    </tr>
    <tr>
        <th style="background-color: #003B5A;  color: #FFFFFF;font-size:12;font-weight:bold">Test Case ID</th>
        <th style="background-color: #003B5A;  color: #FFFFFF;font-size:12;font-weight:bold">Test Case Image</th>
        <th style="background-color: #003B5A;  color: #FFFFFF;font-size:12;font-weight:bold">Test Case Text</th>
    </tr>
    @foreach ($testcases as $index => $testcase)
        <tr>
            <td style="text-align: center">{{ $index + 1 }}</td>
            <td style="width:250px;height:130px;text-align:center">sss</td>
            <td>{{ $testcase[0] }}</td>
        </tr>
    @endforeach


    <tr></tr>
    <tr></tr>
    <tr>
        <td style="font-size:12;font-weight:bold">RESPONSES</td>
    </tr>
    <tr>
        <th style="background-color: #003B5A;  color: #FFFFFF;font-size:12;font-weight:bold">No.</th>
        <th style="background-color: #003B5A;  color: #FFFFFF;font-size:12;font-weight:bold">Tester Name</th>
        <th style="background-color: #003B5A;  color: #FFFFFF;font-size:12;font-weight:bold">Feedback</th>
        <th style="background-color: #003B5A;  color: #FFFFFF;font-size:12;font-weight:bold">Desktop</th>
        <th style="background-color: #003B5A;  color: #FFFFFF;font-size:12;font-weight:bold">Mobile</th>
        <th style="background-color: #003B5A;  color: #FFFFFF;font-size:12;font-weight:bold">Status</th>
    </tr>
    @foreach ($responses as $index => $response)
        <tr>
            <td> {{ $index + 1 }}</td>
            <td>{{ $response[0]->first() }}</td>
            <td>{{ $response[1] }}</td>
            <td>{{ $response[2] }}</td>
            <td>{{ $response[3] }}</td>
            <td>{{ $response[4] }}</td>
        </tr>
    @endforeach
</table>
