<?php

header('Content-type: text/css');
?>

@import url('https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&family=Geist+Mono:wght@400;500;600&display=swap');

/*--------------------------------------------------------------------------
|| Tokens (shared visual language with donate-web)
--------------------------------------------------------------------------*/
:root {
  --nide-orange: #ff6f00;
  --nide-gradient: linear-gradient(120deg, #fb5c23, #ff9f1c);
  --nide-gradient-hover: linear-gradient(120deg, #ff702f, #ffb34a);
  --accent: #ff8a1f;
  --accent-text: #ffb066;
  --accent-soft: rgba(255, 122, 26, 0.12);
  --accent-line: rgba(255, 122, 26, 0.35);
  --on-accent: #1a0900;

  --blue-a: #3b82f6;
  --blue-b: #2563eb;
  --blue-text: #a9ccff;
  --blue-soft: rgba(59, 130, 246, 0.12);
  --blue-line: rgba(59, 130, 246, 0.38);

  --danger-text: #fca5a5;

  --bg: #05070e;
  --surface-1: rgba(16, 21, 37, 0.62);
  --surface-hover: rgba(24, 31, 53, 0.72);
  --field-bg: rgba(6, 9, 18, 0.55);
  --border: rgba(148, 163, 184, 0.12);
  --border-strong: rgba(148, 163, 184, 0.22);
  --hairline: rgba(148, 163, 184, 0.08);
  --highlight: inset 0 1px 0 rgba(255, 255, 255, 0.045);

  --text-1: #f4f6fb;
  --text-body: #e2e6ee;
  --text-2: #b8c0cf;
  --text-3: #8a94a6;
  --text-4: #5f6b7f;

  --r-sm: 8px;
  --r-md: 12px;
  --r-lg: 16px;
  --r-xl: 22px;
  --r-pill: 999px;

  --shadow-md: 0 12px 32px -14px rgba(0, 0, 0, 0.7);
  --shadow-accent: 0 10px 28px -10px rgba(255, 111, 0, 0.6);

  --font-sans: 'Geist', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
  --font-mono: 'Geist Mono', ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;

  --page-max: 1280px;
  --page-gutter: clamp(16px, 3vw, 32px);

  --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
  --ease-standard: cubic-bezier(0.4, 0, 0.2, 1);

  --demo-cols: minmax(0, 2.4fr) minmax(0, 1.5fr) 110px 200px;
}

/*--------------------------------------------------------------------------
|| Base
--------------------------------------------------------------------------*/
*,
*::before,
*::after {
  box-sizing: border-box;
}

html {
  scroll-behavior: smooth;
  scrollbar-color: rgba(148, 163, 184, 0.3) var(--bg);
  scrollbar-width: thin;
}

html,
body {
  min-height: 100%;
  margin: 0;
  padding: 0;
}

body {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  overflow-x: hidden;
  font-family: var(--font-sans);
  font-size: 14.5px;
  line-height: 1.6;
  color: var(--text-body);
  background-color: var(--bg);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  animation: pageFadeIn 0.35s var(--ease-out) both;
}

/* Ambient glows + a dot grid that fades out below the fold */
body::before,
body::after {
  content: '';
  position: fixed;
  inset: 0;
  z-index: -1;
  pointer-events: none;
}

body::before {
  background:
    radial-gradient(55% 45% at 12% -8%, rgba(255, 111, 0, 0.16), transparent 70%),
    radial-gradient(45% 40% at 92% -4%, rgba(59, 130, 246, 0.1), transparent 70%),
    radial-gradient(60% 50% at 50% 115%, rgba(37, 99, 235, 0.08), transparent 70%);
}

body::after {
  background-image: radial-gradient(rgba(148, 163, 184, 0.11) 1px, transparent 1px);
  background-size: 22px 22px;
  -webkit-mask-image: radial-gradient(ellipse 85% 55% at 50% 0%, #000 25%, transparent 75%);
  mask-image: radial-gradient(ellipse 85% 55% at 50% 0%, #000 25%, transparent 75%);
}

h1, h2, h3 {
  margin: 0;
  color: var(--text-1);
  font-weight: 600;
  letter-spacing: -0.02em;
  line-height: 1.2;
}

p {
  margin: 0;
}

a {
  color: var(--accent);
  text-decoration: none;
  transition: color 0.15s var(--ease-standard);
}

a:hover {
  color: var(--accent-text);
}

::selection {
  background: rgba(255, 111, 0, 0.35);
  color: #fff;
}

:focus-visible {
  outline: 2px solid var(--accent);
  outline-offset: 2px;
}

::-webkit-scrollbar {
  width: 10px;
  height: 10px;
}

::-webkit-scrollbar-track {
  background: var(--bg);
}

::-webkit-scrollbar-thumb {
  background: rgba(148, 163, 184, 0.28);
  border-radius: var(--r-pill);
  border: 2px solid var(--bg);
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 111, 0, 0.55);
}

@keyframes pageFadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(12px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}

.hidden {
  display: none !important;
}

.mono {
  font-family: var(--font-mono);
  letter-spacing: -0.01em;
}

/*--------------------------------------------------------------------------
|| Layout
--------------------------------------------------------------------------*/
.container {
  flex: 1 0 auto;
  width: 100%;
  max-width: var(--page-max);
  margin: 0 auto;
  padding: 0 var(--page-gutter) 48px;
}

.page-head {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 16px 24px;
  padding: 36px 0 26px;
}

.page-head__eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 10px;
  font-size: 0.72rem;
  font-weight: 600;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--accent-text);
}

.page-head__eyebrow::before {
  content: '';
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--accent);
  box-shadow: 0 0 0 4px var(--accent-soft);
}

