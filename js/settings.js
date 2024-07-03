const imageButton=document.querySelector('.image-button');
console.log(imageButton);
imageButton.addEventListener('click',(e)=>{
e.preventDefault();
e.stopPropagation();
const imageInput=document.querySelector('.image-input');
imageInput.click();
imageInput.addEventListener('change',()=>{
        const imageField=document.querySelector('.image-field');
        imageField.src=URL.createObjectURL(imageInput.files[0]);     
    })
})


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


function displaySideBar(){
    const toggleButton=document.querySelector('.toggleButton');
    const sidebar=document.querySelector('.sidebar');
    toggleButton.addEventListener('click',()=>{
        sidebar.classList.remove('translate-x-[-100%]');
        sidebar.classList.add('translate-x-[0%]');
    })
}
displaySideBar();


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

