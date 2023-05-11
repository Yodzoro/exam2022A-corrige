import { random } from '/assets/js/random.js'

const main = document.querySelector('body');

const createBubble = () => {
  const bubble = document.createElement('div');
  const size = Math.random() * 200;
  console.log(innerWidth)

  bubble.style.width = `${size}px`;
  bubble.style.height = `${size}px`;
  bubble.style.left = `${random(size / 2, innerWidth - size / 2)}px`;
  bubble.style.top = `${random(size / 2, innerHeight - size / 2)}px`;
  bubble.style.animationDelay = `${random(0.5, 1)}s`;
  bubble.style.animationDuration = `${random(3, 6)}s`;
  bubble.classList.add('bubble');

  main.appendChild(bubble);
}

for (let i = 0; i < 10; i++) {
  createBubble()
}