.page-head__title {
  font-size: clamp(1.65rem, 1.2rem + 1.4vw, 2.35rem);
  font-weight: 650;
  letter-spacing: -0.035em;
  line-height: 1.1;
}

.page-head__sub {
  margin-top: 10px;
  max-width: 64ch;
  font-size: 0.95rem;
  color: var(--text-3);
}

.page-head__actions {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 10px;
}

.section-title {
  font-size: 1.05rem;
  font-weight: 600;
  letter-spacing: -0.015em;
}

.section-sub {
  margin-top: 4px;
  font-size: 0.875rem;
  color: var(--text-3);
}

/*--------------------------------------------------------------------------
|| Navigation
--------------------------------------------------------------------------*/
.site-nav {
  position: sticky;
  top: 0;
  z-index: 100;
  background: rgba(5, 7, 14, 0.66);
  -webkit-backdrop-filter: blur(18px) saturate(160%);
  backdrop-filter: blur(18px) saturate(160%);
  border-bottom: 1px solid var(--border);
}

.nav-inner {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  width: 100%;
  max-width: var(--page-max);
  min-height: 64px;
  margin: 0 auto;
  padding: 0 var(--page-gutter);
}

.nav-brand,
.nav-brand:hover {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-right: 24px;
  color: var(--text-1);
}

.brand-icon {
  display: block;
  height: 34px;
  width: auto;
}

.nav-brand__text {
  display: flex;
  flex-direction: column;
  line-height: 1.15;
}

.nav-brand__name {
  font-size: 0.95rem;
  font-weight: 650;
  letter-spacing: -0.02em;
}

.nav-brand__tag {
  font-size: 0.66rem;
  font-weight: 600;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--text-4);
}

.nav-toggle-input {
  display: none;
}

.nav-toggle {
  display: none;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  margin-left: auto;
  border-radius: var(--r-md);
  border: 1px solid var(--border-strong);
  background: rgba(148, 163, 184, 0.06);
  color: var(--text-1);
  cursor: pointer;
}

.nav-toggle svg {
  width: 20px;
  height: 20px;
}

.nav-toggle .icon-close,
.nav-toggle-input:checked ~ .nav-toggle .icon-open {
  display: none;
}

.nav-toggle-input:checked ~ .nav-toggle .icon-close {
  display: block;
}

.nav-menu {
  display: flex;
  flex: 1;
  align-items: center;
  gap: 16px;
}

.nav-links {
  display: flex;
  align-items: center;
  gap: 2px;
  margin-right: auto;
}

