const sliderElement = $('#slides');
let running = true;

function togglePlay() {
  const button = $('#controls button i');

  button.toggleClass('fa-play');
  button.toggleClass('fa-pause');

  if (running) {
    sliderElement.superslides('stop');
  } else {
    sliderElement.superslides('start');
  }
  running = !running;
}
window.togglePlay = togglePlay;


sliderElement.superslides({
  play: 10000,
  pagination: false,
});