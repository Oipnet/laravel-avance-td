export default (className) => {
    const sizes = document.querySelectorAll(className)
    if (sizes.length) {
        sizes[0].classList.add('border-indigo-600')
        sizes[0].querySelector('input[type=radio]').setAttribute('checked', 'checked');
    }

    [...sizes].map(
        size => {
            size.addEventListener('click', function (e) {
                e.preventDefault();

                [...document.querySelectorAll(className)].map(
                    s => {
                        s.classList.remove('border-indigo-600')
                        s.querySelector('input[type=radio]').removeAttribute('checked')
                    }
                );
                this.querySelector('input[type=radio]').setAttribute('checked', 'checked');
                this.classList.toggle('border-indigo-600')
            })
        }
    )
}
