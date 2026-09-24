<?php

header('Content-type: text/css');
?>

/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap');

/* CSS Variables */
:root {
  --bg-main: #05060a;
  --surface: rgba(255, 255, 255, 0.035);
  --surface-strong: rgba(255, 255, 255, 0.06);
  --border-subtle: rgba(255, 255, 255, 0.08);
  --border-strong: rgba(255, 255, 255, 0.16);
  --text-main: #f4f5f7;
  --text-muted: #98a1b3;
  --text-faint: #5c6579;
  --accent-orange: #ff6a1a;
  --accent-orange-soft: rgba(255, 106, 26, 0.14);
  --accent-orange-dim: rgba(255, 106, 26, 0.38);
  --accent-blue: #1ab6ff;
  --accent-blue-soft: rgba(26, 182, 255, 0.14);
  --accent-blue-dim: rgba(26, 182, 255, 0.38);
  --on-orange: #1c0d02;
  --radius-lg: 22px;
  --radius-md: 14px;
  --radius-sm: 10px;
  --shadow-lg: 0 24px 60px -20px rgba(0, 0, 0, 0.65);
  --font-display: 'Space Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
  --font-body: 'Manrope', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  --font-mono: 'JetBrains Mono', 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
  --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Reset Styles */
* {
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  margin: 0;
  padding: 0;
}

/* Global Styles */
html, body {
  height: 100%;
}

body {
  margin: 0;
  min-height: 100vh;
  font-family: var(--font-body);
  color: var(--text-main);
  background: var(--bg-main);
  background-image:
    radial-gradient(at 12% -8%, rgba(255, 106, 26, 0.18) 0px, transparent 42%),
    radial-gradient(at 88% -6%, rgba(26, 182, 255, 0.12) 0px, transparent 42%);
  background-attachment: fixed;
  background-repeat: no-repeat;
  background-size: 100% 100%;
  display: flex;
  flex-direction: column;
  font-size: 14px;
  line-height: 1.6;
}

/* Navigation Styles */
nav {
  padding: 18px 56px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 28px;
  background: rgba(5, 6, 10, 0.78);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid var(--border-subtle);
  position: sticky;
  top: 0;
  z-index: 100;
}

.nav-brand {
  font-weight: 700;
  text-decoration: none;
  color: var(--text-main);
  display: flex;
  align-items: center;
  gap: 12px;
}

.brand-icon {
  width: 36px;
  height: 36px;
  object-fit: contain;
  border-radius: 10px;
  background: var(--surface-strong);
  border: 1px solid var(--border-subtle);
  padding: 4px;
}

.nav-brand-text {
  display: flex;
  flex-direction: column;
  line-height: 1.15;
}

.nav-brand-name {
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 16px;
  letter-spacing: -0.02em;
  color: var(--text-main);
}

.nav-brand-tag {
  font-size: 10px;
  letter-spacing: 0.14em;
  color: var(--text-faint);
  font-weight: 700;
  text-transform: uppercase;
}

.nav-toggle-input {
  display: none;
}

.nav-toggle {
  display: none;
  align-items: center;
  justify-content: center;
  width: 38px;
  height: 38px;
  border-radius: 10px;
  background: var(--surface-strong);
  border: 1px solid var(--border-strong);
  color: var(--text-main);
  cursor: pointer;
  order: 3;
}

.nav-menu {
  display: flex;
  align-items: center;
  gap: 28px;
  order: 2;
}

.nav-links {
  display: flex;
  align-items: center;
  gap: 30px;
}

.nav-links a {
  text-decoration: none;
  color: var(--text-muted);
  font-size: 13px;
  font-weight: 600;
  transition: var(--transition);
  letter-spacing: 0.01em;
  white-space: nowrap;
}

.nav-links a:hover {
  color: var(--text-main);
}

.nav-links a.active {
  color: var(--accent-orange);
  font-weight: 700;
}

.nav-cta {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 18px;
  border-radius: 100px;
  background: var(--surface-strong);
  border: 1px solid var(--border-strong);
  font-size: 13px;
  font-weight: 700;
  color: var(--text-main) !important;
  text-decoration: none;
  transition: var(--transition);
  white-space: nowrap;
}

.nav-cta:hover {
  background: var(--accent-orange-soft);
  border-color: var(--accent-orange-dim);
  color: var(--accent-orange) !important;
}

/* Main Content */
.container {
  max-width: 900px;
  margin: 0 auto;
  width: 100%;
  padding: 0 2rem;
}

header {
  text-align: center;
  padding: 5.5rem 0 2.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}

.header-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 7px 14px;
  border-radius: 100px;
  background: var(--accent-orange-soft);
  border: 1px solid var(--accent-orange-dim);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.08em;
  color: var(--accent-orange);
  text-transform: uppercase;
}

