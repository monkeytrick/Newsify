//　JS file for loading Chart.JS components so they do not
// need to be imported on each of the admin components using
// charts
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
    ArcElement,
    RadialLinearScale
  } from 'chart.js'

  // Plugin to add random colours to charts
import autocolors from 'chartjs-plugin-autocolors';

export function Chart () {
  return ChartJS.register(     
      Title,
      Tooltip,
      Legend,
      BarElement,
      CategoryScale,
      LinearScale,
      RadialLinearScale,
      ArcElement,
      autocolors)

  }