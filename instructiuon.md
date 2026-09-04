folder called design, consist of the figma designs
the folder called pictures of events consist of pictures of events you can use for the page. 
---

# AFROVERIFIED WEBSITE — PIXEL-ACCURATE HTML IMPLEMENTATION SPECIFICATION

## Objective

Build a complete responsive HTML/CSS/JavaScript implementation of the supplied **Afroverified website designs**.

The supplied design images are the **absolute visual source of truth**.

Your job is **NOT to redesign, reinterpret, modernize, simplify, or improve the UI**.

Your job is to reproduce the supplied designs as accurately as technically possible using clean HTML, CSS and minimal JavaScript.

The final website must look extremely close to the supplied designs on both desktop and mobile.

---

## 1. Technology Requirements

Build the frontend using:

* HTML5
* CSS3
* Vanilla JavaScript
* No React
* No Vue
* No Bootstrap
* No Tailwind
* No external UI framework

You may use:

* CSS Grid
* Flexbox
* CSS variables
* CSS media queries
* SVG icons
* Font Awesome or Lucide for icons if necessary

Do not use a screenshot as the webpage itself.

Every element visible in the designs must be recreated as actual HTML/CSS elements.

Text must remain selectable.

Buttons must be actual buttons/links.

Forms must be actual HTML form controls.

Event cards must be actual components made with HTML/CSS.

---

# 2. Required Pages

Create these pages:

```text
index.html
events.html
event-details.html
submit-event.html
whats-the-vibe.html
sweet-and-reckless.html
promote.html
```

Also create the corresponding responsive/mobile layouts through CSS.

Do NOT create separate mobile HTML files unless technically necessary.

---

# 3. Recommended Project Structure

Use this structure:

```text
afroverified/
│
├── index.html
├── events.html
├── event-details.html
├── submit-event.html
├── whats-the-vibe.html
├── sweet-and-reckless.html
├── promote.html
│
├── assets/
│   ├── images/
│   │   ├── logo-dark.png
│   │   ├── logo-light.png
│   │   ├── hero/
│   │   ├── events/
│   │   ├── vibe/
│   │   ├── sweet-reckless/
│   │   └── promotion/
│   │
│   └── icons/
│
├── css/
│   ├── variables.css
│   ├── global.css
│   ├── components.css
│   ├── responsive.css
│   └── pages/
│       ├── home.css
│       ├── events.css
│       ├── event-details.css
│       ├── submit-event.css
│       ├── vibe.css
│       ├── sweet-reckless.css
│       └── promote.css
│
└── js/
    ├── main.js
    ├── events.js
    └── submit-event.js
```

---

# 4. Design Fidelity Rule

This is the most important instruction.

**FOLLOW THE SUPPLIED DESIGN IMAGES TO THE LETTER.**

Do not:

* invent new sections
* remove sections
* change the color palette
* change card proportions
* change navigation structure
* change CTA placement
* change heading hierarchy
* replace black sections with grey
* introduce gradients unless visible in the design
* introduce animations that are not necessary
* use rounded pills everywhere
* alter spacing because another design looks "better"
* create a generic event website
* substitute a different logo
* change typography simply for convenience

If a design decision is unclear, choose the solution that visually resembles the supplied screenshot most closely.

---

# 5. Core Brand Colors

Create CSS variables.

```css
:root {
    --av-red: #E82210;
    --av-red-dark: #C9180A;

    --av-black: #000000;
    --av-charcoal: #111111;
    --av-dark: #202020;

    --av-white: #FFFFFF;

    --av-gray-50: #F7F7F7;
    --av-gray-100: #EEEEEE;
    --av-gray-200: #DDDDDD;
    --av-gray-400: #999999;
    --av-gray-600: #525252;

    --av-border-dark: #333333;
}
```

The main visual identity should remain:

**Black + White + Afroverified Red**

Red should be used primarily for:

* CTAs
* active navigation
* headings/accent text
* dates
* icons
* important UI states

Do not overuse red.

---

# 6. Typography

Use a clean modern sans-serif typeface.

Preferred:

```text
Poppins
```

Use Google Fonts if necessary.

Recommended weights:

```text
400 Regular
500 Medium
600 SemiBold
700 Bold
800 ExtraBold
```

Major headings should have strong weight similar to the supplied designs.

Examples:

```text
FIND YOUR NEXT MOVE.
EVENTS
WHAT'S THE VIBE?
PROMOTE WITH AFROVERIFIED
REACH THE CULTURE.
GROW YOUR BRAND.
```

Do not use thin typography for major headlines.

---

# 7. Header / Navigation

