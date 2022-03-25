@extends('layouts.admin.dashboard')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

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
            // console.log(this.ordersData);

            let date = new Date(this.ordersData[0].date);
            // console.log(date.getMonth()+1);
            let dateData = [];
            dateData = this.ordersData.map(el => {
                return {
                    month: date.getMonth()+1,
                    total_amount: el.total_amount
                }
            });


            let monthlyTotal = [];
            for(i=0; i < dateData.length; i++) {
                console.log("test");
                for(y=i; y < dateData.length; y++) {
                console.log("test");

                    let sum = 0;
                    if(dateData[i].month == dateData[y].month) {
                        sum += dateData[y].total_amount;
                        monthlyTotal.push({
                            month: dateData[y].month,
                            total_amount: sum
                        })
                    }
                }
            }    
            console.log(monthlyTotal);
        })
        .catch(err => {
            console.log(err);
        })
      
        const data = {
          labels: labels,
          datasets: [{
            label: 'Ordini',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 15, 30, 100],
          }]
        };
      
        const config = {
          type: 'line',
          data: data,
          options: {}
        };
    </script>
    <script>
        const myChart = new Chart(
          document.getElementById('myChart'),
          config
        );
    </script>
@endsection
