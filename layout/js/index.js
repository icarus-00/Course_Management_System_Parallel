const nav = document.querySelector('.nav');
const mainContainer = document.querySelector('.container');

function setMarginTop()
{
    let x = nav.offsetHeight;
    let y = parseInt(getComputedStyle(nav).paddingBottom,10);
    mainContainer.style.marginTop = '${x + y}px';
    
}



setMarginTop();