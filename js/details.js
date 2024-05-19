import {clickLinksSideBar} from './dashboard.js';


function adjustPriceForTrial(){
    const status=document.querySelectorAll('.status');
    status.forEach(item=>{
        if(item.textContent=='trial'){
            item.classList.add('text-blue'); 
            item.nextElementSibling.textContent="_ _";
            item.nextElementSibling.classList.remove('price');
        }
        else{
            item.classList.add('text-green-dark');
        }
    })
}
adjustPriceForTrial();

function totalPrice(){
    const prices=document.querySelectorAll('.price');
    const totalPrice=document.querySelector('.total-price');
    let sum=0;
    prices.forEach(price=>{
        sum+=parseInt(price.textContent);
    })
    totalPrice.textContent=sum;
}
totalPrice();

