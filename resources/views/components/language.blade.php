<select class="form-select " style="width: 78px;" id="langSelect" onchange="changeLang(this.value)">
    <option value="uz">UZ</option>
    <option value="ru">RU</option>
    <option value="en">EN</option>
</select>

<script>
        function changeLang(lang) {
            console.log('foiuewgf8yew')
            const classes = ['uz', 'ru', 'en'];
            classes.forEach(cls => {
                const elements = document.querySelectorAll(`.${cls}`);
                elements.forEach(element => {
                    element.style.display = cls === lang ? 'block' : 'none';
                });
            });
        }
        changeLang('uz')
    </script>