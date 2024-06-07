

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

function clickLinksSideBar(){
    const links=document.querySelectorAll('.link-page');
    links.forEach((link)=>{
    link.addEventListener('click',(e)=>{
            const sibling=e.currentTarget.children[1];
            sibling.click();
        })
    })
}
clickLinksSideBar();

function hideSideBar(){
    const cross=document.querySelector('.cross');
    const sidebar=document.querySelector('.sidebar');
    console.log(cross);
    cross.addEventListener('click',()=>{
        sidebar.classList.remove('translate-x-[0%]');
        sidebar.classList.add('translate-x-[-100%]');
    })
}
hideSideBar();
function displaySideBar(){
    const toggleButton=document.querySelector('.toggleButton');
    const sidebar=document.querySelector('.sidebar');
    toggleButton.addEventListener('click',()=>{
        sidebar.classList.remove('translate-x-[-100%]');
        sidebar.classList.add('translate-x-[0%]');
    })
}
displaySideBar();