.nav-links a {
  display: flex;
  align-items: center;
  gap: 7px;
  padding: 0.5rem 0.9rem;
  border-radius: var(--r-pill);
  font-size: 0.84rem;
  font-weight: 500;
  color: var(--text-2);
  white-space: nowrap;
  transition: background 0.2s var(--ease-standard), color 0.2s var(--ease-standard);
}

.nav-links a i {
  font-size: 0.9em;
  opacity: 0.75;
}

.nav-links a:hover {
  background: rgba(148, 163, 184, 0.07);
  color: var(--text-1);
}

.nav-links a.active {
  background: var(--nide-gradient);
  color: var(--on-accent);
  font-weight: 600;
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), var(--shadow-accent);
}

.nav-links a.active i {
  opacity: 1;
}

.nav-links a.active:hover {
  background: var(--nide-gradient-hover);
}

.nav-actions {
  display: flex;
  align-items: center;
  gap: 10px;
}

.nav-pill,
.nav-pill:visited {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 7px 14px;
  border-radius: var(--r-pill);
  border: 1px solid var(--border-strong);
  background: rgba(148, 163, 184, 0.04);
  color: var(--text-2);
  font-size: 0.8rem;
  font-weight: 500;
  white-space: nowrap;
  transition: border-color 0.18s var(--ease-standard), color 0.18s var(--ease-standard), background 0.18s var(--ease-standard);
}

.nav-pill:hover {
  border-color: var(--accent-line);
  background: var(--accent-soft);
  color: var(--text-1);
}

.nav-pill svg {
  width: 14px;
  height: 14px;
}

/*--------------------------------------------------------------------------
|| Pills & badges
--------------------------------------------------------------------------*/
.info-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 14px;
  border-radius: var(--r-pill);
  background: var(--accent-soft);
  border: 1px solid var(--accent-line);
  color: var(--accent-text);
  font-size: 0.8rem;
  font-weight: 500;
}

.info-pill svg {
  width: 15px;
  height: 15px;
  flex-shrink: 0;
}

.info-pill strong {
  color: var(--text-1);
  font-weight: 600;
}

.badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 0.3em 0.7em;
  border: 1px solid var(--border);
  border-radius: var(--r-pill);
  background: rgba(148, 163, 184, 0.1);
  color: var(--text-2);
  font-size: 0.7rem;
  font-weight: 600;
  letter-spacing: 0.01em;
  white-space: nowrap;
}

/*--------------------------------------------------------------------------
|| Server tiles
--------------------------------------------------------------------------*/
.server-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 14px;
}

.server-tile,
.server-tile:hover {
  --tile-a: #fb5c23;
  --tile-b: #ff9f1c;
  --tile-glow: rgba(255, 111, 0, 0.16);
  --tile-line: var(--accent-line);
  --tile-soft: var(--accent-soft);
  --tile-text: var(--accent-text);
  color: inherit;
}

.server-tile--blue,
.server-tile--blue:hover {
  --tile-a: var(--blue-a);
  --tile-b: var(--blue-b);
  --tile-glow: rgba(59, 130, 246, 0.16);
  --tile-line: var(--blue-line);
  --tile-soft: var(--blue-soft);
  --tile-text: var(--blue-text);
}

.server-tile {
  position: relative;
  display: flex;
  flex-direction: column;
  gap: 18px;
  padding: 22px 24px;
  border-radius: var(--r-xl);
  background:
    radial-gradient(120% 160% at 0% 0%, var(--tile-glow), transparent 55%),
    var(--surface-1);
  border: 1px solid var(--border);
  box-shadow: var(--highlight), var(--shadow-md);
  cursor: pointer;
  transition: border-color 0.2s var(--ease-standard), transform 0.2s var(--ease-out), box-shadow 0.2s var(--ease-standard);
}

.server-tile:hover {
  border-color: var(--border-strong);
  transform: translateY(-2px);
}

.server-tile.active-card {
  border-color: var(--tile-line);
  box-shadow: 0 0 0 3px var(--tile-soft), var(--highlight), var(--shadow-md);
}

