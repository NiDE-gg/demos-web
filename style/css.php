<?php
header('Content-type: text/css'); 
?> 

/* ======= Reset Styles ======= */

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* ======= Global Styles ======= */

html, body {
  height: 100%;
}

body {
  background: #0f1015;
  display: flex;
  min-height: 100vh;
  flex-direction: column;
  color: #efefef;
  font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 14px;
  line-height: 1.6;
  margin: 0;
  padding: 0;
}

.main-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  max-width: 1400px;
  margin: 0 auto;
  width: 100%;
  box-sizing: border-box;
}

a, .navbar .item, .subbar .item {
  color: inherit;
  text-decoration: none;
}

a:hover, .navbar .item:hover, .subbar .item:hover {
  color: #ff4700;
}

/* ======= Header Styles ======= */

.header {
  background: #0f1015;
  display: flex;
  align-items: center;
  height: 100px;
}

/* ======= Footer Styles ======= */

.footer {
  background-color: #13141b;
  margin-top: auto;
  width: 100%;
  color: #efefef;
}

.footer .layout_container {
  padding: 20px 15px;
  max-width: 1200px;
  margin: 0 auto;
}

.footer a {
  font-weight: 700;
  color: #ff4700;
  text-decoration: none;
}

.footer a:hover {
  color: #ff6700;
}

.footer span {
  margin-bottom: 5px;
  font-size: 13px;
}

.footer .fas {
  margin-right: 5px;
}

/* ======= Flex Styles ======= */

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

/* ======= Text Alignment Styles ======= */

.text\\:left {
  text-align: left !important;
}

.text\\:right {
  text-align: right !important;
}

.text\\:center {
  text-align: center !important;
}

/* ======= Layout Styles ======= */

.layout_container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
}

/* ======= Navbar Styles ======= */

