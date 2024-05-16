
function displayNumberOfNewClients(){
    const newClients=document.querySelectorAll('.new-clients');
    let len=newClients.length;
    const numberOfClients=document.querySelector('.number-clients');
    if(numberOfClients!=null)
        numberOfClients.textContent=len;
    else
        numberOfClients.textContent=0;
}
displayNumberOfNewClients();