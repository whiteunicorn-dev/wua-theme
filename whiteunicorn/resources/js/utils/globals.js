export const $win = $(window);
export const $doc = $(document);
export const $html = $("html");
export const $body = $("body");
export const $header = $("#site-header");
export const $nav = $("#site-navigation");
export const $navBtn = $header.find(".header-menu-btn");
export const $footer = $("#footer");
export const $siteContent = $("#content");
export const $main = $siteContent.find(".site-main");
export const isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

import eventsObj from "./helpers/events-obj";
export let events = eventsObj();