.navbar {
  font-size: 16px;
  color: #fff;
  font-weight: 600;
  background: rgb(131, 58, 180);
  background: linear-gradient(45deg, #bb3400 0%, #FD6F01 70%, #FFB000 100%);
  margin-bottom: 15px;
}

.navbar .item {
  display: inline-block;
  padding: 15px;
  text-transform: uppercase;
  cursor: pointer;
}

.navbar .item:hover {
  background-color: rgba(255,255,255,0.1);
  color: #fff;
}

.navbar .item a:hover {
  color: #fff;
}

/* ======= Subbar Styles ======= */

.subbar {
  /* background-color: #0c0d10; */
  font-size: 15px;
  color: #fff;
  text-align: center;
  padding: 10px 0;
}

.subbar .item {
  display: inline-block;
  padding: 12px 24px;
  cursor: pointer;
  transition: all 0.3s ease;
  border-radius: 6px;
  margin: 0 4px;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  font-family: inherit;
  font-size: 14px;
  color: #d1d1d1;
  font-weight: 500;
}

.subbar .item:hover {
  background: rgba(255, 255, 255, 0.08);
  border-color: rgba(255, 255, 255, 0.2);
  color: #fff;
  transform: translateY(-1px);
}

.subbar .item.active {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-color: #667eea;
  color: #fff;
  box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.subbar .item.active:hover {
  background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

.subbar .item a:hover {
  color: #fff;
}

/* ======= Server Styles ======= */

.server {
  width: 100%;
  max-width: 1200px;
  margin: 20px auto;
  background: rgba(19, 20, 27, 0.95);
  border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
  overflow: hidden;
}

.server table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}

.server th {
  background: linear-gradient(135deg, #2c2d3a 0%, #1a1b24 100%);
  padding: 15px 20px;
  color: #e1e1e1;
  font-weight: 600;
  text-transform: uppercase;
  font-size: 12px;
  letter-spacing: 0.5px;
  border-bottom: 1px solid #3a3b4a;
}

.server td {
  padding: 15px 20px;
  border-bottom: 1px solid #2a2b38;
  vertical-align: middle;
  color: #d1d1d1;
}

.server tr:nth-child(even) {
  background: rgba(255, 255, 255, 0.02);
}

.server tr:hover {
  background: rgba(255, 255, 255, 0.05);
  transition: background 0.2s ease;
}

.server tbody tr:last-child td {
  border-bottom: none;
}

/* Mobile responsive design */
@media (max-width: 768px) {
  body {
    font-size: 13px;
  }

  .navbar {
    font-size: 14px;
  }

  .navbar .item {
    padding: 12px 10px;
    font-size: 12px;
  }

  .main-content {
    padding: 10px;
  }

  .server {
    margin: 10px 0;
    border-radius: 6px;
  }

  .server table {
    font-size: 13px;
  }

  .server th,
  .server td {
    padding: 8px 12px;
  }

  /* Hide date column on mobile */
  .server th:nth-child(2),
  .server td:nth-child(2) {
    display: none;
  }

  /* Adjust button column */
  .server th:nth-child(4),
  .server td:nth-child(4) {
    width: 80px;
    text-align: center;
  }

  .button {
    padding: 6px 12px;
    font-size: 11px;
    min-width: 70px;
  }
}

/* Very small screens */
@media (max-width: 480px) {
  .main-content {
    padding: 5px;
  }

  .server th,
  .server td {
    padding: 6px 8px;
    font-size: 12px;
  }

  /* Stack map and size info */
  .server td:nth-child(1) {
    max-width: 120px;
    word-break: break-word;
  }

  .server td:nth-child(3) {
    font-size: 11px;
  }

  .button {
    padding: 4px 8px;
    font-size: 10px;
    min-width: 60px;
    letter-spacing: 0;
  }

  /* Mobile server selection */
  .subbar {
    padding: 8px 5px;
  }

  .subbar .item {
    display: block;
    width: calc(100% - 10px);
    margin: 4px 5px;
    padding: 10px 16px;
    font-size: 13px;
    text-align: center;
  }

  .subbar .item:first-child {
    margin-top: 0;
  }

  .subbar .item:last-child {
    margin-bottom: 0;
  }

  /* Mobile info messages */
  .ipsMessage {
    padding: 12px 16px;
    font-size: 13px;
    margin-bottom: 15px;
  }

  .ipsWidget_inner {
    padding: 0 5px;
  }

  /* Mobile footer */
  .footer .layout_container {
    padding: 15px 10px;
  }

  .footer .flex {
    flex-direction: column;
    text-align: center !important;
  }

  .footer .flex > div {
    margin-bottom: 15px;
  }

  .footer .flex > div:last-child {
    margin-bottom: 0;
  }

  .footer span {
    font-size: 12px;
  }
}

/* ======= Button Styles ======= */

.button {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  font-size: 13px;
  font-weight: 600;
  text-align: center;
  text-decoration: none;
  white-space: nowrap;
  display: inline-block;
  vertical-align: middle;
  padding: 8px 16px;
  border-radius: 6px;
  border: none;
  transition: all 0.3s ease;
  cursor: pointer;
  user-select: none;
  color: #ffffff !important;
  min-width: 100px;
  letter-spacing: 0.3px;
  text-transform: uppercase;
  box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.button:hover {
  background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

/* ======= Tips Styles ======= */

.tipsArea {
  border-bottom: 1px solid #333;
  padding: 5px;
}

.tip {
  display: inline-block;
  background-color: #ff4700;
  color: #fff;
  padding: 5px;
  text-align: center;
  border-radius: 2px; 
  font-size: 13px;
}

/* ======= IpsMessage Styles ======= */

.ipsMessage_theme {
  background: #e07800;
}

.ipsMessage_general {
  background: #70767d;
}

.ipsMessage_info {
  background: #2981bf;
}

.ipsMessage_warning {
  background: #e06d22;
}

.ipsMessage_error {
  background: #ff0000;
}

.ipsMessage_success {
  background: #2a884b;
}

.ipsType_medium {
  font-size: 13.0px;
}

.ipsType_reset {
  margin: 0;
}

.ipsMargin_vertical, .ipsMargin_bottom {
  margin-bottom: 20px !important;
  margin-left: auto;
  margin-right: auto;
}

.ipsMessage, .ipsAnnouncement {
  border-radius: 4px;
  position: relative;
  margin-bottom: 12px;
  color: #fff;
  border: 1px solid rgba(0,0,0,0.1);
  box-shadow: inset rgb(255 255 255 / 10%) 0px 1px 0px;
  padding: 16px 48px 16px 48px;
  width: fit-content;
  font-size: medium;
}

.ipsWidget.ipsWidget_horizontal:not(.ipsWidgetHide) {
  margin-bottom: 10px;
}

.ipsBox, #ipsLayout_mainArea > .ipsForm[action$='do=edit'] > .ipsForm {
  box-shadow: 0px 2px 4px -1px #21232d, 0.1 );
  border-radius: 4px;
  background-color: rgb(12 13 16);
}

/* ======= Scrollbar Styles ======= */

/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 0;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #ff4700; 
  border-radius: 5px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #ff4700;
}

/* ======= Security Enhancement Styles ======= */

.error {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
    padding: 12px;
    border-radius: 4px;
    margin: 10px 0;
    text-align: center;
    font-weight: bold;
}

.security-info {
    background-color: #d1ecf1;
    border: 1px solid #bee5eb;
    color: #0c5460;
    padding: 10px;
    border-radius: 4px;
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
    background: rgba(255,255,255,0.9);
    color: #333;
    padding: 10px 20px;
    border-radius: 4px;
    border: 1px solid #ddd;
    z-index: 1000;
}
