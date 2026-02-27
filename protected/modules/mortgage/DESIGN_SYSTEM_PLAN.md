# Mortgage Dashboard — Design System & Redesign Plan

**Target URL:** `http://localhost:9190/index.php/mortgage/dashboard/index`  
**Scope:** Header, Footer, Dashboard UI (consistent aesthetic and design system)  
**Stack:** Yii 1.1, theme `abound`, Bootstrap 2, module `mortgage`

---

## Current State Summary

| Area | Current Implementation | Issues |
|------|------------------------|--------|
| **Header** | `tpl_navigation.php`: Bootstrap 2 `navbar-inverse`, fixed-top, red gradient; long brand text; dense dropdowns; empty `subnav` strip | Dated look; cramped; no clear hierarchy; empty subnav |
| **Footer** | `tpl_footer.php`: Single line, `navbar-fixed-bottom`, minimal copy | Looks like an afterthought; no structure or links |
| **Dashboard** | `dashboard/index.php`: Inline styles; Bootstrap 2 grid; CPortlet widgets; mixed table styling; hardcoded colours | Inconsistent spacing; no design tokens; tables and portlets feel legacy |

---

## Design System (Tokens)

Apply consistently across Header, Footer, and Dashboard.

### Colours
| Token | Hex | Usage |
|-------|-----|--------|
| **Primary** | `#1e3a5f` | Nav bar, primary buttons, key headings (navy) |
| **Primary light** | `#2c5282` | Hover states, active nav |
| **Accent** | `#0080ff` | Links, focus rings, CTAs |
| **Surface** | `#f8fafc` | Page background, card alternate |
| **Surface elevated** | `#ffffff` | Cards, portlets, table header |
| **Border** | `#e2e8f0` | Card borders, table borders, dividers |
| **Text primary** | `#1e293b` | Body, headings |
| **Text secondary** | `#64748b` | Labels, captions, footer |
| **Success** | `#0d9488` | Positive numbers, success state |
| **Muted** | `#94a3b8` | Disabled, placeholder |

### Typography
- **Font stack:** `'Inter', 'Segoe UI', system-ui, sans-serif` (add Inter via Google Fonts).
- **Headings:** font-weight 600; page title 1.5rem, section 1.25rem, card title 1rem.
- **Body:** 14px base; line-height 1.5.

### Spacing
- **Page padding:** 24px.
- **Section spacing:** 24px between major blocks.
- **Card internal:** 16px padding; 12px between title and content.
- **Gaps:** 8px, 16px, 24px.

### Components
- **Cards / Portlets:** White background, 1px border, border-radius 8px, light shadow; header with bottom border.
- **Tables:** Header row navy; striped rows; numbers right-aligned; consistent padding.
- **Buttons:** Primary = navy; Secondary = outline or light grey.
- **Nav:** Clear active state; dropdowns with padding and hover; no double navbar (remove or repurpose empty subnav).

---

## Phase 1 — Header

**Files:**  
`protected/modules/mortgage/views/layouts/tpl_navigation.php`  
`protected/modules/mortgage/views/layouts/main.php`  
`themes/abound/css/mortgage-dashboard.css` (new; loaded only for mortgage)

**Tasks:**
1. Add body class `mortgage-portal` in `main.php`; register `mortgage-dashboard.css`.
2. Create `mortgage-dashboard.css` with header overrides using design tokens.
3. Update `tpl_navigation.php`: simplify structure; remove or repurpose second `.subnav`; apply new classes.
4. Style nav: primary colour, hover/active, dropdown spacing.

**Deliverable:** Modern, readable header aligned with tokens.

---

## Phase 2 — Footer

**Files:**  
`protected/modules/mortgage/views/layouts/tpl_footer.php`  
`themes/abound/css/mortgage-dashboard.css`

**Tasks:**
1. Replace footer markup with semantic structure (container, columns, copyright).
2. Style footer: background, text/link colours, padding.
3. Ensure main content has bottom padding for fixed footer.

**Deliverable:** Structured footer matching design system.

---

## Phase 3 — Dashboard UI

**Files:**  
`protected/modules/mortgage/views/dashboard/index.php`  
`themes/abound/css/mortgage-dashboard.css`

**Tasks:**
1. Add CSS classes for dashboard wrapper, filter bar, summary, portlet, table.
2. Remove inline styles from `dashboard/index.php`; use design-system classes.
3. Style date filter and Search button; tables (navy header, stripes, alignment); portlets (card style).
4. Consistent empty states and chart container spacing.

**Deliverable:** Dashboard UI consistent with header and footer.

---

## Implementation Order

1. **Phase 1 — Header**  
2. **Phase 2 — Footer**  
3. **Phase 3 — Dashboard UI**

---

## File Checklist

| Phase | File | Action |
|-------|------|--------|
| 1 | `mortgage/views/layouts/main.php` | Body class; register mortgage-dashboard.css |
| 1 | `mortgage/views/layouts/tpl_navigation.php` | Markup and class updates |
| 1 | `themes/abound/css/mortgage-dashboard.css` | Create; header styles |
| 2 | `mortgage/views/layouts/tpl_footer.php` | New footer markup |
| 2 | `themes/abound/css/mortgage-dashboard.css` | Footer styles |
| 3 | `mortgage/views/dashboard/index.php` | Replace inline styles with classes |
| 3 | `themes/abound/css/mortgage-dashboard.css` | Dashboard/portlet/table/button styles |

Scoping via `mortgage-portal` body class avoids affecting other modules (edu, debt, etc.).
