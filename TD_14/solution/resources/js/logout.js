export default (btnLogoutSelector) => {
    const btnLogout = document.querySelector(btnLogoutSelector);
    if (!btnLogout) {
        return;
    }

    btnLogout.addEventListener('click', async function (e) {
        e.preventDefault()

        const target = this.href
        console.log(target)

        try {
            const result = await fetch(target, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-Token': this.dataset.csrf,
                    'content-type': 'application/json'
                }
            })

            const resultJson = await result.json();
            window.location = resultJson.redirect_to

        } catch (e) {
            console.error(e);
        }
    })
}
