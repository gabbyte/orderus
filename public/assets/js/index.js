const URL = window.location.href + 'assets/xhr/data.php';
const storyContainer = document.querySelector('.story-container');
const btn = document.querySelector('.cta-btn');

btn.addEventListener('click', start);




async function start() {
    const data = await fetch(URL);
    const json = await data.json();
    const gameplay = json.gameplay;

    Object.entries(json.stats).forEach(populateStats);

    gameplay.reduce(async (previous, text) => {
        const isLastElement = (text === gameplay[gameplay.length - 1]);

        await previous;
        return populateStory(text, isLastElement);
    }, []);
}

function populateStats([character, stats]) {
    const container = document.querySelector('[data-character="' + character + '"]');
    Object.entries(JSON.parse(stats)).forEach(([name, value]) => {
        const statsEl = container.querySelector('[data-stats-name="' + name + '"]');
        statsEl.textContent = value;
    });
}

async function populateStory(text, last = false) {
    storyContainer.textContent = text;

    if (last) {
        storyContainer.append(btn);
    }

    await delay(1000);
}

function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}