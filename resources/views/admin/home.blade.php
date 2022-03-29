@extends('layouts.admin.dashboard')

@section('content')
    <main class="ms-sm-auto px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Resoconto Ordini</h1>
        </div>
        <div>
            <canvas id="myChart"></canvas>
        </div>
    </main>
    <script>
        const labels = [
            'Gennaio',
            'Febbraio',
            'Marzo',
            'Aprile',
            'Maggio',
            'Giugno',
            'Luglio',
            'Agosto',
            'Settembre',
            'Ottobre',
            'Novembre',
            'Dicembre'

        ];
        let ordersData = [];

        axios.get("http://127.0.0.1:8001/api/orders/data").then(res => {
                this.ordersData = res.data.results;
                //creo un array dove inserirò oggetti contenenti solo il mese e il totale di ogni ordine
                let dateData = [];
                dateData = this.ordersData.map(el => {
                    let date = new Date(el.date);
                    return {
                        month: date.getMonth() + 1,
                        total_amount: el.total_amount
                    }
                });

                // creo un array dove andranno inseriti gli ordini e i totali raggruppati per mese
                let monthlyTotal = [];
                // creo un array dove inserirò i mesi già analizzati nel ciclo
                let monthAnalized = [];

                for (i = 0; i < dateData.length; i++) {
                    // controllo se il mese su cui sto ciclando non è contenuto nell'array di mesi già analizzati
                    if (!monthAnalized.includes(dateData[i].month)) {
                        // creo un oggetto che verrà riempito con la somma dei totali per ogni mese
                        let monthData = {};
                        let totalPrice = 0;
                        for (y = i; y < dateData.length; y++) {
                            // se il mese su cui sto ciclando combacia, aggiorno la somma del totale e lo salvo in un oggetto
                            if (dateData[i].month == dateData[y].month) {
                                totalPrice += dateData[y].total_amount;
                                monthData = {
                                    month: dateData[y].month,
                                    total_amount: totalPrice
                                }
                            }
                        }
                        // alla fine del giro sull'array mi salvo il mese che ho analizzato e pusho l'oggetto in un array e poi nel caso ricomincio un altro giro alla ricerca di un mese diverso
                        monthAnalized.push(dateData[i].month)
                        monthlyTotal.push(monthData);
                    }
                }

                // creo un array dove inserirò solo i totali degli ordini per poter creare la scala del grafico
                let pricesForChart = [];
                // monthlyTotal.forEach(element => {
                //     pricesForChart.push(element.total_amount)
                // });

                // uso il numero del mese (-1) come indice e ci metto dentro il valore del prezzo totale
                //creo una variabile per scoprire qual'è il numero massimo del mese
                let maxMonth = 0;
                for (i = 0; i < monthlyTotal.length; i++) {
                    pricesForChart[monthlyTotal[i].month - 1] = monthlyTotal[i].total_amount;
                    if (maxMonth < monthlyTotal[i].month) {
                        maxMonth = monthlyTotal[i].month;
                    }
                }
                // faccio un ciclo da 0 a numero massimo del mese per riempire con uno 0 la parte di array rimasto vuoto
                for (i = 0; i < maxMonth; i++) {
                    if (!pricesForChart[i]) {
                        pricesForChart[i] = 0;
                    }
                }

                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Ordini',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: [...pricesForChart],
                    }]
                };

                const config = {
                    type: 'line',
                    data: data,
                    options: {}
                };

                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );

            })
            .catch(err => {
                console.log(err);
            })
    </script>
@endsection