.header-eyebrow .live-dot {
  background: var(--accent-orange);
  box-shadow: 0 0 8px var(--accent-orange);
}

h1 {
  font-family: var(--font-display);
  font-size: 3rem;
  font-weight: 700;
  margin: 0;
  letter-spacing: -0.03em;
  line-height: 1.08;
  background: linear-gradient(180deg, #ffffff 45%, #7c8399 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.subtitle {
  color: var(--text-muted);
  font-size: 1rem;
  margin: 0;
  max-width: 440px;
  font-weight: 400;
  line-height: 1.6;
}

/* Server Grid */
.server-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
  margin-bottom: 2rem;
}

.server-card {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 2rem;
  min-height: 196px;
  background: var(--surface);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius-lg);
  text-decoration: none;
  color: inherit;
  transition: var(--transition);
  overflow: hidden;
  cursor: pointer;
  box-shadow: var(--shadow-lg);
}

/* Hover glow effect */
.server-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 88% -12%, var(--glow-color), transparent 60%);
  opacity: 0.22;
  transition: var(--transition);
  z-index: 0;
}

.server-card:hover {
  transform: translateY(-4px);
  border-color: var(--glow-color);
}

.server-card:hover::before {
  opacity: 0.36;
}

.card-content {
  position: relative;
  z-index: 1;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.server-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: var(--glow-color);
}

.live-dot {
  width: 6px;
  height: 6px;
  background: var(--glow-color);
  border-radius: 50%;
  box-shadow: 0 0 8px var(--glow-color);
}

.server-name {
  font-family: var(--font-display);
  font-size: 1.5rem;
  font-weight: 700;
  letter-spacing: -0.02em;
}

.card-footer {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 24px;
}

.action-text {
  font-size: 13px;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--text-main);
}

.arrow-icon {
  transition: var(--transition);
}

.server-card:hover .arrow-icon {
  transform: translateX(4px);
}

/* Color variants */
.card-orange {
  --glow-color: var(--accent-orange);
}

.card-blue {
  --glow-color: var(--accent-blue);
}

/* Active card state */
.server-card.active-card {
  border-color: var(--glow-color);
  box-shadow: 0 0 0 1px var(--glow-color), var(--shadow-lg);
}

.server-card.active-card::before {
  opacity: 0.42;
}

.server-card.active-card .arrow-icon {
  transform: translateX(4px);
}

/* Info Section */
.info-footer {
  text-align: center;
  margin-bottom: 2rem;
}

.info-text {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 0.75rem;
  color: var(--text-muted);
  background: var(--surface);
  padding: 9px 16px;
  border-radius: 100px;
  border: 1px solid var(--border-subtle);
  font-weight: 600;
}

.info-text strong {
  color: var(--text-main);
  font-weight: 700;
}

/* How it works */
.how-it-works {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.25rem;
  margin-bottom: 2.5rem;
}

.step-card {
  display: flex;
  flex-direction: column;
  gap: 8px;
  padding: 1.375rem;
  border-radius: 16px;
  background: var(--surface);
  border: 1px solid var(--border-subtle);
}

