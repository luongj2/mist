<?php $title = "Mist Store" ?>
<?php include(dirname(__DIR__)."/includes/php/header.php")?>

    <link rel="stylesheet" href="store.css">

    <div class="store">
        <div class="search-item">
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
    
 <?php include(dirname(__DIR__)."/includes/php/footer.php")?>