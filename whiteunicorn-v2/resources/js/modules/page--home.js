import { $body } from "../utils/globals";

export default function homePage() {
    if (!$body.hasClass("page-template-home")) { return; }
}