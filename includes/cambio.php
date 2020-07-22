<?php
 /*$xml = simplexml_load_file("https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22USDBRL%22%2C%22EURBRL%22%2C%20%22GBPBRL%22)&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys");

 $USDBRL = $xml->results->rate[0]->Rate;
 $EURBRL = $xml->results->rate[1]->Rate;
 $GBPBRL = $xml->results->rate[2]->Rate;*/
?>

<script type="text/javascript">

// setTimeout(function(){ 

//   if ($('body').hasClass('single-listings')) {
    
//       $('.listing-price.currency').each(function() {
//           var text = $(this).text();
//           $(this).text(text.replace('R$', '')); 
//       });
//   }
// },5000);

</script>

<script type="text/javascript">


  setTimeout(function(){ 

    
    $.getJSON("https://data.fixer.io/api/latest?access_key=acc3c1e5d62db17d69769423cd7da8d5&base=BRL&symbols=USD,EUR,GBP",
    function(data) {
      var dolar = data.rates.USD;
      var euro = data.rates.EUR;
      var pound = data.rates.GBP;
      var Real = data.rates.BRL;


      var selector = document.querySelector("#currencySelector");
      var currencyElements = document.getElementsByClassName("currency");
      var usdChangeRate = {
          USD: data.rates.USD,
          EUR: data.rates.EUR,
          GBP: data.rates.GBP,
          BRL: 1.0
        };

      var selectOption = selector.options[selector.selectedIndex];
      var lastSelected = localStorage.getItem('selector');


      if(lastSelected) {
        selector.value = lastSelected;
      }

      var toCurrency = selector.value.toUpperCase();
      for (var i=0,l=currencyElements.length; i<l; ++i) {
        var el = currencyElements[i];
        var fromCurrency = el.getAttribute("data-currencyName").toUpperCase();
        var simbolo = $("#currencySelector option:selected").attr("id");

        if (fromCurrency in usdChangeRate) {
            var fromCurrencyToUsdAmount = parseFloat(el.innerHTML) * usdChangeRate[fromCurrency];
            var toCurrencyAmount = fromCurrencyToUsdAmount * usdChangeRate[toCurrency];

            el.innerHTML = simbolo+" "+toCurrencyAmount.toFixed(2);
            el.setAttribute("data-currencyName",toCurrency);
            el.setAttribute("data-value", toCurrencyAmount.toFixed(2));

            var valorNormal = el.getAttribute("data-value");
            function getMoney( str ) {
              return parseInt( str.replace(/[\D]+/g,'') );
            }
            function formatReal( int ) {
              var tmp = int+'';
              tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
              if( tmp.length > 6 )
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
              return tmp;
            }
            var int = getMoney( valorNormal );

            el.innerHTML = simbolo+" "+formatReal(int);
        }
      }

      selector.onchange = function() {
        lastSelected = selector.options[selector.selectedIndex].value;
        localStorage.setItem('selector', lastSelected);
      };


    }
  );

  
  },5000);

</script>
