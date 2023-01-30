import './bootstrap';

import '../css/app.css';

const userMenuButton = document.querySelector('#user-menu-button')

if (userMenuButton) {
    userMenuButton.addEventListener('click', (e) => {
        e.preventDefault()
        document.querySelector('#user-menu').classList.toggle('hidden')
    })
}
