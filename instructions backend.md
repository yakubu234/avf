Yes. I used the same strict approach as the customer-facing specification you shared: the supplied design images remain the **absolute visual source of truth**, Codex must not redesign them, and every visible UI element must be rebuilt as real HTML/CSS rather than using the screenshots themselves. 

Below is the admin-side specification you can give directly to Codex.

---

# AFROVERIFIED ADMIN PORTAL — PIXEL-ACCURATE HTML IMPLEMENTATION SPECIFICATION

## Objective

Build the complete **Afroverified Admin Portal** from the supplied admin design screenshots.

The screenshots inside the admin design folder are the **absolute visual specification**.

Your job is **NOT** to redesign the admin portal, simplify it, modernize it, reinterpret it, or replace sections with generic dashboard components.

Your job is to reproduce the supplied designs as accurately as technically possible.

Every screen should look extremely close to its supplied reference when compared side-by-side.

The same rule used for the public Afroverified website applies here: screenshots are the specification, not merely inspiration. 

---

# 1. Technology Requirements

For the static admin implementation, use:

```text
HTML5
CSS3
Vanilla JavaScript
```

Do not use:

```text
React
Vue
Bootstrap
Tailwind
Material UI
AdminLTE
Pre-built dashboard templates
```

You may use:

```text
CSS Grid
Flexbox
CSS Variables
CSS Media Queries
SVG
Lucide Icons
Font Awesome
Chart.js for charts
```

Do not use a screenshot as a background for an entire page.

Every visible interface element must be recreated using real HTML/CSS.

Tables must be real HTML tables or semantic grid structures.

Forms must be real form controls.

Dropdowns must behave like controls.

Buttons must be real buttons.

Tabs must work.

Side navigation links must work.

Modals and confirmation dialogs should be functional where appropriate.

Charts must be actual charts, not screenshots.

---

# 2. Admin Portal Pages to Implement

Build the following admin screens based on the designs provided.

```text
admin/
│
├── dashboard.html
│
├── events.html
│
├── event-details.html
│
├── add-event.html
│
├── event-categories.html
│
├── event-venues.html
│
├── event-submissions.html
│
├── whats-the-vibe.html
│
├── promotions.html
│
├── organizers.html
│
├── users.html
│
├── reports.html
│
└── settings/
    ├── communication.html
    ├── email.html
    ├── sms.html
    ├── templates.html
    ├── signatures.html
    └── notifications.html
```

These are separate screens.

Do not combine Categories, Venues and Event Submissions into one page.

Do not combine the different Settings screens into one giant page.

The navigation may load them as separate HTML files while preserving the appearance of tabs/subnavigation.

---

# 3. Recommended Project Structure

Use an organized structure such as:

```text
afroverified/
│
├── admin/
│   ├── dashboard.html
│   ├── events.html
│   ├── event-details.html
│   ├── add-event.html
│   ├── event-categories.html
│   ├── event-venues.html
│   ├── event-submissions.html
│   ├── whats-the-vibe.html
│   ├── promotions.html
│   ├── organizers.html
│   ├── users.html
│   ├── reports.html
│   │
│   └── settings/
│       ├── communication.html
│       ├── email.html
│       ├── sms.html
│       ├── templates.html
│       ├── signatures.html
│       └── notifications.html
│
├── assets/
│   ├── images/
│   │   ├── logo-dark.png
│   │   ├── logo-light.png
│   │   ├── events/
│   │   ├── venues/
│   │   ├── avatars/
│   │   └── promotions/
│   │
│   └── icons/
│
├── css/
│   ├── admin-variables.css
│   ├── admin-global.css
│   ├── admin-layout.css
│   ├── admin-components.css
│   ├── admin-responsive.css
│   │
│   └── admin-pages/
│       ├── dashboard.css
│       ├── events.css
│       ├── event-details.css
│       ├── event-form.css
│       ├── categories.css
│       ├── venues.css
│       ├── submissions.css
│       ├── vibe.css
│       ├── promotions.css
│       ├── organizers.css
│       ├── users.css
│       ├── reports.css
│       └── settings.css
│
└── js/
    ├── admin.js
    ├── sidebar.js
    ├── tables.js
    ├── filters.js
    ├── charts.js
    ├── event-form.js
    ├── submissions.js
    ├── vibe.js
    └── settings.js
```

Do not duplicate the same sidebar/header CSS inside every page.

---

# 4. Absolute Design Fidelity Rule

This is the most important instruction.

**FOLLOW EACH ADMIN SCREENSHOT TO THE LETTER.**

Do not:

```text
❌ change the sidebar
❌ replace the sidebar with a top navigation
❌ alter card proportions
❌ redesign tables
❌ move the right detail panels elsewhere
❌ change button placement
❌ alter tab structures
❌ invent additional metrics
❌ remove metrics shown in the reference
❌ replace red accents with another color
❌ introduce gradients not shown
❌ turn everything into pill-shaped controls
❌ replace tables with cards on desktop
❌ use a generic admin dashboard template
❌ change typography for convenience
❌ add large animations
❌ add excessive shadows
❌ simplify the information architecture
```

If a screenshot shows a three-column structure, reproduce a three-column structure.

If it shows a right-side details panel, reproduce that panel.

If it shows four statistic cards, use four cards.

If a design decision is unclear, choose the option visually closest to the supplied reference.

---

# 5. Core Admin Design System

Use CSS variables.

```css
:root {
    --av-red: #E82210;
    --av-red-dark: #C9180A;

    --av-black: #000000;
    --av-sidebar: #050505;
    --av-charcoal: #111111;

    --av-white: #FFFFFF;
    --av-page-bg: #F7F8FA;

    --av-gray-50: #F8F9FB;
    --av-gray-100: #F1F3F6;
    --av-gray-200: #E5E7EB;
    --av-gray-300: #D1D5DB;
    --av-gray-400: #9CA3AF;
    --av-gray-500: #6B7280;
    --av-gray-700: #374151;
    --av-gray-900: #111827;

    --av-green: #12B76A;
    --av-green-bg: #E8F8EF;

    --av-orange: #F59E0B;
    --av-orange-bg: #FFF4D8;

    --av-blue: #2684FF;
    --av-blue-bg: #EAF3FF;

    --av-purple: #7C3AED;
    --av-purple-bg: #F1EAFE;

    --av-danger: #E82210;
    --av-danger-bg: #FEECEC;

    --av-border: #E6E8EC;

    --sidebar-width: 224px;
    --header-height: 60px;

    --radius-sm: 6px;
    --radius-md: 10px;
    --radius-lg: 14px;
}
```

Afroverified's primary admin identity remains:

```text
Black
White
Light neutral backgrounds
Afroverified Red
```

Status colors may additionally use:

```text
Green = active / approved / published
Orange = pending / scheduled
Red = rejected / destructive
Gray = draft / inactive
Blue/Purple = categories or supporting states
```

Do not allow category colors to overpower Afroverified red.

---

# 6. Typography

Use:

```text
Poppins
```

Recommended weights:

```text
400 Regular
500 Medium
600 SemiBold
700 Bold
800 ExtraBold
```

Admin headings should be strong and compact.

Examples:

```text
Dashboard
Events Management
Event Details
Add New Event
Event Categories
Event Venues
Event Submissions
What's The Vibe Management
Promotions & Partnerships
Organizers
User Management
Reports & Analytics
Settings
```

Body/interface text should remain readable and relatively compact.

This is an admin application, not a marketing landing page.

---

# 7. Global Admin Layout

Every admin page should use the same base shell.

Desktop:

```text
┌──────────────┬─────────────────────────────────────────────┐
│              │ Top Header                                  │
│              ├─────────────────────────────────────────────┤
│  SIDEBAR     │                                             │
│              │ Main Content                                │
│              │                                             │
│              │                                             │
└──────────────┴─────────────────────────────────────────────┘
```

The sidebar should remain persistent on desktop.

Main background:

```text
very light gray / white
```

Cards:

```text
white
thin gray border
small/subtle shadow
rounded corners
```

---

# 8. Global Admin Sidebar

The sidebar design must stay consistent across every admin screen.

Top:

```text
AFROVERIFIED LOGO
```

Main navigation:

```text
Dashboard
Events
What's The Vibe
Sweet & Reckless
Promotions
Organizers
Users
Reports
Settings
```

Bottom:

```text
← Back to Website

[AY]
Abiola Yakubu
Administrator
⋮
```

Active section uses Afroverified red.

Example:

```text
background: #E82210;
color: #FFFFFF;
```

Inactive items remain dark with white/light text.

Icons should closely resemble those in the design.

---

# 9. Events Sidebar Expansion

When Events is active, support expanded child navigation:

```text
Events
   All Events
   Add New Event
   Categories
   Venues
   Event Submissions
```

Only the relevant child item should receive the selected treatment.

For example on Categories:

```text
Events = red parent
Categories = active child
```

Do not redesign this as horizontal navigation.

---

# 10. Global Top Header

Header structure:

```text
[☰]  [ Search events, organizers, users... ]

                                [Notification Bell]

                                [AY]
                                Abiola Yakubu
                                Administrator
                                [⌄]
```

The header remains white/light.

Include a subtle bottom border.

Search should be styled like the screenshots.

Do not make it excessively tall.

---

# 11. Shared Admin Components

Create reusable components/classes for:

```text
.admin-shell
.admin-sidebar
.admin-header
.admin-main

.page-header
.page-title
.page-subtitle

.stat-grid
.stat-card
.stat-icon
.stat-value
.stat-label
.stat-trend

.filter-bar
.filter-control

.data-card
.data-table
.table-status
.table-actions

.tabs
.tab
.tab-active

.detail-panel
.detail-card

.primary-btn
.secondary-btn
.danger-btn
.success-btn

.status-active
.status-pending
.status-published
.status-rejected
.status-draft
.status-inactive

.quick-actions
.help-card
.pagination
```

Do not manually restyle these from scratch on every page.

---

# 12. Dashboard Page

Implement the supplied Dashboard design.

Heading:

```text
Welcome back, Abiola!
Here's what's happening on Afroverified.
```

Date selector:

```text
Aug 1, 2026 – Aug 31, 2026
```

Top metrics:

```text
128 Total Events
54 Organizers
12,480 Total Users
86,320 Event Views
```

Show trend indicators exactly as visually represented.

---

## Dashboard Event Views Chart

Create a functional line chart.

Heading:

```text
Event Views
```

Use Chart.js or equivalent.

The chart should resemble the reference:

```text
red line
light red area fill
light grid lines
clean axes
tooltip
```

Do not use an image for the chart.

---

## Events By Category

Create a real doughnut chart.

Example categories:

```text
Afrobeats
Amapiano
Soca / Reggae
Hip Hop
Other
```

Center:

```text
128
Events
```

---

## Dashboard Right Column

Include:

```text
Quick Actions
Pending Submissions
Recent Activity
```

Quick Actions include:

```text
Add New Event
Manage Events
View Pending Submissions
Create Promotion
```

---

## Recent Events

Table columns should resemble:

```text
#
Event Name
Date
Location
Category
Status
Views
Actions
```

---

# 13. Events — All Events Page

Page title:

```text
Events
```

or according to the supplied implementation:

```text
Events Management
```

Use the title visible in the specific reference screenshot being implemented.

Top metrics include:

```text
Total Events
Published
Upcoming / Pending
Drafts / Rejected
```

Use the exact values and wording shown in the selected screenshot.

---

## Event Filters

Include:

```text
Search
Category
Status
Location
Date Range
Reset
Apply
```

---

## Events Tabs

Where visible:

```text
All Events
Published
Pending
Rejected
Drafts
```

or:

```text
All Events
Categories
Venues
Event Submissions
```

Use whichever tab system belongs to that specific reference.

Do not merge separate designs arbitrarily.

---

## Events Table

Use columns similar to:

```text
Checkbox
#
Event
Organizer
Date & Time
Location
Category
Status
Views / Attendees
Actions
```

Use event thumbnails.

Use actual status badges.

Actions menu should use:

```text
⋮
```

and can expose:

```text
View
Edit
Duplicate
Change Status
Delete
```

where appropriate.

---

# 14. Event Details Admin Page

Implement the supplied Event Details screen.

Header controls:

```text
Back to Events

Event Details

Published

View Event
Edit Event
More Actions
```

Main area includes:

```text
Event poster
Event name
Tags
Description
Date and time
Venue
Organizer
Instagram
Website
Age Restriction
```

Example:

```text
Afrobeats In The City
```

---

## Event Performance

Right-side metrics:

```text
Total Views
Clicks (Tickets)
Shares
Avg. Rating
```

---

## Event Status

Include:

```text
Published
Submitted On
Last Updated
Published On
Event ID
```

---

## Event Detail Tabs

Use:

```text
Event Overview
Media
Tickets & Links
Attendees
Reviews
Activity Log
```

Active tab red.

---

## Quick Actions

Use:

```text
Duplicate Event
Feature This Event
Remove Event
```

Destructive action styled red.

---

# 15. Add New Event Page

Use the supplied multi-step form.

Title:

```text
Add New Event
```

Description:

```text
Submit event details to be reviewed and published on Afroverified.
```

Steps:

```text
1 Event Info
2 Details
3 Media & Links
4 Review
```

Active step Afroverified red.

---

## Event Information Fields

Include real controls:

```text
Event Name
Category
Event Type
Subcategory
Organizer / Company
Location / City
Contact Name
Venue Name
Email Address
Venue Address
Instagram Handle
Event Date
Event Time
```

Buttons:

```text
Save as Draft
Next Step →
```

Implement the multi-step functionality using JavaScript.

Do not make the steps decorative only.

---

## Add Event Right Sidebar

Include:

```text
Submit Your Event
Our Review Process
Need Help?
Tips for a Successful Submission
```

---

# 16. Event Categories Page

This page is separate.

Title:

```text
Event Categories
```

Description:

```text
Organize your events with categories to make them easy to find.
```

Top summary:

```text
Total Categories
Active Categories
Inactive Categories
```

Example values from the supplied design:

```text
12
8
2
```

---

## Category Filters

Include:

```text
Search categories by name or description
Status
Sort By
Reset
Apply
```

