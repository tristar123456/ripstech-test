import c3 from 'c3';

let statisticData = [];

function renderChart() {
  c3.generate({
    bindTo: '#chart',
    data: {
      json: statisticData,
      keys: {
        value: ['net', 'gross'],
      },
    },
  });
}

async function fetchStatistics() {
  const options = {method: 'GET'};
  const response = await fetch('/statistics', options);
  statisticData = await response.json();

  renderChart();
}


renderChart();
fetchStatistics();