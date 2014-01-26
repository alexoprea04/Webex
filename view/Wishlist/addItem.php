<style>
    .main_container_form {
        padding:1em 0 1em 0;
    }
    .main_container_form input[type="text"] {
        width:100%;
    }

    .main_container_form input[type="submit"] {
        height: 3em;
        width:100%;
    }
    .main_container_form span {
        margin-bottom:15em;
    }

    .medium_height {
        height:2em;
    }
</style>
<div class="header">
    <div class="buttons">
        <div class="home">
            <a href="/Home/index"><img src="/images/home.jpeg" alt="home" width='49px' height='40'>
            </a>
        </div>
        <div class="title"><h1>Adauga Lista</h1></div>
        <div class="menu">
            <a href="/Wishlist/listItems/"><img src="/images/menu.png" alt="menu"></a>
        </div>

    </div>
</div>
<div class="main main_container_form">
    <br>
    <form action="<?=$baseDir?>Wishlist/saveItem/" method="POST">
        <label>Nume</label>
        <span>
            <input type="text" name="name" class="ui-corner-all medium_height" >
        </span>
<br>
        <label>Description</label>
        <span>
            <input type="text" name="description" class="ui-corner-all medium_height"><br>
        </span>
        <br>
        <input type="submit" value="Salveaza">
    </form>
</div>