---

## Category Table

Columns:

```text
Checkbox
#
Category Name
Description
Events
Status
Date Created
Actions
```

Example categories:

```text
Music
Nightlife
Cultural
Food & Drink
Business
Sports
Arts & Theatre
Party
Education
Other
```

---

## Category Details Panel

When a category is selected, show the right-side detail panel.

Example:

```text
Music
Active

Concerts, live music, DJ nights and all music related events.
```

Details:

```text
Events in this category
Date Created
Last Updated
Created By
```

Quick Actions:

```text
View Events
Edit Category
Deactivate Category
Delete Category
```

Include:

```text
Help & Tips
```

The right-side detail panel is essential.

Do not remove it.

---

# 17. Event Venues Page

Separate page.

Title:

```text
Event Venues
```

Description:

```text
Add and manage venues where events take place.
```

Metrics:

```text
24 Total Venues
20 Active Venues
4 Inactive Venues
12 Cities
```

---

## Venue Filters

Include:

```text
Search venues by name, address or city
City
Status
Sort By
Reset
Apply
```

---

## Venue Table

Columns:

```text
Checkbox
#
Venue Name
Location
City
Capacity
Status
Date Added
Actions
```

Example venues:

```text
Eko Convention Centre
The Arena
Freedom Park
Transcorp Hilton
Muri Okunola Park
Landmark Centre
Expo Centre
The New Afrika Shrine
National Theatre
Muson Centre
```

---

## Venue Details Panel

Example:

```text
Eko Convention Centre
Lagos, Nigeria
Indoor & Outdoor Venue
Active
```

Show:

```text
Address
City
Capacity
Date Added
Last Updated
Created By
```

Quick Actions:

```text
View Events
Edit Venue
Deactivate Venue
Delete Venue
```

Help section included.

---

# 18. Event Submissions Page

Separate page.

Title:

```text
Event Submissions
```

Description:

```text
Review and manage events submitted by organizers.
```

Metrics:

```text
18 Total Submissions
6 Pending Review
10 Approved
2 Rejected
```

Tabs:

```text
All Submissions
Pending Review
Approved
Rejected
```

---

## Submission Filters

Include:

```text
Search
Category
Status
Date Range
Reset
Apply
Export
```

---

## Submission Table

Columns:

```text
Checkbox
#
Event Name
Organizer
Category
Submitted On
Status
Actions
```

Statuses:

```text
Pending Review
Approved
Rejected
```

---

## Submission Details Right Panel

The selected event should populate this panel.

Example:

```text
Afro Fusion Night
Pending Review
```

Show:

```text
Organizer
Email
Phone
Category
Submitted On
Description
```

Event Details:

```text
Date & Time
Venue
City
Expected Attendees
Event Type
Ticketing
```

Attachments:

```text
event-poster.jpg
venue-layout.pdf
artist-lineup.pdf
```

Admin Notes textarea.

Buttons:

```text
Approve
Reject
Save Note
```

Approval and rejection should trigger confirmation UI.

Do not instantly remove rows without confirmation.

---

# 19. What's The Vibe Management

Title:

```text
What's The Vibe Management
```

Description:

```text
Create and manage weekly lineups, past editions and featured events.
```

Metrics:

```text
Total Editions
Active Edition
Scheduled
Past Editions
```

Tabs:

```text
Current Edition
Past Editions
Drafts
```

---

## Current Edition

Show:

```text
This Week's Lineup
May 20 – May 26, 2026
```

Controls:

```text
Previous Week
Next Week
Change Week
```

---

## Lineup Table

Include:

```text
drag handle
#
Event
Date
Location
Status
Actions
```

The drag handle should function if practical.

Allow order changes.

Controls:

```text
Edit
Delete
More
```

Bottom:

```text
+ Add Event to Lineup
```

---

## Edition Preview

Right-side card should visually display:

```text
WHAT'S THE VIBE
MAY 20 – MAY 26, 2026
TORONTO
```

Button:

```text
View on Website
```

Settings:

```text
Status
Title
Location
Banner Image
Change Image
```

---

# 20. Promotions & Partnerships

Title:

```text
Promotions & Partnerships
```

Description:

```text
Manage promotional packages, active campaigns and brand partnerships.
```

Metrics:

```text
Total Promotions
Active Campaigns
Scheduled
Completed
```

Tabs:

```text
All Promotions
Active
Scheduled
Completed
```

---

## Promotion Table

Columns:

```text
Checkbox
#
Promotion
Type
Partner / Organizer
Start Date
End Date
Status
Actions
```

Types can include:

```text
Event Promotion
Brand Partnership
Featured Listing
Social Media
Ad Campaign
```

---

## Promotion Details Panel

Example:

```text
Sweet & Reckless Tour
Active
```

Show:

```text
Campaign artwork
Promotion type
Dates
Organizer
Location
Website
Description
```

Controls:

```text
Edit Promotion
View Performance
```

Quick Stats:

```text
Impressions
Clicks
Conversions
CTR
```

Related actions:

```text
Duplicate
End Campaign
```

---

# 21. Organizers Page

Title:

```text
Organizers
```

Description:

```text
Manage event organizers, view their details and track their events.
```

Metrics:

```text
Total Organizers
Active Organizers
Pending Approval
Suspended
```

---

## Organizer Table

Columns:

```text
Checkbox
#
Organizer
Contact
Location
Events
Status
Joined
Actions
```

---

## Organizer Details Panel

Example:

```text
DJ Kulture
DJ Kulture Events
Active
```

Contact information:

```text
Email
Phone
Location
Instagram
Website
```

Stats:

```text
Total Events
Published
Pending
Rejected
```

Also show:

```text
Recent Events
Notes
Add Note
```

---

# 22. Users Management

Title:

```text
User Management
```

or:

```text
Users Management
```

Use the exact title from the chosen reference.

Metrics:

```text
Total Users
Administrators
Organizers
Other Roles
```

Tabs:

```text
All Users
Administrators
Organizers
Other Roles
```

Filters:

```text
Search
Role
Status
Location
Reset
Apply
```

---

## User Table

Columns:

```text
Checkbox
#
Name
Email
Role
Location
Status
Last Active
Actions
```

Roles can include:

```text
Administrator
Organizer
Event Manager
Marketing
Support
Content Creator
Finance
```

---

## User Details Panel

Show:

```text
Avatar initials
Name
Role
Email
Status
```

Additional:

```text
Location
Phone
Date Joined
Last Active
```

Roles & Permissions:

```text
Manage all events
Manage users
Access reports
Platform settings
Manage promotions
```

Recent Activity timeline.

Controls:

```text
Edit
Deactivate User
```

---

# 23. Reports & Analytics

Title:

```text
Reports & Analytics
```

Description:

```text
Get insights into your events, audience, sales and platform performance.
```

Date range control.

Button:

```text
Export Report
```

Metrics:

```text
Total Attendees
Tickets Sold
Total Revenue
Total Events
```

---

## Report Tabs

Use:

```text
Overview
Events
Sales
Attendees
Organizers
Locations
Marketing
```

---

## Charts

Create actual charts for:

```text
Event Attendance Trend
Ticket Sales by Event Type
```

Do not recreate chart screenshots as images.

---

## Report Tables / Cards

Include:

```text
Top Performing Events
Attendees by Location
Sales Summary
Recent Activity
```

Filters in the right column:

```text
Date Range
Event Type
Location
Organizer
Apply Filters
```

Use Nigerian currency where the design shows it:

```text
₦28,450,900
₦226.80
```

---

# 24. Settings Global Structure

Settings header:

```text
Settings
Manage your platform preferences, communication rules and system configurations.
```

Top tabs:

```text
General
Communication
Event Settings
Users & Permissions
Integrations
Billing
Security
System
```

For the currently designed screens:

```text
Communication
```

is active.

---

## Communication Subnavigation

Left internal settings menu:

```text
Communication Settings
Email Settings
SMS Settings
Templates
Signatures
Notifications
```

Each item has its own dedicated page.

Do NOT display all forms simultaneously.

---

# 25. Communication Settings

Heading:

```text
Communication Settings
```

Description:

```text
Define how frequently a lead can receive SMS or email across all communication channels.
```

Include:

```text
View Communication Log
```

Information banner:

```text
These rules apply to all communication channels
```

Channels:

```text
Campaigns
Broadcasts
Lead Profile
Conversations
```

---

## Recent Communication Rule

Fields:

```text
Communication Type
Time Period
Unit
Action When Restricted
Allow Override
Enable Rule
```

Example:

```text
SMS
24
Hours
Prevent from sending
```

---

## Maximum Contacts Rule

Example:

```text
Email
3
7 Days
Delay until period resets
```

---

## Quiet Hours Rule

Fields:

```text
Communication Type
Start Time
End Time
Time Zone
Action When Restricted
Enable Rule
```

Buttons:

```text
Reset to Defaults
Save Changes
```

Right:

```text
Communication Summary
Channels Affected
Need Help?
```

---

# 26. Email Settings

Heading:

```text
Email Settings
```

Description:

```text
Configure your email sending preferences, SMTP settings, and default options for outgoing emails.
```

---

## Email Sending Configuration

Fields:

```text
Mail Driver
Host
Port
Encryption
Username
Password
Enable Email Sending
```

Example:

```text
SMTP
smtp.yourprovider.com
587
TLS
noreply@afroverified.com
```

---

## Default From Settings

Fields:

```text
From Name
From Email
Reply-To Email
```

---

## Email Preferences

