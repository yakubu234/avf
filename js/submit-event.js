const eventForm=document.querySelector('#event-form');const formSteps=[...document.querySelectorAll('.form-step')];const indicators=[...document.querySelectorAll('[data-step-indicator]')];const nextButton=document.querySelector('[data-next]');const backButton=document.querySelector('[data-back]');const submitButton=document.querySelector('.submit-button');const errorMessage=document.querySelector('.form-error');let currentStep=1;
function showStep(step){currentStep=step;formSteps.forEach(panel=>panel.classList.toggle('active',Number(panel.dataset.step)===step));indicators.forEach(item=>{const number=Number(item.dataset.stepIndicator);item.classList.toggle('active',number===step);item.classList.toggle('complete',number<step)});backButton.hidden=step===1;nextButton.hidden=step===4;submitButton.hidden=step!==4;errorMessage.textContent='';if(step===4)buildReview();window.scrollTo({top:0,behavior:'smooth'})}
function validateStep(){const active=formSteps[currentStep-1];const fields=[...active.querySelectorAll('[required]')];for(const field of fields){if(!field.checkValidity()){field.reportValidity();errorMessage.textContent='Please complete all required fields before continuing.';return false}}return true}
function buildReview(){const data=new FormData(eventForm);const labels={eventName:'Event Name',eventType:'Event Type',organizer:'Organizer',location:'City',venue:'Venue',eventDate:'Date',eventTime:'Time',email:'Contact Email'};document.querySelector('.review-summary').innerHTML=Object.entries(labels).map(([key,label])=>`<div><dt>${label}</dt><dd>${data.get(key)||'—'}</dd></div>`).join('')}
nextButton?.addEventListener('click',()=>{if(validateStep())showStep(Math.min(4,currentStep+1))});
backButton?.addEventListener('click',()=>showStep(Math.max(1,currentStep-1)));
eventForm?.addEventListener('submit',async event=>{
  event.preventDefault();
  if(!validateStep())return;
  submitButton.disabled=true;
  submitButton.textContent='Submitting...';
  try{
    const data=Object.fromEntries(new FormData(eventForm).entries());
    const response=await fetch('api/submissions',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(data)});
    const result=await response.json();
    if(!response.ok)throw new Error(result.error||'Unable to submit event');
    eventForm.hidden=true;
    document.querySelector('.stepper').hidden=true;
    document.querySelector('.success-message').hidden=false;
  }catch(error){
    errorMessage.textContent=error.message;
    submitButton.disabled=false;
    submitButton.textContent='Submit Event';
  }
});
