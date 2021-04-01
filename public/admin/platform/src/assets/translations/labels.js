import { ar } from "./ar";
import { en } from "./en";

const lang = document.getElementsByTagName('html')[0].getAttribute('lang')
export const labels = lang == 'ar' ? ar : en;