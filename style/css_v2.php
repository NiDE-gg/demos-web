<?php

header('Content-type: text/css');
?> 

/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

/* CSS Variables */
:root {
  --bg-main: #020408;
  --bg-card: rgba(15, 23, 42, 0.3);
  --border-subtle: rgba(255, 255, 255, 0.06);
  --text-main: #ffffff;
  --text-muted: #94a3b8;
  --accent-orange: #ff6f00;
  --accent-blue: #00b0ff;
  --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  color: var(--text-main);
  background: var(--bg-main);
  background-image:
    radial-gradient(at 0% 0%, rgba(255, 111, 0, 0.18) 0px, transparent 40%),
    radial-gradient(at 100% 0%, rgba(0, 176, 255, 0.08) 0px, transparent 40%);
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
  padding: 1.5rem 3rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: rgba(2, 4, 8, 0.8);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid var(--border-subtle);
  position: sticky;
  top: 0;
  z-index: 100;
}

.nav-brand {
  font-weight: 800;
  font-size: 1.2rem;
  text-decoration: none;
  color: #fff;
  letter-spacing: -0.03em;
  display: flex;
  align-items: center;
  gap: 10px;
}

.brand-icon {
  width: 64px;
  height: 64px;
  object-fit: contain;
}

.nav-links {
  display: flex;
  gap: 2.5rem;
}

.nav-links a {
  text-decoration: none;
  color: var(--text-muted);
  font-size: 0.85rem;
  font-weight: 600;
  transition: var(--transition);
  letter-spacing: 0.02em;
}

.nav-links a:hover { 
  color: #fff; 
}

.nav-links a.active { 
  color: var(--accent-orange); 
}

/* Main Content */
.container {
  max-width: 900px;
  margin: 5rem auto;
  width: 100%;
  padding: 0 2rem;
}

header {
  text-align: center;
  margin-bottom: 3rem;
}

h1 {
  font-size: 2.5rem;
  font-weight: 800;
  margin: 0;
  letter-spacing: -0.05em;
  background: linear-gradient(to bottom, #fff 60%, #64748b);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.subtitle {
  color: var(--text-muted);
  font-size: 1rem;
  margin-top: 0.5rem;
  font-weight: 400;
}

/* Server Grid */
.server-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
  margin-bottom: 3rem;
}

@media (max-width: 768px) {
  .server-grid { 
    grid-template-columns: 1fr; 
  }
  
  nav {
    padding: 1rem 1.5rem;
  }
  
  .nav-links {
    gap: 1.5rem;
  }
  
  .nav-links a {
    font-size: 0.8rem;
  }
  
  .container {
    margin: 2rem auto;
    padding: 0 1rem;
  }
  
  h1 {
    font-size: 2rem;
  }
}

.server-card {
  position: relative;
  display: flex;
  flex-direction: column;
  padding: 1.75rem;
  background: var(--bg-card);
  border: 1px solid var(--border-subtle);
  border-radius: 18px;
  text-decoration: none;
  color: inherit;
  transition: var(--transition);
  overflow: hidden;
  cursor: pointer;
}

/* Hover glow effect */
.server-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at top right, var(--glow-color), transparent 70%);
  opacity: 0;
  transition: var(--transition);
  z-index: 0;
}

.server-card:hover {
  transform: translateY(-6px);
  border-color: var(--glow-color);
  box-shadow: 0 16px 32px rgba(0, 0, 0, 0.4);
}

.server-card:hover::before {
  opacity: 0.15;
}

.card-content {
  position: relative;
  z-index: 1;
}

.server-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 0.65rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: var(--glow-color);
  margin-bottom: 0.75rem;
}

.live-dot {
  width: 6px;
  height: 6px;
  background: var(--glow-color);
  border-radius: 50%;
  box-shadow: 0 0 8px var(--glow-color);
}

.server-name {
  font-size: 1.4rem;
  font-weight: 800;
  letter-spacing: -0.03em;
  margin-bottom: 1.5rem;
}

