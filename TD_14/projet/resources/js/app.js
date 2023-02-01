import './bootstrap';

import '../css/app.css';
import initSizeSelector from './size-selector'
import initLogout from './logout'

const userMenuButton = document.querySelector('#user-menu-button')

if (userMenuButton) {
    userMenuButton.addEventListener('click', (e) => {
        e.preventDefault()
        document.querySelector('#user-menu').classList.toggle('hidden')
    })
}

initLogout('#btn-logout');
initSizeSelector('.label-sizes');