.step-number {
  font-family: var(--font-display);
  font-size: 13px;
  font-weight: 700;
  color: var(--accent-orange);
}

.step-title {
  font-size: 14px;
  font-weight: 700;
  color: var(--text-main);
}

.step-text {
  font-size: 12.5px;
  color: var(--text-muted);
  line-height: 1.55;
}

/* Demos Container */
.demos-container {
  margin-top: 1rem;
  display: none; /* Initially hidden */
  width: 100%;
  justify-content: center;
  align-items: stretch;
  flex-direction: column;
  gap: 1.5rem;
}

.demos-container.show {
  display: flex;
  animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Search / Toolbar */
.table-toolbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  margin: 0 auto 1.25rem;
  max-width: 1200px;
  width: 100%;
}

.search-box {
  position: relative;
  flex: 1;
  max-width: 340px;
  display: flex;
  align-items: center;
}

.search-box i.fa-search {
  position: absolute;
  left: 16px;
  color: var(--text-faint);
  font-size: 13px;
  pointer-events: none;
}

.search-box input {
  width: 100%;
  padding: 11px 40px;
  background: var(--surface);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius-sm);
  color: var(--text-main);
  font-family: inherit;
  font-size: 13px;
  outline: none;
  transition: var(--transition);
}

.search-box input::placeholder {
  color: var(--text-faint);
}

.search-box input:focus {
  border-color: var(--accent-orange);
  box-shadow: 0 0 0 3px var(--accent-orange-soft);
}

.search-clear {
  position: absolute;
  right: 8px;
  width: 24px;
  height: 24px;
  display: none;
  align-items: center;
  justify-content: center;
  background: none;
  border: none;
  border-radius: 6px;
  color: var(--text-faint);
  cursor: pointer;
  font-size: 11px;
  transition: var(--transition);
}

.search-clear.visible {
  display: flex;
}

.search-clear:hover {
  color: var(--text-main);
  background: var(--surface-strong);
}

.demo-count {
  font-size: 0.8rem;
  color: var(--text-faint);
  font-weight: 700;
  white-space: nowrap;
}

/* Demo List */
.demo-list {
  width: 100%;
  max-width: 1200px;
  background: var(--surface);
  border-radius: 18px;
  border: 1px solid var(--border-subtle);
  overflow: hidden;
  margin: 0 auto 2rem;
  box-shadow: var(--shadow-lg);
}

.demo-list-header {
  display: grid;
  grid-template-columns: 2.2fr 1.4fr 1fr 0.9fr;
  gap: 1rem;
  padding: 16px 28px;
  background: linear-gradient(90deg, var(--accent-orange-soft), var(--accent-blue-soft));
  border-bottom: 1px solid var(--border-strong);
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 1px;
  color: var(--text-muted);
  position: sticky;
  top: 0;
  z-index: 10;
}

.demo-list-header .demo-col-size,
.demo-list-header .demo-col-action {
  text-align: center;
}

.demo-list-body .demo-row {
  display: grid;
  grid-template-columns: 2.2fr 1.4fr 1fr 0.9fr;
  gap: 1rem;
  align-items: center;
  padding: 15px 28px;
  border-bottom: 1px solid var(--border-subtle);
  transition: var(--transition);
}

.demo-list-body .demo-row:last-child {
  border-bottom: none;
}

.demo-list-body .demo-row:nth-child(even) {
  background: rgba(255, 255, 255, 0.015);
}

.demo-list-body .demo-row:hover {
  background: linear-gradient(90deg, var(--accent-orange-soft) 0%, transparent 100%);
}

/* Map column: icon + name */
.demo-col-map {
  display: flex;
  align-items: center;
  gap: 12px;
  min-width: 0;
}

.demo-icon {
  flex-shrink: 0;
  width: 36px;
  height: 36px;
  border-radius: 9px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--accent-orange-soft);
  color: var(--accent-orange);
  font-size: 14px;
}

.demo-map-name {
  font-weight: 600;
  color: var(--text-main);
  font-size: 13px;
  font-family: var(--font-mono);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  min-width: 0;
}

