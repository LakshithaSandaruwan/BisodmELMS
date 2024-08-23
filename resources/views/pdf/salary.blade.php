

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>salary</title>
    <style>
        .salary-slip {
            margin: 15px;

            .empDetail {
                width: 100%;
                text-align: left;
                border: 2px solid black;
                border-collapse: collapse;
                table-layout: fixed;
            }

            .head {
                margin: 10px;
                margin-bottom: 50px;
                width: 100%;
            }

            .companyName {
                text-align: right;
                font-size: 25px;
                font-weight: bold;
            }

            .salaryMonth {
                text-align: center;
            }

            .table-border-bottom {
                border-bottom: 1px solid;
            }

            .table-border-right {
                border-right: 1px solid;
            }

            .myBackground {
                padding-top: 10px;
                text-align: left;
                border: 1px solid black;
                height: 40px;
            }

            .myAlign {
                text-align: center;
                border-right: 1px solid black;
            }

            .myTotalBackground {
                padding-top: 10px;
                text-align: left;
                background-color: #EBF1DE;
                border-spacing: 0px;
            }

            .align-4 {
                width: 25%;
                float: left;
            }

            .tail {
                margin-top: 35px;
            }

            .align-2 {
                margin-top: 25px;
                width: 50%;
                float: left;
            }

            .border-center {
                text-align: center;
            }

            .border-center th,
            .border-center td {
                border: 1px solid black;
            }

            th,
            td {
                padding-left: 6px;
            }
        }
    </style>
</head>

<body>
    <div class="salary-slip">
        <table class="empDetail">
            <tr height="100px" style='background-color: #c2d69b'>
                <td colspan='4'>
                    <img height="90px" src='img/logo.jpg' />
                    
                </td>
                <td colspan='4' class="companyName"> BisodmELMS.</td>
            </tr>
            <tr>
                <th>
                    Name -
                </th>
                <td>
                    {{ $teacher->full_name }}
                </td>
                <td></td>
            </tr>

            <tr class="myBackground">
                <th colspan="2">
                    Payments
                </th>
                <th>
                    Particular
                </th>
                <th class="table-border-right">
                    Amount (Rs.)
                </th>
                <th colspan="2">
                    Deductions
                </th>
                <th>
                    Particular
                </th>
                <th>
                    Amount (Rs.)
                </th>
            </tr>
            <tr>
                <th colspan="2">
                    Basic Salary
                </th>
                <td></td>
                <td class="myAlign">
                    {{ $salaryDetails['basic'] }}
                </td>
                <th colspan="2">
                    Insitute pay
                </th>
                <td></td>

                <td class="myAlign">
                    {{ $salaryDetails['insitute_pay'] }}
                </td>
            </tr>
            <tr>
                <th colspan="2">
                    Bonus
                </th>
                <td></td>

                <td class="myAlign">
                    {{ $salaryDetails['bonus'] }}
                </td>
                <th colspan="2">
                    Taxes
                </th>
                <td></td>

                <td class="myAlign">
                    {{ $salaryDetails['taxes'] }}
                </td>
            </tr>

            <tr class="myBackground">
                <th colspan="3">
                    Total Payments
                </th>
                <td class="myAlign">
                    {{ $salaryDetails['basic'] + $salaryDetails['bonus'] }}
                </td>
                <th colspan="3">
                    Total Deductions
                </th>
                <td class="myAlign">
                    {{ $salaryDetails['insitute_pay'] + $salaryDetails['taxes'] }}
                </td>
            </tr>
            <tr height="40px">
                <th colspan="2">
                    Projection for Financial Year:
                </th>
                <th>
                </th>
                <td class="table-border-right">
                </td>
                <th colspan="2" class="table-border-bottom">
                    Net Salary
                </th>
                <td>
                </td>
                <td>
                    {{ $salaryDetails['basic'] + $salaryDetails['bonus'] - ($salaryDetails['insitute_pay'] + $salaryDetails['taxes']) }}
                </td>
            </tr>


        </table>

    </div>

</body>

</html>
