# Modified Files List — PHP, CSS, JS & CDN/External Scripts

Generated from the project structure and script references.  
**Note:** Git was not available in this environment. For the exact list of **modified** files, run locally:

```bash
cd /home/buildco/elitebizpanel
git status -s | awk '{print $2}'
git diff --name-only
git diff --cached --name-only
```

---

## 1. PHP files (with path)

The truncated git status provided at the start of the conversation did **not** include any `.php` paths in the visible portion (only asset files were listed). To get **modified** PHP files only, run:

```bash
git status -s | awk '{print $2}' | grep '\.php$'
git diff --name-only | grep '\.php$'
```

**Example PHP files in the project (for reference — not necessarily modified):**

- `index.php`
- `protected/config/main.php`
- `protected/config/localmain.php`
- `protected/config/stagingmain.php`
- `protected/views/layouts/main.php`
- `protected/modules/mortgage/views/layouts/main.php`
- `protected/modules/mortgage/views/lenders/_form.php`
- `protected/modules/mortgage/views/graph/index.php`
- `protected/modules/homeimprovement/views/layouts/main.php`
- `protected/modules/homeimprovement/views/lenders/_form.php`
- `protected/modules/healthinsurance/views/layouts/main.php`
- `protected/modules/edu/views/layouts/main.php`
- `protected/modules/debt/views/layouts/main.php`
- `protected/modules/businessloans/views/layouts/main.php`
- `protected/modules/autoinsurance/views/layouts/main.php`
- `protected/modules/auto/views/layouts/main.php`
- `themes/abound/views/layouts/main.php`
- `themes/abound/views/site/index.php`
- `themes/elitepanel/views/layouts/main.php`
- *(and other PHP files under `protected/`, `themes/`)*

---

## 2. CSS files (with path)

From the **git status snapshot** (modified CSS paths that were visible):

- `assets/12803ec0/css/bootstrap-editable.css`
- `assets/15de76af/pager.css`
- `assets/3d1f923/ui.daterangepicker.css`
- `assets/4374ab21/detailview/styles.css`
- `assets/4374ab21/gridview/styles.css`
- `assets/4374ab21/listview/styles.css`
- `assets/4ba2e79b/detailview/styles.css`
- `assets/4ba2e79b/gridview/styles.css`
- `assets/4ba2e79b/listview/styles.css`
- `assets/50fc2f52/pager.css`
- `assets/7bf19d4a/highlight.css`
- `assets/73bb0dac/ui.daterangepicker.css`
- `assets/77be838e/css/bootstrap-editable.css`
- `assets/7d47701/css/bootstrap-editable.css`
- `assets/98dce911/yiitab/jquery.yiitab.css`
- `assets/98dce911/treeview/jquery.treeview.css`
- `assets/98dce911/jui/css/base/jquery.ui.theme.css`
- `assets/98dce911/jui/css/base/jquery.ui.autocomplete.css`
- `assets/98dce911/jui/css/base/jquery.ui.resizable.css`
- `assets/98dce911/jui/css/base/jquery.ui.datepicker.css`
- `assets/98dce911/jui/css/base/jquery-ui.css`
- `assets/98dce911/jui/css/base/jquery.ui.selectable.css`
- `assets/98dce911/jui/css/base/jquery.ui.core.css`
- `assets/98dce911/jui/css/base/jquery.ui.tabs.css`
- `assets/98dce911/jui/css/base/jquery.ui.accordion.css`
- `assets/98dce911/jui/css/base/jquery.ui.button.css`
- `assets/98dce911/jui/css/base/jquery.ui.dialog.css`
- `assets/98dce911/jui/css/base/jquery.ui.slider.css`
- `assets/98dce911/jui/css/base/jquery.ui.progressbar.css`
- `assets/98dce911/autocomplete/jquery.autocomplete.css`
- `assets/a2079b73/detailview/styles.css`
- `assets/a2079b73/gridview/styles.css`
- `assets/a2079b73/listview/styles.css`
- `assets/cfbbc535/yiitab/jquery.yiitab.css`
- `assets/cfbbc535/treeview/jquery.treeview.css`
- `assets/cfbbc535/rating/jquery.rating.css`
- `assets/cfbbc535/jui/css/smoothness/jquery-ui.css`
- `assets/cfbbc535/jui/css/base/jquery-ui.css`
- `assets/cfbbc535/autocomplete/jquery.autocomplete.css`
- `assets/d625fd3e/treeview/jquery.treeview.css`
- `assets/d625fd3e/jui/css/base/jquery-ui.css`
- `assets/d625fd3e/jui/css/smoothness/jquery-ui.css`
- `assets/d625fd3e/autocomplete/jquery.autocomplete.css`
- `assets/d625fd3e/rating/jquery.rating.css`
- `assets/d625fd3e/yiitab/jquery.yiitab.css`
- `assets/5da3bd3d/yiitab/jquery.yiitab.css`
- `assets/5da3bd3d/treeview/jquery.treeview.css`
- `assets/5da3bd3d/rating/jquery.rating.css`
- `assets/5da3bd3d/jui/css/base/jquery-ui.css`
- `assets/5da3bd3d/autocomplete/jquery.autocomplete.css`

*(Git status was truncated; more CSS under `assets/` may be modified. Run the git commands above for the full list.)*

---

## 3. JS files (with path)

