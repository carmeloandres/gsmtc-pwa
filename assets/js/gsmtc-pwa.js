
// this function is only for develop use
if( navigator.serviceWorker){

    navigator.serviceWorker.register('/gsmtc-plugins/sw.js');
    console.log( 'podemos usar PWA!');
}

// this function is only for production use
/*
if( navigator.serviceWorker){

    navigator.serviceWorker.register('/sw.js');
    console.log( 'podemos usar PWA!');
} */
