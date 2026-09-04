document.querySelector('#login-form').addEventListener('submit',async event=>{
  event.preventDefault();
  const form=event.currentTarget,button=form.querySelector('button'),error=form.querySelector('.login-error');
  button.disabled=true;button.textContent='Signing In...';error.textContent='';
  try{
    const response=await fetch('../api/auth/login',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(Object.fromEntries(new FormData(form)))});
    const result=await response.json();
    if(!response.ok)throw new Error(result.error||'Unable to sign in');
    location.href='dashboard.html';
  }catch(exception){error.textContent=exception.message;button.disabled=false;button.textContent='Sign In'}
});
