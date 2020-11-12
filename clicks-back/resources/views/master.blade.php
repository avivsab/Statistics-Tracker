<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Company Website</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">

                        @foreach($trackedLinks as $link)
                        <li class="nav-item">
                            <a id={{$link[0]}} class="nav-link" href="#">
                                <span data-feather={{$link[1]}}></span>
                                {{$link[0]}}
                            </a>
                        </li>
                        @endforeach

                    </ul>

                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Saved reports</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">

                        @foreach($trackedItems as $item)
                        <li class="nav-item">
                            <a id={{$item}} class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                {{$item}}
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button class="btn btn-sm btn-outline-secondary" id="share">Share</button>
                            <button class="btn btn-sm btn-outline-secondary" id="export">Export</button>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar"></span>
                            This week
                        </button>
                    </div>
                </div>

                <canvas class="my-4" id="myChart" width="900" height="380"></canvas>

                <h2>Section title</h2>
                <p class="content">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Praesentium cumque porro, laudantium sunt,
                    molestiae, a quia reiciendis accusantium sed dolor recusandae enim! Explicabo architecto laudantium
                    necessitatibus officia quas esse maxime
                </p>
            </main>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
    feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            datasets: [{
                data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false,
            }
        }
    });
    </script>
    <form name="statics" action="/" method="post">
        <input type="hidden" name="data" value="" id="data">
        {{ csrf_field() }}
        <button type="button" class="btn btn-success send">Send Statistics</button>
    </form>


    <script>
    // clicks counter script
    const elementsId = [];
    const clicksData = [];
    const clickedElements = [];
    window.onload = () => {
        document.querySelectorAll('*').forEach(node => {
            if (node.hasAttribute("id")) {
                elementsId.push(node.id);
            }
        });
        for (let i = 0; i < elementsId.length; i++) {
            const element = elementsId[i];
            for (let j = 0; j < elementsId.length; j++) {
                if (i === j) continue;
                if (element === elementsId[j]) {
                    console.warn('duplicate id on the page ', `(id = ${element})`);
                    // here I created opportunity to change the element id
                }
            }
        }
    }
    document.body.onclick = (e) => {
        const clickedElementIdentifier = e.target.id;
        if (!clickedElementIdentifier) return;

        if (clickedElements.includes(clickedElementIdentifier)) {
            return calculateClicks(clickedElementIdentifier)
        }
        clickedElements.push(clickedElementIdentifier);
        clicksData.push({
            [clickedElementIdentifier]: 1
        });
    }
    // for developmet use:
    const btn = document.getElementsByClassName('send')[0];
    btn.addEventListener('click', sendStatistics);
    // ==================

    function calculateClicks(el) {
        'use strict';
        for (let i = 0; i < clickedElements.length; i++) {
            const element = clickedElements[i];
            if (Object.keys(clicksData[i])[0] === el) {
                clicksData[i][el] += 1;

            }
        }
    }

    function sendStatistics() {
                    const inputData = document.getElementById('data');
                    inputData.value = JSON.stringify(clicksData);
                    document.statics.submit();
                }

        /* **prod function for update user clicks summary in the statistics table:

        const staticticsScript = document.createElement('script');
        staticticsScript.setAttribute('type', 'text/javascript');
        staticticsScript.innerText = ` 
        document.body.appendChild(staticticsScript);
        window.onbeforeunload = function() {    
                                                ** before closing tab send data or in settimeout
                                                * if user leave browser open
                  
                fetch("/", {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('input[name="_token"]').val()
                        },
                        method: "post",
                        credentials: "same-origin",
                        body: JSON.stringify({
                            key: clicksData
                        })
                        document.statistics.submit();
                        return null;
                    }

                    document.body.appendChild(staticticsScript);
                `;
                }
            */
    </script>

</body>

</html>