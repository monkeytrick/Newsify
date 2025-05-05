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
    RadialLinearScale,
    Colors
  } from 'chart.js'

export function Chart () {

  ChartJS.register(     
      Title,
      Tooltip,
      Legend,
      BarElement,
      CategoryScale,
      LinearScale,
      RadialLinearScale,
      ArcElement,
      Colors
    )

  }