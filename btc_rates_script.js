const fetchRates = () => {
    fetch('https://api.coindesk.com/v1/bpi/currentprice.json')
        .then(response => {
            if( !response ) {
                throw new Error('BTC Rates response was not ok');
            }
            return response.json();
        })
        .then(data => {
            var rates = data.bpi;
            var usd = formatCurrency(rates.USD.rate_float, 'USD');
            var gbp = formatCurrency(rates.GBP.rate_float, 'GBP');
            var eur = formatCurrency(rates.EUR.rate_float, 'EUR');

            document.querySelector('#rate_usd').innerHTML = usd;
            document.querySelector('#rate_gbp').innerHTML = gbp;
            document.querySelector('#rate_eur').innerHTML = eur;
        })
        .catch(error => {
            console.log('BTC Rates', error);
        });
}

const formatCurrency = (amount, currency) => {
    if (typeof amount !== 'number' || isNaN(amount)) {
        return 'N/A';
    }

    return amount.toLocaleString('en-US', {
        minimumFractionDigits: 2, 
        maximumFractionDigits: 2
    });
}

document.addEventListener('DOMContentLoaded', ()=>{
    fetchRates();
    
    setInterval(()=> {
        fetchRates();
    }, 1000*60); // 1 second is 1000 millis times 60 seconds equals 1 minute

    document.querySelector( '#fetch_rates' ).onclick = () => {
        fetchRates();
    }
});