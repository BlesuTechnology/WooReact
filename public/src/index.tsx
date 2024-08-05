// /* eslint-disable @typescript-eslint/ban-ts-comment */

console.log('staaaaart');
import { Test } from "./test";

// import React from "react";
import ReactDOM from "react-dom";


const waitForElementToRender = ({ selector, timeout = 5000 }: any) => {

	const checkElement = (resolve: any, reject: any) => {
		const element = document.querySelector(selector ?? "");
		if (element) {
			resolve(element);
		} else if (timeout <= 0) {
			reject(new Error(`Could not find element with selector ${selector}`));
		} else {
			setTimeout(checkElement, 100, resolve, reject);
		}
		timeout -= 100;
	};
	return new Promise(checkElement);

};


const createLogo = () => {

	// return new Promise<boolean>((resolve, reject): void => {

	waitForElementToRender({ selector: `.wc-block-checkout__contact-fields` }).then(async (hiddenInput: any) => {
		console.log(hiddenInput);

		waitForElementToRender({ selector: `.wc-block-checkout__form` }).then(async (billingSection: any) => {
			console.log(billingSection);
			const WooReactContainer = document.createElement("div");
			WooReactContainer.setAttribute("id", "WooReact");

			billingSection?.insertBefore(WooReactContainer, billingSection.firstChild);
			if (WooReactContainer) {

				waitForElementToRender({ selector: `#WooReact` }).then(async (container: any) => {
					console.log(container);



					try {

						// ReactDOM.render(
						// 	<Test />,
						// 	document.getElementById('WooReact')
						// );


					} catch (err) {
						console.log(err);
					}


				})
			}
		})

	});
	// })
}

window.addEventListener("load", () => {
	createLogo()
});




