<?php
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['depends' => \yii\web\JqueryAsset::class]);
$labels = json_encode(array_column($fiscalYears, 'fiscal_year'));
$data = json_encode(array_column($fiscalYears, 'total'));
?>

<h3>งบประมาณรวมรายปี</h3>
<canvas id="budgetChart" height="100"></canvas>

<?php
$this->registerJs(<<<JS
const ctx = document.getElementById('budgetChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: $labels,
        datasets: [{
            label: 'งบประมาณรวม (บาท)',
            data: $data,
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
JS);
?>
