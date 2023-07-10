//import log from "../utils/helpers/console-log";
import { $win, $body, $nav, $navBtn, events } from "../utils/globals";

export default function navTrigger() {
	$navBtn.on("click", toggleMenu);
	$nav.find(".close-btn").on("click", closeMenu);            
	$win.resize(closeMenu);
	events.on("scroll_to_link_click", closeMenu);
	
	function toggleMenu() {
		$navBtn.toggleClass("active");
		$nav.toggleClass("open", $navBtn.hasClass("active"));
		$body.toggleClass("nav-open", $navBtn.hasClass("active"));
		$.scrollLock($navBtn.hasClass("active"));
	}
	function closeMenu() {
		$navBtn.removeClass("active");
		$nav.removeClass("open");
		$body.removeClass("nav-open");
		$.scrollLock(false);
	}
}