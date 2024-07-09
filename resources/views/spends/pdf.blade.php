<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spends Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center">Spends Report</h2>
    <table >
        <thead>
            <tr>
                <th>#</th>
                <th>Spend</th>
                <th>Category</th>
                <th>Project</th>
                <th>Amount</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($spends as $key => $spend)
                <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $spend->title }}</td>
                <td>{{ $spend->category->title }}</td>
                <td>{{ $spend->project->name }}</td>
                <td>${{ round($spend->totalAmount, 2) }}</td>
                <td>{{ $spend->user->name }}</td>
                </tr>
                @endforeach 
        </tbody>
        <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th>Total Amount:</th>
                <th>
                    <div> <span id="totalAmount"></span></div>
                </th>
            </tfoot>
    </table>
</body>
</html>

