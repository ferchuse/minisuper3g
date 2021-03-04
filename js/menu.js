window.addEventListener('load', e => {
  // new PWAConfApp();
  registerSW(); 
});


async function registerSW() { 
	console.log("registerSW()")
  if ('serviceWorker' in navigator) { 
    try {
      await navigator.serviceWorker.register('../sw.js'); 
    } catch (e) {
      alert('ServiceWorker registration failed. Sorry about that.'); 
	  }
  } else {
    document.querySelector('.alert').removeAttribute('hidden'); 
  }
}

$.ajaxSetup({ cache: false });