.server-tile__top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}

.server-tile__chip {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  width: 46px;
  height: 46px;
  border-radius: var(--r-lg);
  background: linear-gradient(135deg, var(--tile-a), var(--tile-b));
  color: #fff;
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3);
}

.server-tile:not(.server-tile--blue) .server-tile__chip {
  color: var(--on-accent);
}

.server-tile__chip svg {
  width: 21px;
  height: 21px;
}

.server-tile .badge {
  color: var(--tile-text);
  background: var(--tile-soft);
  border-color: var(--tile-line);
}

.server-tile__name {
  font-size: 1.3rem;
  font-weight: 650;
  letter-spacing: -0.03em;
  line-height: 1.2;
  color: var(--text-1);
}

.server-tile__id {
  margin-top: 4px;
  font-family: var(--font-mono);
  font-size: 0.78rem;
  color: var(--text-4);
}

.server-tile__foot {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 14px;
  border-top: 1px solid var(--hairline);
  font-size: 0.84rem;
  font-weight: 600;
  color: var(--text-2);
}

.server-tile__arrow {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 30px;
  height: 30px;
  border-radius: var(--r-pill);
  border: 1px solid var(--border-strong);
  color: var(--text-2);
  transition: transform 0.2s var(--ease-out), background 0.2s var(--ease-standard), color 0.2s var(--ease-standard), border-color 0.2s var(--ease-standard);
}

.server-tile__arrow svg {
  width: 14px;
  height: 14px;
}

.server-tile:hover .server-tile__arrow,
.server-tile.active-card .server-tile__arrow {
  transform: translateX(3px);
  border-color: transparent;
  background: linear-gradient(135deg, var(--tile-a), var(--tile-b));
  color: #fff;
}

.server-tile:not(.server-tile--blue):hover .server-tile__arrow,
.server-tile:not(.server-tile--blue).active-card .server-tile__arrow {
  color: var(--on-accent);
}

.server-tile.active-card .server-tile__foot {
  color: var(--tile-text);
}

/*--------------------------------------------------------------------------
|| Recordings list: toolbar
--------------------------------------------------------------------------*/
.list-head {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 14px 24px;
  margin: 40px 0 16px;
}

.list-tools {
  display: flex;
  align-items: center;
  gap: 10px;
}

.search-box {
  position: relative;
  display: flex;
  align-items: center;
  width: 300px;
}

.search-box i.fa-search {
  position: absolute;
  left: 14px;
  color: var(--text-4);
  font-size: 13px;
  pointer-events: none;
}

.search-box input {
  width: 100%;
  padding: 0.55rem 2.3rem;
  border: 1px solid var(--border-strong);
  border-radius: var(--r-pill);
  background: var(--field-bg);
  color: var(--text-1);
  font-family: inherit;
  font-size: 0.86rem;
  outline: none;
  transition: border-color 0.15s var(--ease-standard), box-shadow 0.15s var(--ease-standard);
}

.search-box input::placeholder {
  color: var(--text-4);
}

.search-box input:focus {
  border-color: var(--accent-line);
  box-shadow: 0 0 0 3px var(--accent-soft);
}

.search-clear {
  position: absolute;
  right: 6px;
  display: none;
  align-items: center;
  justify-content: center;
  width: 26px;
  height: 26px;
  border: 0;
  border-radius: var(--r-pill);
  background: none;
  color: var(--text-3);
  font-size: 11px;
  cursor: pointer;
}

.search-clear.visible {
  display: flex;
}

.search-clear:hover {
  color: var(--text-1);
  background: rgba(148, 163, 184, 0.1);
}

.demo-count {
  font-family: var(--font-mono);
  font-size: 0.78rem;
  color: var(--text-3);
  white-space: nowrap;
}

.demo-count:empty {
  display: none;
}

/*--------------------------------------------------------------------------
|| Recordings list: grid rows (markup from pages/server.php)
--------------------------------------------------------------------------*/
.demos-container {
  display: none;
  flex-direction: column;
  gap: 6px;
}

.demos-container.show,
.demos-container.loading {
  display: flex;
}