/* Date column */
.demo-col-date .demo-date {
  display: flex;
  flex-direction: column;
}

.demo-col-date .system-time {
  font-size: 13px;
  color: var(--text-muted);
  font-weight: 500;
}

.demo-col-date .local-time {
  margin-top: 2px;
  font-size: 11px;
  color: var(--text-faint);
}

/* Size column */
.demo-col-size {
  text-align: center;
}

.size-badge {
  display: inline-block;
  color: var(--accent-blue);
  font-weight: 700;
  font-size: 11.5px;
  background: var(--accent-blue-soft);
  border: 1px solid var(--accent-blue-dim);
  border-radius: 8px;
  padding: 5px 10px;
  white-space: nowrap;
}

/* Download column */
.demo-col-action {
  text-align: center;
}

.demo-list .button {
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.download-count {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  margin-left: 8px;
  font-size: 11px;
  color: var(--text-faint);
  vertical-align: middle;
}

/* Button Styles */
.button {
  background: linear-gradient(135deg, var(--accent-orange) 0%, #ff8a3d 100%);
  font-size: 11px;
  font-weight: 800;
  text-align: center;
  text-decoration: none;
  white-space: nowrap;
  display: inline-block;
  vertical-align: middle;
  padding: 9px 16px;
  border-radius: 8px;
  border: none;
  transition: var(--transition);
  cursor: pointer;
  user-select: none;
  color: var(--on-orange) !important;
  min-width: 90px;
  letter-spacing: 0.4px;
  text-transform: uppercase;
  box-shadow: 0 8px 20px -6px rgba(255, 106, 26, 0.5);
  font-family: inherit;
}

.button:hover {
  transform: translateY(-1px);
  box-shadow: 0 10px 24px -6px rgba(255, 106, 26, 0.6);
}

/* Footer Styles */
footer {
  margin-top: auto;
  border-top: 1px solid var(--border-subtle);
  background: rgba(5, 6, 10, 0.7);
  backdrop-filter: blur(20px);
}

.footer-inner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem 2rem 1.75rem;
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.footer-links {
  display: flex;
  flex-wrap: wrap;
  gap: 1.6rem;
  justify-content: center;
}

.footer-links a {
  font-size: 12px;
  font-weight: 600;
  color: var(--text-muted);
  text-decoration: none;
  transition: var(--transition);
}

.footer-links a:hover,
.footer-links a.active {
  color: var(--accent-orange);
}

.footer-divider {
  height: 1px;
  background: var(--border-subtle);
}

.footer-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 10px;
  font-size: 12px;
  color: var(--text-faint);
}

.footer-bottom a {
  color: var(--accent-orange);
  text-decoration: none;
  font-weight: 700;
}

.footer-bottom a:hover {
  color: var(--text-main);
}

.footer-credits {
  display: flex;
  align-items: center;
  gap: 14px;
  flex-wrap: wrap;
}

.footer-credits a {
  color: var(--text-muted);
  font-weight: 600;
}

.footer-credits a:hover {
  color: var(--text-main);
}

.footer-github {
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

/* Security Enhancement Styles */
.error {
    background-color: rgba(248, 215, 218, 0.1);
    border: 1px solid rgba(245, 198, 203, 0.3);
    color: #ff6b6b;
    padding: 12px;
    border-radius: 8px;
    margin: 10px 0;
    text-align: center;
    font-weight: bold;
}

.security-info {
    background-color: rgba(209, 236, 241, 0.1);
    border: 1px solid rgba(190, 229, 235, 0.3);
    color: var(--accent-blue);
    padding: 10px;
    border-radius: 8px;
    margin: 10px 0;
    font-size: 0.9em;
}

/* Loading state for AJAX */
.loading {
    opacity: 0.6;
    pointer-events: none;
    position: relative;
}

.loading::after {
    content: "Loading...";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: var(--surface);
    color: var(--text-main);
    padding: 20px 30px;
    border-radius: 12px;
    border: 1px solid var(--border-subtle);
    z-index: 1000;
    backdrop-filter: blur(20px);
    font-weight: 600;
}

/* Scrollbar Styles */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: var(--bg-main);
}

::-webkit-scrollbar-thumb {
  background: var(--accent-orange);
  border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
  background: #ff8a3d;
}

/* Empty state styling */
.empty-state {
    text-align: center;
    padding: 60px 40px;
    color: var(--text-muted);
}

.empty-state i {
    font-size: 48px;
    margin-bottom: 20px;
    opacity: 0.3;
    color: var(--accent-orange);
}

.empty-state h3 {
    margin: 0;
    font-weight: 400;
    font-size: 18px;
    color: var(--text-muted);
}

.demo-date .system-time,
.demo-date .local-time {
  display: block;
}

.demo-date .local-time {
  margin-top: 2px;
  font-size: 0.85em;
  color: var(--text-faint);
}

.hidden {
  display: none !important;
}

/* Very large screens */
@media (min-width: 1200px) {
  .container {
    max-width: 1100px;
  }

  nav {
    padding: 20px 4rem;
  }

  .server-grid,
  .how-it-works {
    gap: 2rem;
  }
}

/* Tablet / small desktop responsive adjustments */
@media (max-width: 900px) {
  .nav-toggle {
    display: flex;
  }

  .nav-menu {
    display: none;
  }

  .nav-toggle-input:checked ~ .nav-menu {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    gap: 6px;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    padding: 14px 20px 20px;
    background: rgba(5, 6, 10, 0.96);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border-subtle);
  }

  .nav-toggle-input:checked ~ .nav-menu .nav-links {
    flex-direction: column;
    align-items: flex-start;
    gap: 2px;
  }

  .nav-toggle-input:checked ~ .nav-menu .nav-links a {
    width: 100%;
    padding: 10px 0;
  }

  .nav-toggle-input:checked ~ .nav-menu .nav-cta {
    justify-content: center;
    margin-top: 8px;
  }
}