Create one reusable header style used throughout the website.

Desktop structure:

```text
[AFROVERIFIED LOGO]

Events
What's The Vibe
Sweet & Reckless
Promote With Us

[SUBMIT EVENT]

[Menu icon if shown]
```

Dark pages should use:

```text
black background
white logo version
white navigation
red active navigation
```

Light pages can use the correct logo variant.

The supplied Afroverified logos must be used.

Do not redraw or approximate the logo with text.

---

# 8. Mobile Header

At mobile widths:

```text
[AFROVERIFIED LOGO]       [SUBMIT EVENT] [☰]
```

Where there is insufficient width:

```text
[AFROVERIFIED LOGO]                [☰]
```

Clicking the hamburger should open a proper mobile menu containing:

```text
Events
What's The Vibe
Sweet & Reckless
Promote With Us
Submit Event
```

---

# 9. Home Page

Reproduce the supplied Home design.

## Hero

Large black hero section.

Left side:

```text
FIND YOUR
NEXT MOVE.
```

Description:

```text
Discover Afrobeats, Amapiano, Caribbean,
African, and cultural event experiences
around you.
```

Buttons:

```text
EXPLORE EVENTS
SUBMIT YOUR EVENT
```

Right side:

Use the supplied event/concert hero image.

The image should visually blend into the black background using appropriate positioning/overlay.

Do not turn it into a plain rectangular stock image.

---

## Events Happening This Week

White background.

Heading:

```text
EVENTS HAPPENING THIS WEEK
```

Right:

```text
View all events →
```

Display event posters/cards.

Example events:

```text
Afrobeats In The City
Day Party Vibes
Amapiano Night
Soca Reggae
```

Cards should use the event artwork prominently.

The poster itself is the dominant part of each event card.

---

## What's The Vibe Home Feature

White/light card.

Heading:

```text
WHAT'S THE VIBE?
```

Supporting text.

CTA:

```text
VIEW THIS WEEK'S VIBE
```

Use relevant imagery.

---

## Sweet & Reckless Feature

Dark card.

Text:

```text
SWEET & RECKLESS

The tour.
The vibe.
The movement.
```

CTA:

```text
VIEW NEXT STOP
```

Use the appropriate Sweet & Reckless event image.

---

## Bottom promotional section

Two blocks:

```text
ARE YOU AN EVENT ORGANIZER?
```

and

```text
PROMOTE WITH AFROVERIFIED
```

Then newsletter:

```text
STAY IN THE LOOP
```

Email input and signup button.

---

# 10. Events / Calendar Page

Follow the supplied Events design.

Dark page.

Page heading:

```text
EVENTS
```

Subtitle:

```text
Find events by date, city or category.
```

Filters:

```text
DATE
This Weekend

CITY
All Cities

CATEGORY
All Categories
```

Reset control.

Navigation filters:

```text
ALL EVENTS
TODAY
THIS WEEKEND
NEXT 7 DAYS
```

---

## Event grid

Desktop:

Approximately four cards per row depending on viewport.

Event cards include:

* poster
* date
* city
* event name/category
* genre
* tags where applicable

Use supplied/generated poster images.

Do NOT leave poster cards as colored boxes.

---

## Right Sidebar

Desktop should contain:

```text
THIS WEEK
```

With compact event rows.

At the bottom:

```text
SUBMIT EVENT
```

Mobile should reposition this content appropriately rather than maintaining a narrow desktop sidebar.

---

# 11. Event Details Page

Dark background.

Layout should closely match the supplied design.

Desktop:

```text
poster | primary information | secondary information
```

Poster should be large.

Example:

```text
AFROBEATS IN THE CITY
```

Display:

```text
Saturday, May 24, 2025
10:00 PM – 3:00 AM

Rebel
11 Polson St, Toronto, ON
```

Primary CTA:

```text
GET TICKETS
```

Secondary:

```text
ADD TO CALENDAR
SHARE EVENT
```

---

## About section

Include:

```text
ABOUT THIS EVENT
```

Then:

```text
Presented by
Age Restriction
Instagram
Website
```

Tags:

```text
Afrobeats
Nightlife
```

---

## Related Events

Heading:

```text
OTHER EVENTS YOU MIGHT LIKE
```

Display horizontally arranged event cards.

---

# 12. Submit Event Page

This page should primarily use a light background.

Dark global header remains.

Main heading:

```text
SUBMIT YOUR EVENT
```

Description:

```text
Share your event for consideration in the
Afroverified Event Calendar and What's The Vibe.
```

---

## Multi-step indicator

Display:

```text
1 Event Info
2 Details
3 Additional
4 Review
```

