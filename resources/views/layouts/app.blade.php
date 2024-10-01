<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
    @yield('content')

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Scripts for initializing charts and tables -->
    <script>
        // Area Chart Example
        var ctx = document.getElementById('myAreaChart').getContext('2d');
        var myAreaChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mar 1', 'Mar 3', 'Mar 5', 'Mar 7', 'Mar 9', 'Mar 11', 'Mar 13'],
                datasets: [{
                    label: 'Data',
                    data: [10000, 20000, 15000, 25000, 20000, 30000, 35000],
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: '#007bff',
                    fill: true,
                }]
            },
        });

        // Bar Chart Example
        var ctxBar = document.getElementById('myBarChart').getContext('2d');
        var myBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Revenue',
                    data: [5000, 10000, 7000, 15000, 12000, 20000],
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: '#007bff',
                    borderWidth: 1
                }]
            }
        });

        // DataTables initialization
        $(document).ready(function() {
            $('#datatablesSimple').DataTable();
        });
    </script>
</body>
</html>
