(()=>{
  const prefix=location.pathname.includes('/settings/')?'../../':'../';
  let selectedRow=null,pendingDelete=null,wizardStep=0;
  const token=async()=>{const response=await fetch(prefix+'api/auth/csrf');if(!response.ok)throw new Error('Your session has expired');return (await response.json()).token};
  const request=async(path,options={})=>{options.headers={...(options.headers||{}),'X-CSRF-Token':await token()};const response=await fetch(prefix+'api/'+path,options);const result=await response.json();if(!response.ok)throw new Error(result.error||'Request failed');return result};
  const toast=message=>{const node=document.createElement('div');node.className='toast';node.textContent=message;document.body.append(node);setTimeout(()=>node.remove(),2400)};
  const install=()=>{
    if(!document.querySelector('.sidebar')||document.querySelector('.logout-btn'))return;
    const logout=document.createElement('button');logout.className='btn logout-btn';logout.textContent='↪ Log Out';document.querySelector('.sidebar-bottom').prepend(logout);
    logout.onclick=async()=>{await fetch(prefix+'api/auth/logout',{method:'POST'});location.href=prefix+'admin/login.html'};
    if(document.body.dataset.page==='dashboard')fetch(prefix+'api/dashboard').then(r=>r.json()).then(({data})=>{if(!data)return;const values=[data.events,data.organizers,data.users,data.views];document.querySelectorAll('.stats .stat strong').forEach((node,index)=>{if(values[index]!==undefined)node.textContent=Number(values[index]).toLocaleString()})}).catch(()=>{});
    if(location.pathname.includes('/settings/'))fetch(prefix+`api/admin/settings/${document.body.dataset.page}`).then(r=>r.json()).then(({data})=>{const saved=Object.fromEntries((data||[]).map(item=>{let value=item.setting_value;try{value=JSON.parse(value)}catch{}return[item.setting_key,value]}));document.querySelectorAll('.settings-layout input,.settings-layout select,.settings-layout textarea').forEach((field,index)=>{const value=saved[field.name||`field_${index}`];if(value!==undefined)field.value=value});document.querySelectorAll('.settings-layout .toggle').forEach((toggle,index)=>{if(saved[`toggle_${index}`]!==undefined)toggle.classList.toggle('on',Boolean(saved[`toggle_${index}`]))})}).catch(()=>{});
  };
  new MutationObserver(install).observe(document.documentElement,{childList:true,subtree:true});install();
  document.addEventListener('click',async event=>{
    const menu=event.target.closest('.menu-btn');if(menu)selectedRow=menu.closest('tr');
    if(event.target.closest('.danger-item')&&selectedRow?.dataset.id)pendingDelete={resource:selectedRow.dataset.resource||'events',id:selectedRow.dataset.id,row:selectedRow};
    const rowDelete=event.target.closest('.row-delete');if(rowDelete){const row=rowDelete.closest('tr');pendingDelete={resource:row.dataset.resource,id:row.dataset.id,row};const name=row.querySelector('strong')?.textContent||'this record';const modal=document.querySelector('.modal');modal.querySelector('h2').textContent=`Delete ${name}?`;modal.querySelector('p').textContent='It will be removed from the homepage slider and from any events it sponsors. This action cannot be undone.';modal.classList.add('open')}
    const sponsorToggle=event.target.closest('.sponsor-toggle');if(sponsorToggle){const row=sponsorToggle.closest('tr'),live=!sponsorToggle.classList.contains('on');try{await request(`admin/sponsors/${row.dataset.id}`,{method:'PATCH',headers:{'Content-Type':'application/json'},body:JSON.stringify({status:live?'active':'hidden'})});sponsorToggle.setAttribute('aria-checked',String(live));row.querySelector('.sponsor-state').textContent=live?'Visible':'Hidden';toast(live?'Sponsor is now live on the homepage':'Sponsor hidden from the homepage')}catch(error){sponsorToggle.classList.toggle('on',!live);toast(error.message)}}
    const sponsorSave=event.target.closest('.event-sponsor-save');if(sponsorSave){const card=sponsorSave.closest('.event-sponsor-card'),select=card.querySelector('.event-sponsor-select');sponsorSave.disabled=true;try{await request(`admin/events/${card.dataset.event}`,{method:'PATCH',headers:{'Content-Type':'application/json'},body:JSON.stringify({sponsor_id:select.value})});const label=document.querySelector('.event-sponsor-name');if(label)label.textContent=select.value?select.selectedOptions[0].textContent.replace(/ \(hidden\)$/,''):'—';toast(select.value?'Event sponsor saved':'Sponsor removed from event')}catch(error){toast(error.message)}finally{sponsorSave.disabled=false}}
    if(event.target.closest('.modal-confirm')&&pendingDelete){try{await request(`admin/${pendingDelete.resource}/${pendingDelete.id}`,{method:'DELETE'});pendingDelete.row.remove();document.querySelector('.modal')?.classList.remove('open');toast('Record deleted successfully');pendingDelete=null}catch(error){toast(error.message)}}
    const save=event.target.closest('.save');if(save&&location.pathname.includes('/settings/')){event.preventDefault();const group=document.body.dataset.page;const values={};document.querySelectorAll('.settings-layout input,.settings-layout select,.settings-layout textarea').forEach((field,index)=>values[field.name||`field_${index}`]=field.type==='checkbox'?field.checked:field.value);document.querySelectorAll('.settings-layout .toggle').forEach((toggle,index)=>values[`toggle_${index}`]=toggle.classList.contains('on'));try{await request(`admin/settings/${group}`,{method:'PATCH',headers:{'Content-Type':'application/json'},body:JSON.stringify(values)});toast('Settings saved successfully')}catch(error){toast(error.message)}}
    if(event.target.closest('.next-step')&&document.querySelector('.wizard')){wizardStep++;if(wizardStep>=4){event.preventDefault();const fields=[...document.querySelectorAll('.wizard .control')];try{const [categories,organizers]=await Promise.all([fetch(prefix+'api/categories').then(r=>r.json()),fetch(prefix+'api/organizers').then(r=>r.json())]);const name=fields[0]?.value?.trim();if(!name)throw new Error('Event name is required');const startDate=fields[11]?.value||new Date().toISOString().slice(0,10),startTime=fields[12]?.value||'19:00';const payload={category_id:categories.data[0].id,organizer_id:organizers.data[0].id,name,slug:name.toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/^-|-$/g,''),description:`${name} event`,event_type:fields[2]?.value||'In-person',subcategory:fields[3]?.value||null,city:fields[5]?.value||'Lagos',country:'Nigeria',venue_name:fields[7]?.value||null,venue_address:fields[9]?.value||null,instagram:fields[10]?.value||null,starts_at:`${startDate} ${startTime}:00`,status:'draft'};await request('admin/events',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});toast('Event saved as draft');setTimeout(()=>location.href='events.html',700)}catch(error){toast(error.message)}}}
  },true);
  document.addEventListener('change',event=>{
    const input=event.target.closest('.logo-drop input[type=file]');if(!input)return;
    const preview=input.parentElement.querySelector('img'),file=input.files[0];
    if(preview.src)URL.revokeObjectURL(preview.src);
    if(file&&file.size>5*1024*1024){toast('Maximum upload size is 5 MB');input.value=''}
    preview.hidden=!input.files[0];input.parentElement.classList.toggle('has-image',!preview.hidden);if(!preview.hidden)preview.src=URL.createObjectURL(input.files[0]);
  });
  document.addEventListener('submit',async event=>{
    const form=event.target.closest('.sponsor-form');if(!form)return;
    event.preventDefault();
    const button=form.querySelector('[type=submit]'),fields=form.elements,name=fields.name.value.trim(),website=fields.website.value.trim();
    if(!name){toast('Sponsor name is required');fields.name.focus();return}
    if(website&&!/^https?:\/\/\S+\.\S+/i.test(website)){toast('Website must start with http:// or https://');fields.website.focus();return}
    button.disabled=true;button.textContent='Saving...';
    try{
      let logo=null;
      if(fields.logo.files[0]){const upload=new FormData();upload.append('file',fields.logo.files[0]);logo=(await request('admin/uploads',{method:'POST',body:upload})).path}
      await request('admin/sponsors',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({name,website:website||null,tagline:fields.tagline.value.trim()||null,logo,sort_order:Number(fields.sort_order.value)||0,status:fields.status.value})});
      toast(`${name} added`);setTimeout(()=>location.reload(),600);
    }catch(error){toast(error.message);button.disabled=false;button.textContent='＋ Add Sponsor'}
  });
})();