Toggles:

```text
Track Email Opens
Track Link Clicks
Enable Unsubscribe Link
Send Copy to Admin
```

---

## Email Footer

Provide a basic editable HTML/text area.

Right sidebar:

```text
Email Status
Test Your Settings
Helpful Information
```

Include:

```text
SMTP Connection
Last Email Sent
Emails in Queue
Daily Email Limit
Emails Sent Today
```

Buttons:

```text
Send Test Email
Save Changes
Reset to Defaults
```

---

# 27. SMS Settings

Heading:

```text
SMS Settings
```

Description:

```text
Configure your SMS sending preferences, gateway settings, and default options for outgoing messages.
```

Fields:

```text
SMS Provider
Account SID
Auth Token
From Number / Sender ID
Message Type
Default Country Code
Enable SMS Sending
```

Example:

```text
Twilio
Transactional
Nigeria (+234)
```

---

## SMS Preferences

Toggles:

```text
Track Delivery Status
Enable Opt-Out Handling
Append Opt-Out Text
Send Copy to Admin
```

Opt-out text:

```text
Reply STOP to opt out
```

---

## Message Limits

Fields:

```text
Daily SMS Limit
Per Recipient Limit
Time Interval
```

Right:

```text
SMS Status
Test Your Settings
Helpful Information
```

Status examples:

```text
SMS Connection
Account Balance
Messages Sent Today
Failed Messages
Delivery Rate
```

---

# 28. Message Templates

Heading:

```text
Message Templates
```

Description:

```text
Create and manage reusable email and SMS templates for your events.
```

Button:

```text
+ Create Template
```

Tabs:

```text
Email Templates
SMS Templates
```

Filters:

```text
Search
Category
Status
Reset
Apply
```

---

## Template Table

Columns:

```text
Checkbox
#
Template Name
Subject
Category
Status
Last Updated
Actions
```

Example templates:

```text
Event Confirmation
Ticket Purchase
Event Reminder
Event Update
Event Cancellation
Post-Event Thank You
Feedback Request
Organizer Invitation
Waitlist Notification
Marketing Newsletter
```

---

## Template Details Panel

Example:

```text
Event Confirmation
Active
```

Show:

```text
Category
Subject
Last Updated
Created By
```

Message Preview:

```text
HTML
Text
```

Support placeholders such as:

```text
{{first_name}}
{{event_name}}
{{event_date}}
{{venue_name}}
{{ticket_type}}
```

Do not hard-code each recipient value.

---

# 29. Email Signatures

Heading:

```text
Email Signatures
```

Description:

```text
Create and manage email signature templates for your team.
```

Button:

```text
+ Create Signature
```

Filters:

```text
Search
Status
Created By
Reset
Apply
```

---

## Signature Table

Columns:

```text
Checkbox
#
Signature Name
Preview
Created By
Status
Last Updated
Actions
```

Examples:

```text
Default Signature
Support Team
Event Team
Marketing Team
Organizer Outreach
Minimal Signature
Corporate Signature
Festival Signature
```

---

## Signature Preview Panel

Show an actual signature preview.

Example:

```text
Abiola Yakubu
Product Manager
AfroVerified

+234 ...
abiola@afroverified.com
www.afroverified.com
Lagos, Nigeria
```

Social icons.

Afroverified logo.

Quick actions:

```text
Preview in New Tab
Duplicate Signature
Edit Signature
Deactivate Signature
Delete Signature
```

---

# 30. Notification Settings

Heading:

```text
Notification Settings
```

Description:

```text
Configure system and user notifications for important activities, alerts and updates.
```

Button:

```text
Save Changes
```

---

## Global Notification Preferences

Cards:

```text
In-App Notifications
Email Notifications
SMS Notifications
```

Each has an enable/disable toggle.

---

## Notification Tabs

Use:

```text
System Notifications
Organizer Notifications
User Notifications
```

---

## Notification Table

Columns:

```text
Checkbox
#
Notification Name
Category
Channels
Status
Actions
```

Examples:

```text
New Event Submission
Event Approved
Event Rejected
New User Registration
Organizer Verification
Payment Received
Payout Processed
System Announcement
Security Alert
Event Reminder
```

Channels can visually represent:

```text
Email
SMS
In-App
```

---

## Notification Right Sidebar

Summary:

```text
Total Notifications
Active Notifications
Inactive Notifications
```

Quick Actions:

```text
Create New Notification
Notification Log
Test Notification
Reset to Defaults
```

Helpful Information section.

---

# 31. Table Behaviour

All admin tables should support realistic UI behaviour.

Where shown, implement:

```text
row selection
select-all checkbox
search
filters
sorting
pagination
status badges
action menus
detail selection
```

Clicking a row or View action should update the detail panel where one exists.

Do not reload the entire page just to visually select a record unless necessary.