.card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: auto;
}

.action-text {
  font-size: 0.85rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 8px;
  color: #fff;
}

.arrow-icon {
  transition: var(--transition);
}

.server-card:hover .arrow-icon {
  transform: translateX(5px);
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
  transform: translateY(-6px);
  border-color: var(--glow-color);
  box-shadow: 0 16px 32px rgba(0, 0, 0, 0.4);
}

.server-card.active-card::before {
  opacity: 0.2;
}

.server-card.active-card .arrow-icon {
  transform: translateX(5px);
}

/* Info Section */
.info-footer {
  text-align: center;
  margin-bottom: 3rem;
}

.info-text {
  font-size: 0.8rem;
  color: var(--text-muted);
  background: rgba(255, 255, 255, 0.03);
  padding: 0.5rem 1rem;
  border-radius: 100px;
  display: inline-block;
  border: 1px solid var(--border-subtle);
}

/* Demos Container */
.demos-container {
  margin-top: 3rem;
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
  color: var(--text-muted);
  font-size: 13px;
  pointer-events: none;
}

.search-box input {
  width: 100%;
  padding: 12px 40px;
  background: var(--bg-card);
  border: 1px solid var(--border-subtle);
  border-radius: 10px;
  color: var(--text-main);
  font-family: inherit;
  font-size: 13px;
  outline: none;
  transition: var(--transition);
  backdrop-filter: blur(20px);
}

.search-box input::placeholder {
  color: var(--text-muted);
}

.search-box input:focus {
  border-color: var(--accent-orange);
  box-shadow: 0 0 0 3px rgba(255, 111, 0, 0.12);
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
  color: var(--text-muted);
  cursor: pointer;
  font-size: 11px;
  transition: var(--transition);
}

.search-clear.visible {
  display: flex;
}

.search-clear:hover {
  color: #fff;
  background: rgba(255, 255, 255, 0.06);
}

.demo-count {
  font-size: 0.8rem;
  color: var(--text-muted);
  font-weight: 600;
  white-space: nowrap;
}

/* Demo List */
.demo-list {
  width: 100%;
  max-width: 1200px;
  background: rgba(15, 23, 42, 0.4);
  border-radius: 16px;
  border: 1px solid var(--border-subtle);
  overflow: hidden;
  backdrop-filter: blur(30px);
  margin: 0 auto 2rem;
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
}

.demo-list-header {
  display: grid;
  grid-template-columns: 2.2fr 1.4fr 1fr 0.9fr;
  gap: 1rem;
  padding: 20px 32px;
  background: linear-gradient(135deg, rgba(255, 111, 0, 0.15) 0%, rgba(0, 176, 255, 0.1) 100%);
  border-bottom: 2px solid rgba(255, 111, 0, 0.3);
  text-transform: uppercase;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 1.5px;
  color: #ffffff;
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
  padding: 20px 32px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  transition: all 0.3s ease;
}

.demo-list-body .demo-row:last-child {
  border-bottom: none;
}

.demo-list-body .demo-row:nth-child(even) {
  background: rgba(255, 255, 255, 0.02);
}

.demo-list-body .demo-row:hover {
  background: linear-gradient(90deg, rgba(255, 111, 0, 0.08) 0%, rgba(255, 111, 0, 0.04) 100%);
  box-shadow: 0 4px 20px rgba(255, 111, 0, 0.1);
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
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 111, 0, 0.1);
  color: var(--accent-orange);
  font-size: 14px;
}

.demo-map-name {
  font-weight: 600;
  color: #ffffff;
  font-size: 14px;
  font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
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
  color: #b3b8c7;
}

/* Size column */
.demo-col-size {
  text-align: center;
}

