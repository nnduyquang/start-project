<div id="menu_mobile" class="d-none d-block d-sm-none">
    <header class="nav-top">
        <span class="hamburger material-icons" id="ham"><i class="fas fa-bars"></i></span>
    </header>
    <nav class="nav-drill">
        <div class="menu_logo"><a
                    href="#">{{ HTML::image('images/logo/logo_blue.png', 'logo-smartlinks', array( )) }}</a></div>
        <ul class="nav-items nav-level-1">
            <li class="nav-item nav-expand">
                <a class="nav-link nav-expand-link" href="#">
                    Menu
                </a>
                <ul class="nav-items nav-expand-content">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Level 2
                        </a>


                    </li>
                    <li class="nav-item nav-expand">
                        <a class="nav-link nav-expand-link" href="#">
                            Menu
                        </a>
                        <ul class="nav-items nav-expand-content">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Level 3
                                </a>
                            </li>
                            <li class="nav-item nav-expand">
                                <a class="nav-link nav-expand-link" href="#">
                                    Menu
                                </a>
                                <ul class="nav-items nav-expand-content">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Level 4
                                        </a>
                                    </li>
                                    <li class="nav-item nav-expand">
                                        <a class="nav-link nav-expand-link" href="#">
                                            Menu
                                        </a>
                                        <ul class="nav-items nav-expand-content">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">
                                                    Level 5 Directory
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">
                                                    Level 5 Contact
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">
                                                    Level 5 Quick links
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">
                                                    Level 5 Launchpad
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Level 4 Directory
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Level 4 Contact
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Level 4 Quick links
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Level 4 Launchpad
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Level 3 Directory
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Level 3 Contact
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Level 3 Quick links
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Level 3 Launchpad
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Level 2 Directory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Level 2 Contact
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Level 2 Quick links
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Level 2 Launchpad
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Directory
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Contact
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Quick links
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Launchpad
                </a>
            </li>

        </ul>
        <div style="height: 100%">aaa</div>

    </nav>
</div>
<script>
    console.clear()

    const navExpand = [].slice.call(document.querySelectorAll('.nav-expand'))
    const backLink = `<li class="nav-item">
	<a class="nav-link nav-back-link" href="javascript:;">
		Back
	</a>
</li>`

    navExpand.forEach(item => {
        item.querySelector('.nav-expand-content').insertAdjacentHTML('afterbegin', backLink)
        item.querySelector('.nav-link').addEventListener('click', () => item.classList.add('active'))
        item.querySelector('.nav-back-link').addEventListener('click', () => item.classList.remove('active'))
    })


    // ---------------------------------------
    // not-so-important stuff starts here

    const ham = document.getElementById('ham')
    ham.addEventListener('click', function () {
        document.body.classList.toggle('nav-is-toggled')
    })

</script>