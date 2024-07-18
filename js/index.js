function selectLanguage(){
    const selectElement=document.querySelector('.select');
    selectElement.addEventListener('change',e=>{
        const option=e.target.selectedOptions[0];
        const value=option.value;
        console.log(e.target.selectedOptions);
        window.location.href =value;
    })
}
selectLanguage();


gsap.registerPlugin(ScrollTrigger);
gsap.to('.row',{
    opacity:1,
    duration:3,
    ScrollTrigger:".row"
})


console.log(new Date().getHours());
