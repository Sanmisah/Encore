<?php
use Carbon\Carbon;
?>

    <table>
        <thead >
            <tr>
                <th colspan="12" style="font-weight: bold; text-align: center;">Grant Approval Format (GAF) - Report</th>
            </tr>
            <tr>
                <th>ME HQ: </th>
                <th>ABM HQ: </th>
                <th>RBM HQ: </th>
                <th>Doctor Name: </th>
                <th>Speciality: </th>
                <th>MPL No: </th>
                <th>Location: </th>
                <th>Email: </th>
                <th>Activity: </th>
                <th>Date: </th>
                <th>Month: </th>
                <th>Amount: </th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($print))
            @foreach($print as $detail)                           
            <tr>
                <td>{{ ucfirst(@$detail->Manager->name) }}</td>
                <td>{{ ucfirst(@$detail->Manager->AreaManager->name) }}</td>
                <td>{{ ucfirst(@$detail->Manager->ZonalManager->name) }}</td>
                <td>{{ ucfirst(@$detail->Doctor->doctor_name) }}</td>
                <td>{{ @$detail->doctor->speciality }}</td>
                <td>{{ @$detail->doctor->mpl_no }}</td>                
                <td>{{ @$detail->doctor->type }}</td>
                <td>{{ @$detail->email }}</td>
                <td>{{ ucfirst(@$detail->Activity->name) }}</td>
                <td>{{ @$detail->date_of_issue }}</td>
                <td>{{ @$detail->proposal_month }}</td>
                <td>{{ @$detail->proposal_amount }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>