@media (max-width: 768px) {
  .server-grid {
    grid-template-columns: 1fr;
  }

  .how-it-works {
    grid-template-columns: 1fr;
  }

  nav {
    padding: 14px 20px;
  }

  .container {
    padding: 0 1.25rem;
  }

  header {
    padding: 2.75rem 0 2rem;
  }

  h1 {
    font-size: 2rem;
  }
}

/* Small screen responsive adjustments */
@media (max-width: 480px) {
  h1 {
    font-size: 1.75rem;
  }

  .server-card {
    padding: 1.375rem;
    min-height: unset;
  }

  .server-name {
    font-size: 1.2rem;
  }

  .footer-inner {
    padding: 1.5rem 1.25rem 1.25rem;
  }

  .footer-bottom {
    justify-content: center;
    text-align: center;
  }

  /* Stack demo rows as cards on small screens */
  .demo-list-header {
    display: none;
  }

  .demo-list-body .demo-row {
    grid-template-columns: 1fr;
    justify-items: start;
    gap: 10px;
    padding: 16px 18px;
  }

  .demo-col-map {
    width: 100%;
  }

  .demo-map-name {
    white-space: normal;
    word-break: break-word;
  }

  .demo-col-size,
  .demo-col-action {
    text-align: left;
  }

  .demo-col-action {
    width: 100%;
    text-align: center;
  }

  .demo-list .button {
    width: 100%;
    justify-content: center;
    padding: 10px 16px;
    font-size: 11px;
  }

  .download-count {
    display: inline-flex;
    margin-left: 0;
    margin-top: 6px;
  }

  .demo-list {
    border-radius: 12px;
    margin-top: 0.5rem;
  }

  .table-toolbar {
    flex-direction: column;
    align-items: stretch;
    gap: 0.5rem;
  }

  .search-box {
    max-width: none;
  }

  .demo-count {
    text-align: right;
  }
}
