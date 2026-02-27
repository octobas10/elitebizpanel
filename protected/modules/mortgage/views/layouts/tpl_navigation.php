<?php
$navItems = $this->getNavItems();
$brandUrl = Yii::app()->createUrl('default/index');
$brandDomain = 'elitemortgagefinder.com';
$portalLabel = (isset($user_from_url) && $user_from_url !== '') ? ($user_from_url . ' Portal') : 'Portal';
$brandLabel = $brandDomain . ' ' . (isset($user_from_url) ? $user_from_url : 'Portal') . ' Portal';

function renderNavUrl($url) {
	if (is_string($url)) return $url;
	return Yii::app()->createUrl($url[0], array_slice($url, 1));
}

function navItemVisible($item) {
	return !isset($item['visible']) || $item['visible'];
}
?>
<?php
/* Black header: use white/light logo asset for contrast without changing original logo colours. */
$themeImg = Yii::app()->theme->baseUrl . '/img/';
$logoUrl = $themeImg . 'elite-mortgage-finder-logo-white.png';
$logoUrlFallback = $themeImg . 'elite-mortgage-finder-logo.png';
?>
<header class="fixed top-0 left-0 right-0 z-50 border-b border-black/20 shadow-sm portal-header-red dashboard-header" id="portal-header" role="banner">
	<div class="w-full px-4 sm:px-6 lg:px-8 dashboard-header-inner">
		<div class="flex items-center justify-between min-h-[3.5rem] py-2 md:min-h-[4.5rem] md:py-2.5">
			<a href="<?php echo htmlspecialchars($brandUrl); ?>" class="flex flex-col items-start justify-center gap-0.5 min-w-0 max-w-[55vw] sm:max-w-none text-white hover:opacity-90 transition-opacity" title="<?php echo htmlspecialchars($brandLabel); ?>">
				<img src="<?php echo htmlspecialchars($logoUrl); ?>" alt="Elite Mortgage Finder" class="h-6 sm:h-7 w-auto object-contain flex-shrink-0 portal-header-logo" width="160" height="32" data-fallback-src="<?php echo htmlspecialchars($logoUrlFallback); ?>" onerror="var p=this.parentNode; if(this.dataset.triedFallback){ this.style.display='none'; p.querySelector('.portal-header-text-fallback').classList.remove('hidden'); p.querySelector('.portal-header-text-fallback').classList.add('flex'); var pl=p.querySelector('.portal-header-portal-label'); if(pl) pl.style.display='none'; } else { this.dataset.triedFallback='1'; this.onerror=null; this.src=this.getAttribute('data-fallback-src'); }">
				<span class="flex flex-col leading-tight portal-header-text-fallback hidden">
					<span class="font-semibold text-sm sm:text-base truncate"><?php echo htmlspecialchars($brandDomain); ?></span>
					<span class="font-medium text-xs sm:text-sm truncate opacity-90"><?php echo htmlspecialchars($portalLabel); ?></span>
				</span>
				<span class="font-medium text-[10px] sm:text-xs truncate opacity-90 mt-0.5 portal-header-portal-label"><?php echo htmlspecialchars($portalLabel); ?></span>
			</a>
			<nav class="flex items-center gap-1 flex-wrap justify-end dashboard-header-nav" aria-label="Main navigation">
				<?php foreach ($navItems as $item): ?>
					<?php if (!navItemVisible($item)) continue; ?>
					<?php if (!empty($item['items'])): ?>
						<div class="portal-dropdown relative">
							<button type="button" class="portal-dropdown-trigger dashboard-dropdown-trigger flex items-center gap-1 px-3 py-2 min-h-[44px] text-white text-sm font-medium rounded-md hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-[#F26721] focus:ring-offset-2 focus:ring-offset-black" aria-expanded="false" aria-haspopup="true">
								<span class="dashboard-dropdown-trigger-label"><?php echo htmlspecialchars($item['label']); ?></span>
								<svg class="w-4 h-4 opacity-90 dashboard-dropdown-trigger-chevron" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
							</button>
							<div class="portal-dropdown-panel absolute right-0 top-full mt-1 py-1 w-48 rounded-lg bg-white shadow-lg border border-slate-200 hidden z-50">
								<?php foreach ($item['items'] as $sub): ?>
									<?php if (!navItemVisible($sub)) continue; ?>
									<?php $subUrl = renderNavUrl($sub['url']); $subOpts = isset($sub['linkOptions']) ? $sub['linkOptions'] : array(); $target = isset($subOpts['target']) ? ' target="' . htmlspecialchars($subOpts['target']) . '"' : ''; ?>
									<a href="<?php echo htmlspecialchars($subUrl); ?>" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50"<?php echo $target; ?>><?php echo htmlspecialchars($sub['label']); ?></a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php else: ?>
						<?php $href = renderNavUrl($item['url']); $opts = isset($item['linkOptions']) ? $item['linkOptions'] : array(); $target = isset($opts['target']) ? ' target="' . htmlspecialchars($opts['target']) . '"' : ''; ?>
						<a href="<?php echo htmlspecialchars($href); ?>" class="px-3 py-2 min-h-[44px] flex items-center text-white text-sm font-medium rounded-md hover:bg-white/10 hover:text-white"<?php echo $target; ?>><?php echo htmlspecialchars($item['label']); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
			</nav>
		</div>
	</div>
</header>
<div class="h-[3.5rem] md:h-[4.5rem] flex-shrink-0" aria-hidden="true"></div>
<script>
(function() {
	document.querySelectorAll('.portal-dropdown-trigger').forEach(function(btn) {
		btn.addEventListener('click', function(e) {
			e.preventDefault();
			var wrap = btn.closest('.portal-dropdown');
			var panel = wrap.querySelector('.portal-dropdown-panel');
			var isOpen = !panel.classList.contains('hidden');
			document.querySelectorAll('.portal-dropdown-panel').forEach(function(p) { p.classList.add('hidden'); });
			document.querySelectorAll('.portal-dropdown-trigger').forEach(function(b) { b.setAttribute('aria-expanded', 'false'); });
			if (!isOpen) {
				panel.classList.remove('hidden');
				btn.setAttribute('aria-expanded', 'true');
			}
		});
	});
	document.addEventListener('click', function(e) {
		if (!e.target.closest('.portal-dropdown')) {
			document.querySelectorAll('.portal-dropdown-panel').forEach(function(p) { p.classList.add('hidden'); });
			document.querySelectorAll('.portal-dropdown-trigger').forEach(function(b) { b.setAttribute('aria-expanded', 'false'); });
		}
	});
})();
</script>