From the **git status snapshot** (modified JS paths that were visible):

- `assets/12803ec0/js/bootstrap-editable.js`
- `assets/12803ec0/js/bootstrap-editable.min.js`
- `assets/1fc8b0be/jquery.infinitescroll.min.js`
- `assets/3d1f923/jquery.daterangepicker.js`
- `assets/4374ab21/gridview/jquery.yiigridview.js`
- `assets/4374ab21/listview/jquery.yiilistview.js`
- `assets/4b5ab3a4/jquery.infinitescroll.min.js`
- `assets/4ba2e79b/gridview/jquery.yiigridview.js`
- `assets/4ba2e79b/listview/jquery.yiilistview.js`
- `assets/5da3bd3d/jquery.ajaxqueue.js`
- `assets/5da3bd3d/jquery.autocomplete.js`
- `assets/5da3bd3d/jquery.ba-bbq.js`
- `assets/5da3bd3d/jquery.ba-bbq.min.js`
- `assets/5da3bd3d/jquery.bgiframe.js`
- `assets/5da3bd3d/jquery.cookie.js`
- `assets/5da3bd3d/jquery.history.js`
- `assets/5da3bd3d/jquery.js`
- `assets/5da3bd3d/jquery.maskedinput.js`
- `assets/5da3bd3d/jquery.maskedinput.min.js`
- `assets/5da3bd3d/jquery.metadata.js`
- `assets/5da3bd3d/jquery.min.js`
- `assets/5da3bd3d/jquery.multifile.js`
- `assets/5da3bd3d/jquery.rating.js`
- `assets/5da3bd3d/jquery.treeview.async.js`
- `assets/5da3bd3d/jquery.treeview.edit.js`
- `assets/5da3bd3d/jquery.treeview.js`
- `assets/5da3bd3d/jquery.yii.js`
- `assets/5da3bd3d/jquery.yiiactiveform.js`
- `assets/5da3bd3d/jquery.yiitab.js`
- `assets/5da3bd3d/jui/js/jquery-ui-i18n.min.js`
- `assets/5da3bd3d/jui/js/jquery-ui.min.js`
- `assets/5da3bd3d/punycode.js`
- `assets/5da3bd3d/punycode.min.js`
- `assets/6fa24431/jquery.infinitescroll.min.js`
- `assets/73bb0dac/jquery.daterangepicker.js`
- `assets/77be838e/js/bootstrap-editable.js`
- `assets/77be838e/js/bootstrap-editable.min.js`
- `assets/7d47701/js/bootstrap-editable.js`
- `assets/7d47701/js/bootstrap-editable.min.js`
- `assets/98dce911/` (jquery.*, jui, treeview, etc.)
- `assets/a2079b73/gridview/jquery.yiigridview.js`
- `assets/a2079b73/listview/jquery.yiilistview.js`

*(Git status was truncated; more JS under `assets/` may be modified. Run the git commands above for the full list.)*

---

## 4. CDN and external / new JS references

| URL / reference | Used in (file path) |
|-----------------|---------------------|
| `https://cdn.tailwindcss.com` | `protected/modules/mortgage/views/layouts/main.php` |
| `https://cdn.canvasjs.com/canvasjs.min.js` | `protected/modules/mortgage/views/graph/index.php` |
| `http://html5shim.googlecode.com/svn/trunk/html5.js` | mortgage, abound, homeimprovement, healthinsurance, edu, debt, businessloans, autoinsurance, auto layouts |
| `https://api.pushnami.com/scripts/v1/pushnami-adv/5da7456e7e1a360012f6040d` | mortgage, abound, homeimprovement, healthinsurance, edu, debt, businessloans, autoinsurance, auto (privacy, agreement, websiteterm, layouts) |
| `https://ads.elitemate.com/adg.js` | themes/abound/views/site/index.php; homeimprovement privacy/websiteterm/agreement; edu affiliateRegister |
| `https://ads.elitemate.com/adx.js` | `mockup/edu/xy7elite/indexpx.php` |
| `https://cdn.rawgit.com/crlcu/multiselect/v2.5.1/dist/js/multiselect.min.js` | `protected/modules/edu/views/campusSettings/_form.php` |
| `https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js` | `protected/modules/edu/views/affiliates/landing_page.php` |
| `https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js` | `protected/modules/edu/views/affiliates/landing_page.php` |
| `http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js` | `protected/modules/edu/views/affiliates/landing_page.php` |

**Local script references (baseUrl):**

- `js/bootstrap2-toggle.min.js` — mortgage, homeimprovement, healthinsurance lenders/_form.php; homeimprovement affiliates/_form.php
- `js/jquery.multiselect2side/js/jquery.multiselect2side.js` — mortgage, homeimprovement, healthinsurance (lenders, lenderAffiliateSettings, feeds dialogbox.php)
- `js/canvasjs.min.js` — mortgage layout (registerScriptFile)
- `fusionchart/fusionCharts.js` — homeimprovement graph/index.php
- `zeroclipboard-2.2.0/ZeroClipboard.js` — homeimprovement viewemailcreatives.php
- `manifest.json` / `service-worker.js` — various privacy, agreement, websiteterm, layouts (sometimes commented)

---

To get only **modified** PHP/CSS/JS from your repo, run:

```bash
git status -s | awk '{print $2}' | grep -E '\.(php|css|js)$'
```