.demos-container.show {
  animation: fadeInUp 0.45s var(--ease-out) both;
}

.demo-list-body {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.demo-list-header,
.demo-list-body .demo-row {
  display: grid;
  grid-template-columns: var(--demo-cols);
  gap: 12px;
  align-items: center;
}

.demo-list-header {
  padding: 0 16px 4px;
  font-size: 0.68rem;
  font-weight: 600;
  letter-spacing: 0.07em;
  text-transform: uppercase;
  color: var(--text-4);
}

.demo-list-header .demo-col-size {
  text-align: center;
}

.demo-list-header .demo-col-action {
  text-align: right;
}

.demo-list-body .demo-row {
  padding: 10px 16px;
  border-radius: var(--r-md);
  background: var(--surface-1);
  border: 1px solid var(--border);
  box-shadow: var(--highlight);
  font-size: 0.84rem;
  transition: border-color 0.15s var(--ease-standard), background 0.15s var(--ease-standard);
}

.demo-list-body .demo-row:hover {
  background: var(--surface-hover);
  border-color: var(--border-strong);
}

.demo-col-map {
  display: flex;
  align-items: center;
  gap: 12px;
  min-width: 0;
}

.demo-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  width: 32px;
  height: 32px;
  border-radius: var(--r-sm);
  background: var(--accent-soft);
  border: 1px solid var(--accent-line);
  color: var(--accent-text);
  font-size: 13px;
}

.demo-map-name {
  min-width: 0;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  font-family: var(--font-mono);
  font-size: 0.86rem;
  font-weight: 500;
  color: var(--text-1);
}

.demo-date {
  display: flex;
  flex-direction: column;
  font-variant-numeric: tabular-nums;
}

.demo-date .system-time {
  color: var(--text-2);
}

.demo-date .local-time {
  font-size: 0.75rem;
  color: var(--text-4);
}

.demo-col-size {
  text-align: center;
}

.size-badge {
  display: inline-block;
  padding: 0.25em 0.65em;
  border: 1px solid var(--border);
  border-radius: var(--r-pill);
  background: rgba(148, 163, 184, 0.08);
  color: var(--text-2);
  font-family: var(--font-mono);
  font-size: 0.74rem;
  white-space: nowrap;
}

.demo-col-action {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 12px;
}

.demo-col-action > a {
  color: inherit;
}

.button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 7px;
  padding: 7px 16px;
  border-radius: var(--r-pill);
  background: var(--nide-gradient);
  color: var(--on-accent);
  font-size: 0.8rem;
  font-weight: 600;
  white-space: nowrap;
  cursor: pointer;
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.28), var(--shadow-accent);
  transition: transform 0.18s var(--ease-out), background 0.18s var(--ease-standard);
}

.button:hover {
  background: var(--nide-gradient-hover);
  transform: translateY(-1px);
}

.button i {
  font-size: 0.9em;
}

.download-count {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  min-width: 34px;
  font-family: var(--font-mono);
  font-size: 0.75rem;
  color: var(--text-4);
}

.download-count i {
  font-size: 0.8em;
}

/* Loading, empty and error states */
.demo-loading {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  padding: 40px 16px;
  border-radius: var(--r-lg);
  background: var(--surface-1);
  border: 1px solid var(--border);
  color: var(--text-3);
  font-size: 0.875rem;
}

.demo-loading__spinner {
  width: 18px;
  height: 18px;
  border: 2px solid rgba(255, 111, 0, 0.18);
  border-top-color: var(--nide-orange);
  border-radius: 50%;
  animation: spin 0.7s linear infinite;
}

.empty-state {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 22px 24px;
  border-radius: var(--r-xl);
  background:
    radial-gradient(120% 160% at 0% 0%, rgba(255, 111, 0, 0.12), transparent 55%),
    var(--surface-1);
  border: 1px solid var(--border);
  box-shadow: var(--highlight);
}

.empty-state i {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  width: 46px;
  height: 46px;
  border-radius: var(--r-lg);
  background: var(--accent-soft);
  border: 1px solid var(--accent-line);
  color: var(--accent);
  font-size: 18px;
}

