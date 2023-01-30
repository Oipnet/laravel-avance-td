export default (selector) => {
    const orderStateUpdatelinks = document.querySelectorAll(selector);

    [...orderStateUpdatelinks].map((orderStateUpdatelink) => {
        orderStateUpdatelink.addEventListener('click', async function(e) {
            e.preventDefault()

            const target = this.href;
            await fetch(target, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-Token': this.dataset.csrf,
                    'content-type': 'application/json'
                }
            })

            this.remove()
        })
    })
}
