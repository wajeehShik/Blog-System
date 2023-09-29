
        const prevBtns=document.querySelectorAll(".btn-prev")
        const nextBtns=document.querySelectorAll(".btn-next")
        const formSteps=document.querySelectorAll(".form-step")
        
        
        let formStepsNum=0;
        if(formStepsNum==0){
            document.querySelector(".btn-prev").style.display ="none";
        }
        nextBtns.forEach(btn=>{
            btn.addEventListener("click",()=>{
                formStepsNum++;
        
                updateFormSteps();
            if(formStepsNum==1){
            document.querySelector(".btn-prev").style.display ="block";
            document.querySelector(".btn-next").style.display ="none";
        }
        
            })
        })
        prevBtns.forEach(btn=>{
            btn.addEventListener("click",()=>{
              if(formStepsNum ==1){
                formStepsNum--;
                updateFormSteps();
            document.querySelector(".btn-prev").style.display ="none";
            document.querySelector(".btn-next").style.display ="block";
              }
        
            })
        })
        
        function updateFormSteps(){
            formSteps.forEach(formStep=>{
                formStep.classList.contains("from-step-active") && 
                formStep.classList.remove('from-step-active');
            })
            formSteps[formStepsNum].classList.add('from-step-active')
        }
        