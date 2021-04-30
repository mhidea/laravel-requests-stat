<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LaravelRequestsStat</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        .wrap {
            white-space: -moz-pre-wrap !important;
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            white-space: pre-wrap;
            word-wrap: break-word;
            white-space: -webkit-pre-wrap;
            word-break: break-all;
            white-space: normal;
        }

        body {
            position: relative;
            height: 100vh;
            width: 100vw;
            padding-bottom: 15px;
            margin: 0;
            background-color: #fff;
            color: #1f2020;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            overflow-x: hidden;

        }

        .flexcoloumn {
            display: flex;
            flex-direction: column;
            overflow-y: hidden;
        }

        .header {
            width: 100%;
            font-size: 56px;
            color: lightcoral;
            text-align: center;
        }

        th {
            text-align: center;
            font-size: larger;
            background-color: lightcoral;
            color: white;
        }

        td {
            text-align: center;
            color: black;
            word-wrap: break-word;
            background-color: #cecece;

        }

        tr {
            border-bottom: 1px solid #acabab;
        }

        table {
            border-collapse: collapse;
            width: 100%;

        }

        .table-container {
            overflow-y: auto;
        }

        a {
            word-wrap: break-word;
        }

        #sortable1,
        #sortable2 {
            margin-left: 5px;
            margin-right: 5px;
            color: black;
        }

        .fa-github {
            color: black;
            text-decoration: none;
        }

        .fa-github:hover {
            color: lightcoral;
        }

        .reset-all {
            color: white;
            background-color: rgb(233, 22, 22);
        }

        .reset:link {
            color: red;
            background-color: transparent;
            text-decoration: none;
        }

        .reset:visited {
            color: gray;
            background-color: transparent;
            text-decoration: none;
        }

        .reset:hover {
            color: red;
            background-color: transparent;
            text-decoration: underline;
        }

        .reset:active {
            color: red;
            background-color: transparent;
            text-decoration: underline;
        }
    </style>
</head>
<script>
    //src : https://www.w3schools.com/howto/howto_js_sort_table.asp
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("mh-stat");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /* Check if the two rows should switch place,
                based on the direction, asc or desc: */
                if (dir == "asc") {
                    if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // Each time a switch is done, increase this count by 1:
                switchcount++;
            } else {
                /* If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again. */
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
        if (dir == "desc") {
            document.getElementById('sortable' + n).className = "fa fa-angle-down"
        } else {
            document.getElementById('sortable' + n).className = "fa fa-angle-up"

        }
    }

    function resetall() {
        let r = confirm('Are you sure?')
        if (r) {
            const Http = new XMLHttpRequest();
            const url =
                "{{route('laravelRequestsStat.resetall')}}";
            Http.open("GET", url);
            Http.send();
            location.reload()
        }
    }
</script>

<body class="flexcoloumn">

    <div class="header">
        LaravelRequestsStat
        <a class="fa fa-github" aria-hidden="true" href="https://github.com/mhidea/laravel-requests-stat"></a>
    </div>
    <div style="text-align: center;">
        <button class="reset-all" onclick="resetall()">Reset all</button>
    </div>
    <div class="table-container">
        <table id="mh-stat">
            <tr>
                <th>path</th>
                <th onclick="sortTable(1)">count<i id="sortable1"></i></th>
                <th onclick="sortTable(2)">avg[s]<i id="sortable2"></i></th>
                <th>from</th>
                <th>reset</th>

            </tr>

            @foreach($stats as $stat)
            <tr>
                <td>{{$stat->path}}</td>
                <td>{{$stat->count}}</td>
                <td>{{$stat->count?$stat->sum/$stat->count:0}}</td>
                <td>{{$stat->diffInDays}}</td>
                <td>
                    <a class="reset" href="{{route('laravelRequestsStat.reset',$stat->id)}}">reset</a>
                </td>
            </tr>
            @endforeach
        </table>

    </div>

</body>

</html>