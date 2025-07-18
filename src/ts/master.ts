import * as M from "materialize-css";
import IMask from "imask";
let sidenav;

(() => {
	render();
	sidenav = M.Sidenav.init(document.querySelector(".sidenav"), {
		edge: "right",
	});

	document.querySelectorAll('[name="phone"]').forEach((el) => {
		IMask(el as HTMLInputElement, {
			mask: "+{7} (000) 000-0000",
		});
	});

	// Ссылки
	document.querySelectorAll(".scroll-link").forEach((link) => {
		(link as HTMLElement).addEventListener("click", scrollTo);
	});

	// Переключатель вкладок
	document.querySelectorAll(".tab").forEach((element) => {
		const el = element as HTMLElement;
		el.addEventListener("click", setTab);
	});

	// Регистрация
	document.querySelectorAll(".register").forEach((el) => {
		(el as HTMLElement).addEventListener("click", register);
	});

	document.querySelectorAll('.select').forEach(el => {
		(el as HTMLElement).addEventListener('mouseenter', showList);
		(el as HTMLElement).addEventListener('touchend', showList);
	});

	document.querySelectorAll('.select').forEach(el => {
		(el as HTMLElement).addEventListener('mouseleave', hideList);
	});

	document.querySelectorAll('.select .list li').forEach(el => {
		(el as HTMLElement).addEventListener('click', selectItem);
		(el as HTMLElement).addEventListener('touchend', selectItem);
	});

	// Готов участвовать
	(document.querySelector("#ready") as HTMLElement)?.addEventListener("click", ready);

	// Для кого форум
	document.querySelectorAll("[data-text]").forEach((el) => {
		(el as HTMLElement).addEventListener("click", fillPurpose);
	});

	initObserver();
})();

function showList(e:MouseEvent){
	e.preventDefault();
	this.classList.add('hover');
}

function hideList(e:MouseEvent){
	e.preventDefault();
	this.classList.remove('hover');
}

function selectItem(e:MouseEvent){
	e.preventDefault();
	const parent = parents(e.currentTarget as HTMLElement, 'select');
	const input = parent?.nextElementSibling as HTMLInputElement;
	const current = parent?.querySelector('.current span');
	input.value = current.textContent = this.textContent;
	parent.classList.remove('hover');
	e.stopPropagation();
}

function fillPurpose(e: MouseEvent) {
	e.preventDefault();
	const el = e.currentTarget as HTMLElement;
	const text = el.dataset["text"];
	const outputContainer = document.querySelector(".output-container");

	document.querySelectorAll("[data-text]").forEach((el) => {
		el.classList.remove("active");
	});

	el.classList.add("active");

	if (outputContainer) {
		outputContainer.innerHTML = "";
	}

	if (text) {
		for (let f = 0; f < text.length; f++) {
			const span = document.createElement("span");
			span.textContent = text[f];
			outputContainer?.appendChild(span);
		}
	}
}

function register(e: MouseEvent) {
	e.preventDefault();
	const el = e.currentTarget as HTMLElement;
	const form = parents(el, "FORM");

	if (form === undefined) return false;

	const formData = new FormData(form);
	const url = "../sender.php";

	form.querySelectorAll(`[name]`).forEach((input) => {
		input.classList.remove("error");
	});

	const phoneInput = form.querySelector('[name="phone"]') as HTMLInputElement;
	const phone = phoneInput?.value;

	const agreenment = form.querySelector("[type=checkbox]") as HTMLInputElement;
	const agreenmentValue = agreenment?.checked;

	if (agreenmentValue === false) {
		agreenment.classList.add("error");
		M.toast({ html: "Вы должны принять условия пользовательского соглашения!" });
		return;
	}

	if (phone.length < 17) {
		phoneInput.classList.add("error");
		M.toast({ html: "Неверный формат телефона" });
		return;
	}

	try {
		fetch(url, {
			method: "POST",
			body: formData,
		})
			.then((response) => response.json())
			.then((data) => {
				M.toast({ html: data.message });
				if (!data.success) {
					if (data.fields.length) {
						data.fields.forEach((field) => {
							form.querySelector(`[name='${field}']`)?.classList.add("error");
						});
					}
				} else {
					form.reset();
				}
			});
	} catch (error) {
		console.error(error);
		debugger;
	}
}

