# Conversion Summary: Mortgage Affiliates UI & Footer

Summary of UI and layout changes (Banner Creatives, Email Creatives, footer, main layout).

---

## 1. Banner Creatives — Image URLs (Live URL)

**Problem:** Image URLs broke (e.g. `/https://www.elitebizpanel.com/promotional_creatives/...`).  
**Fix:** Build assets base URL from config: use `backEnd` when full URL, else `httphost`+`backEnd`, else request origin.

| File | Changes |
|------|--------|
| `protected/modules/mortgage/views/affiliates/creatives.php` | Replaced `$baseUrl` with `$assetsBaseUrl` logic; use for `$imgSrc` and embed code. |

---

## 2. Banner Creatives — Scroll UX & Grid

**Problem:** Long list, lots of scrolling; no quick return to top.  
**Fix:** Two-column grid for creatives + back-to-top button (show after scroll).

| File | Changes |
|------|--------|
| `protected/modules/mortgage/views/affiliates/creatives.php` | Wrapped loop in `<div class="creatives-promo-grid">`. Added back-to-top button and scroll script. |
| `themes/abound/css/mortgage-dashboard.css` | `.creatives-promo-grid` (2-col; 1-col &lt;768px). `.scroll-to-top` (fixed, z-index 1040). `.creatives-promo-card` margin-bottom: 0. |

---

## 3. Return-to-Top Z-Index & Main Top Padding

**Problem:** Back-to-top behind footer; breadcrumb no space below header.  
**Fix:** Higher z-index for button; top padding on main content.

| File | Changes |
|------|--------|
| `themes/abound/css/mortgage-dashboard.css` | `.scroll-to-top`: z-index 1040, bottom 5.5rem. `.main-body`: padding-top 1.5rem. |

---

## 4. Email Creatives — Subject/From Lines on Top, Side by Side

**Problem:** Subject/from lines below banner grid; user wanted them on top, side by side.  
**Fix:** Move both above banner grid; two-column row.

| File | Changes |
|------|--------|
| `protected/modules/mortgage/views/affiliates/emailcreatives.php` | Subject lines + from lines in `<div class="creatives-lines-row">` above banner grid. Empty state and encoding tweaks. |
| `themes/abound/css/mortgage-dashboard.css` | `.creatives-lines-row` (2-col grid; 1-col &lt;768px). `.creatives-lines-row .creatives-display-card` margin-bottom: 0. |

---

## 5. Email Creatives — Padding Aligned With Portlets

**Problem:** Subject/from lines cards had different padding.  
**Fix:** Match standard portlet (decoration 1rem 1.25rem, content 1.25rem).

| File | Changes |
|------|--------|
| `themes/abound/css/mortgage-dashboard.css` | `.creatives-display-card`: removed card padding. Decoration: padding 1rem 1.25rem. `.creatives-display-card .portlet-content`: padding 1.25rem. |

---

## 6. Footer — Simplify & Remove Duplicates

**Problem:** Duplicate classes and Support link; mixed Tailwind/CSS.  
**Fix:** Single class set; one Support link; layout in CSS only.

| File | Changes |
|------|--------|
| `protected/modules/mortgage/views/layouts/tpl_footer.php` | Only `mortgage-portal-footer` / `mortgage-portal-footer-inner`. Nav: Dashboard + Support. Copy + tagline simplified; no duplicate email. |
| `themes/abound/css/mortgage-dashboard.css` | Footer: only `.mortgage-portal-footer` and `.mortgage-portal-footer-inner`; flex layout; min-height 56px; consolidated focus styles. |

---

## Files Modified (List)

| File | Purpose |
|------|--------|
| `protected/modules/mortgage/views/affiliates/creatives.php` | Live image URL, grid, back-to-top |
| `protected/modules/mortgage/views/affiliates/emailcreatives.php` | Subject/from on top, side by side |
| `protected/modules/mortgage/views/layouts/tpl_footer.php` | Footer markup simplified |
| `themes/abound/css/mortgage-dashboard.css` | All layout/padding/footer CSS above |

---

*Conversion summary for Mortgage affiliates UI and footer.*