---

# 32. Pagination

Match the screenshot.

Example:

```text
‹
1
2
3
4
5
...
13
›
```

Active page:

```text
red background
white text
```

---

# 33. Forms

Use proper:

```html
<label>
<input>
<select>
<textarea>
<button>
```

Do not fake form controls with `<div>` elements unless implementing a genuinely custom UI component.

Required fields should display:

```text
*
```

where shown.

---

# 34. Dropdowns and Action Menus

The `⋮` menu should work.

Example actions:

```text
View
Edit
Duplicate
Deactivate
Delete
```

Use a positioned dropdown.

Click outside should close the menu.

Escape should close it.

---

# 35. Delete / Destructive Actions

Do not immediately delete content.

Show a confirmation dialog:

```text
Delete Event?

This action cannot be undone.

Cancel
Delete Event
```

Use the same approach for:

```text
Delete Category
Delete Venue
Delete Signature
Reject Submission
Deactivate User
End Campaign
```

---

# 36. Responsive Behaviour

The admin portal must be responsive even though the current primary references are desktop.

Recommended:

```css
@media (max-width: 1280px) {}

@media (max-width: 1024px) {}

@media (max-width: 768px) {}

@media (max-width: 480px) {}
```

At smaller widths:

```text
sidebar collapses
header remains usable
tables can horizontally scroll inside their card
right detail panels move below main content
stat cards wrap
filters wrap/stack
forms become single-column
tabs allow horizontal scrolling if necessary
```

Do not destroy the desktop design while making it responsive.

---

# 37. Sidebar Responsive Behaviour

Desktop:

```text
full sidebar
logo
text labels
user profile
```

Tablet:

```text
optional collapsed icon sidebar
```

Mobile:

```text
off-canvas sidebar
hamburger opens drawer
overlay behind drawer
```

---

# 38. Image Handling

Use the supplied Afroverified images.

Example directories:

```text
assets/images/events/
assets/images/venues/
assets/images/promotions/
```

Use:

```css
object-fit: cover;
object-position: center;
```

Never stretch posters.

For table thumbnails, preserve aspect ratio.

For event details posters, use the supplied vertical artwork.

---

# 39. Logo Usage

Use the actual supplied Afroverified logo.

On the black admin sidebar:

```text
use the dark-background logo
```

Do not type:

```text
AFRO
VERIFIED
```

as normal HTML text to imitate the logo.

Maintain the logo's proportions exactly.

---

# 40. Accessibility

Use:

```html
<aside>
<header>
<nav>
<main>
<section>
table
button
form
label
```

Include:

```text
aria-label
aria-expanded
aria-selected
aria-current
alt text
keyboard navigation
focus states
```

Status should not be communicated by color alone.

---

# 41. JavaScript Requirements

Implement the necessary UI interactions:

```text
sidebar expand/collapse
mobile sidebar
notifications dropdown
profile dropdown
tabs
filters
search
table selection
pagination
row detail selection
action menus
modals
form wizard
status toggles
submission approve/reject
template preview switching
settings toggles
test email/SMS simulation
charts
```

No backend is required unless the existing project already provides one.

For static prototype behaviour, use local JavaScript state.

---

# 42. Data Architecture

Do not hardcode the same markup manually ten times when a JavaScript array can render rows consistently.

For example:

```js
const events = [
    {
        id: 1,
        name: "Afrobeats In The City",
        organizer: "DJ Kulture",
        category: "Afrobeats",
        status: "Published",
        location: "Toronto, ON"
    }
];
```

The same applies to:

```text
venues
categories
organizers
users
submissions
promotions
templates
signatures
notifications
```

However, do not turn the task into a full frontend framework.

Vanilla JS modules are sufficient.

---

# 43. Component Consistency

The following must remain visually identical across the entire admin portal:

```text
sidebar
header
page titles
buttons
cards
metric cards
filters
form controls
tables
status badges
tabs
pagination
right-side detail cards
help panels
footers
```

Do not redesign a button differently on every page.

---

# 44. Visual Comparison Requirement

This rule is mandatory.

After implementing **every page**:

```text
1. Start the application locally.
2. Open the exact admin route.
3. Use a viewport close to the design reference.
4. Capture a screenshot.
5. Compare it directly with the supplied design image.
6. Fix visible differences.
7. Repeat until the page closely matches.
```

Inspect:

```text
sidebar width
header height
page padding
card spacing
font sizes
line heights
table row heights
column proportions
right panel width
button height
icon size
border radius
border colors
status badges
chart dimensions
```

The original public-site specification already required screenshot comparison and refinement before considering a page complete; use that same process here. 

If Playwright is available, automate screenshots.

Suggested desktop viewport:

```text
1536 × 1024
```

because that closely matches the supplied admin designs.

---

# 45. Implementation Order

Do NOT tell Codex:

