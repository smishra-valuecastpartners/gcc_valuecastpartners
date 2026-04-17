# Valuecast Homepage – Techbiz Child Theme Integration
## Installation & Setup Guide

---

## 📁 What's Changed From Original Techbiz Child

| File | Status | What Changed |
|---|---|---|
| `style.css` | ✅ Updated | Kept original Techbiz header; styles moved to `assets/css/valuecast.css` |
| `functions.php` | ✅ Updated | Original enqueue preserved; Valuecast assets added (homepage only) |
| `assets/js/custom.js` | ✅ Unchanged | Original file untouched |
| `front-page.php` | 🆕 New | Valuecast homepage template (auto-loads on static front page) |
| `assets/css/valuecast.css` | 🆕 New | All Valuecast homepage CSS (scoped to `.vc-page` class) |
| `assets/js/valuecast.js` | 🆕 New | Tabs, scroll reveal, smooth scroll (loaded on homepage only) |
| `assets/images/logo.png` | 🆕 New | Your Valuecast logo (fallback if no WP custom logo set) |
| `assets/video/hero-bg.mp4` | 🆕 New | Hero background video |

**Key principle:** Valuecast styles/scripts are ONLY loaded on the front page. All other Techbiz pages remain 100% unaffected.

---

## 🚀 Installation Steps

### Step 1 – Upload & Activate
1. Go to **WordPress Admin → Appearance → Themes → Add New → Upload Theme**
2. Upload `techbiz-child-valuecast.zip`
3. Click **Activate**
   > ⚠️ Make sure the **Techbiz parent theme** is also installed (this is a child theme)

### Step 2 – Set the Static Homepage
1. Go to **Settings → Reading**
2. Set **"Your homepage displays"** → **"A static page"**
3. Under **Homepage**, select or create a page named **"Home"**
4. Save Changes
   > WordPress will now automatically use `front-page.php` for the homepage

### Step 3 – Upload Your Logo
**Option A (Recommended) – WordPress Customizer:**
1. Go to **Appearance → Customize → Site Identity → Logo**
2. Upload your logo PNG
3. The logo will appear in the Techbiz nav bar automatically

**Option B – Direct file:**
- The file `assets/images/logo.png` is already included as a fallback

### Step 4 – Hero Video
The video `assets/video/hero-bg.mp4` is bundled in the theme.

**To replace with a different video:**
- Via FTP: replace `wp-content/themes/techbiz-child/assets/video/hero-bg.mp4`
- OR upload to WordPress Media Library and update `valuecast_video_url()` in `functions.php`

### Step 5 – Customize Content
Go to **Appearance → Customize** and look for these new sections:

| Customizer Section | What You Can Edit |
|---|---|
| 🎯 Valuecast – Hero | Eyebrow, Headline, Sub-headline, Description, CTA buttons |
| 🎯 Valuecast – Contact & CTA | Email, Phone, CTA banner headline & button |

---

## 🎨 Customizing Colors & Fonts

Edit CSS variables at the top of `assets/css/valuecast.css`:

```css
:root {
  --vc-blue:       #1A38F0;   /* Change primary brand color here */
  --vc-blue-dark:  #1228CC;   /* Hover/darker variant */
  --vc-text:       #1C2340;   /* Body text */
  --vc-text-light: #4A5270;   /* Lighter body text */
  --vc-off-white:  #F4F6FB;   /* Card/section backgrounds */
}
```

---

## 🔧 Editing Homepage Sections

All homepage sections live in `front-page.php`. Each section is clearly commented:

```
═══ HERO SECTION ═══
═══ WHAT WE DO ══════
═══ MARQUEE 1 ═══════
═══ MISSION ══════════
═══ FOCUS AREAS ══════
═══ MARQUEE 2 ═══════
═══ DIFFERENTIATORS ══
═══ CTA BANNER ═══════
═══ WHY IT MATTERS ═══
```

To edit the **Why It Matters** lists, find these PHP arrays in `front-page.php`:
```php
$problems  = array( 'Problem 1', 'Problem 2', ... );
$solutions = array( 'Solution 1', 'Solution 2', ... );
```

To edit **Differentiators cards**, find `$cards = array(...)`.

---

## ❓ Troubleshooting

**Q: The homepage still shows the Techbiz default layout**
→ Make sure Settings → Reading → Homepage is set to a static page

**Q: Video not playing**
→ Check file is at `wp-content/themes/techbiz-child/assets/video/hero-bg.mp4`
→ Ensure your server supports `.mp4` MIME type
→ Some browsers need HTTPS for autoplay — make sure SSL is enabled

**Q: My other Techbiz pages look broken**
→ This theme only modifies the front page. All CSS is scoped to `.vc-page` body class which is only added on `is_front_page()`. Check that your other pages aren't accidentally set as the static front page.

**Q: Fonts not loading**
→ Check your server allows Google Fonts connections (some hosts block external URLs)
→ Alternatively, download the fonts and host them locally in `assets/fonts/`

**Q: Logo not showing in nav**
→ Upload via Appearance → Customize → Site Identity → Logo
→ The Techbiz parent theme controls the nav — make sure it supports `custom_logo`

---

## 🆘 Support

For Techbiz parent theme issues: https://themeforest.vecuro.com/wordpress/techbiz/
For Valuecast design customization: contact your developer

---
© 2025 Valuecast Partners | Techbiz Child Theme v2.0