.size-badge {
  display: inline-block;
  color: var(--accent-blue);
  font-weight: 600;
  font-size: 12px;
  background: rgba(0, 176, 255, 0.08);
  border: 1px solid rgba(0, 176, 255, 0.15);
  border-radius: 8px;
  padding: 6px 10px;
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
  color: var(--text-muted, #888);
  vertical-align: middle;
}

/* Button Styles */
.button {
  background: linear-gradient(135deg, var(--accent-orange) 0%, #ff8f00 100%);
  font-size: 11px;
  font-weight: 600;
  text-align: center;
  text-decoration: none;
  white-space: nowrap;
  display: inline-block;
  vertical-align: middle;
  padding: 8px 16px;
  border-radius: 6px;
  border: none;
  transition: var(--transition);
  cursor: pointer;
  user-select: none;
  color: #ffffff !important;
  min-width: 90px;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  box-shadow: 0 3px 12px rgba(255, 111, 0, 0.2);
  font-family: inherit;
  border: 1px solid rgba(255, 111, 0, 0.2);
}

.button:hover {
  background: linear-gradient(135deg, #e56300 0%, #ff7f00 100%);
  transform: translateY(-1px);
  box-shadow: 0 5px 15px rgba(255, 111, 0, 0.3);
  border-color: rgba(255, 111, 0, 0.4);
}

/* Footer Styles */
footer {
  margin-top: auto;
  padding: 3rem;
  text-align: center;
  font-size: 0.8rem;
  color: var(--text-muted);
  border-top: 1px solid var(--border-subtle);
  background: rgba(2, 4, 8, 0.8);
  backdrop-filter: blur(20px);
}

footer a {
  color: var(--accent-orange);
  text-decoration: none;
  font-weight: 600;
}

footer a:hover {
  color: #fff;
}

/* Utility Classes */
.flex {
  display: flex;
  justify-content: space-evenly;
}

.flex-jc\:center {
  justify-content: center;
}

.flex-jc\:space-between {
  justify-content: space-between;
}

.flex-jc\:end {
  justify-content: flex-end;
}

.flex-jc\:start {
  justify-content: flex-start;
}

.flex-ai\:center {
  align-items: center;
}

.flex-ai\:start {
  align-items: flex-start;
}

.flex-ai\:end {
  align-items: flex-end;
}

.flex-fd\:column {
  flex-direction: column;
}

.flex-wrap\:wrap {
  flex-wrap: wrap;
}

.flex\:11 {
  flex: 1;
  width: 100%;
}

.text\\:left {
  text-align: left !important;
}

.text\\:right {
  text-align: right !important;
}

.text\\:center {
  text-align: center !important;
}

/* Layout Container */
.layout_container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
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
    background: var(--bg-card);
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
  background: #ff8f00;
}

/* Small screen responsive adjustments */
@media (max-width: 480px) {
  nav {
    flex-direction: column;
    gap: 1rem;
    padding: 1rem;
  }
  
  .nav-links {
    gap: 1rem;
    flex-wrap: wrap;
    justify-content: center;
  }
  
  .container {
    margin: 1rem auto;
  }
  
  h1 {
    font-size: 1.8rem;
  }
  
  .server-card {
    padding: 1.25rem;
  }
  
  .server-name {
    font-size: 1.2rem;
  }
  
  footer {
    padding: 2rem 1rem;
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
  }

  .demo-list .button {
    width: 100%;
    justify-content: center;
    padding: 10px 16px;
    font-size: 11px;
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

/* Very large screens */
@media (min-width: 1200px) {
  .container {
    max-width: 1100px;
  }
  
  nav {
    padding: 2rem 4rem;
  }
  
  .server-grid {
    gap: 2rem;
  }
}

/* Dark mode adjustments for better contrast */
@media (prefers-color-scheme: dark) {
  :root {
    --text-main: #ffffff;
    --text-muted: #a1a1aa;
  }
}

/* Empty state styling */
.server .empty-state {
    text-align: center;
    padding: 60px 40px;
    color: var(--text-muted);
}

.server .empty-state i {
    font-size: 48px;
    margin-bottom: 20px;
    opacity: 0.3;
    color: var(--accent-orange);
}

.server .empty-state h3 {
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
  color: #b3b8c7;
}

.hidden {
  display: none !important;
}

