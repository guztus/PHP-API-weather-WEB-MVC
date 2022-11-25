<nav class="navigationBar">
    <div class="city-shortcut-buttons">
        <button class="primary-button" onclick="window.location.href='/?city=Riga'">
            Riga
        </button>
        <button class="primary-button" onclick="window.location.href='/?city=Vilnius'">Vilnius</button>
        <button class="primary-button" onclick="window.location.href='/?city=Tallinn'">Tallinn</button>
    </div>

    <div class="nav-search">
        <form action="/" method="get" validate="validate">
            <label for="city">
                City:
            </label>
            <input id="city" type="text" name="city" placeholder="City name" required>
            <button type="submit"
                    class="primary-button">Get weather
            </button>
        </form>
    </div>

    <div class="about-button">
        <button class="primary-button" onclick="window.location.href='/about'">About</button>
    </div>
</nav>
