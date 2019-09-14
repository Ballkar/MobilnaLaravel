<div class="menuContainer">
    <div class="widthContainer">
        <div class="menu">
            <div id="logo">MK</div>

            <div id="menuItems">
                <div class="item">Blog

                    <div class="horizontalMenu">
                        <a class="item" href="/admin/blog/category">Kategorie</a>
                        <a class="item" href="/admin/blog/post">Wpisy</a>
                    </div>
                </div>
                <div class="item">Userzy</div>

                <a class="item" onclick="event.preventDefault(); document.getElementById('logout').submit();">logout</a>

                <form action="/logout" method="POST" id="logout">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
