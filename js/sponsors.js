(async()=>{
  const section=document.querySelector('.sponsors');if(!section)return;
  const track=section.querySelector('.sponsors__track'),viewport=section.querySelector('.sponsors__viewport');
  const escape=value=>String(value??'').replace(/[&<>"']/g,char=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[char]));
  let sponsors=[];
  try{const response=await fetch('api/sponsors');if(!response.ok)return;({data:sponsors}=await response.json())}catch(error){return}
  if(!sponsors?.length)return;
  track.innerHTML=sponsors.map(sponsor=>{
    const link=/^https?:\/\//i.test(sponsor.website||''),tag=link?'a':'div';
    const logo=sponsor.logo?`<img src="${escape(sponsor.logo)}" alt="${escape(sponsor.name)}" loading="lazy">`:`<b>${escape(sponsor.name)}</b>`;
    return `<${tag} class="sponsor-card" role="listitem"${link?` href="${escape(sponsor.website)}" target="_blank" rel="noopener sponsored"`:''}><span class="sponsor-card__logo">${logo}</span><span class="sponsor-card__name">${escape(sponsor.name)}</span>${sponsor.tagline?`<small>${escape(sponsor.tagline)}</small>`:''}</${tag}>`;
  }).join('');
  section.hidden=false;

  const reduceMotion=matchMedia('(prefers-reduced-motion: reduce)').matches;
  const stepSize=()=>{const card=track.firstElementChild;return card?card.getBoundingClientRect().width+parseFloat(getComputedStyle(track).columnGap||0):track.clientWidth};
  const atStart=()=>track.scrollLeft<=4,atEnd=()=>track.scrollLeft+track.clientWidth>=track.scrollWidth-4;
  const overflowing=()=>track.scrollWidth>track.clientWidth+4;
  const update=()=>{section.classList.toggle('is-static',!overflowing());viewport.classList.toggle('at-start',atStart());viewport.classList.toggle('at-end',atEnd())};
  const go=direction=>{
    const behavior=reduceMotion?'auto':'smooth';
    if(direction>0&&atEnd())track.scrollTo({left:0,behavior});
    else if(direction<0&&atStart())track.scrollTo({left:track.scrollWidth,behavior});
    else track.scrollBy({left:direction*stepSize(),behavior});
  };

  let timer=null,paused=false;
  const stop=()=>{clearInterval(timer);timer=null};
  const start=()=>{stop();if(!reduceMotion&&!paused&&overflowing())timer=setInterval(()=>{if(!document.hidden)go(1)},3200)};
  section.querySelector('[data-sponsor-prev]').addEventListener('click',()=>{go(-1);start()});
  section.querySelector('[data-sponsor-next]').addEventListener('click',()=>{go(1);start()});
  track.addEventListener('keydown',event=>{if(event.key==='ArrowRight'||event.key==='ArrowLeft'){event.preventDefault();go(event.key==='ArrowRight'?1:-1)}});
  section.addEventListener('pointerenter',()=>{paused=true;stop()});
  section.addEventListener('pointerleave',()=>{paused=false;start()});
  section.addEventListener('focusin',()=>{paused=true;stop()});
  section.addEventListener('focusout',event=>{if(!section.contains(event.relatedTarget)){paused=false;start()}});
  track.addEventListener('touchstart',()=>{paused=true;stop()},{passive:true});
  track.addEventListener('touchend',()=>{paused=false;setTimeout(start,1500)},{passive:true});
  track.addEventListener('scroll',update,{passive:true});
  addEventListener('resize',()=>{update();start()});
  track.querySelectorAll('img').forEach(image=>image.addEventListener('load',update,{once:true}));
  update();start();
})();