.empty-state h3 {
  font-size: 1rem;
  font-weight: 600;
}

.error {
  padding: 14px 16px;
  border-radius: var(--r-md);
  background: rgba(248, 113, 113, 0.07);
  border: 1px solid rgba(248, 113, 113, 0.28);
  color: var(--danger-text);
  font-size: 0.875rem;
}

/*--------------------------------------------------------------------------
|| Footer
--------------------------------------------------------------------------*/
.site-footer {
  position: relative;
  margin-top: auto;
  padding: 3rem var(--page-gutter) 2rem;
  font-size: 0.82rem;
  color: var(--text-3);
  background: linear-gradient(180deg, rgba(5, 7, 14, 0), rgba(5, 7, 14, 0.85) 40%);
  border-top: 1px solid var(--border);
}

.site-footer::before {
  content: '';
  position: absolute;
  top: -1px;
  left: 50%;
  width: min(560px, 80%);
  height: 1px;
  transform: translateX(-50%);
  background: linear-gradient(90deg, transparent, rgba(255, 122, 26, 0.6), transparent);
}

.site-footer__inner {
  max-width: calc(var(--page-max) - 2 * var(--page-gutter));
  margin: 0 auto;
}

.site-footer__grid {
  display: grid;
  grid-template-columns: 1.7fr 1fr 1fr;
  gap: 2rem;
}

.site-footer__brand {
  display: block;
  margin-bottom: 0.6rem;
  font-size: 0.95rem;
  font-weight: 600;
  color: var(--text-1);
}

.site-footer__about p {
  max-width: 38ch;
}

.site-footer__heading {
  margin: 0 0 0.8rem;
  font-size: 0.7rem;
  font-weight: 600;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--text-4);
}

.site-footer ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

.site-footer li + li {
  margin-top: 0.45rem;
}

.site-footer a {
  color: var(--text-2);
  font-weight: 500;
}

.site-footer a:hover {
  color: var(--accent-text);
}

.site-footer__bottom {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 0.5rem 1.5rem;
  margin-top: 2.25rem;
  padding-top: 1.25rem;
  border-top: 1px solid var(--hairline);
  font-size: 0.78rem;
}

.site-footer__bottom .site-footer__author {
  color: var(--accent-text);
  font-weight: 600;
}

/*--------------------------------------------------------------------------
|| Responsive
--------------------------------------------------------------------------*/
@media (max-width: 991.98px) {
  .nav-toggle {
    display: inline-flex;
  }

  .nav-menu {
    display: none;
    flex: 1 0 100%;
    flex-direction: column;
    align-items: stretch;
    gap: 12px;
    padding: 8px 0 16px;
  }

  .nav-toggle-input:checked ~ .nav-menu {
    display: flex;
  }

  .nav-links {
    flex-direction: column;
    align-items: stretch;
    gap: 4px;
    margin-right: 0;
  }

  .nav-actions {
    flex-wrap: wrap;
  }
}

@media (max-width: 860px) {
  :root {
    --demo-cols: minmax(0, 1fr) auto;
  }

  .demo-list-header {
    display: none;
  }

  .demo-list-body .demo-row {
    gap: 10px 12px;
    padding: 14px 16px;
  }

  .demo-col-map,
  .demo-col-action {
    grid-column: 1 / -1;
  }

  .demo-col-action {
    justify-content: space-between;
    flex-direction: row-reverse;
    padding-top: 10px;
    border-top: 1px solid var(--hairline);
  }
}

@media (max-width: 720px) {
  .server-grid {
    grid-template-columns: 1fr;
  }

  .page-head {
    padding: 28px 0 20px;
  }

  .list-tools,
  .search-box {
    width: 100%;
  }

  .site-footer {
    padding: 2.25rem var(--page-gutter) 1.75rem;
    text-align: center;
  }

  .site-footer__grid {
    grid-template-columns: 1fr;
    gap: 1.75rem;
  }

  .site-footer__about p {
    max-width: none;
  }

  .site-footer__bottom {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .demo-col-action .button {
    padding: 9px 18px;
  }
}
