<html>

<head>
    <?php include(dirname(__DIR__).'/includes/html/head.html')?>

    <title>Mist Store</title>
</head>

<body>
    <noscript>You need to enable JavaScript to access this page.</noscript>

    <?php include(dirname(__DIR__).'/includes/html/header.html')?>

    <link rel="stylesheet" href="store.css">

    <div class="store">
        <div class="search-item">
            <h1>Store Page</h1>

            <div class="search-bar">
                <input />
                <button>Search</button>
            </div>

            <div class=filter-item>
                <button>Sort By Date</button>
                <button>Filter By Category</button>
            </div>
        </div>

        <div class="browse-list" id="browseList">
            <script>
                var games = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];

                var browseList = document.getElementById("browseList");

                games.forEach((game)=>{
                    let div = document.createElement("div");
                    div.className = "browse-item";
                    let h1 = document.createElement("h1");
                    div.appendChild(h1);
                    h1.innerText = game;
                    browseList.appendChild(div);
                })
            </script>
        </div>
    </div>
</body>

</html>