function parents(el: HTMLElement, selector: string) {
	let parent = el.parentElement;
	while (parent) {
		if (parent.tagName === selector || parent.classList.contains(selector) || parent.id == selector) return parent as HTMLFormElement;
		return parents(parent, selector);
	}
}

function ready(e: MouseEvent) {
	e.preventDefault();
	const form = document.querySelector("#almanac-form") as HTMLFormElement;
	form.scrollIntoView({ behavior: "smooth", block: "start", inline: "center" });
}

function setTab(e: MouseEvent) {
	e.preventDefault();
	debugger;
	const clickedTab = e.currentTarget as HTMLElement;
	document.querySelectorAll(".tab").forEach((tab) => {
		tab.classList.remove("active");
	});
	clickedTab.classList.add("active");
	const tabId = clickedTab.dataset["tab"];

	document.querySelectorAll(".tab-content").forEach((tc) => {
		tc.classList.remove("active");
	});

	document.querySelectorAll(".tab-description").forEach((td) => {
		td.classList.remove("active");
	});

	document.querySelector(`.tab-content.${tabId}`)?.classList.add("active");
	document.querySelector(`.tab-description.${tabId}`)?.classList.add("active");
}

function initObserver() {
	// Установка активных пунктов навигации
	const hero = document.querySelector("#hero") as HTMLElement;
	const about = document.querySelector("#about") as HTMLElement;
	const purpose = document.querySelector("#purpose") as HTMLElement;
	const includes = document.querySelector("#includes") as HTMLElement;
	const discuss = document.querySelector("#discuss") as HTMLElement;
	const invitation = document.querySelector("#invitation") as HTMLElement;
	const partnership = document.querySelector("#partnership") as HTMLElement;
	const partners = document.querySelector("#partners") as HTMLElement;
	const almanac = document.querySelector("#almanac") as HTMLElement;

	const observer = new IntersectionObserver(intersect, {
		threshold: 0.5,
	});

	hero != null ? observer.observe(hero) : () => {};
	about != null ? observer.observe(about) : () => {};
	purpose != null ? observer.observe(purpose) : () => {};
	includes != null ? observer.observe(includes) : () => {};
	discuss != null ? observer.observe(discuss) : () => {};
	invitation != null ? observer.observe(invitation) : () => {};
	partnership != null ? observer.observe(partnership) : () => {};
	partners != null ? observer.observe(partners) : () => {};
	almanac != null ? observer.observe(almanac) : () => {};
}

function scrollTo(e: MouseEvent) {
	e.preventDefault();
	const link = e.currentTarget as HTMLAnchorElement;
	const hash = new URL(link.href).hash;
	const element = document.querySelector(hash);
	if (element) {
		element.scrollIntoView({ behavior: "smooth", block: "start", inline: "center" });
	}
	sidenav.close();
}

function intersect(entries: IntersectionObserverEntry[], observer: IntersectionObserver) {
	entries.forEach((entry) => {
		const id = entry.target.id;

		if (entry.isIntersecting) {
			switch (true) {
				case id === "discuss" || id === "includes":
					document.querySelectorAll("nav a").forEach((link) => {
						link.classList.remove("active");
					});

					document.querySelectorAll(`[href="#purpose"]`).forEach((link) => {
						link.classList.add("active");
					});
					break;
				case id === "partner-form" || id === "partnership":
					document.querySelectorAll("nav a").forEach((link) => {
						link.classList.remove("active");
					});

					document.querySelectorAll(`[href="#partnership"]`).forEach((link) => {
						link.classList.add("active");
					});
					break;
				default:
					document.querySelectorAll("nav a").forEach((link) => {
						link.classList.remove("active");
					});

					document.querySelectorAll(`[href="#${id}"]`).forEach((link) => {
						link.classList.add("active");
					});
					break;
			}
		}
	});
}

function render() {
	// Установка цвета фона хедера и степени размытия фона
	const min = 0;
	const max = window.innerHeight * 2;
	const current = document.documentElement.scrollTop;
	const percentage = (current - min) / (max - min);
	const red = 0;
	const green = 7;
	const blue = 13;
	let alpha = percentage;
	if (alpha > 0.5) {
		alpha = 0.5;
	}
	const color = `rgba(${red}, ${green}, ${blue}, ${alpha})`;
	const header = document.querySelector("header") as HTMLElement;
	const blur = 12 * alpha;
	header.style.backgroundColor = color;
	header.style.backdropFilter = `blur(${blur}px)`;

	requestAnimationFrame(render);
}