```text
"Build the entire admin."
```

and allow it to generate everything in one pass.

Implement in phases:

```text
PHASE 1
Admin Shell
Sidebar
Header
Shared Design System

PHASE 2
Dashboard

PHASE 3
Events — All Events

PHASE 4
Event Details

PHASE 5
Add New Event

PHASE 6
Event Categories

PHASE 7
Event Venues

PHASE 8
Event Submissions

PHASE 9
What's The Vibe Management

PHASE 10
Promotions & Partnerships

PHASE 11
Organizers

PHASE 12
Users

PHASE 13
Reports & Analytics

PHASE 14
Settings — Communication

PHASE 15
Settings — Email

PHASE 16
Settings — SMS

PHASE 17
Settings — Templates

PHASE 18
Settings — Signatures

PHASE 19
Settings — Notifications
```

After each phase:

```text
Run it
Open the page
Capture a screenshot
Compare with reference
Correct differences
Check console
Check responsive behaviour
Then proceed
```

This is the same page-by-page discipline used in your original implementation specification rather than attempting every screen at once. 

---

# 46. Screens Not Yet Designed

Do not invent screens that do not yet have a reference.

For example, the sidebar includes:

```text
Sweet & Reckless
```

but if no dedicated Sweet & Reckless admin-management screenshot has been supplied yet:

```text
DO NOT invent its admin page.
```

Leave the navigation item wired to a placeholder route or mark it as awaiting design.

The same rule applies to any unprovided Settings top tabs such as:

```text
General
Event Settings
Users & Permissions
Integrations
Billing
Security
System
```

Do not invent these screens until design references exist.

---

# 47. Things Codex Must NOT Do

This section is mandatory.

```text
❌ Do not redesign the admin.

❌ Do not use AdminLTE.

❌ Do not install a random dashboard template.

❌ Do not use screenshots as page backgrounds.

❌ Do not merge separate admin pages.

❌ Do not omit right-side detail panels.

❌ Do not remove tables because cards are easier.

❌ Do not change Afroverified red.

❌ Do not replace the Afroverified logo.

❌ Do not invent unprovided screens.

❌ Do not replace Chart.js charts with static images.

❌ Do not omit action menus.

❌ Do not leave buttons non-functional when simple frontend behaviour can be implemented.

❌ Do not remove filters.

❌ Do not remove tabs.

❌ Do not remove pagination.

❌ Do not simplify multi-step forms.

❌ Do not make all statuses the same color.

❌ Do not use random event/venue imagery.

❌ Do not change the sidebar information architecture.

❌ Do not declare a page complete before comparing it with its supplied screenshot.
```

---

# 48. Definition of Done

The Afroverified Admin Portal is complete only when:

```text
✓ Global admin shell matches the references.

✓ Sidebar is reusable and consistent.

✓ Header is reusable and consistent.

✓ Dashboard matches the supplied design.

✓ All Events page exists.

✓ Event Details exists.

✓ Add New Event exists.

✓ Categories exists.

✓ Venues exists.

✓ Event Submissions exists.

✓ What's The Vibe Management exists.

✓ Promotions & Partnerships exists.

✓ Organizers exists.

✓ Users exists.

✓ Reports & Analytics exists.

✓ Communication Settings exists.

✓ Email Settings exists.

✓ SMS Settings exists.

✓ Templates exists.

✓ Signatures exists.

✓ Notifications exists.

✓ All designed navigation links work.

✓ Tabs work.

✓ Filters have frontend behaviour.

✓ Tables support expected interactions.

✓ Right-hand detail panels behave properly.

✓ Forms use real controls.

✓ Multi-step event creation works.

✓ Charts are real interactive charts.

✓ Modals/confirmations work.

✓ Correct Afroverified logo is used.

✓ Supplied artwork is used appropriately.

✓ No placeholder rectangles remain.

✓ No console errors remain.

✓ No accidental horizontal overflow occurs.

✓ Responsive behaviour is acceptable.

✓ Every page has been screenshot-compared against its design.

✓ Shared components remain visually consistent across the application.
```

---

# FINAL CODEX INSTRUCTION

**The admin design screenshots I provide are not conceptual references. They are the specification. Reproduce each screen faithfully. Do not make independent UI/UX decisions, do not replace the layouts with a generic dashboard template, and do not simplify the information architecture.**

**Implement one screen at a time. After each implementation, run the page, capture a screenshot, compare it side-by-side with the supplied design, and continue correcting spacing, dimensions, typography, colors, card sizes, tables, sidebar proportions and right-side panels until the difference is minimal.**

**When moving from one page to the next, preserve the exact sidebar, header, design tokens, card styling, form controls, table styling, status badges, tabs, buttons and spacing system already established.**

**If a screen has not been supplied, do not invent it. Ask for the design or leave the route pending.**