Active step should be Afroverified red.

---

## Form

Use real form controls.

Fields include:

```text
Event Name
Event Type
Organizer / Company
Location
Contact Name
Venue Name
Email
Event Date
Instagram Handle
Event Time
```

Next button:

```text
NEXT STEP →
```

Implement basic JavaScript so steps can actually change.

No backend submission is required yet.

---

## Submission Sidebar

Dark sidebar/cards showing:

```text
SUBMIT YOUR EVENT

OUR REVIEW PROCESS

Event Review
Notification
Live on Afroverified

NEED HELP?
```

---

# 13. What's The Vibe Page

Dark page.

Heading:

```text
WHAT'S THE VIBE?
```

Description:

```text
Your weekly guide to the best events near you.
```

Tabs:

```text
THIS WEEK
PAST LINEUPS
```

---

## Weekly feature

Large visual area.

Use:

```text
WHAT'S
THE VIBE

MAY 20 – MAY 26
TORONTO
```

Adjacent event list:

```text
MAY 20
Afrobeats In The City
Rebel, Toronto, ON

MAY 22
Day Party Vibes
Brampton, ON

MAY 24
Amapiano Night
Montreal, QC

MAY 25
Soca on the Rooftop
Ottawa, ON

MAY 26
Wild Thoughts
Mississauga, ON
```

Main CTA:

```text
VIEW ALL EVENTS
```

Desktop sidebar can include:

```text
ABOUT WHAT'S THE VIBE?
FEATURED EVENT
STAY IN THE LOOP
```

---

# 14. Sweet & Reckless Page

This page must feel distinct while remaining within Afroverified.

Black background.

Use dramatic monochrome/nightlife imagery.

Large styled heading:

```text
Sweet &
Reckless
```

Supporting line:

```text
The tour. The vibe. The movement.
```

CTA:

```text
VIEW NEXT STOP
```

---

## Next Stop

Example:

```text
Toronto

Friday, June 6, 2025

Rebel
11 Polson St, Toronto

Doors 10:00 PM
```

CTA:

```text
GET TICKETS
```

---

## Tour Dates

List:

```text
JUN 06
TORONTO, ON
Rebel

JUN 20
MONTREAL, QC
New City Gas

JUN 20
OTTAWA, ON
Luxe

JUN 27
CALGARY, AB
The Palace
```

CTA:

```text
VIEW ALL DATES
```

---

# 15. Promote With Afroverified Page

Follow the supplied dark promotional design.

Hero:

```text
PROMOTE WITH AFROVERIFIED

REACH THE CULTURE.
GROW YOUR BRAND.
```

Supporting copy.

Use a red-lit concert/crowd image.

CTA:

```text
VIEW PARTNERSHIP PACKAGES
```

or according to the supplied design:

```text
OUR SERVICES
GET IN TOUCH
```

Do not invent content if the reference shows different wording.

The visual reference takes precedence.

---

## Benefit icons

Use sections such as:

```text
ENGAGED AUDIENCE
TARGETED PROMOTION
BRAND GROWTH
TRUSTED PLATFORM
```

Use red line-style icons.

---

## Partnership Packages

Where shown in the supplied page, implement:

### Basic

```text
$199 / month
```

### Growth

```text
$499 / month
```

Mark:

```text
POPULAR
```

### Premium

```text
$999 / month
```

Each should have the benefits visible in the reference design.

---

## Final CTA

```text
LET'S WORK TOGETHER
```

Button:

```text
CONTACT OUR TEAM
```

---

# 16. Responsive Behaviour

This website must be genuinely responsive.

Do NOT just shrink the desktop layout.

Suggested breakpoints:

```css
@media (max-width: 1200px) {}

@media (max-width: 992px) {}

@media (max-width: 768px) {}

@media (max-width: 480px) {}
```

Primary mobile target:

```text
390px width
```

Desktop target:

```text
1440px – 1536px width
```

---

# 17. Mobile Requirements

On mobile:

* hide desktop navigation
* use hamburger navigation
* change multi-column layouts to one column
* event cards remain visually dominant
* filters stack vertically
* desktop sidebars move underneath primary content
* buttons should be finger-friendly
* text must not overflow
* images should use `object-fit: cover`
* avoid horizontal scrolling
* forms become single-column
* spacing should match the mobile reference

Do not simply use:

```css
transform: scale();
```

to shrink the desktop site.

Build proper responsive CSS.

---

# 18. Image Handling

All supplied imagery should be stored in:

```text
assets/images/
```

Use meaningful filenames such as:

```text
hero-concert.jpg
afrobeats-city.jpg
day-party-vibes.jpg
amapiano-night.jpg
soca-reggae.jpg
afro-fusion.jpg
wild-thoughts.jpg
one-africa-fest.jpg
sweet-reckless-hero.jpg
promotion-crowd.jpg
```

Use:

```css
object-fit: cover;
object-position: center;
```

where appropriate.

Never stretch images.

---

# 19. Logo Usage

Two logos are supplied.

Use:

```text
logo-dark.png
```

for black/dark backgrounds.

Use:

```text
logo-light.png
```

for white/light backgrounds.

Maintain the original logo aspect ratio.

Do not recreate the logo using HTML text.

Do not modify its colors.

---

# 20. Shared Components

Although this is plain HTML, styles should be reusable.

Create common classes for:

```text
.header
.mobile-menu
.container
.section-title
.primary-button
.secondary-button
.event-card
.event-poster
.event-meta
.event-tag
.filter-control
.form-control
.sidebar-card
.footer
```

Avoid duplicating 500 lines of identical CSS across every page.

---

# 21. JavaScript Interactions

Implement only lightweight interactions.

Required:

* mobile navigation open/close
* event filter dropdown visual behaviour
* What's The Vibe tabs
* Submit Event multi-step wizard
* optional event-card navigation
* optional calendar interaction
* optional horizontal event sliders

Do NOT add unnecessary animations.

---

# 22. Accessibility

Use:

```html
<header>
<nav>
<main>
<section>
<article>
<footer>
```

Include:

```text
alt attributes
form labels
button semantics
aria-label where necessary
keyboard accessible navigation
```

Maintain sufficient color contrast.

---

# 23. Visual Comparison Requirement

After implementing each page:

1. Run the website locally.
2. Open it at the target viewport.
3. Capture a screenshot.
4. Compare the screenshot against the supplied design.
5. Adjust:

   * spacing
   * typography
   * image positioning
   * widths
   * card heights
   * margins
   * padding
   * border radius
   * button dimensions
   * section heights
6. Repeat until visually close.

If Playwright is available, use it to generate screenshots automatically.

Example:

```text
Desktop: 1440 × 1200+
Mobile: 390 × 844+
```

Do not consider a page complete after only creating the HTML.

It must be visually verified.

---

# 24. Critical Implementation Rule

Do **NOT** attempt to create all seven pages at once without reviewing the results.

Work in this order:

```text
Phase 1
Home Desktop
Home Mobile

Phase 2
Events Desktop
Events Mobile

Phase 3
Event Details Desktop
Event Details Mobile

Phase 4
Submit Event Desktop
Submit Event Mobile

Phase 5
What's The Vibe Desktop
What's The Vibe Mobile

Phase 6
Sweet & Reckless Desktop
Sweet & Reckless Mobile

Phase 7
Promote Desktop
Promote Mobile
```

After each phase:

```text
Run page
Check console
Capture screenshot
Compare to reference
Fix differences
Then continue
```

---

# 25. Things Codex Must NOT Do

This section is mandatory.

Do not:

```text
❌ redesign the UI
❌ replace imagery with generic placeholders
❌ change Afroverified red
❌ use random stock images
❌ remove sections
❌ combine pages
❌ generate a dashboard
❌ build organizer accounts
❌ implement payment processing
❌ create ticket scanning
❌ introduce a different navigation
❌ turn the supplied designs into generic Bootstrap layouts
❌ use screenshots as background images for the entire page
❌ make mobile just a scaled desktop version
❌ replace the Afroverified logo with text
```

---

# 26. Definition of Done

The project is finished only when:

* all seven pages exist
* all pages work without console errors
* all internal links work
* desktop layout closely matches supplied desktop references
* mobile layouts work properly
* correct Afroverified logo is used
* supplied event imagery is used
* no placeholder blocks remain
* forms are properly styled
* buttons and navigation work
* no horizontal overflow exists
* page structure is semantic
* CSS is organized
* JavaScript is minimal and maintainable
* layouts visually match the supplied reference designs

---

## Final instruction to Codex

**The images I provide are not inspiration. They are the specification. Reproduce them as faithfully as possible. Do not make independent design decisions unless required to translate the same layout responsively. If the implementation and the supplied screenshot look noticeably different when viewed side-by-side, continue refining it before declaring the page complete.**

---

One additional thing I would do: give Codex **one page image at a time**, starting with the Home page, rather than dumping everything into the first prompt. Once Home is pixel-accurate, tell it to preserve the exact same header, colors, typography, spacing system, buttons, card styling and breakpoints when moving to the other pages. That will give you a much more consistent final website.
