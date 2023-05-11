let page = 0
const loadGames = async () => {
    const response = await fetch('http://localhost:8000/assets/actions/gameServer.php?page=' + page)
    const games = await response.json()

    const gamesContainer = document.querySelector('main section')

    games.forEach(game => {
        const gameElement = document.createElement('a')
        gameElement.href = `/game.php?id=${game.id}`
        gameElement.innerHTML = `
            <article>
                <header>
                    <img src="/public/uploads/${game.image}" alt="${game.name}"/>
                    <h3>${game.name}</h3>
                </header>
                <p>${game.description}</p>
            </article>
        `
        gamesContainer.appendChild(gameElement)
    })
}

const response = await fetch('http://localhost:8000/assets/actions/gameTableSize.php')
const gameTableSize = await response.json()

document.querySelector('main button')
        .addEventListener('click', async () => {
            await loadGames()
            page++

            if ((page * 3) >= gameTableSize) {
                document.querySelector('main button')
                        .remove()
            }
        })
