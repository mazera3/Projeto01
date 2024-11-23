import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    LineElement,
    Filler,
    PointElement,
    Legend,
} from 'chart.js';

import { Line } from "react-chartjs-2";

ChartJS.register(
    CategoryScale,
    LinearScale,
    LineElement,
    Filler,
    PointElement,
    Legend,
)

const LineChartUsers = ({ data }) => {
    const monthNames = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];
    const labels = data.labels.map(month => monthNames[month - 1]);
    const chartData = {
        ...data,
        labels: labels,
        datasets: data.datasets.map((dataset) => ({
            ...dataset,
            label: 'Cadastros Line',
            backgroudColor: '#9bd0f5',
            borderColor: '#36a2eb',
            borderWidth: 1,
            fill: true
        })),
    };

    const options = {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Gráfico de Cadastros'
            },
        },
    };
    return (
        <>
            {labels ? (
                <Line
                    data={chartData}
                    options={options}
                />
            ) : (<p>carregando..</p>)}
        </>
    )
}

export default LineChartUsers;