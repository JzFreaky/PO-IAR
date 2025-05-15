document.getElementById('preloader').style.display = 'flex';

const minDuration = 600; 
const startTime = Date.now();

window.onload = function() {
    const elapsedTime = Date.now() - startTime;
    const hideDelay = Math.max(minDuration - elapsedTime, 0);
    
    setTimeout(function() {
        document.getElementById('preloader').style.display = 'none';
    }, hideDelay);
};