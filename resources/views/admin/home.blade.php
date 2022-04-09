@extends('layouts.admin.dashboard')

@php
use App\Model\Dish;

$totalDishes = count(Dish::where('user_id', Auth::user()->id)->get());

$orders = DB::table('orders')
    ->select('orders.*')
    ->distinct()
    ->join('dish_order', 'orders.id', '=', 'dish_order.order_id')
    ->join('dishes', 'dish_order.dish_id', '=', 'dishes.id')
    ->where('user_id', Auth::user()->id) //Auth::user()->id non gli piace, bisognerà passargli dei parametri dall'home
    ->get();

$ordersNumber = count($orders);

$totalRevenue = 0;

foreach ($orders as $order) {
    $totalRevenue += $order->total_amount;
}
@endphp

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-xl-3 my-2">
            <div id="stat-card-1" class="stat-card rounded d-flex justify-content-around align-items-center">
                <div class="stat-card-info d-flex flex-column">
                    <span class="stat-card-info-number">{{ $ordersNumber }}</span>
                    <span class="stat-card-info-text">Totale Ordini</span>
                </div>
                <div class="stat-card-logo rounded-circle d-flex align-items-center justify-content-center">
                    <i class="stat-card-logo-fa fa-solid fa-dolly"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 my-2">
            <div id="stat-card-2" class="stat-card rounded d-flex justify-content-around align-items-center">
                <div class="stat-card-info d-flex flex-column">
                    <span class="stat-card-info-number">{{ $totalDishes }}</span>
                    <span class="stat-card-info-text">Numero Piatti</span>
                </div>
                <div class="stat-card-logo rounded-circle d-flex align-items-center justify-content-center">
                    <i class="stat-card-logo-fa fa-solid fa-pizza-slice"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 my-2">
            <div id="stat-card-3" class="stat-card rounded d-flex justify-content-around align-items-center">
                <div class="stat-card-info d-flex flex-column">
                    <span class="stat-card-info-number">{{ $totalRevenue }}&euro;</span>
                    <span class="stat-card-info-text">Totale Guadagni</span>
                </div>
                <div class="stat-card-logo rounded-circle d-flex align-items-center justify-content-center">
                    <i class="stat-card-logo-fa fa-solid fa-dollar-sign"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 my-2">
            <div id="stat-card-4" class="stat-card rounded d-flex justify-content-around align-items-center">
                <div class="stat-card-info d-flex flex-column">
                    @if ($ordersNumber > 0)
                        <span
                            class="stat-card-info-number">{{ number_format(round($totalRevenue / $ordersNumber, 2), 2, '.', '') }}&euro;</span>
                    @else
                        <span class="stat-card-info-number">0</span>
                    @endif
                    <span class="stat-card-info-text">Media Ordini</span>
                </div>
                <div class="stat-card-logo rounded-circle d-flex align-items-center justify-content-center">
                    <i class="stat-card-logo-fa fa-solid fa-calculator"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="ms-sm-auto px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Resoconto Fatturato / Ordini</h1>
            </div>
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <script>
        let restaurantId = {!! json_encode((array) auth()->user()->id) !!};
        console.log(restaurantId);
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
        const apiKey = 'deliveboo26313334';

        // axios.get("http://127.0.0.1:8000/api/orders/data", {
        //         headers: {
        //             'Authorization': 'Bearer ' + apiKey
        //         }, 
        //         params: {
        //             id: this.restaurantId
        //         }
        //     })

        axios
            .post(
                "http://127.0.0.1:8000/api/orders/data", {
                    headers: {
                        'Authorization': 'Bearer ' + apiKey,
                    },
                    params: {
                        id: restaurantId
                    }
                })
            .then(res => {
                this.ordersData = res.data.results;
                // console.log(res);
                //creo un array dove inserirò oggetti contenenti solo il mese e il totale di ogni ordine
                let dateData = [];
                dateData = this.ordersData.map(el => {
                    let date = new Date(el.date);
                    
                    return {
                        month: date.getMonth() + 1,
                        total_amount: el.total_amount
                    }
                });

                // creo un array dove andranno inseriti il numero ordini per ogni mese
                let numberOrderPerMonth = [];
                //array che tiene traccia dei mesi già analizzati
                let monthAnalized = [];
                let maxOrders = 0;
                for (let i = 0; i < dateData.length; i++) {
                    let counter = 1;
                    // controllo se il mese su cui sto ciclando non è contenuto nell'array di mesi già analizzati
                    if (!monthAnalized.includes(dateData[i].month)) {
                        for(let y = i + 1; y < dateData.length; y++) {
                            //se i mesi su cui sto ciclando combaciano, aumento di 1 il contatore, significa che c'è un ordine in più per quel mese
                            if(dateData[i].month == dateData[y].month) {
                                counter++;
                            }
                        }
                    monthAnalized.push(dateData[i].month)
                    numberOrderPerMonth[dateData[i].month - 1] = counter;
                    if(counter > maxOrders) {
                        maxOrders = counter;
                    }
                    }
                }


                // creo un array dove andranno inseriti gli ordini e i totali raggruppati per mese
                let monthlyTotal = [];
                // creo un array dove inserirò i mesi già analizzati nel ciclo
                monthAnalized = [];
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
                        numberOrderPerMonth[i] = 0;
                        pricesForChart[i] = 0;
                    }
                }


                const data = {
                //     labels: labels,
                //     datasets: [{
                //         label: 'Guadagni',
                //         yAxisID: 'A',
                //         backgroundColor: 'rgb(0, 153, 0)',
                //         borderColor: 'rgb(0, 153, 0)',
                //         data: [...pricesForChart],
                //     },
                //     {
                //         label: 'Numero Ordini',
                //         yAxisID: 'B',
                //         backgroundColor: 'rgb(200, 10, 10)',
                //         borderColor: 'rgb(200, 10, 10)',
                //         data: [...numberOrderPerMonth],
                //     }
                // ]
                    labels: labels,
                    datasets: [{
                        label: 'Fatturato',
                        yAxisID: 'A',
                        data: [...pricesForChart],
                        backgroundColor: 'rgb(0, 153, 0)',
                        borderColor: 'rgb(0, 153, 0)',
                    }, {
                        label: 'Numero Ordini',
                        yAxisID: 'B',
                        data: [...numberOrderPerMonth],
                        backgroundColor: 'rgb(200, 10, 10)',
                        borderColor: 'rgb(200, 10, 10)',
                    }]
                };

                const config = {
                    type: 'line',
                    data: data,
                    
                    options: {
                        scales: {
                            A: {
                                type: 'linear',
                                position: 'left',
                            },
                            B: {
                                type: 'linear',
                                position: 'right',
                                suggestedMin: 0,
                                suggestedMax: maxOrders + 5,
                                
                            }
                        }
                    }
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
