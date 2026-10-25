(async()=>{
  const asset=value=>value?.startsWith('http')?value:value||'assets/images/events/afrobeats-city.jpg';
  const date=value=>new Date(value.replace(' ','T'));
  const loadingTargets=[...document.querySelectorAll('.event-card,.listing-card'),...(document.body.classList.contains('details-page')?[document.querySelector('.detail-main')||document.querySelector('main')]:[])].filter(Boolean);
  loadingTargets.forEach(node=>node.classList.add('public-data-loading'));
  try{
    const response=await fetch('api/events?status=published&limit=24');
    if(!response.ok)return;
    const {data:events}=await response.json();
    if(!events?.length)return;
    document.querySelectorAll('.event-card').forEach((card,index)=>{
      const event=events[index%events.length],when=date(event.starts_at);
      card.href=`event-details.html?event=${encodeURIComponent(event.slug)}`;
      card.querySelector('img')?.setAttribute('src',asset(event.poster));
      const title=card.querySelector('strong');if(title)title.innerHTML=`${event.name}<small>${event.category_name}</small>`;
      const day=card.querySelector('.event-card__meta b');if(day)day.innerHTML=`<i>${when.toLocaleString('en',{month:'short'})}</i>${when.getDate()}`;
      const place=card.querySelector('.event-card__meta span');if(place)place.textContent=`⌖ ${event.city}, ${event.country}`;
    });
    document.querySelectorAll('.listing-card').forEach((card,index)=>{
      const event=events[index%events.length],when=date(event.starts_at);
      card.dataset.city=event.city;card.dataset.category=event.category_name;
      const link=card.querySelector('a');if(link)link.href=`event-details.html?event=${encodeURIComponent(event.slug)}`;
      card.querySelector('img')?.setAttribute('src',asset(event.poster));
      const day=card.querySelector('.listing-meta b');if(day)day.innerHTML=`<span>${when.toLocaleString('en',{month:'short'})}</span>${when.getDate()}`;
      const place=card.querySelector('.listing-meta p');if(place)place.textContent=`⌖ ${event.city}, ${event.country}`;
      const heading=card.querySelector('.listing-card__body h2');if(heading)heading.textContent=event.name;
      const category=card.querySelector('.listing-card__body>p');if(category)category.textContent=event.category_name;
    });
    const slug=new URLSearchParams(location.search).get('event');
    if(slug&&document.body.classList.contains('details-page')){
      const detailResponse=await fetch(`api/events/${encodeURIComponent(slug)}`);if(!detailResponse.ok)return;
      const {data:event}=await detailResponse.json(),when=date(event.starts_at);
      document.title=`${event.name} | Afroverified`;
      const poster=document.querySelector('.detail-poster img');if(poster){poster.src=asset(event.poster);poster.alt=`${event.name} event poster`}
      const heading=document.querySelector('.event-primary h1');if(heading)heading.textContent=event.name;
      document.querySelectorAll('.event-summary,.about-event>p').forEach(paragraph=>paragraph.textContent=event.description);
      const facts=document.querySelectorAll('.event-facts dd'),time=value=>value.toLocaleTimeString('en',{hour:'numeric',minute:'2-digit'});
      if(facts[0])facts[0].textContent=when.toLocaleDateString('en',{weekday:'long',month:'long',day:'numeric',year:'numeric'});
      if(facts[1])facts[1].textContent=event.ends_at?`${time(when)} – ${time(date(event.ends_at))}`:time(when);
      if(facts[2]){facts[2].innerHTML='<strong></strong><small></small>';facts[2].querySelector('strong').textContent=event.venue_name||event.venue_record_name||event.city;facts[2].querySelector('small').textContent=event.venue_address||`${event.city}, ${event.country}`}
      const sponsor=document.querySelector('.event-sponsor');
      if(sponsor&&event.sponsor_name){
        sponsor.querySelector('strong').textContent=event.sponsor_name;
        const logo=sponsor.querySelector('.event-sponsor__logo');
        if(event.sponsor_logo){const image=new Image();image.src=asset(event.sponsor_logo);image.alt='';logo.replaceChildren(image)}else logo.textContent=event.sponsor_name.slice(0,2).toUpperCase();
        if(/^https?:\/\//i.test(event.sponsor_website||'')){sponsor.href=event.sponsor_website;sponsor.target='_blank';sponsor.rel='noopener sponsored'}
        sponsor.hidden=false;
      }
      document.querySelectorAll('[data-calendar]').forEach(button=>button.dataset.eventDate=when.toISOString());
    }
  }catch(error){console.info('Public pages are using bundled sample content.',error)}
  finally{loadingTargets.forEach(node=>node.classList.remove('public-data-loading'))}
})();
